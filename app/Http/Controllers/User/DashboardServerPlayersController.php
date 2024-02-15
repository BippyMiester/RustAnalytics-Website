<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Battlemetrics\Player;
use App\Models\PlayerConnections;
use App\Models\ProxyCheckIO\ProxyCheck;
use App\Models\Server;
use App\Models\ServerData;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use proxycheck\proxycheck as ProxyCheckAPI;

class DashboardServerPlayersController extends Controller
{

    protected $proxyCheckCollection;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function index(Request $request, string $slug) {
        $server = Server::where('slug', $slug)->where('user_id', Auth::id())->first();

        if($server) {

            $uniquePlayers = PlayerConnections::select('steam_id', DB::raw('MAX(id) as latest_id'))
                ->where('server_id', $server->id)
                ->groupBy('steam_id')
                ->pluck('latest_id');

            $players = PlayerConnections::whereIn('id', $uniquePlayers)
                ->orderBy('username')
                ->paginate(24);

            return view('user.dashboard.server.players.index')
                ->withServer($server)
                ->withPlayers($players);
        }

        return abort(404);
    }

    public function show(Request $request, string $slug, string $steam_id) {
        $server = Server::where('slug', $slug)->where('user_id', Auth::id())->first();
        $player = PlayerConnections::where('server_id', $server->id)->where('steam_id', $steam_id)->first();

        if($server && $player) {
            $playerIPs = PlayerConnections::where('server_id', $server->id)
                ->where('steam_id', $steam_id)
                ->distinct()
                ->pluck('ip_address');

            $this->CheckIPAddresses($playerIPs);

            $playerLastConnection = PlayerConnections::where('server_id', $server->id)
                ->where('steam_id', $steam_id)
                ->orderBy('created_at', 'desc') // Order by creation time, most recent first
                ->first();

            $this->getBattleMetricsInformation($player->steam_id);

            $battlemetricsPlayer = Player::where('steam_id', $player->steam_id)->first();

            return view('user.dashboard.server.players.show')
                ->withServer($server)
                ->withPlayer($player)
                ->withProxyCheckCollection($this->proxyCheckCollection)
                ->withPlayerLastConnection($playerLastConnection)
                ->withBattlemetricsPlayer($battlemetricsPlayer);
        }

        return abort(404);
    }

    private function getBattleMetricsInformation(string $steamID)
    {
        $player = Player::where('steam_id', $steamID)->first();
        if($player) return $player;

        $client = new Client();

        $jsonData = [
            "data" => [
                [
                    "type" => "identifier",
                    "attributes" => [
                        "type" => "steamID",
                        "identifier" => $steamID
                    ]
                ]
            ]
        ];

        $bearerToken = env('BATTLEMETRICS_API_KEY');

        try {
            $response = $client->request('POST', 'https://api.battlemetrics.com/players/match', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $bearerToken,
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ],
                'json' => $jsonData
            ]);

            $statusCode = $response->getStatusCode();
            $body = $response->getBody()->getContents();

            $this->CreateNewBattlemetricsPlayer(json_decode($body, true));

            // Process the response
            return response()->json([
                'status' => $statusCode,
                'data' => json_decode($body, true)
            ]);

        } catch (GuzzleException $e) {
            // Handle exception
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    private function CreateNewBattlemetricsPlayer($data)
    {
        $player = Player::where('battlemetrics_id', $data["data"][0]['id'])->first();
        if($player) return;

        $player = new Player;
        $data = $data["data"][0];
        $attributes = $data['attributes'];
        $profile = $attributes['metadata']['profile'];
        $bans = $attributes['metadata']['bans'];

        $player->battlemetrics_id = $data['id'];
        $player->steam_id = $attributes['identifier'];

        $profile_status = "public";
        if($attributes['private'] == true) {
            $profile_status = "private";
        }
        $player->profile_status = $profile_status;
        $player->username = $profile['personaname'];
        $player->profile_url = $profile['profileurl'];
        $player->steam_avatar = $profile['avatarfull'];

        $player->vac_banned = $bans['VACBanned'];
        $player->vac_ban_count = $bans['NumberOfVACBans'];
        $player->community_banned = $bans['CommunityBanned'];
        $player->days_since_last_ban = $bans['DaysSinceLastBan'];
        $player->game_bans_count = $bans['NumberOfGameBans'];

        $player->save();
    }

    private function CheckIPAddresses($playerIPs)
    {
        $proxycheck_options = array(
            'API_KEY' => env('PROXY_CHECK_API_KEY'), // Your API Key.
            'ASN_DATA' => 1, // Enable ASN data response.
            'DAY_RESTRICTOR' => 7, // Restrict checking to proxies seen in the past # of days.
            'VPN_DETECTION' => 1, // Check for both VPN's and Proxies instead of just Proxies.
            'RISK_DATA' => 1, // 0 = Off, 1 = Risk Score (0-100), 2 = Risk Score & Attack History.
            'INF_ENGINE' => 1, // Enable or disable the real-time inference engine.
            'TLS_SECURITY' => 0, // Enable or disable transport security (TLS).
            'QUERY_TAGGING' => 1, // Enable or disable query tagging.
            'MASK_ADDRESS' => 0, // Anonymises the local-part of an email address (e.g. anonymous@domain.tld)
            'BLOCKED_COUNTRIES' => array('Wakanda', 'WA'), // Specify an array of countries or isocodes to be blocked.
            'ALLOWED_COUNTRIES' => array('Azeroth', 'AJ') // Specify an array of countries or isocodes to be allowed.
        );

        $this->proxyCheckCollection = new Collection();

        foreach($playerIPs as $ip) {
            //$ip = "73.236.115.130";
            //$ip = "127.0.0.1";
            // I noticed you're using $testIP inside the loop, assuming you meant to use $ip from your loop iteration
            $proxyCheck = ProxyCheck::where('ip_address', $ip)->first();

            if($proxyCheck) {
                // Assuming $proxyCheck->updated_at is already a Carbon instance
                $updated_at = $proxyCheck->updated_at instanceof Carbon ? $proxyCheck->updated_at : new Carbon($proxyCheck->updated_at);

                if ($updated_at->lt(Carbon::now()->subWeeks(2))) {
                    $result_array = ProxyCheckAPI::check($ip, $proxycheck_options);
                    $proxyCheck = $this->UpdateProxyCheck($result_array, $proxyCheck);
                    // Add $proxyCheck to collection
                    $this->proxyCheckCollection->push($proxyCheck);
                } else {
                    // If the proxy check is less than 2 weeks old, we still want to add it to the collection
                    $this->proxyCheckCollection->push($proxyCheck);
                    continue;
                }
            } else {
                $result_array = ProxyCheckAPI::check($ip, $proxycheck_options);
                $proxyCheck = $this->CreateProxyCheck($result_array, $ip);
                // Add $proxyCheck to collection
                $this->proxyCheckCollection->push($proxyCheck);
            }
        }
    }

    private function UpdateProxyCheck($result_array, $proxyCheck)
    {
        // Check if the results array is valid
        if($result_array['status'] == "error") return;

        $keys = array_keys($result_array);
        $ipInfo = $result_array[$keys[2]];

        $proxyCheck = new ProxyCheck;
        $proxyCheck->asn = $ipInfo['asn'];
        $proxyCheck->range = $ipInfo['range'];
        $proxyCheck->provider = $ipInfo['provider'];
        $proxyCheck->continent = $ipInfo['continent'];
        $proxyCheck->continent_code = $ipInfo['continentcode'];
        $proxyCheck->country = $ipInfo['country'];
        $proxyCheck->isocode = $ipInfo['isocode'];
        $proxyCheck->region = $ipInfo['region'];
        $proxyCheck->regioncode = $ipInfo['regioncode'];
        $proxyCheck->timezone = $ipInfo['timezone'];
        $proxyCheck->city = $ipInfo['city'];
        $proxyCheck->postcode = $ipInfo['postcode'];
        $proxyCheck->latitude = $ipInfo['latitude'];
        $proxyCheck->longitude = $ipInfo['longitude'];
        $proxyStatus = ($ipInfo['proxy'] == "no") ? false : true;
        $proxyCheck->proxy = $proxyStatus;
        $proxyCheck->type = $ipInfo['type'];
        $proxyCheck->risk = $ipInfo['risk'];
        $blockStatus = ($result_array['block'] == "no") ? false : true;
        $proxyCheck->blocked = $blockStatus;
        $proxyCheck->block_reason = $result_array['block_reason'];
        $proxyCheck->save();
    }

    private function CreateProxyCheck($result_array, $ip_address)
    {
        // Check if the results array is valid
        if($result_array['status'] == "error") return;

        $keys = array_keys($result_array);
        $ipInfo = $result_array[$keys[2]];

        $proxyCheck = new ProxyCheck;
        $proxyCheck->asn = $ipInfo['asn'];
        $proxyCheck->ip_address = $ip_address;
        $proxyCheck->range = $ipInfo['range'];
        $proxyCheck->provider = $ipInfo['provider'];
        $proxyCheck->continent = $ipInfo['continent'];
        $proxyCheck->continent_code = $ipInfo['continentcode'];
        $proxyCheck->country = $ipInfo['country'];
        $proxyCheck->isocode = $ipInfo['isocode'];
        $proxyCheck->region = $ipInfo['region'];
        $proxyCheck->regioncode = $ipInfo['regioncode'];
        $proxyCheck->timezone = $ipInfo['timezone'];
        $proxyCheck->city = $ipInfo['city'];
        $proxyCheck->postcode = $ipInfo['postcode'];
        $proxyCheck->latitude = $ipInfo['latitude'];
        $proxyCheck->longitude = $ipInfo['longitude'];
        $proxyStatus = ($ipInfo['proxy'] == "no") ? false : true;
        $proxyCheck->proxy = $proxyStatus;
        $proxyCheck->type = $ipInfo['type'];
        $proxyCheck->risk = $ipInfo['risk'];
        $blockStatus = ($result_array['block'] == "no") ? false : true;
        $proxyCheck->blocked = $blockStatus;
        $proxyCheck->block_reason = $result_array['block_reason'];
        $proxyCheck->save();

        return $proxyCheck;
    }
}
