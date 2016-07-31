<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAgentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nom');
            $table->string('prenom');
            $table->string('phone');
            $table->timestamps();
        });

        Schema::create('agent_groupe', function (Blueprint $table) {
            $table->integer('agent_id')->unsigned();
            $table->integer('groupe_id')->unsigned();

            //$table->primary(['agent_id', 'groupe_id']);

            $table->foreign('agent_id')->references('id')->on('agents')->onDelete('cascade');
            $table->foreign('groupe_id')->references('id')->on('groupes')->onDelete('cascade');
        });

        Schema::create('agent_sms', function (Blueprint $table) {
            $table->integer('agent_id')->unsigned();
            $table->integer('sms_id')->unsigned();

            $table->foreign('agent_id')->references('id')->on('agents')->onDelete('cascade');
            $table->foreign('sms_id')->references('id')->on('sms')->onDelete('cascade');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('agent_sms');
        Schema::drop('agent_groupe');
        Schema::drop('agents');
    }
}
