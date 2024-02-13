<?php

namespace App\Console\Commands;

use App\Models\WeaponFire;
use Carbon\Carbon;
use Illuminate\Console\Command;

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

        $this->info("Deleting old data thats more then {$days} days old.");

        $this->info("Clearing Weapon Fire...");
        $count = WeaponFire::where('created_at', '<', $cutOffDate)->count();
        $this->info("Removing {$count} entries!");
        WeaponFire::where('created_at', '<', $cutOffDate)->delete();
        $this->info("Weapon Fire Table has been trimmed.");
        $this->info("==========================");


    }
}
