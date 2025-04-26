<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('instructors', function (Blueprint $table) {
            if (!Schema::hasColumn('instructors', 'department_id')) {
                $table->string('department_id')->nullable();
            }
            if (!Schema::hasColumn('instructors', 'title')) {
                $table->string('title')->nullable();
            }
            if (!Schema::hasColumn('instructors', 'specialization')) {
                $table->string('specialization')->nullable();
            }
            if (!Schema::hasColumn('instructors', 'bio')) {
                $table->text('bio')->nullable();
            }
            if (!Schema::hasColumn('instructors', 'profile_photo')) {
                $table->string('profile_photo')->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('instructors', function (Blueprint $table) {
            $table->dropColumn([
                'department_id',
                'title',
                'specialization',
                'bio',
                'profile_photo'
            ]);
        });
    }
}; 