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
        Schema::create('information_for_admission', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')
                ->nullable(false)
                ->constrained('students')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('faculty_id')
                ->nullable(false)
                ->constrained('faculties')
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->foreignId('financing_type_id')
                ->nullable(false)
                ->constrained('financing_types')
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->boolean('is_original_docs')
                ->nullable(false);
            $table->decimal('testing')->nullable();
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
        Schema::dropIfExists('information_for_admission');
    }
};
