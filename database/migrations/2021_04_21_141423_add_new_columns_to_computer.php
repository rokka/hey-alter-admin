<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewColumnsToComputer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('computers', function (Blueprint $table) {
            $table->unsignedTinyInteger('type')->after('email')->default(0);
            $table->string('cpu')->after('model')->default('');
            $table->unsignedTinyInteger('memory_in_gb')->after('model')->default(0);
            $table->unsignedTinyInteger('hard_drive_type')->after('memory_in_gb')->default(0);
            $table->unsignedSmallInteger('hard_drive_space_in_gb')->after('hard_drive_type')->default(0);
            $table->boolean('has_vga_videoport')->after('hard_drive_space_in_gb')->default(false);
            $table->boolean('has_dvi_videoport')->after('has_vga_videoport')->default(false);
            $table->boolean('has_hdmi_videoport')->after('has_dvi_videoport')->default(false);
            $table->boolean('has_displayport_videoport')->after('has_hdmi_videoport')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('computers', function (Blueprint $table) {
            $table->dropColumn('type');
            $table->dropColumn('cpu');
            $table->dropColumn('memory_in_gb');
            $table->dropColumn('hard_drive_type');
            $table->dropColumn('hard_drive_space_in_gb');
            $table->dropColumn('has_vga_videoport');
            $table->dropColumn('has_dvi_videoport');
            $table->dropColumn('has_hdmi_videoport');
            $table->dropColumn('has_displayport_videoport');
        });
    }
}
