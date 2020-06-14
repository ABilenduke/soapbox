<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Category;

class AddCategories extends Command
{
    protected $categories = [
        "animals",
        "art",
        "culture",
        "current_events",
        "health",
        "history",
        "how_to",
        "humour",
        "music",
        "nature",
        "science",
        "sports"
    ];

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'soapbox:addCategories';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'A command to add the categories to the database.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('***** ADDING CATEGORIES NOW! *****');
        
        foreach($this->categories as $category) {
            if (!Category::where('title', $category)->exists()) {
                Category::create(['title' => $category]);
                $this->info(">>> '$category' was added");
            } else {
                Category::where('title', $category)->update(['title' => $category]);
                $this->info(">>> '$category' was updated");
            }
        }

        $this->info('***** FINISHED! ALL CATEGORIES ADDED! *****');
    }
}
