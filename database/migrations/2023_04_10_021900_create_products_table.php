<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->set('display', ['Show', 'Hide'])->default('Show');
            $table->bigInteger('category_id')->index();
            $table->bigInteger('sub_category_id')->index();
            $table->bigInteger('product_group_id')->index();

            $table->double('mrp')->default(0);
            $table->double('rate')->default(0);
            $table->double('cost')->default(0);
            $table->double('tax')->default(0);
            $table->string('itemcode')->nullable();
            $table->string('barcode')->nullable();
            $table->string('weight')->nullable();
            $table->string('volume')->nullable();
            $table->string('color')->nullable();
            $table->string('size')->nullable();

            $table->text('media_a')->nullable();
            $table->text('media_b')->nullable();
            $table->text('media_c')->nullable();
            $table->text('media_d')->nullable();
            $table->text('media_e')->nullable();
            $table->text('media_f')->nullable();

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
        Schema::dropIfExists('products');
    }
}
