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
        Schema::create('comercial__operations', function (Blueprint $table) {
            $table->id();

            $table->string('Client_Name');
            $table->foreignId('Client_id')->constrained('clients');

            $table->double('Debtor');
            $table->double('Creditor');
            $table->string('Balance');
            $table->string('Statement');
          
            $table->string('Currency');
            $table->foreignId('currency_id')->constrained('devises');
            $table->string('Emloyee_Name');
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
        Schema::dropIfExists('comercial__operations');
    }
};
