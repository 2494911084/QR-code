<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddWeixinOpenidKeyToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('r_name')->nullable()->after('name');
            $table->string('avatar')->nullable()->after('r_name');
            $table->string('phone')->nullable()->unique()->after('avatar');
            $table->string('weixin_openid')->unique()->after('avatar');
            $table->string('weixin_session_key')->after('weixin_openid');
            $table->string('email')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('r_name');
            $table->dropColumn('avatar');
            $table->dropColumn('phone');
            $table->dropColumn('weixin_openid');
            $table->dropColumn('weixin_session_key');
            $table->string('email')->nullable('false')->change();
        });
    }
}
