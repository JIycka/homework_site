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
        Schema::create('ads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('author_name');
            $table->text('description');
            $table->string('title');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade') ->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ads', function (Blueprint $table) {
            $table->dropForeign('user_id');

        });
        Schema::dropIfExists('ads');
    }
};
