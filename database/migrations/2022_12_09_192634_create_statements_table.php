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
        Schema::create('statements', function (Blueprint $table) {
            $table->id();
            $table->string('fio')->nullable();
            $table->date('date_of_create')->nullable();
            $table->boolean('is_signed')->default(false);
            $table->string('stamp')->nullable();
            $table->string('numbers')->nullable();
            $table->string('gas')->default(1);
            $table->foreignId('tanker_id')->constrained();
            $table->foreignId('sheet_id')->constrained();
            $table->foreignId('fuel_id')->constrained();
            $table->foreignId('garage_id')->constrained();
            $table->timestamps();
            $table->softDeletes()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('statements');
    }
};