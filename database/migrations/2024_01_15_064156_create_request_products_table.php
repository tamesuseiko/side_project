<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_products', function (Blueprint $table) {
            $table->id();
            $table->integer('id_mouse')->nullable()->comment('คือ id_product');
            $table->integer('id_keyboard')->nullable()->comment('คือ id_product');
            $table->text('details')->nullable()->comment('รายละเอียดที่ขอ');
            $table->integer('id_user')->comment('id ของคนบันทุึกข้อมูล');
            $table->enum('status',['active','inactive'])->nullable()->default('active');
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
        Schema::dropIfExists('request_products');
    }
}
