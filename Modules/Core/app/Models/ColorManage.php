<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Core\Database\Factories\ColorManageFactory;

class ColorManage extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_info',
        'color_pattern',
        'layout_left_color',
        'layout_right_color',

        'sidebar_left_color',
        'sidebar_right_color',
        'sidebar_menu_hover_color',
        'sidebar_text_color',
        'sidebar_text_hover_color',

        'card_border_color',
        'card_header_color',
        'card_body_color',
        'card_text_color',

        'table_header_bg_color',
        'table_header_text_color',
        'table_text_color',
        'table_header_border_color',
        
        'btn_success_color',
        'btn_danger_color',
        'btn_info_color',
        'btn_warning_color',
        'btn_primary_color',
        'btn_secondary_color',
        'btn_dark_color',
        'input_border_color',
        'body_bg_color',
        'border_dashed',
        'inp_select_bg',
        'inp_focus_border',
        'inp_focus_bg',
        'inp_selected_border',
        'inp_suggest_bg',
        'inp_search_spinner',
        'active_color',
    ];

    // protected static function newFactory(): ColorManageFactory
    // {
    //     // return ColorManageFactory::new();
    // }
}
