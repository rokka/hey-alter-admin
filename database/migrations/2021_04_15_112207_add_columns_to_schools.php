<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToSchools extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('schools', function (Blueprint $table) {
            $table->foreignId('team_id')->after('id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('type')->after('name')->default(false);
            $table->string('zip')->after('type')->default('');
            $table->string('city')->after('zip')->default('');
            $table->string('street')->after('city')->default('');
            $table->string('phone')->after('street')->default('');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('schools', function (Blueprint $table) {
            $table->dropColumn('team_id');
            $table->dropColumn('type');
            $table->dropColumn('zip');
            $table->dropColumn('city');
            $table->dropColumn('street');
            $table->dropColumn('phone');
        });
    }
}
