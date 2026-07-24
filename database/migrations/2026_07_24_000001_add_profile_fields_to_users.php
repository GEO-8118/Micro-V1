<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (! Schema::hasColumn('users', 'date_of_birth')) {
                $table->date('date_of_birth')->nullable()->after('location');
            }
            if (! Schema::hasColumn('users', 'age')) {
                $table->integer('age')->nullable()->after('date_of_birth');
            }
            if (! Schema::hasColumn('users', 'school_enrolled')) {
                $table->string('school_enrolled')->nullable()->after('age');
            }
            if (! Schema::hasColumn('users', 'hobby')) {
                $table->string('hobby')->nullable()->after('school_enrolled');
            }
            if (! Schema::hasColumn('users', 'address')) {
                $table->string('address')->nullable()->after('hobby');
            }
            if (! Schema::hasColumn('users', 'bio')) {
                $table->text('bio')->nullable()->after('address');
            }
            if (! Schema::hasColumn('users', 'gender')) {
                $table->string('gender')->nullable()->after('suffix');
            }
            if (! Schema::hasColumn('users', 'profile_completed')) {
                $table->boolean('profile_completed')->default(false)->after('bio');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'profile_completed')) {
                $table->dropColumn('profile_completed');
            }
            if (Schema::hasColumn('users', 'gender')) {
                $table->dropColumn('gender');
            }
            if (Schema::hasColumn('users', 'bio')) {
                $table->dropColumn('bio');
            }
            if (Schema::hasColumn('users', 'address')) {
                $table->dropColumn('address');
            }
            if (Schema::hasColumn('users', 'hobby')) {
                $table->dropColumn('hobby');
            }
            if (Schema::hasColumn('users', 'school_enrolled')) {
                $table->dropColumn('school_enrolled');
            }
            if (Schema::hasColumn('users', 'age')) {
                $table->dropColumn('age');
            }
            if (Schema::hasColumn('users', 'date_of_birth')) {
                $table->dropColumn('date_of_birth');
            }
        });
    }
};
