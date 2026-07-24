<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            if (! Schema::hasColumn('courses', 'submitted_by')) {
                $table->foreignId('submitted_by')->nullable()->constrained('users')->nullOnDelete();
            }
            if (! Schema::hasColumn('courses', 'status')) {
                $table->string('status')->default('pending')->after('is_published');
            }
            if (! Schema::hasColumn('courses', 'review_note')) {
                $table->text('review_note')->nullable()->after('status');
            }
            if (! Schema::hasColumn('courses', 'approved_at')) {
                $table->timestamp('approved_at')->nullable()->after('review_note');
            }
        });
    }

    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            if (Schema::hasColumn('courses', 'approved_at')) {
                $table->dropColumn('approved_at');
            }
            if (Schema::hasColumn('courses', 'review_note')) {
                $table->dropColumn('review_note');
            }
            if (Schema::hasColumn('courses', 'status')) {
                $table->dropColumn('status');
            }
            if (Schema::hasColumn('courses', 'submitted_by')) {
                $table->dropForeign(['submitted_by']);
                $table->dropColumn('submitted_by');
            }
        });
    }
};
