<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //create role table
            Schema::create('roles', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name')->unique();
                $table->enum('status',['y','n']);
                $table->timestamps();
            });

        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('role_id')->unsigned()->nullable();
            $table->string('name');
            $table->string('username');
            $table->string('email')->unique();
            $table->string('password');            
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('role_id')
                ->references('id')
                ->on('roles')
                ->onUpdate('cascade')
                ->onDelete('restrict');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
        Schema::drop('roles');
    }
}
