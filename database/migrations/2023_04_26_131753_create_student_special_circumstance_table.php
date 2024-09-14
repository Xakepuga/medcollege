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
        Schema::create('student_special_circumstance', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')
                ->nullable(false)
                ->constrained('students')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('special_circumstance_id')
                ->nullable(false)
                ->constrained('special_circumstances')
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->boolean('status')->nullable(false);
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
        Schema::dropIfExists('student_special_circumstance');
    }
};
