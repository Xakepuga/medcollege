<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name', 30)->nullable(false);
            $table->string('surname', 30)->nullable(false);
            $table->string('patronymic', 30)->nullable();
            $table->foreignId('passport_id')
                ->nullable(false)
                ->constrained('passports')
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->string('phone', 30)->nullable();
            $table->string('email', 50)->nullable();
            $table->foreignId('language_id')
                ->nullable(false)
                ->constrained('languages')
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->text('about_me')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
};
