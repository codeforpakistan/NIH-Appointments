<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin', 
            'email' => 'admin@example.com', 
            'email_verified_at' => now(),
            'password' => Hash::make('admin'), 
            'remember_token' => Str::random(10),
        ]);

        $admin = App\User::find(1);
        $admin->assignRole('admin');

        factory(App\User::class, 2)->create()->each(function ($user) {
            $user->assignRole('staff');
        });

        factory(App\User::class, 3)->create()->each(function ($user) {
            $user->assignRole('agent');
        });

        factory(App\User::class, 5)->create()->each(function ($user) {
            $user->assignRole('caller');
        });
    }
}
