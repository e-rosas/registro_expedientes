<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpedientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expedientes', function (Blueprint $table) {
            $table->id();
            $table->string('full_name', '180')->index();
            $table->date('birth_date');
            $table->string('phone_number')->nullable();
            $table->string('email')->nullable();
            $table->boolean('insured');
            $table->date('first_consultation_date');
            $table->date('last_consultation_date');
            $table->text('comments')->nullable();
            $table->boolean('destroyed')->default(0);
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
        Schema::dropIfExists('expedientes');
    }
}
