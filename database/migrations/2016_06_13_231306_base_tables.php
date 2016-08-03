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

            Schema::create('networks', function($t) {
                $t->increments('id');
                $t->string('name');
                $t->string('description')->nullable();
                $t->string('features')->nullable();
                $t->string('ip_range')->default('');
                $t->timestamps();
            });

            Schema::create('nodes', function($t) {
                $t->increments('id');
                $t->string('name');
                $t->text('description');
                $t->string('physic_description');
                $t->decimal('latitude', 11, 8);
                $t->decimal('longitude', 11, 8);
                $t->integer('network_id')->unsigned()->nullable();
                $t->timestamps();

                $t->foreign('network_id')->references('id')->on('networks')
                    ->onUpdate('SET NULL');
            });

            Schema::create('node_ipv4', function($t) {
                $t->increments('id');
                $t->string('range');
                $t->integer('node_id')->unsigned();
                $t->string('type', 5)->default('ipv4');
                $t->timestamps();
                $t->foreign('node_id')->references('id')->on('nodes');
            });

            Schema::create('node_user', function($t) {
                $t->increments('id');
                $t->integer('node_id')->unsigned()->nullable();
                $t->integer('user_id')->unsigned()->nullable();
                $t->boolean('is_admin')->default(false);
                $t->boolean('is_owner')->default(false);
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
            Schema::dropIfExists('node_ipv4');
            Schema::dropIfExists('node_user');
            Schema::dropIfExists('users');
            Schema::dropIfExists('nodes');
            Schema::dropIfExists('networks');

            \DB::commit();
        } catch(Exception $e) {
            \DB::rollback();
        }

    }
}
