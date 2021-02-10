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
        $pages[] = ['slug' =>'main', 'title'=> ['en' => 'Main']];
        $pages[] = [ 'slug' => 'about', 'title' => ['en' =>'About']];
        $pages[] = [ 'slug' => 'sellers', 'title' => ['en' => 'For Sellers']];
        $pages[] = [ 'slug' => 'buyers', 'title' => ['en' => 'For Buyers']];
        $pages[] = [ 'slug' => 'contacts', 'title' => ['en' => 'Contacts']];
        $pages[] = [ 'slug' => 'faq', 'title' => ['en' => 'Faq']];
        $pages[] = [ 'slug' => 'story', 'title' => ['en' => 'Create your story']];

        foreach ($pages as $page) {
            Page::create(['slug'=> $page['slug'], 'title' => $page['title']]);
        }
    }
}
