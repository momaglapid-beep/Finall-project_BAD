<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Equipment;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create the Admin Account
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@school.edu',
            'password' => bcrypt('password'),
            'role' => 'approver', // Important: This gives Admin access
            'position' => 'Equipment Manager'
        ]);

        // 2. Create a Student Account (For testing)
        User::create([
            'name' => 'Monico Student',
            'email' => 'student@school.edu',
            'password' => bcrypt('password'),
            'role' => 'borrower',
            'department' => 'BSIS'
        ]);

        // 3. Add some sample Equipment
        Equipment::create([
            'Name' => 'Canon DSLR 80D',
            'Category' => 'Audio/Visual',
            'Quantity' => 1,
            'Condition' => 'Good',
            'Description' => 'High quality camera with lens kit.',
            'AvailabilityStatus' => 'Available'
        ]);

        Equipment::create([
            'Name' => 'Epson Projector',
            'Category' => 'IT & Computing',
            'Quantity' => 2,
            'Condition' => 'New',
            'Description' => 'HDMI compatible projector.',
            'AvailabilityStatus' => 'Available'
        ]);
    }
}