<?php

namespace App\Console\Commands;

use App\Models\AnimalKills;
use App\Models\DestroyedBuildings;
use App\Models\DestroyedContainers;
use App\Models\PlacedDeployables;
use App\Models\PlacedStructures;
use App\Models\PlayerCrafting;
use App\Models\PlayerDeaths;
use App\Models\PlayerKills;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class RemoveOldData30Days extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ra:removeolddata30days';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Removes data from the database that is more then 30 days old.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $days = 30;
        // Calculate the date for the comparison
        $cutOffDate = Carbon::now()->subDays($days);
        $log = Log::channel('commands');
        $logMsg = "";

        $logMsg .= "Command: ra.removedolddata30days\n";
        $logMsg .= "Deleting old data thats more then {$days} days old.\n";
        $logMsg .= "Date Time: " . Carbon::now()->format('H:i:s | m-d-y') . "\n";
        $logMsg .= "==========================\n";

        $logMsg .= "Clearing Animal Kills...\n";
        $count = AnimalKills::where('created_at', '<', $cutOffDate)->count();
        $logMsg .= "Removing {$count} entries!\n";
        AnimalKills::where('created_at', '<', $cutOffDate)->delete();
        $logMsg .= "Animal Kills Table has been trimmed.\n";

        $logMsg .= "Clearing Player Crafting...\n";
        $count = PlayerCrafting::where('created_at', '<', $cutOffDate)->count();
        $logMsg .= "Removing {$count} entries!\n";
        PlayerCrafting::where('created_at', '<', $cutOffDate)->delete();
        $logMsg .= "Player Crafting Table has been trimmed.\n";

        $logMsg .= "Clearing Player Deaths...\n";
        $count = PlayerDeaths::where('created_at', '<', $cutOffDate)->count();
        $logMsg .= "Removing {$count} entries!\n";
        PlayerDeaths::where('created_at', '<', $cutOffDate)->delete();
        $logMsg .= "Player Deaths Table has been trimmed.\n";

        $logMsg .= "Clearing Player Kills...\n";
        $count = PlayerKills::where('created_at', '<', $cutOffDate)->count();
        $logMsg .= "Removing {$count} entries!\n";
        PlayerKills::where('created_at', '<', $cutOffDate)->delete();
        $logMsg .= "Player Kills Table has been trimmed.\n";

        $logMsg .= "==========================\n";

        $log->info($logMsg);

    }
}
