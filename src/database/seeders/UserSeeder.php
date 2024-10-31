<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $encryptedPassword = Hash::make('thisisatest');
        
        User::create([
            'login_id' => 'admin01',
            'password' => $encryptedPassword,
            'role' => 1,
        ]);
    }
}
