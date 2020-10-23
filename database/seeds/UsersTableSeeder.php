<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->create([
            'name' => 'Адиминистратор',
            'email' => config('admin.email'),
            'role' => 'admin'
        ]);

        if (config('app.env') === 'local') {
            factory(User::class, 5)->create();

            factory(User::class, 5)->create([
                'role' => 'seller'
            ]);
        }
    }
}
