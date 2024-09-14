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
        Schema::create('students_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')
                ->nullable(false)
                ->constrained('students')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('user_id')
                ->nullable(false)
                ->constrained('users')
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->boolean('is_creator')
                ->default(0)
                ->nullable(false);
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
        Schema::dropIfExists('students_users');
    }
};
