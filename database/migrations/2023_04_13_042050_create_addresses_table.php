<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('user_id')->index();
            $table->string('mobile');
            $table->string('email');
            $table->string('name');
            $table->string('address');
            $table->string('city');
            $table->string('pincode');
            $table->string('state');
            $table->string('country');
            $table->set('default', ['Yes', 'No'])->default('No');
            $table->set('deleted', ['Yes', 'No'])->default('No');
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();

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
        Schema::dropIfExists('addresses');
    }
}
