<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BaseTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::beginTransaction();
        try {
            Schema::create('users', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->string('email')->unique();
                $table->string('password');
                $table->rememberToken();
                $table->timestamps();
            });

            Schema::create('password_resets', function (Blueprint $table) {
                $table->string('email')->index();
                $table->string('token')->index();
                $table->timestamp('created_at');
            });

            Schema::create('nodes', function($t) {
                $t->increments('id');
                $t->string('name');
                $t->text('description');
                $t->string('city')->nullable();
                $t->decimal('latitude', 11, 8);
                $t->decimal('longitude', 11, 8);
                $t->timestamps();
            });

            Schema::create('node_user', function($t) {
                $t->increments('id');
                $t->integer('node_id')->unsigned()->nullable();
                $t->integer('user_id')->unsigned()->nullable();
                $t->timestamps();

                $t->foreign('node_id')->references('id')->on('nodes')->onDelete('SET NULL');
                $t->foreign('user_id')->references('id')->on('users')->onDelete('SET NULL');
            });

            \DB::commit();
        } catch(Exception $e) {
            \DB::rollback();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \DB::beginTransaction();
        try {
            Schema::dropIfExists('password_resets');
            Schema::dropIfExists('node_user');
            Schema::dropIfExists('users');
            Schema::dropIfExists('nodes');

            \DB::commit();
        } catch(Exception $e) {
            \DB::rollback();
        }

    }
}
