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
            $table->string('original_price_dollar')->nullable()->after('discount_price');
            $table->string('selling_price_dollar')->nullable()->after('original_price_dollar');
            $table->string('discount_dollar')->nullable()->after('selling_price_dollar');
            $table->string('discount_price_dollar')->nullable()->after('discount_dollar');
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
