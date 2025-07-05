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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('icon')->nullable();
            $table->string('url')->nullable();
            $table->string('route')->nullable();
            $table->json('params')->nullable();
            $table->unsignedBigInteger('parent_route')->nullable();
            $table->integer('order')->default(0);
            $table->string('permission')->nullable(); // single permission string
            $table->json('roles')->nullable();       // role-based visibility
            $table->boolean('is_active')->default(true);
            $table->boolean('is_hidden')->default(false);
            $table->boolean('has_children')->default(false);
            $table->string('module')->nullable();
            $table->string('target')->nullable();     // _blank, modal, etc.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
