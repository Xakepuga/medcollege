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
        Schema::create('enrollment', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')
                ->nullable(false)
                ->constrained('students')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('faculty_id')
                ->nullable()
                ->constrained('faculties')
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->foreignId('decree_id')
                ->nullable()
                ->constrained('decrees')
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->boolean('is_budget')->nullable(false);
            $table->boolean('is_pickup_docs')->nullable();
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
        Schema::dropIfExists('enrollment');
    }
};
