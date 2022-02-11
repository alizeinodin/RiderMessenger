<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnonymousMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anonymous_messages', function (Blueprint $table) {
            $table->id();
            // one to many relationship
            $table->integer('room_id')->unsigned();
            $table->foreign('room_id')->references('id')
                ->on('rooms')->onDelete('cascade');
            // ----------------------
            $table->ipAddress('ip');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('anonymous_messages');
    }
}
