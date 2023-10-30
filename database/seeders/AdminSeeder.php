<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (! DB::table('users')->count()) {
            User::factory()->create([
                'name' => 'admin',
                'password' => Hash::make('q12345'),
            ]);
        }
    }
}
