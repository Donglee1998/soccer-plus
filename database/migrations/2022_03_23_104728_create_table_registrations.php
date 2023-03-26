<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableRegistrations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            //team
            $table->string('name');
            $table->string('name_furigana');
            $table->string('registration_email');
            $table->string('corp_name');
            $table->string('corp_name_furigana');
            $table->string('zip');
            $table->string('address');
            $table->string('tel');

            //pic
            $table->string('pic_name');
            $table->string('pic_name_furigana');
            $table->string('pic_email');
            $table->string('pic_mobile');
            $table->string('pic_birthday');
            $table->tinyInteger('pic_gender');
            $table->string('pic_zip');
            $table->string('pic_address');
            $table->string('pic_tel');
            $table->tinyInteger('contract_premium1');
            $table->tinyInteger('contract_premium2');
            $table->tinyInteger('contract_premium3');
            $table->json('contract_option');
            $table->tinyInteger('payment_method1');
            $table->tinyInteger('payment_method2');

            //contact2
            $table->string('contact2_name')->nullable();
            $table->string('contact2_name_furigana')->nullable();
            $table->string('contact2_email')->nullable();
            $table->string('contact2_tel')->nullable();

            //delivery
            $table->string('delivery_name');
            $table->string('delivery_zip');
            $table->string('delivery_address');

            $table->tinyInteger('contract_status');
            $table->tinyInteger('type')->nullable();

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
        Schema::dropIfExists('registrations');
    }
}
