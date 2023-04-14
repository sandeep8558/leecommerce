<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_data', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('order_id')->index()->nullable();
            $table->bigInteger('product_id')->index()->nullable();

            /* From ProductGroup */
            $table->string('group_name');
            $table->string('brand')->nullable();
            $table->string('hsn')->nullable();
            $table->string('tax_name')->nullable();
            $table->double('tax_percentage')->default(0);
            $table->string('itemcode')->nullable();
            $table->string('barcode')->nullable();
            $table->string('weight')->nullable();
            $table->string('volume')->nullable();
            $table->string('color')->nullable();
            $table->string('size')->nullable();

            /* From Product */
            $table->double('mrp')->default(0);
            $table->double('cost')->default(0);
            $table->double('tax')->default(0);
            $table->double('rate')->default(0);

            /* Calculations */
            $table->integer('qty')->nullable();
            $table->double('mrp_total')->default(0);
            $table->double('cost_total')->default(0);
            $table->double('tax_total')->default(0);
            $table->double('rate_total')->default(0);

            /* Operations */
            $table->timestamp('replace_at')->nullable();
            $table->timestamp('replaced_at')->nullable();
            $table->timestamp('cancelled_at')->nullable();
            
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
        Schema::dropIfExists('order_data');
    }
}
