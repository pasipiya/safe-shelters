<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSheltersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shelters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('shel_name')->nullable();
            $table->string('user_id');
            $table->string('shel_status')->nullable();
            $table->string('shel_country')->nullable();
            $table->string('shel_postal_code')->nullable();
            $table->string('shel_address')->nullable();
            $table->string('shel_city')->nullable();
            $table->string('shel_rooms')->nullable();
            $table->string('shel_contact_1')->nullable();
            $table->string('shel_contact_2')->nullable();
            $table->string('shel_rating')->nullable();
            $table->string('shel_latitude')->nullable();
            $table->string('shel_longitude')->nullable();
            $table->string('shel_description')->nullable();
            $table->string('shel_pic')->nullable();
            $table->string('website')->nullable();
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
        Schema::dropIfExists('shelters');
    }
}
