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
        Schema::create('order_shirts', function (Blueprint $table) {
            $table->unsignedBigInteger('shirts_id_shi');
            $table->unsignedBigInteger('orders_id_ord');
            $table->timestamps();
    
            $table->primary(['shirts_id_shi', 'orders_id_ord']);
    
            $table->foreign('shirts_id_shi')->references('id_shi');
            $table->foreign('orders_id_ord')->references('id_ord');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_shirts');
    }
};
