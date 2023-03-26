<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableMembers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->integer('team_id');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->date('birthday')->nullable();
            $table->string('number_official')->nullable();
            $table->string('number_practice')->nullable();
            $table->tinyInteger('position')->nullable()->comment('GK DF MF FW その他');
            $table->tinyInteger('dominant_foot')->nullable()->comment('左 右 未選択');
            $table->float('height')->nullable()->comment('0.0cm');
            $table->float('weight')->nullable()->comment('0.0kg');
            $table->string('school')->nullable();
            $table->string('email')->nullable();
            $table->string('former_team')->nullable();
            $table->integer('created_by')->nullable();
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
        Schema::dropIfExists('members');
    }
}
