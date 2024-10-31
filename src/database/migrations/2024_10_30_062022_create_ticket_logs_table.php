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
        //
        Schema::create('ticket_logs', function (Blueprint $table) {
            $table->id();
            $table->string('unique_code')->unique();
            $table->integer('ticket_id')->index();
            $table->integer('user_id')->index();
            $table->dateTime('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('ticket_logs');
    }
};
