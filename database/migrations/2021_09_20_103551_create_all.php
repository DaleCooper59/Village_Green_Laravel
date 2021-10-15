<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAll extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('countries', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned(); 
            $table->string('country_code', 2);
            $table->string('name');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('cities', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->unsignedBigInteger('country_id');
            $table->string('name');
            $table->string('postal_code', 20);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('country_id')->references('id')->on('countries')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('address', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->unsignedBigInteger('city_id');
            $table->string('street');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('city_id')->references('id')->on('cities')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('companies', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->unsignedBigInteger('address_id');
            $table->string('name');
            $table->char('SIRET', 14);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('address_id')->references('id')->on('address')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('company_id');
            $table->string('department', 100);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('company_id')->references('id')->on('companies')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('employee_id');
            $table->string('ref_customer');
            $table->string('type', 60);
            $table->decimal('coefficient', 4, 2, true);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('employee_id')->references('id')->on('employees')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('address_customer', function (Blueprint $table) {
            $table->bigInteger('address_id')->unsigned();
            $table->foreign('address_id')->references('id')->on('address')->onUpdate('cascade')->onDelete('cascade');
            $table->bigInteger('customer_id')->unsigned();
            $table->foreign('customer_id')->references('id')->on('customers')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('suppliers', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->unsignedBigInteger('address_id');
            $table->string('name', 80);
            $table->string('tel', 30);
            $table->string('email');
            $table->string('type');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('address_id')->references('id')->on('address')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->unsignedInteger('quantity_total');
            $table->decimal('discount', 5, 2, true)->nullable();
            $table->decimal('extra_discount', 5, 2, true)->nullable();
            $table->decimal('tax', 4, 2, true);
            $table->decimal('amount_paid', 4, 2, true)->nullable();
            $table->string('payment_method')->nullable();
            $table->dateTime('payment_date');
            $table->string('shipping_status');
            $table->dateTime('shipping_date')->nullable();
            $table->string('model_type')->nullable();
            $table->unsignedInteger('model_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('order_address', function (Blueprint $table) {
            $table->bigInteger('order_id')->unsigned();
            $table->foreign('order_id')->references('id')->on('orders')->onUpdate('cascade')->onDelete('cascade');
            $table->bigInteger('address_id')->unsigned();
            $table->foreign('address_id')->references('id')->on('address')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('invoices', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->unsignedBigInteger('order_id');
            $table->text('invoice_all');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('order_id')->references('id')->on('orders')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('label');
            $table->string('ref');
            $table->string('picture');
            $table->text('description');
            $table->string('EAN', 45);
            $table->string('color', 45);
            $table->decimal('unit_price_HT', 12, 2, true);
            $table->string('supply_ref')->nullable();
            $table->string('supply_product_name')->nullable();
            $table->decimal('supply_unit_price_HT', 12, 2, true)->nullable();
            $table->unsignedInteger('stock');
            $table->unsignedInteger('stock_alert');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('supplier_product', function (Blueprint $table) {
            $table->bigInteger('supplier_id')->unsigned();
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onUpdate('cascade')->onDelete('cascade');
            $table->bigInteger('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('products')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('order_product', function (Blueprint $table) {
            //quantity and detail_products
            $table->bigInteger('order_id')->unsigned();
            $table->foreign('order_id')->references('id')->on('orders')->onUpdate('cascade')->onDelete('cascade');
            $table->bigInteger('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('products')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->string('name');
            $table->string('picture');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('parent_id')->references('id')->on('categories')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('category_product', function (Blueprint $table) {
            $table->bigInteger('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('categories')->onUpdate('cascade')->onDelete('cascade');
            $table->bigInteger('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('products')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('tags', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('name');
            $table->string('color', 7);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('taggables', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->unsignedBigInteger('taggable_id');
            $table->string('taggable_type');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
