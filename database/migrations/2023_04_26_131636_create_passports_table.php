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
        Schema::create('passports', function (Blueprint $table) {
            $table->id();
            $table->date('birthday')->nullable(false);
            $table->string('birthplace', 150)->nullable(false);
            $table->string('number', 20)->nullable(false);
            $table->string('gender', 7)->nullable(false);
            $table->foreignId('nationality_id')
                ->nullable(false)
                ->constrained('nationality')
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->string('issue_by', 150)->nullable(false);
            $table->date('issue_date')->nullable(false);
            $table->string('address_registered', 180)->nullable(false);
            $table->string('address_residential', 180)->nullable(false);
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
        Schema::dropIfExists('passports');
    }
};
