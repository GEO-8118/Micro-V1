<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

uses(RefreshDatabase::class);

it('redirects faculty and admin users to their own dashboard after completing profile', function () {
    foreach ([
        ['role_id' => 1, 'route' => 'admin.dashboard'],
        ['role_id' => 2, 'route' => 'faculty.dashboard'],
    ] as $case) {
        $user = User::create([
            'first_name' => 'Test',
            'last_name' => 'User',
            'email' => 'role-' . $case['role_id'] . '@example.com',
            'username' => 'role-' . $case['role_id'],
            'password' => Hash::make('password123'),
            'role_id' => $case['role_id'],
            'student_id' => 'USER-' . $case['role_id'],
            'user_code' => 'USER-' . $case['role_id'],
            'is_active' => true,
            'profile_completed' => false,
        ]);

        $this->actingAs($user)
            ->post(route('profile.complete.store'), [
                'name' => 'Test User',
                'gender' => 'Prefer not to say',
                'date_of_birth' => '2000-01-01',
                'age' => 25,
                'phone' => '09123456789',
                'school_enrolled' => 'Example School',
                'address' => 'Example Address',
                'email' => $user->email,
            ])
            ->assertRedirect(route($case['route']));
    }
});
