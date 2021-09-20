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
        
        Schema::table('countries', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('name');
            $table->string('country_code', 3);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('cities', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->unsignedBigInteger('country_id');
            $table->string('name');
            $table->string('postal_code', 10);
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
            $table->unsignedBigInteger('address_id');
            $table->decimal('coefficient', 4, 2, true);
            $table->string('type', 60);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('address_id')->references('id')->on('address')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('suppliers', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->unsignedBigInteger('address_id');
            $table->string('name', 80);
            $table->string('tel', 14);
            $table->string('email');
            $table->string('type');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('address_id')->references('id')->on('address')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->dateTime('shipping_date');
            $table->unsignedInteger('quantity_total');
            $table->decimal('discount', 5, 2, true)->nullable();
            $table->decimal('extra_discount', 5, 2, true)->nullable();
            $table->decimal('tax', 4, 2, true);
            $table->string('payment_method')->nullable();
            $table->dateTime('payment_date');
            $table->string('model_type')->nullable();
            $table->unsignedInteger('model_id')->nullable();
            $table->decimal('amount_paid', 4, 2, true)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('address_id')->references('id')->on('address')->onUpdate('cascade')->onDelete('cascade');
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
