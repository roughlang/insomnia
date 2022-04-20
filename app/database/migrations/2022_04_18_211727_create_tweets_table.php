<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTweetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('tweets', function (Blueprint $table) {
        $table->id();
        $table->string('unique_id', 128);
        $table->string('datetime', 16);
        $table->string('tweet', 256);
        $table->mediumInteger('likes');
        $table->mediumInteger('retweets');
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
      Schema::dropIfExists('tweets');
    }
}
