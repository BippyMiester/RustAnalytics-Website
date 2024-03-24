<?php

namespace App\Console\Commands;

use App\Models\PlacedStructures;
use App\Models\PlayerData;
use App\Models\ServerData;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class RemoveOldData1Days extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ra:removeolddata1days';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Removes data from the database that is more then 1 days old.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $days = 1;
        // Calculate the date for the comparison
        $cutOffDate = Carbon::now()->subDays($days);
        $log = Log::channel('commands');
        $logMsg = "";

        $logMsg .= "Command: ra.removeolddata1days\n";
        $logMsg .= "Deleting old data thats more then {$days} days old.\n";
        $logMsg .= "Date Time: " . Carbon::now()->format('H:i:s | m-d-y') . "\n";
        $logMsg .= "==========================\n";

        $logMsg .= "Clearing Server Data...\n";
        $count = ServerData::where('created_at', '<', $cutOffDate)->count();
        $logMsg .= "Removing {$count} entries!\n";
        ServerData::where('created_at', '<', $cutOffDate)->delete();
        $logMsg .= "Server Data Table has been trimmed.\n";
        $logMsg .= "==========================\n";

        $logMsg .= "Clearing Player Data...\n";
        $count = PlayerData::where('created_at', '<', $cutOffDate)->count();
        $logMsg .= "Removing {$count} entries!\n";
        PlayerData::where('created_at', '<', $cutOffDate)->delete();
        $logMsg .= "Player Data Table has been trimmed.\n";
        $logMsg .= "==========================\n";

        $logMsg .= "Clearing Placed Structures...\n";
        $count = PlacedStructures::where('created_at', '<', $cutOffDate)->count();
        $logMsg .= "Removing {$count} entries!\n";
        PlacedStructures::where('created_at', '<', $cutOffDate)->delete();
        $logMsg .= "Placed Structures Table has been trimmed.\n";

        $log->info($logMsg);
    }
}
