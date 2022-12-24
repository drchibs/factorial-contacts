<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_histories', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->string("action")->default("edited");
            $table->unsignedBigInteger('contact_id');
            $table->string("first_name");
            $table->string("last_name");
            $table->string("email");
            $table->string("phone_number");
            $table->timestamps();
            $table->foreign("contact_id")->references('id')->on('contacts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contact_histories');
    }
}
