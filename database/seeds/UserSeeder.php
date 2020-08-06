<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->insert([
            'username' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
            'email_verified_at' => \Carbon\Carbon::now(),
            'titles' => 'adminTitle',
            'honorific' => 'Herr',
            'title' => 'Dr.',
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'pharmacy' => 'Admin',
            'street' => 'Admin',
            'address' => 'Admin',
            'postal' => 'Admin',
            'city' => 'Admin',
            'phone' => 'Admin',
            'fax' => 'Admin',
            'subscribed' => 0,
            'active' => 1,
            'is_admin' => 1,
        ]);
    }
}
