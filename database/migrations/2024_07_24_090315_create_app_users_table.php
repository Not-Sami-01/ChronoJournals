<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    use DatabaseMigrations;
    public function up(): void
    {
        Schema::create('app_users', function (Blueprint $table) {
            // $table->id('user_id');
            $table->string('username')->unique();
            $table->string('password');
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('app_users');
    }
};
