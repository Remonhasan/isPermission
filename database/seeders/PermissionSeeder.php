<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        foreach ($users as $user) {
            // Check if permissions already exist for this user and scope
            $existingPermissions = Permission::where('user_id', $user->id)->pluck('scope');

            // Set permissions for category scope if not already set
            if (!$existingPermissions->contains('category')) {
                Permission::create([
                    'user_id' => $user->id,
                    'scope' => 'category',
                    'create' => true,
                    'edit' => true,
                    'view' => true,
                    'list' => true,
                    'delete' => true,
                ]);
            }

            // Set permissions for product scope if not already set
            if (!$existingPermissions->contains('product')) {
                Permission::create([
                    'user_id' => $user->id,
                    'scope' => 'product',
                    'create' => true,
                    'edit' => true,
                    'view' => true,
                    'list' => true,
                    'delete' => true,
                ]);
            }

            // Set permissions for coupon scope if not already set
            if (!$existingPermissions->contains('coupon')) {
                Permission::create([
                    'user_id' => $user->id,
                    'scope' => 'coupon',
                    'create' => true,
                    'edit' => true,
                    'view' => true,
                    'list' => true,
                    'delete' => true,
                ]);
            }
        }
    }
}
