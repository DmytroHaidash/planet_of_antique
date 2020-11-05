<?php

use App\Models\Page;
use Illuminate\Database\Seeder;

class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pages[] = [ 'slug' => 'about', 'title' => 'About'];
        $pages[] = [ 'slug' => 'sellers', 'title' => 'For Sellers'];
        $pages[] = [ 'slug' => 'buyers', 'title' => 'For Buyers'];
        $pages[] = [ 'slug' => 'contacts', 'title' => 'Contacts'];

        foreach ($pages as $page) {
            Page::create(['slug'=> $page['slug'], 'title' => $page['title']]);
        }
    }
}
