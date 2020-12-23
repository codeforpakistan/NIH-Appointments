<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RelateDepartmentHospital extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('department_hospital', function (Blueprint $table) {
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
            $table->foreign('hospital_id')->references('id')->on('hospitals')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('department_hospital', function (Blueprint $table) {
            $table->dropForeign(["department_id"]);
            $table->dropForeign(["hospital_id"]);
        });
    }
}
