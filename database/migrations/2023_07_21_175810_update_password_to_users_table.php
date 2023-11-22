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
        if (Schema::hasColumn('users', 'password')) {
            // Modify the existing 'password' column to be nullable and of type string
            DB::statement('ALTER TABLE users MODIFY COLUMN password VARCHAR(255) NULL');
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('users', 'password')) {
            // Modify the existing 'password' column back to not nullable and of type string
            DB::statement('ALTER TABLE users MODIFY COLUMN password VARCHAR(255) NOT NULL');
        }
    }
};
