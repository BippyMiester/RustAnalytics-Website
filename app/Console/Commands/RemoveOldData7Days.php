<?php

namespace App\Console\Commands;

use App\Models\DestroyedBuildings;
use App\Models\DestroyedContainers;
use App\Models\PlacedDeployables;
use App\Models\PlacedStructures;
use App\Models\WeaponFire;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class RemoveOldData7Days extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ra:removeolddata7days';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Removes data from the database that is more then 7 days old.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $days = 7;
        // Calculate the date for the comparison
        $cutOffDate = Carbon::now()->subDays($days);
        $log = Log::channel('commands');
        $logMsg = "";

        $logMsg .= "Command: ra.removeolddata7days\n";
        $logMsg .= "Deleting old data thats more then {$days} days old.\n";
        $logMsg .= "Date Time: " . Carbon::now()->format('H:i:s | m-d-y') . "\n";
        $logMsg .= "==========================\n";

        $logMsg .= "Clearing Weapon Fire...\n";
        $count = WeaponFire::where('created_at', '<', $cutOffDate)->count();
        $logMsg .= "Removing {$count} entries!\n";
        WeaponFire::where('created_at', '<', $cutOffDate)->delete();
        $logMsg .= "Weapon Fire Table has been trimmed.\n";
        $logMsg .= "==========================\n";

        $logMsg .= "Clearing Destroyed Buildings...\n";
        $count = DestroyedBuildings::where('created_at', '<', $cutOffDate)->count();
        $logMsg .= "Removing {$count} entries!\n";
        DestroyedBuildings::where('created_at', '<', $cutOffDate)->delete();
        $logMsg .= "Destroyed Buildings Table has been trimmed.\n";

        $logMsg .= "Clearing Destroyed Containers...\n";
        $count = DestroyedContainers::where('created_at', '<', $cutOffDate)->count();
        $logMsg .= "Removing {$count} entries!\n";
        DestroyedContainers::where('created_at', '<', $cutOffDate)->delete();
        $logMsg .= "Destroyed Containers Table has been trimmed.\n";

        $logMsg .= "Clearing Placed Deployables...\n";
        $count = PlacedDeployables::where('created_at', '<', $cutOffDate)->count();
        $logMsg .= "Removing {$count} entries!\n";
        PlacedDeployables::where('created_at', '<', $cutOffDate)->delete();
        $logMsg .= "Placed Deployables Table has been trimmed.\n";



        $log->info($logMsg);

    }
}
