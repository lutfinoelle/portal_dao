<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'   => 'Administator',
            'no_pn'  => '1337',
            'role'   => 'ADMIN',
            'password' => Hash::make('123456')
        ]);
    }
}
