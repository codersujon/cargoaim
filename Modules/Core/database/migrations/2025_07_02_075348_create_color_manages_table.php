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
        Schema::create('color_manages', function (Blueprint $table) {
            $table->id();
            $table->string('user_info');
            $table->string('color_pattern')->nullable();
            $table->string('layout_left_color', 20);
            $table->string('layout_right_color', 20);
            $table->string('sidebar_left_color', 20);
            $table->string('sidebar_right_color', 20);
            $table->string('sidebar_menu_hover_color', 20);
            $table->string('sidebar_text_color', 20);
            $table->string('sidebar_text_hover_color', 20)->nullable();
            $table->string('card_border_color', 20);
            $table->string('card_header_color', 20);
            $table->string('card_body_color', 20);
            $table->string('card_text_color', 20);
            $table->string('table_header_bg_color', 20);
            $table->string('table_header_text_color', 20);
            $table->string('table_text_color', 20);
            $table->string('table_header_border_color', 20);
            $table->string('btn_success_color', 20);
            $table->string('btn_danger_color', 20);
            $table->string('btn_info_color', 20);
            $table->string('btn_warning_color', 20);
            $table->string('btn_primary_color', 20);
            $table->string('btn_secondary_color', 20);
            $table->string('btn_dark_color', 20);
            $table->string('input_border_color', 20)->nullable();
            $table->string('body_bg_color', 20)->nullable();
            $table->string('inp_select_bg', 30)->nullable();
            $table->string('active_color')->nullable();
            $table->string('border_dashed', 30)->nullable();
            $table->string('inp_focus_border', 30)->nullable();
            $table->string('inp_focus_bg', 30)->nullable();
            $table->string('inp_selected_border', 30)->nullable();
            $table->string('inp_suggest_bg', 30)->nullable();
            $table->string('inp_search_spinner', 30)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('color_manages');
    }
};
