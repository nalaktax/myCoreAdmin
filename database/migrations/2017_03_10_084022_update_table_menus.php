<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTableMenus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('menus',function (Blueprint $table) {
            $table->integer('parent_id')->unsigned()->nullable();
            $table->integer('order')->unsigned()->nullable()->default(0);
            $table->string('controller')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('menus',function (Blueprint $table) {
            $table->dropColumn(['parent_id','order']);
            $table->string('controller')->nullable(false)->change();
        });
    }
}
