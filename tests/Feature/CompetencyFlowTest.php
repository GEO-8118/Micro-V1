<?php

use App\Models\Assessment;
use App\Models\Badge;
use App\Models\BadgeRule;
use App\Models\CompetencyCategory;
use App\Models\CompetencyLevel;
use App\Models\CompetencyUnit;
use App\Models\User;
use App\Services\CompetencyService;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

describe('competency flow', function () {
    it('marks a competency complete and issues a badge when an assessment passes', function () {
        $user = User::factory()->create([
            'email' => 'competency@example.com',
            'role_id' => 3,
        ]);

        $category = CompetencyCategory::create([
            'name' => 'Programming',
            'description' => 'Programming competencies',
        ]);

        $unit = CompetencyUnit::create([
            'competency_category_id' => $category->id,
            'title' => 'Laravel Basics',
            'description' => 'Core Laravel concepts',
            'order' => 1,
        ]);

        $level = CompetencyLevel::create([
            'competency_unit_id' => $unit->id,
            'title' => 'Foundation',
            'description' => 'Foundational mastery',
            'level_number' => 1,
            'points' => 100,
        ]);

        $badge = Badge::create([
            'name' => 'Laravel Starter',
            'description' => 'Completed the Laravel Basics competency',
            'is_stackable' => true,
            'badge_level' => 'Bronze',
        ]);

        BadgeRule::create([
            'badge_id' => $badge->id,
            'rule_type' => 'competency_complete',
            'rule_value' => $unit->id,
            'operator' => 'equals',
        ]);

        $assessment = Assessment::create([
            'user_id' => $user->id,
            'competency_unit_id' => $unit->id,
            'competency_level_id' => $level->id,
            'type' => 'Quiz',
            'title' => 'Laravel Basics Quiz',
            'description' => 'A simple quiz',
            'passing_score' => 70,
            'status' => 'assigned',
        ]);

        $service = app(CompetencyService::class);
        $service->completeAssessment($user, $assessment, 85);

        $progress = $user->competencyProgresses()->where('competency_unit_id', $unit->id)->first();

        expect($progress)->not->toBeNull();
        expect($progress->status)->toBe('completed');
        expect($progress->mastery_score)->toBe(85);
        expect($user->badges()->pluck('badges.id')->contains($badge->id))->toBeTrue();
    });
});
