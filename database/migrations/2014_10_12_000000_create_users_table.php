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
        Schema::create('users', function (Blueprint $table) {
            $table->id('id_use');
            $table->string('prenom_use', 255);
            $table->string('nom_use', 255);
            $table->string('adresse_use', 255);
            $table->string('mdp_use', 255);
            $table->unsignedBigInteger('roles_id_rol');
            $table->timestamps();
    
            $table->foreign('roles_id_rol')->references('id_rol');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
