<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('product_id')->index();
            $table->date('date')->nullable();
            $table->integer('quantity')->default(0);
            $table->double('rate')->default(0);
            $table->double('amount')->default(0);
            $table->string('supplier')->nullable();
            $table->string('bill_no')->nullable();
            $table->string('narration')->nullable();

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
        Schema::dropIfExists('purchases');
    }
}
