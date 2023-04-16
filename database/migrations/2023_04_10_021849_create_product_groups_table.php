<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_groups', function (Blueprint $table) {
            $table->id();

            $table->set('display', ['Show', 'Hide'])->default('Show');
            $table->bigInteger('category_id')->index();
            $table->bigInteger('sub_category_id')->index();
            $table->string('group_name');
            $table->string('brand')->nullable();
            $table->string('hsn')->nullable();
            $table->string('tax_name')->nullable();
            $table->double('tax_percentage')->default(0);
            $table->set('weight', ['No', 'Yes'])->default('No');
            $table->set('volume', ['No', 'Yes'])->default('No');
            $table->set('color', ['No', 'Yes'])->default('No');
            $table->set('size', ['No', 'Yes'])->default('No');
            $table->text('description')->nullable();
            $table->text('tags')->nullable();

            $table->string('title')->nullable();
            $table->text('keywords')->nullable();
            $table->text('description')->nullable();

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
        Schema::dropIfExists('product_groups');
    }
}
