<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddQmImgToFileViewLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('file_view_logs', function (Blueprint $table) {
            $table->string('qm_img');
            $table->datetime('view_time')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('file_view_logs', function (Blueprint $table) {
            $table->dropColumn('qm_img');
            $table->datetime('view_time')->nullable(false)->change();
        });
    }
}
