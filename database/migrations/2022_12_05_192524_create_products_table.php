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

            $table->integer("user_id");
            $table->bigInteger("cate_id")->nullable(true);
            $table->string("name");
            $table->mediumText("small_description")->nullable(true);
            $table->longText("description")->nullable(true);
            $table->string("selling_price")->nullable(true);
            $table->string("price");
            $table->string("image")->nullable(true);
            $table->string("qty")->nullable(true);
            $table->string("tax")->nullable(true);
            $table->tinyInteger("status");
            $table->tinyInteger("trending")->nullable(true);
            $table->mediumText("meta_title")->nullable(true);
            $table->mediumText("meta_keywords")->nullable(true);
            $table->mediumText("meta_description")->nullable(true);

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
