<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSessionInputsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('session_inputs', function (Blueprint $table) {
            $table->id();
            $table->string('session_id', 50);
            $table->string('page', 10);
            $table->json('data');
            $table->timestamp('submitted_at')->nullable();
            $table->timestamps();

            $table->unique(['session_id', 'page', 'submitted_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('session_inputs');
    }
}
