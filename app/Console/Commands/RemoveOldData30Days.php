<?php

namespace App\Console\Commands;

use App\Models\AnimalKills;
use Carbon\Carbon;
use Illuminate\Console\Command;

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
        $days = 10;
        // Get all of the models that need to be trimmed
        $this->info("Deleting old data thats more then {$days} days old.");
        AnimalKills::where('created_at', '<', Carbon::now()->subDays($days))->delete();
    }
}
