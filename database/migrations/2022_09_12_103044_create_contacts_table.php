<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('お名前|user write contact');
            $table->string('email')->comment('メールアドレス|email of user write contact');
            $table->string('team')->nullable()->comment('所属チーム|name of team');
            $table->tinyInteger('status')->default('0')->comment('対応状況|status of contacts| 0: 未対応(Chưa đối ứng) 1: 対応中(Đang đối ứng) 2: 対応済み(Đã đối ứng)');
            $table->tinyInteger('app_type')->nullable()->comment('ご利用アプリ| 0: iPadレンタル版アプリ(Bản app kèm theo iPad) 1: AppStore版アプリ(Bản AppStore) 2: わからない(Không biết)|Loại app đang sử dụng');
            $table->tinyInteger('purpose')->nullable()->comment('オンラインでの案内希望|利用中のアプリについてのお問い合わせ|その他のお問い合わせ');
            $table->string('content')->comment('お問い合わせ内容: content of contact');
            $table->string('admin_memo')->nullable();
            $table->tinyInteger('type')->nullable()->comment('user|admin');
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
        Schema::dropIfExists('contacts');
    }
}
