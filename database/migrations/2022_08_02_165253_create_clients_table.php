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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->string('First_Name');
            $table->string('Last_Name');
            $table->string('Email');
            $table->string('Balance');
            
            $table->double('Debtor');
            $table->double('Creditor');
            $table->string('Currency');
           
            $table->string('Statement');
            $table->integer('Activation');
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
        Schema::dropIfExists('clients');
    }
};
