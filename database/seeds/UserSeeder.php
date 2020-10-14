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
            'username' => 'mpadmin',
            'email' => 'mpadmin@mp-resource.com',
            'password' => Hash::make('esist+mpRAadm1n'),
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
