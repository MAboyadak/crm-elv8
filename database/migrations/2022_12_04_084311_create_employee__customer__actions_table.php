<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeCustomerActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_customer_actions', function (Blueprint $table) {
            $table->unsignedInteger('employee_id');
            $table->foreign('employee_id')->references('id')->on('users');
            $table->unsignedInteger('action_id');
            $table->foreign('action_id')->references('id')->on('actions');
            $table->text('result');
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
        Schema::dropIfExists('employee__customer__actions');
    }
}
