<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Products extends Migration
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
            $table->string('title')->default('Product title');
            $table->longText('content')->nullable();
            $table->longText('tags')->nullable();
            $table->string('user_id')->default(1);
            $table->string('image')->nullable();
            $table->string('gallery')->nullable();
            $table->string('lang')->nullable();
            $table->string('categories')->nullable();
            $table->string('price')->nullable();
            $table->string('attribute')->nullable();
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
