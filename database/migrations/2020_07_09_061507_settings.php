<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Settings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('title')->default('my web site');
            $table->string('description')->default('personal website about me')->nullable();
            $table->string('site_url')->nullable();
            $table->longText('tags')->nullable();;
            $table->string('email_send')->nullable();;
            $table->string('email_received')->nullable();
            $table->string('lang')->nullable();
            $table->string('homepage_txt')->default('Hello World ! Im a blueCMS, from Laravel! Hello World ! I had high security and speed , Made for the core of professional sites,you can write for me controller or model and very easy for startup ! hello world !')->nullable();

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
        Schema::dropIfExists('settings');

    }
}
