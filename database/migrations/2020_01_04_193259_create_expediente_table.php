<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpedienteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expediente', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('expediente',300);
            $table->string('responsable',300)->nullable();
            $table->date('fechaatencion');
            $table->integer('id_atencion');
            $table->date('fechadocumento')->nullable();
            $table->date('fecha1atencion')->nullable();
            $table->text('cumpleatencion1')->nullable();
            $table->date('fecha2atencion')->nullable();
            $table->enum('cumpleatencion2',['SI','NO'])->default('NO');
            $table->integer('id_trabajador');
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
        Schema::dropIfExists('expendiente');
    }
}


