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

        $this->info("Deleting old data thats more then {$days} days old.");

        $this->info("Clearing Animal Kills...");
        $count = AnimalKills::where('created_at', '<', $cutOffDate)->count();
        $this->info("Removing {$count} entries!");
        AnimalKills::where('created_at', '<', $cutOffDate)->delete();
        $this->info("Animal Kills Table has been trimmed.");
        $this->info("==========================");

        $this->info("Clearing Destroyed Buildings...");
        $count = DestroyedBuildings::where('created_at', '<', $cutOffDate)->count();
        $this->info("Removing {$count} entries!");
        DestroyedBuildings::where('created_at', '<', $cutOffDate)->delete();
        $this->info("Destroyed Buildings Table has been trimmed.");
        $this->info("==========================");

        $this->info("Clearing Destroyed Containers...");
        $count = DestroyedContainers::where('created_at', '<', $cutOffDate)->count();
        $this->info("Removing {$count} entries!");
        DestroyedContainers::where('created_at', '<', $cutOffDate)->delete();
        $this->info("Destroyed Containers Table has been trimmed.");
        $this->info("==========================");

        $this->info("Clearing Placed Deployables...");
        $count = PlacedDeployables::where('created_at', '<', $cutOffDate)->count();
        $this->info("Removing {$count} entries!");
        PlacedDeployables::where('created_at', '<', $cutOffDate)->delete();
        $this->info("Placed Deployables Table has been trimmed.");
        $this->info("==========================");

        $this->info("Clearing Placed Structures...");
        $count = PlacedStructures::where('created_at', '<', $cutOffDate)->count();
        $this->info("Removing {$count} entries!");
        PlacedStructures::where('created_at', '<', $cutOffDate)->delete();
        $this->info("Placed Structures Table has been trimmed.");
        $this->info("==========================");

        $this->info("Clearing Player Crafting...");
        $count = PlayerCrafting::where('created_at', '<', $cutOffDate)->count();
        $this->info("Removing {$count} entries!");
        PlayerCrafting::where('created_at', '<', $cutOffDate)->delete();
        $this->info("Player Crafting Table has been trimmed.");
        $this->info("==========================");

        $this->info("Clearing Player Deaths...");
        $count = PlayerDeaths::where('created_at', '<', $cutOffDate)->count();
        $this->info("Removing {$count} entries!");
        PlayerDeaths::where('created_at', '<', $cutOffDate)->delete();
        $this->info("Player Deaths Table has been trimmed.");
        $this->info("==========================");

        $this->info("Clearing Player Kills...");
        $count = PlayerKills::where('created_at', '<', $cutOffDate)->count();
        $this->info("Removing {$count} entries!");
        PlayerKills::where('created_at', '<', $cutOffDate)->delete();
        $this->info("Player Kills Table has been trimmed.");
        $this->info("==========================");

    }
}
