<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operation_commercials', function (Blueprint $table) {
            $table->id();
            $table->string('Client_Name');
            $table->double('Debtor');
            $table->double('Creditor');
            $table->string('Balance');
            $table->string('Statement');
            $table->date('Date');
            $table->string('Currency');
            $table->string('Employee_Name');
           
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
        Schema::dropIfExists('operation_commercials');
    }
};
