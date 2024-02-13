<?php

namespace App\Console\Commands;

use App\Models\PlayerData;
use App\Models\ServerData;
use Carbon\Carbon;
use Illuminate\Console\Command;

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

        $this->info("Deleting old data thats more then {$days} days old.");

        $this->info("Clearing Server Data...");
        $count = ServerData::where('created_at', '<', $cutOffDate)->count();
        $this->info("Removing {$count} entries!");
        ServerData::where('created_at', '<', $cutOffDate)->delete();
        $this->info("Server Data Table has been trimmed.");
        $this->info("==========================");

        $this->info("Clearing Player Data...");
        $count = PlayerData::where('created_at', '<', $cutOffDate)->count();
        $this->info("Removing {$count} entries!");
        PlayerData::where('created_at', '<', $cutOffDate)->delete();
        $this->info("Player Data Table has been trimmed.");
        $this->info("==========================");
    }
}
