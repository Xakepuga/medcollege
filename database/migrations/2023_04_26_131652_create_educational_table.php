<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('educational', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')
                ->nullable(false)
                ->constrained('students')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('ed_institution_type_id')
                ->nullable(false)
                ->constrained('educational_institution_types')
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->foreignId('ed_doc_type_id')
                ->nullable(false)
                ->constrained('educational_doc_types')
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->string('ed_doc_number', 30)->nullable(false);
            $table->string('ed_institution_name', 255)->nullable(false);
            $table->boolean('is_first_spo')->nullable(false);
            $table->boolean('is_excellent_student')->nullable(false);
            $table->decimal('avg_rating')->nullable(false);
            $table->date('issue_date')->nullable(false);
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
        Schema::dropIfExists('educational');
    }
};
