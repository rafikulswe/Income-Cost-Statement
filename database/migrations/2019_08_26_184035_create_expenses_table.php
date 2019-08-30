<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('expense_category_id');
            $table->string('expense_name');
            $table->string('expense_details')->nullable();
            $table->float('expense_amount', 10, 2);
            $table->date('expense_date')->nullable();
            $table->timestamps();
            $table->tinyInteger('valid')->default('1');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('expenses');
    }
}
