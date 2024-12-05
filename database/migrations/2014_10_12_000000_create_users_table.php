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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->dateTime('last_login')->nullable();
            $table->string('role_id')->references('group_id')->on('groups')->constrained('groups')->cascadeOnUpdate()->cascadeOnDelete()->nullable();
            $table->longText('nip')->nullable();
            $table->string('rank')->nullable();
            $table->string('group')->nullable();
            $table->string('position')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->index('role_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
