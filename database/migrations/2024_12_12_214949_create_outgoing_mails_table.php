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
            $table->string('user_id')->references('id')->on('users')->constrained('users')->cascadeOnUpdate()->cascadeOnDelete()->nullable();
            $table->string('letter_id')->references('id')->on('letter_types')->constrained('letter_types')->cascadeOnUpdate()->cascadeOnDelete()->nullable();
            $table->string('subject')->nullable();
            $table->string('from')->nullable();
            $table->string('sender')->nullable();
            $table->string('receipint')->nullable();
            $table->date('date')->nullable();
            $table->string('document')->nullable();
            $table->string('doc_name')->nullable();
            $table->string('doc_extension')->nullable();
            $table->timestamps();
            $table->index('user_id');
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
