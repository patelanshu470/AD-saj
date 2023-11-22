<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('tax_rate')->nullable();
            $table->string('tax_amount')->nullable();
            $table->string('subtotal')->nullable();
            $table->string('tax_rate_dollar')->nullable();
            $table->string('tax_amount_dollar')->nullable();
            $table->string('subtotal_dollar')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            //
        });
    }
};
