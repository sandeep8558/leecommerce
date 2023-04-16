<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('user_id')->index();
            $table->bigInteger('address_id')->index();
            $table->bigInteger('offer_id')->nullable();
            $table->double('mrp_total')->default(0);
            $table->double('cost_total')->default(0);
            $table->double('tax_total')->default(0);
            $table->double('rate_total')->default(0);
            
            $table->double('discount')->default(0);
            $table->double('offer_discount')->default(0);
            $table->double('delivery')->default(0);
            $table->double('payable')->default(0);
            $table->timestamp('accepted_at')->nullable();
            
            $table->timestamp('picked_at')->nullable();
            $table->timestamp('packed_at')->nullable();
            $table->timestamp('shipped_at')->nullable();
            $table->timestamp('delivered_at')->nullable();
            $table->bigInteger('accepted_by')->nullable();
            
            $table->bigInteger('picked_by')->nullable();
            $table->bigInteger('packed_by')->nullable();
            $table->bigInteger('shipped_by')->nullable();
            $table->bigInteger('delivered_by')->nullable();
            $table->timestamp('r_accepted_at')->nullable();
            
            $table->timestamp('r_picked_at')->nullable();
            $table->timestamp('r_packed_at')->nullable();
            $table->timestamp('r_shipped_at')->nullable();
            $table->timestamp('r_delivered_at')->nullable();
            $table->bigInteger('r_accepted_by')->nullable();
            
            $table->bigInteger('r_picked_by')->nullable();
            $table->bigInteger('r_packed_by')->nullable();
            $table->bigInteger('r_shipped_by')->nullable();
            $table->bigInteger('r_delivered_by')->nullable();
            $table->timestamp('replace_at')->nullable();
            
            $table->timestamp('cancelled_at')->nullable();
            $table->timestamp('payment_at')->nullable();
            $table->string('razorpay_payment_id')->nullable();
            $table->set('orderstatus', ['Pending', 'Success', 'Cancelled'])->default('Pending');
            $table->set('paymentmode', ['COD', 'Online', 'Wallet', 'UPI', 'Cash'])->nullable();

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
        Schema::dropIfExists('orders');
    }
}
