<?php

namespace App\Console\Commands;

use App\Models\Page;
use Illuminate\Console\Command;

class CreateNewStaticPage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'new:pages';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command ti create new static page';

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
     * @return int
     */
    public function handle()
    {
        Page::create([
            'slug' => 'new-museum',
            'title' => ['en' => 'Create your museum'],
        ]);
        Page::create([
            'slug' => 'new-items',
            'title' => ['en' => 'New items'],
        ]);
        Page::create([
            'slug' => 'recommended',
            'title' => ['en' => 'Recommended'],
        ]);
        Page::create([
            'slug' => 'sellers',
            'title' => ['en' => 'Sellers'],
        ]);
        Page::create([
            'slug' => 'museums',
            'title' => ['en' => 'Museums'],
        ]);
        Page::create([
            'slug' => 'museum-items',
            'title' => ['en' => 'Museum items'],
        ]);

    }
}
