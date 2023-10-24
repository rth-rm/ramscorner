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
            $table->string('d_ID');
            $table->string('d_name');
            $table->unsignedBigInteger('d_inventorynum');
            $table->timestamp('d_purchase_date');
            $table->string('d_type');
            $table->string('d_assignment');
            $table->boolean('d_approve')->default(0);
            $table->string('d_submittedby');

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
