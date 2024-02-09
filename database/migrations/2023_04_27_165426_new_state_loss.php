<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NewStateLoss extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE computers CHANGE COLUMN state state ENUM('new','in_progress','refurbished','delivered','destroyed', 'picked', 'loss')");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("ALTER TABLE computers CHANGE COLUMN state state ENUM('new','in_progress','refurbished','delivered','destroyed', 'picked')");
    }
}
