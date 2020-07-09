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


            $homepage_txt = "";
            $table->id();
            $table->string('title')->default('my web site');
            $table->string('description')->default('personal website about me')->nullable();
            $table->string('site_url')->nullable();
            $table->longText('tags')->nullable();;
            $table->string('email_send')->nullable();;
            $table->string('email_received')->nullable();
            $table->string('lang')->nullable();
            $table->longText('homepage_txt')->default("Hello World  Im a blueCMS <br>
                       from Laravel       <br>     Hello World     
                       <br>    I had high security and speed       <br> 
                               Made for the core of professional sites     <br> 
                                        you can write for me controller or model and very easy for startup      <br> 
                                                 for change text and login to admin     <br> 
                                                          email  password hi@blue.cms")->nullable();

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
