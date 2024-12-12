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
        Schema::create('outgoing_mails', function (Blueprint $table) {
            $table->id();
            $table->string('letter_id')->references('letter_id')->on('letter_types')->constrained('letter_types')->cascadeOnUpdate()->cascadeOnDelete()->nullable();
            $table->string('subject')->nullable();
            $table->string('from')->nullable();
            $table->string('sender')->nullable();
            $table->string('receipint')->nullable();
            $table->date('date')->nullable();
            $table->string('document')->nullable();
            $table->timestamps();
            $table->index('letter_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('outgoing_mails');
    }
};
