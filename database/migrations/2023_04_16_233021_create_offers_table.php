<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->id();

            $table->set('display', ['Show', 'Hide'])->default('Show');
            $table->string('offer_name');
            $table->string('description');
            $table->string('coupon_code')->unique();
            $table->date('start');
            $table->date('end');
            $table->set('offer_type', ['Flat Discount', 'Percentile Discount'])->default('Flat Discount');
            $table->set('offer_for', ['All Orders', 'First Order'])->default('All Orders');
            $table->double('minimum_purchase_amount')->default(0);
            $table->double('maximum_offer_amount')->default(0);
            $table->double('offer_value')->default(0);
            $table->integer('ticket_size')->default(0);
            $table->integer('ticket_per_day')->default(0);
            $table->integer('ticket_per_customer')->default(0);
            $table->integer('ticket_per_customer_per_day')->default(0);
            $table->text('media')->nullable();

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
        Schema::dropIfExists('offers');
    }
}
