<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessageSubscriberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('message_subscriber', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("subscriber_id");
            $table->unsignedBigInteger("message_id");
            $table->unsignedSmallInteger("tries");
            $table->string("status_code");
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
        Schema::dropIfExists('message_subscriber');
    }
}
