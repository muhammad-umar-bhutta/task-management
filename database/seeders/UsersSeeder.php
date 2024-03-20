<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(30)->create()->each(function ($user) {
            // Seed user addresses
            $numberOfAddresses = rand(0, 2); // Randomly generate 0, 1, or 2 addresses per user
            if ($numberOfAddresses > 0) {
                // Create an array to store the addresses for this user
                $addresses = [];
        
                // Generate unique addresses
                for ($i = 0; $i < $numberOfAddresses; $i++) {
                    $addresses[] = UserAddress::factory()->make()->address;
                }
        
                // Check if we need to duplicate some addresses
                $numberOfDuplicates = rand(0, 2); // Randomly generate 0, 1, or 2 duplicate addresses
                for ($i = 0; $i < $numberOfDuplicates; $i++) {
                    // Randomly select an address from the generated addresses array
                    $addressToDuplicate = $addresses[array_rand($addresses)];
        
                    // Add the selected address as a duplicate for this user
                    $user->addresses()->save(UserAddress::factory()->make(['address' => $addressToDuplicate]));
                }
        
                // Save the unique addresses
                $user->addresses()->saveMany(UserAddress::factory($numberOfAddresses - $numberOfDuplicates)->make());
            }
        });
    }
}
