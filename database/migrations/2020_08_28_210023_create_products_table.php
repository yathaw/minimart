<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        

        Schema::create('brands', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('logo');
             $table->foreignId('category_id')->references('id')->on('categories')
            ->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
        
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('codeno');
            $table->string('name');
            $table->longText('photo');
            $table->string('price');
             
            $table->foreignId('category_id')->references('id')->on('categories')
            ->onDelete('cascade');


            $table->softDeletes();
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
}
