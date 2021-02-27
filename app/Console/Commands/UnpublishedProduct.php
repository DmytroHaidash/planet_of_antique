<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class UnpublishedProduct extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'product:unpublish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Unpublish product if finish user premium';

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
        $users = User::where('role', 'seller')->whereNotNull('premium')->where('premium', '<', now())->get();
        if($users){
            foreach ($users as $user){
                $products = $user->shop->products->skip(app('settings')->ads_per_user);
                if($products){
                    foreach($products as $product){
                        $product->update(['is_published' => 0]);
                    }
                }
            }
        }

        return 0;
    }
}
