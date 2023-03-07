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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('crop_id');
            $table->unsignedBigInteger('field_id');
            $table->string('name');
            $table->integer('price')->default(0);
            $table->integer('unit')->default(0);
            $table->foreign('crop_id')
                ->references('id')
                ->on('crops')
                ->onDelete('cascade');
            $table->foreign('field_id')
                ->references('id')
                ->on('fields')
                ->onDelete('cascade');
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
        Schema::dropIfExists('products');
    }
};
