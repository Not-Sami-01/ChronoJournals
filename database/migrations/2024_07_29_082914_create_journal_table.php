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
        Schema::create('journal', function (Blueprint $table) {
            // $table->id('journal_id');
            $table->foreignId('user_id')->references('user_id')->on('app_users');
            $table->text('content');
            $table->string('tag')->nullable();
            $table->timestamp('journal_date_time')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('journal');
    }
};
