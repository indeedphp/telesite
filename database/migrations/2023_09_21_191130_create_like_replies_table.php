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
        Schema::create('like_replies', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('reply_id');
            $table->string('name')->nullable();
            $table->integer('dislike')->default(0);
            $table->integer('like')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('like_replies');
    }
};
