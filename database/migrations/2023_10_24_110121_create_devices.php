<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devices', function (Blueprint $table) {
            $table->unsignedBigInteger('d_ID')->autoIncrement();
            $table->varchar('d_code');
            $table->varchar('d_name');
            $table->unsignedBigInteger('d_inventorynum');
            $table->timestamp('d_purchase_date');
            $table->varchar('d_type');
            $table->varchar('d_location');
            $table->boolean('d_approve')->default("false");
            $table->varchar('d_submittedby');



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
        Schema::dropIfExists('devices');
    }
};
