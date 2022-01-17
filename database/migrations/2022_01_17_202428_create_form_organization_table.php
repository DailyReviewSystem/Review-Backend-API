<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormOrganizationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_organization', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("form_id");
            $table->unsignedBigInteger("organization_id");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('form_organization', function (Blueprint $table) {
            //
        });
    }
}
