<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('language', function (Blueprint $table) {
           $table->id('row_id'); // Primary Key, Auto Increment

            $table->string('apply_on_type', 30)->comment('MSG=Pop Message, BTN=Button, TTL=Title, BOD=Page Body');
            $table->string('message_id_to_call', 30)->comment('this will be used for calling the text');

            $table->string('en', 512)->comment('English Text');
            $table->string('bn', 512)->nullable()->comment('Bangla Text');
            $table->string('cn', 512)->nullable()->comment('China Text');
            $table->string('th', 512)->nullable()->comment('Thailand Text');
            $table->string('vn', 512)->nullable()->comment('Vietnam Text');
            $table->string('kh', 512)->nullable()->comment('Cambodia Text');
            $table->string('module')->nullable()->comment('Module Name');

            $table->string('remarks', 255)->nullable()->comment('Open comment for understanding');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('language');
    }
};
