<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableArticles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->date('public_date')->nullable();
            $table->tinyInteger('category')->nullable();
            $table->tinyInteger('sub_category')->nullable();
            $table->string('title')->nullable();
            $table->text('editor')->nullable();
            $table->tinyInteger('is_public')->nullable();
            $table->datetime('start_date')->nullable();
            $table->datetime('end_date')->nullable();
            $table->text('update_comment')->nullable();
            $table->tinyInteger('is_draft')->nullable();
            $table->integer('order')->nullable();
            $table->text('overview')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news');
    }
}
