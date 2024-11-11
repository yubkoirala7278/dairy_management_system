<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('11111'),
            'owner_name' => 'admin',
            'farmer_number' => 0,
            'location' => 'mahuli',
            'gender' => 'पुरुष',
            'status' => 'चालू',
            'phone_number' => '987654321',
            'pan_number' => '1111',
            'vat_number' => '1111'
        ]);
        $user->assignRole('admin');
    }
}
