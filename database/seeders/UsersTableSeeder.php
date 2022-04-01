<?php

declare(strict_types=1);

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run(): void
    {
        $adminUser = User::create([
            'name' =>  'admin',
            'email' =>  'admin@admin.com',
            'type' =>  'admin',
            'password' =>  Hash::make(12345678),
            'email_verified_at' => Carbon::now(),
            'remember_token' => Str::random(10)
        ]);

        $adminUser->createToken('some token')->accessToken;

        User::create([
            'name' =>  'client',
            'email' =>  'user@app.com',
            'type' =>  'customer',
            'password' =>  Hash::make(12345678),
            'email_verified_at' => Carbon::now(),
            'remember_token' => Str::random(10)
        ]);
    }
}
