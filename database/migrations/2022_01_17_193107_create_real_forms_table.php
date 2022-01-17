<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRealFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('real_forms', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            /**
             *  Form Data User Submitted ( In JSON Format )
             */
            $table->string("value")->default(null);

            /**
             * Real Form Spec of this form ( get fields )
             */
            $table->unsignedBigInteger("form_id");

            /**
             * User need to fill this form
             */
            $table->unsignedBigInteger("user_id");

            /**
             * Status of this Real Form ( filled or not )
             */
            $table->boolean("done")->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('real_forms');
    }
}
