<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDistributionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('distributions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('team_id');
            $table->unsignedBigInteger('computer_id');
            $table->unsignedBigInteger('school_id')->nullable();
            $table->string('hash', 255);
            $table->timestamps();
            $table->foreign('team_id')->references('id')->on('teams');
            $table->foreign('computer_id')->references('id')->on('computers');
            $table->foreign('school_id')->references('id')->on('schools')->onDelete('set null');
            $table->unique('hash');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('distributions');
    }
}
