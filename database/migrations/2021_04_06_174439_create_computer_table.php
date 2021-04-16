<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComputerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('computers', function (Blueprint $table) {
            $table->id();
            $table->string('identifier')->unique();
            $table->string('donor')->nullable();
            $table->string('email')->nullable();
            $table->string('model')->default('');
            $table->boolean('is_deletion_required')->default(false);
            $table->boolean('needs_donation_receipt')->default(false);
            $table->enum('state', ['new', 'in_progress', 'refurbished', 'delivered', 'destroyed'])->default('new');
            $table->string('comment')->default('');
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
        Schema::dropIfExists('computers');
    }
}
