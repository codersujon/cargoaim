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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
             $table->string('name');
            $table->string('email')->unique();
            $table->string('contact');
            $table->string('other_contact')->nullable();
            $table->longtext('address')->nullable();
            $table->string('logo')->nullable();
            $table->string('fav_icon')->nullable();
            $table->string('fb_link')->nullable();
            $table->string('whatsapp_link')->nullable();
            $table->string('twiter_link')->nullable();
            $table->string('instra_link')->nullable();
            $table->string('youTube_link')->nullable();
            $table->string('telegram_link')->nullable();
            $table->string('viber_link')->nullable();
            $table->string('botim_link')->nullable();
            $table->longtext('location')->nullable();
            $table->longtext('message')->nullable();
            $table->longtext('copyright')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
