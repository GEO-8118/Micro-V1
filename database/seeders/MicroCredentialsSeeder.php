<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MicroCredentialsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insertOrIgnore([
            ['id' => 1, 'name' => 'admin', 'display_name' => 'Administrator', 'description' => 'Platform administrator'],
            ['id' => 2, 'name' => 'faculty', 'display_name' => 'Faculty', 'description' => 'Course instructor'],
            ['id' => 3, 'name' => 'student', 'display_name' => 'Student', 'description' => 'Learner'],
        ]);

        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'first_name' => 'System',
                'last_name' => 'Administrator',
                'username' => 'admin',
                'password' => bcrypt('password'),
                'role_id' => 1,
                'student_id' => 'ADM-001',
                'phone' => '09170000001',
                'location' => 'Main Campus',
                'avatar_url' => null,
                'is_active' => true,
            ]
        );

        $student = User::firstOrCreate(
            ['email' => 'student@example.com'],
            [
                'first_name' => 'Ana',
                'last_name' => 'Lopez',
                'username' => 'ana.lopez',
                'password' => bcrypt('password'),
                'role_id' => 3,
                'student_id' => 'STU-001',
                'phone' => '09170000002',
                'location' => 'North Campus',
                'avatar_url' => null,
                'is_active' => true,
            ]
        );

        $faculty = User::firstOrCreate(
            ['email' => 'faculty@example.com'],
            [
                'first_name' => 'Juan',
                'last_name' => 'Dela Cruz',
                'username' => 'juan.delacruz',
                'password' => bcrypt('password'),
                'role_id' => 2,
                'student_id' => 'FAC-001',
                'phone' => '09170000003',
                'location' => 'West Campus',
                'avatar_url' => null,
                'is_active' => true,
            ]
        );

        $courses = [
            [
                'title' => 'Full-Stack Web Development with Laravel',
                'slug' => 'full-stack-web-development-with-laravel',
                'description' => 'Build modern web applications using Laravel, Blade, and MySQL.',
                'category' => 'Web Development',
                'level' => 'Intermediate',
                'duration' => '40h',
                'instructor' => 'Prof. Juan Dela Cruz',
                'lessons_count' => 4,
                'enrolled_count' => 4,
                'passing_score' => 75,
                'is_featured' => true,
                'is_published' => true,
                'thumbnail_url' => null,
            ],
            [
                'title' => 'Computer Networking Fundamentals',
                'slug' => 'computer-networking-fundamentals',
                'description' => 'Learn networking fundamentals, routing, and switching concepts.',
                'category' => 'Networking',
                'level' => 'Beginner',
                'duration' => '30h',
                'instructor' => 'Prof. Juan Dela Cruz',
                'lessons_count' => 3,
                'enrolled_count' => 10,
                'passing_score' => 75,
                'is_featured' => false,
                'is_published' => true,
                'thumbnail_url' => null,
            ],
        ];

        foreach ($courses as $course) {
            DB::table('courses')->updateOrInsert(
                ['slug' => $course['slug']],
                $course
            );
        }

        $badge = DB::table('badges')->updateOrInsert(
            ['name' => 'Database Master'],
            ['description' => 'Completed Database and Eloquent Model', 'icon_url' => null]
        );

        DB::table('user_badges')->updateOrInsert(
            ['user_id' => $student->id, 'badge_id' => $badge['id'] ?? DB::table('badges')->where('name', 'Database Master')->value('id')],
            ['earned_at' => now()]
        );

        DB::table('announcements')->insertOrIgnore([
            [
                'title' => 'Welcome to Micro-Credentials',
                'body' => 'New learners can browse courses and enroll right away.',
                'created_by' => $admin->id,
                'is_published' => true,
                'published_at' => now(),
            ],
        ]);

        $course = DB::table('courses')->where('slug', 'full-stack-web-development-with-laravel')->first();

        if ($course) {
            $quizId = DB::table('quizzes')->insertGetId([
                'course_id' => $course->id,
                'title' => 'Laravel Fundamentals Quiz',
                'description' => 'Assess basic Laravel knowledge.',
                'passing_score' => 75,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::table('quiz_questions')->insert([
                [
                    'quiz_id' => $quizId,
                    'question' => 'What is the primary purpose of Laravel routes?',
                    'options' => json_encode(['Handle HTTP requests', 'Build CSS', 'Manage hardware', 'Render images']),
                    'correct_answer' => 'Handle HTTP requests',
                    'points' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);

            DB::table('quiz_attempts')->insert([
                [
                    'user_id' => $student->id,
                    'quiz_id' => $quizId,
                    'score' => 100,
                    'passed' => true,
                    'started_at' => now()->subMinutes(10),
                    'submitted_at' => now(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
        }

        DB::table('payments')->insertOrIgnore([
            [
                'user_id' => $student->id,
                'course_id' => $course->id ?? null,
                'reference_number' => 'PAY-1001',
                'amount' => 1500.00,
                'currency' => 'PHP',
                'status' => 'paid',
                'payment_method' => 'bank_transfer',
                'paid_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('notifications')->insertOrIgnore([
            [
                'user_id' => $student->id,
                'title' => 'Course Enrollment Confirmed',
                'message' => 'Your enrollment has been confirmed.',
                'type' => 'success',
                'is_read' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('analytics_events')->insertOrIgnore([
            [
                'user_id' => $student->id,
                'event_type' => 'course_enrolled',
                'entity_type' => 'course',
                'entity_id' => $course->id ?? 1,
                'metadata' => json_encode(['source' => 'web']),
                'occurred_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
