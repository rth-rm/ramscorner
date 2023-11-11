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
        Schema::create('repair_history', function (Blueprint $table) {
            $table->unsignedBigInteger('rh_id')->autoIncrement();
            $table->string('dcode');
            $table->string('rh_problem');
            $table->string('rh_solution');
            $table->string('d_submittedby');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('repair_history');
    }
};
