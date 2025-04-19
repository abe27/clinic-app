<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->timestamps();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('tel')->nullable();
            $table->string('hn')->nullable();
            $table->string('pass_id')->nullable();
            $table->foreignUlid('gender_id')
                ->nullable()
                ->constrained('genders')
                ->nullOnDelete();
            $table->date('birth_date');
            $table->foreignUlid('card_id')
                ->nullable()
                ->constrained('cards')
                ->nullOnDelete();
            $table->string('avatar')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
