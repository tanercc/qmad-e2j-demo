<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer("orderID")->nullable();
            $table->string("customerID")->nullable();
            $table->dateTime("orderDate")->nullable();
            $table->dateTime("shippedDate")->nullable();
            $table->float("freight")->nullable();
            $table->string("shipName")->nullable();
            $table->string("shipAddress")->nullable();
            $table->string("shipCity")->nullable();
            $table->string("shipRegion")->nullable();
            $table->string("shipCountry")->nullable();
            $table->foreignId('status_id')->constrained('statuses');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
