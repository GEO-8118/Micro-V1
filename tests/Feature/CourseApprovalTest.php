<?php

use App\Models\Course;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('approves a faculty course and makes it visible to students', function () {
    $course = Course::create([
        'title' => 'Faculty Submitted Course',
        'slug' => 'faculty-submitted-course',
        'description' => 'Awaiting review',
        'category' => 'Web Development',
        'level' => 'Beginner',
        'duration' => '4 weeks',
        'instructor' => 'Prof. Test',
        'is_published' => false,
        'status' => 'pending',
    ]);

    $adminResponse = $this->get(route('admin.courses'));
    $adminResponse->assertOk();
    $adminResponse->assertSee('Pending');
    $adminResponse->assertSee($course->title);

    $this->post(route('admin.courses.approve', $course->id))
        ->assertRedirect(route('admin.courses'));

    $course->refresh();

    expect($course->status)->toBe('approved')
        ->and((bool) $course->is_published)->toBeTrue();

    $browseResponse = $this->get(route('courses.browse'));
    $browseResponse->assertOk();
    $browseResponse->assertSee($course->title);
});
