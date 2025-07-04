@extends('core::dashboard.layouts.master')

@section('title', "| Color Settings")

@section('content')
    <style>
        #layout_left_picker, #layout_right_picker, #sidebar_left_picker, #sidebar_right_picker, #sidebar_menu_hover_picker, #sidebar_text_picker, #card_border_picker, #card_header_picker, #card_body_picker, #card_text_picker, #input_bg_picker, #input_label_picker, #input_picker, #table_header_bg_picker, #table_header_text_picker, #table_text_picker, #table_header_border_picker, #btn_success_picker, #btn_danger_picker, #btn_info_picker, #btn_warning_picker, #btn_primary_picker, #btn_secondary_picker, #btn_dark_picker, #sidebar_text_hover_picker, #input_border_picker, #body_bg_color_picker, #border_dashed_picker, #inp_select_bg_picker, #inp_focus_border_picker, #inp_focus_bg_picker, #inp_selected_border_picker, #inp_suggest_bg_picker, #inp_search_spinner_picker {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
        }
       

    </style>
    <div class="row pt-3">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-bottom border-dashed d-md-flex justify-content-between align-items-center">
                    <!-- Mobile view (visible only on small screens) -->
                    {{-- <div class="d-block d-md-none w-100">
                        <div class="mb-2">
                            <h4 class="card-title mb-2">Color Settings</h4>
                        </div>
                        <div class="mb-2">
                            <div class="input-group">
                                <label class="input-group-text" for="inputGroupSelect01">Choose a Color Pattern</label>
                                <select name="color_pattern" id="color_pattern" class="form-control text-center form-select">
                                    <option value="">-- Choose a Color Pattern --</option>
                                    @foreach ($colorPatterns as $colorPattern)
                                        <option value="{{ $colorPattern->color_pattern }}" {{ $data->color_pattern == $colorPattern->color_pattern ? 'selected' : '' }}>
                                            {{ ucfirst($colorPattern->color_pattern) }} Color
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between gap-2">
                            <button type="button" class="btn btn-danger w-50" id="btn_save">Save</button>
                            <button type="button" class="btn btn-primary w-50 btn_new_color_pattern">New</button>
                        </div>
                    </div> --}}
                
                    <!-- Desktop view (visible only on md and up) -->
                    <div class="d-none d-md-flex justify-content-between align-items-center w-100">
                        <h4 class="card-title mb-0">{{ transText('color_settings_btn') }}</h4>
                
                        <div class="input-group w-25 mx-3">
                            <label class="input-group-text" for="inputGroupSelect01" style="width: auto;">{{ transText('ccp_label') }}</label>
                            <select name="color_pattern" id="color_pattern" class="form-control form-select">
                                <option value="">-- Choose a Color Pattern --</option>
                                @foreach ($colorPatterns as $colorPattern)
                                    <option value="{{ $colorPattern->color_pattern }}" {{ $data->color_pattern == $colorPattern->color_pattern ? 'selected' : '' }}>
                                        {{ ucfirst($colorPattern->color_pattern) }} Color
                                    </option>
                                @endforeach
                            </select>
                        </div>
                
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-danger" id="btn_save">{{ transText('save_and_apply_btn') }}</button>
                            <button type="button" class="btn btn-primary btn_new_color_pattern">{{ transText('save_and_apply_btn') }}</button>
                        </div>
                    </div>
                </div><!-- end card header -->
                
                
                


                <div class="card-body">
                    <form id="form" name="form" class="form-horizontal" method="POST" action="{{ url('color_settings') }}" enctype="multipart/form-data">
                        @csrf()
                        <div class="layout-color-wrapper">

                            <input type="hidden" name="id" id="color_id" value="{{ $data->id }}">
                            <input type="hidden" name="user_info" id="user_info" value="{{ $data->user_info }}">
                            <input type="hidden" name="color_pattern" id="color_patterns" value="{{ $data->color_pattern }}">

                            <!-- New Color Pattern --> 
                            <div class="row color-inputs mt-3" id="new_pattern" style="display: none;">
                                <div class="col-sm-12 col-md-12 col-lg-6">
                                    <div class="row">
                                        <div class="col-5 col-md-3 col-lg-3 d-flex align-items-center ps-md-3">
                                            <h5 class="d-none d-sm-block"> COLOR PATTERN</h5>
                                            <h5 class="d-none d-sm-block ms-auto">:</h5>
                                        
                                            <h5 class="d-block d-sm-none"> COLOR PATTERN:</h5>
                                        </div>                                                                             
                                        
                                        <div class="col-7 col-md-3 col-lg-5 mb-2">                                            
                                            <input type="text" class="form-control" id="new_color_pattern" placeholder="Enter your color pattern name">                                                
                                        </div>
                                        <div class="col-12 col-md-4 col-lg-4 mb-2">
                                            <button type="submit" class="btn btn-success" id="btn_save_color_pattern" style="display: none"> {{ transText('save_btn') }} </button>
                                            <button type="submit" class="btn btn-danger" id="btn_close_color_pattern"> {{ transText('close_btn') }} </button>
                                        </div>
                                    </div>                                    
                                </div>
                            </div>
                            </br>

                            <!-- Bar Color --> 
                            <div class="row color-inputs">
                                <div class="col-sm-12 col-md-12 col-lg-6">
                                    <div class="row">
                                        <div class="col-6 col-md-3 col-lg-3 d-flex align-items-center ps-md-3">
                                            <h5 class="d-none d-sm-block">{{ transText('bar_color') }}</h5>
                                            <h5 class="d-none d-sm-block ms-auto">:</h5>
                                        
                                            <h5 class="d-block d-sm-none">{{ transText('bar_color') }} :</h5>
                                        </div>
                                                                             
                                        
                                        <div class="col-6 col-md-3 col-lg-3 mb-2">
                                            <!-- Layout Left Color Picker -->
                                            <div class="input-group align-items-center">
                                                <div class="input-group-text" id="layout_left_box" style="width: 50px; height: 25px; background-color: {{ $data->layout_left_color }};"></div>
                                                <input type="text" class="form-control text-center" id="layout_left_color" name="layout_left_color" value="{{ $data->layout_left_color }}">
                                                <input type="color" id="layout_left_picker" value="{{ $data->layout_left_color }}" class="form-control form-control-color" title="{{ transText('topbar1_color_label') }}">
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-3 col-lg-3 mb-2">
                                            <!-- Layout Right Color Picker -->
                                            <div class="input-group align-items-center">
                                                <div class="input-group-text" id="layout_right_box" style="width: 50px; height: 25px; background-color: {{ $data->layout_right_color }};"></div>
                                                <input type="text" class="form-control text-center" id="layout_right_color" name="layout_right_color" value="{{ $data->layout_right_color }}">
                                                <input type="color" id="layout_right_picker" value="{{ $data->layout_right_color }}" class="form-control form-control-color" title="{{ transText('topbar2_color_label') }}">
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-3 col-lg-3 mb-2">
                                            <!-- Sidebar Left Color Picker -->
                                            <div class="input-group align-items-center">
                                                <div class="input-group-text" id="sidebar_left_box" style="width: 50px; height: 25px; background-color: {{ $data->sidebar_left_color }};"></div>
                                                <input type="text" class="form-control text-center" id="sidebar_left_color" name="sidebar_left_color" value="{{ $data->sidebar_left_color }}" title="{{ transText('sidebar1_color') }}">
                                                <input type="color" id="sidebar_left_picker" value="{{ $data->sidebar_left_color }}" class="form-control form-control-color" title="{{ transText('sidebar1_color') }}">
                                            </div>
                                        </div>
                                    </div>                                    
                                </div>

                                <div class="col-sm-12 col-md-12 col-lg-6">
                                    <div class="row">
                                        <div class="col-6 col-md-3 col-lg-3 mb-2">
                                            <!-- Sidebar Right Color Picker -->
                                            <div class="input-group align-items-center">
                                                <div class="input-group-text" id="sidebar_right_box" style="width: 50px; height: 25px; background-color: {{ $data->sidebar_right_color }};"></div>
                                                <input type="text" class="form-control text-center" id="sidebar_right_color" name="sidebar_right_color" value="{{ $data->sidebar_right_color }}" title="{{ transText('sidebar2_color') }}">
                                                <input type="color" id="sidebar_right_picker" value="{{ $data->sidebar_right_color }}" class="form-control form-control-color" title="{{ transText('sidebar2_color') }}">
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-3 col-lg-3 mb-2">
                                            <!-- Sidebar Menu Hover Color Picker -->
                                            <div class="input-group align-items-center">
                                                <div class="input-group-text" id="sidebar_menu_hover_box" style="width: 50px; height: 25px; background-color: {{ $data->sidebar_menu_hover_color }};"></div>
                                                <input type="text" class="form-control text-center" id="sidebar_menu_hover_color" name="sidebar_menu_hover_color" value="{{ $data->sidebar_menu_hover_color }}" title="Sidebar Menu Hover Color">
                                                <input type="color" id="sidebar_menu_hover_picker" value="{{ $data->sidebar_menu_hover_color }}" class="form-control form-control-color" title="{{ transText('sidebar_menu_hover') }}">
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-3 col-lg-3 mb-2">
                                             <!-- Sidebar Text Color Picker -->
                                            <div class="input-group align-items-center">
                                                <div class="input-group-text" id="sidebar_text_box" style="width: 50px; height: 25px; background-color: {{ $data->sidebar_text_color }};"></div>
                                                <input type="text" class="form-control text-center" id="sidebar_text_color" name="sidebar_text_color" value="{{ $data->sidebar_text_color }}">
                                                <input type="color" id="sidebar_text_picker" value="{{ $data->sidebar_text_color }}" class="form-control form-control-color" title="{{ transText('side_and_topbar_text') }}">
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-3 col-lg-3 mb-2">
                                            <!-- Sidebar Text Hover Color Picker -->
                                            <div class="input-group align-items-center">
                                                <div class="input-group-text" id="sidebar_text_hover_box" style="width: 50px; height: 25px; background-color: {{ $data->sidebar_text_hover_color }};"></div>
                                                <input type="text" class="form-control text-center" id="sidebar_text_hover_color" name="sidebar_text_hover_color" value="{{ $data->sidebar_text_hover_color }}">
                                                <input type="color" id="sidebar_text_hover_picker" value="{{ $data->sidebar_text_hover_color }}" class="form-control form-control-color" title="{{ transText('side_and_topbar_text_hover') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            
                            <!-- Card Color -->                                                     
                            <div class="row color-inputs">
                                <div class="col-sm-12 col-md-12 col-lg-6">
                                    <div class="row">
                                        <div class="col-6 col-md-3 col-lg-3 d-flex align-items-center ps-md-3">
                                            <h5 class="d-none d-sm-block">{{ transText('card_color') }}</h5>
                                            <h5 class="d-none d-sm-block ms-auto">:</h5>
                                        
                                            <h5 class="d-block d-sm-none">{{ transText('card_color') }} :</h5>
                                        </div>
                                        <!-- Card Header Color Picker -->
                                        <div class="col-6 col-md-3 col-lg-3 mb-2">
                                            <div class="input-group align-items-center">
                                                <div class="input-group-text" id="card_header_box" style="width: 50px; height: 25px; background-color: {{ $data->card_header_color }};"></div>
                                                <input type="text" class="form-control text-center" id="card_header_color" name="card_header_color" value="{{ $data->card_header_color }}">
                                                <input type="color" id="card_header_picker" value="{{ $data->card_header_color }}" class="form-control form-control-color" title="{{ transText('card_header_color_label') }}">
                                            </div>
                                        </div>
                                        <!-- Card Border Color Picker -->
                                        <div class="col-6 col-md-3 col-lg-3 mb-2">
                                            <div class="input-group align-items-center">
                                                <div class="input-group-text" id="card_border_box" style="width: 50px; height: 25px; background-color: {{ $data->card_border_color }};"></div>
                                                <input type="text" class="form-control text-center" id="card_border_color" name="card_border_color" value="{{ $data->card_border_color }}">
                                                <input type="color" id="card_border_picker" value="{{ $data->card_border_color }}" class="form-control form-control-color" title="{{ transText('card_header_text_color') }}">
                                            </div>
                                        </div> 
                                        <!-- Card Body Color Picker -->
                                        <div class="col-6 col-md-3 col-lg-3 mb-2">
                                            <div class="input-group align-items-center">
                                                <div class="input-group-text" id="card_body_box" style="width: 50px; height: 25px; background-color: {{ $data->card_body_color }};"></div>
                                                <input type="text" class="form-control text-center" id="card_body_color" name="card_body_color" value="{{ $data->card_body_color }}">
                                                <input type="color" id="card_body_picker" value="{{ $data->card_body_color }}" class="form-control form-control-color" title="{{ transText('card_body_color') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-6">
                                    <div class="row">
                                        <!-- Card Body Color Picker -->
                                        <div class="col-6 col-md-3 col-lg-3 mb-2">
                                            <div class="input-group align-items-center">
                                                <div class="input-group-text" id="card_text_box" style="width: 50px; height: 25px; background-color: {{ $data->card_text_color }};"></div>
                                                <input type="text" class="form-control text-center" id="card_text_color" name="card_text_color" value="{{ $data->card_text_color }}">
                                                <input type="color" id="card_text_picker" value="{{ $data->card_text_color }}" class="form-control form-control-color" title="{{ transText('card_text_color') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>

                            <!-- Table Color -->                          
                            <div class="row color-inputs">
                                <div class="col-sm-12 col-md-12 col-lg-6">
                                    <div class="row">
                                        <div class="col-6 col-md-3 col-lg-3 d-flex align-items-center ps-md-3">
                                            <h5 class="d-none d-sm-block">{{ transText('table_color') }}</h5>
                                            <h5 class="d-none d-sm-block ms-auto">:</h5>
                                        
                                            <h5 class="d-block d-sm-none">{{ transText('table_color') }} :</h5>
                                        </div>
                                        <!-- Table Header bg Color Picker -->
                                        <div class="col-6 col-md-3 col-lg-3 mb-2">
                                            <div class="input-group align-items-center">
                                                <div class="input-group-text" id="table_header_bg_box" style="width: 50px; height: 25px; background-color: {{ $data->table_header_bg_color }};"></div>
                                                <input type="text" class="form-control text-center" id="table_header_bg_color" name="table_header_bg_color" value="{{ $data->table_header_bg_color }}">
                                                <input type="color" id="table_header_bg_picker" value="{{ $data->table_header_bg_color }}" class="form-control form-control-color" title="{{ transText('table_heder_bg_Color') }}">
                                            </div>
                                        </div>
                                        <!-- Table Header Text Color Picker -->
                                        <div class="col-6 col-md-3 col-lg-3 mb-2">
                                            <div class="input-group align-items-center">
                                                <div class="input-group-text" id="table_header_text_box" style="width: 50px; height: 25px; background-color: {{ $data->table_header_text_color }};"></div>
                                                <input type="text" class="form-control text-center" id="table_header_text_color" name="table_header_text_color" value="{{ $data->table_header_text_color }}">
                                                <input type="color" id="table_header_text_picker" value="{{ $data->table_header_text_color }}" class="form-control form-control-color" title="{{ transText('table_header_text_color') }}">
                                            </div>
                                        </div>
                                        <!--Table Body Text Color Picker -->
                                        <div class="col-6 col-md-3 col-lg-3 mb-2">
                                            <div class="input-group align-items-center">
                                                <div class="input-group-text" id="table_text_box" style="width: 50px; height: 25px; background-color: {{ $data->table_text_color }};"></div>
                                                <input type="text" class="form-control text-center" id="table_text_color" name="table_text_color" value="{{ $data->table_text_color }}">
                                                <input type="color" id="table_text_picker" value="{{ $data->table_text_color }}" class="form-control form-control-color" title="{{ transText('table_body_text_color') }}">
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-6">
                                    <div class="row">
                                        <!-- Table Header Border Color Picker -->
                                        <div class="col-6 col-md-3 col-lg-3 mb-2">
                                            <div class="input-group align-items-center">
                                                <div class="input-group-text" id="table_header_border_box" style="width: 50px; height: 25px; background-color: {{ $data->table_header_border_color }};"></div>
                                                <input type="text" class="form-control text-center" id="table_header_border_color" name="table_header_border_color" value="{{ $data->table_header_border_color }}">
                                                <input type="color" id="table_header_border_picker" value="{{ $data->table_header_border_color }}" class="form-control form-control-color" title="{{ transText('table_border_color') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>

                            <!-- Button Color -->                          
                            <div class="row color-inputs">
                                <div class="col-sm-12 col-md-12 col-lg-6">
                                    <div class="row">
                                        <div class="col-6 col-md-3 col-lg-3 d-flex align-items-center ps-md-3">
                                            <h5 class="d-none d-sm-block">{{ transText('button_color') }}</h5>
                                            <h5 class="d-none d-sm-block ms-auto">:</h5>
                                        
                                            <h5 class="d-block d-sm-none">{{ transText('button_color') }} :</h5>
                                        </div>
                                        <!-- Success Button Color Picker -->
                                        <div class="col-6 col-md-3 col-lg-3 mb-2">
                                            <div class="input-group align-items-center">
                                                <div class="input-group-text" id="btn_success_box" style="width: 50px; height: 25px; background-color: {{ $data->btn_success_color }};"></div>
                                                <input type="text" class="form-control text-center" id="btn_success_color" name="btn_success_color" value="{{ $data->btn_success_color }}">
                                                <input type="color" id="btn_success_picker" value="{{ $data->btn_success_color }}" class="form-control form-control-color" title="{{ transText('success_button_color') }}">
                                            </div>
                                        </div>
                                        <!-- Danger Button Color Picker -->
                                        <div class="col-6 col-md-3 col-lg-3 mb-2">
                                            <div class="input-group align-items-center">
                                                <div class="input-group-text" id="btn_danger_box" style="width: 50px; height: 25px; background-color: {{ $data->btn_danger_color }};"></div>
                                                <input type="text" class="form-control text-center" id="btn_danger_color" name="btn_danger_color" value="{{ $data->btn_danger_color }}">
                                                <input type="color" id="btn_danger_picker" value="{{ $data->btn_danger_color }}" class="form-control form-control-color" title="{{ transText('danger_button_color') }}">
                                            </div>
                                        </div>
                                        <!--Info Button Color Picker -->
                                        <div class="col-6 col-md-3 col-lg-3 mb-2">
                                            <div class="input-group align-items-center">
                                                <div class="input-group-text" id="btn_info_box" style="width: 50px; height: 25px; background-color: {{ $data->btn_info_color }};"></div>
                                                <input type="text" class="form-control text-center" id="btn_info_color" name="btn_info_color" value="{{ $data->btn_info_color }}">
                                                <input type="color" id="btn_info_picker" value="{{ $data->btn_info_color }}" class="form-control form-control-color" title="{{ transText('info_button_color') }}">
                                            </div>
                                        </div>
                                    </div>                                    
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-6">
                                    <div class="row">
                                        <!-- Warning Button Color Picker -->
                                        <div class="col-6 col-md-3 col-lg-3 mb-2">
                                            <div class="input-group align-items-center">
                                                <div class="input-group-text" id="btn_warning_box" style="width: 50px; height: 25px; background-color: {{ $data->btn_warning_color }};"></div>
                                                <input type="text" class="form-control text-center" id="btn_warning_color" name="btn_warning_color" value="{{ $data->btn_warning_color }}">
                                                <input type="color" id="btn_warning_picker" value="{{ $data->btn_warning_color }}" class="form-control form-control-color" title="{{ transText('warning_button_color') }}">	
                                            </div>
                                        </div>
                                        <!-- Primary Button Color Picker -->
                                        <div class="col-6 col-md-3 col-lg-3 mb-2">
                                            <div class="input-group align-items-center">
                                                <div class="input-group-text" id="btn_primary_box" style="width: 50px; height: 25px; background-color: {{ $data->btn_primary_color }};"></div>
                                                <input type="text" class="form-control text-center" id="btn_primary_color" name="btn_primary_color" value="{{ $data->btn_primary_color }}">
                                                <input type="color" id="btn_primary_picker" value="{{ $data->btn_primary_color }}" class="form-control form-control-color" title="{{ transText('primary_button_color') }}">
                                            </div>
                                        </div>
                                        <!-- Secondary Button Color Picker -->
                                        <div class="col-6 col-md-3 col-lg-3 mb-2">
                                            <div class="input-group align-items-center">
                                                <div class="input-group-text" id="btn_secondary_box" style="width: 50px; height: 25px; background-color: {{ $data->btn_secondary_color }};"></div>
                                                <input type="text" class="form-control text-center" id="btn_secondary_color" name="btn_secondary_color" value="{{ $data->btn_secondary_color }}">
                                                <input type="color" id="btn_secondary_picker" value="{{ $data->btn_secondary_color }}" class="form-control form-control-color" title="{{ transText('secondary_button_color') }}">
                                            </div>
                                        </div>
                                        <!-- Dark Button Color Picker -->
                                        <div class="col-6 col-md-3 col-lg-3 mb-2">
                                            <div class="input-group align-items-center">
                                                <div class="input-group-text" id="btn_dark_box" style="width: 50px; height: 25px; background-color: {{ $data->btn_dark_color }};"></div>
                                                <input type="text" class="form-control text-center" id="btn_dark_color" name="btn_dark_color" value="{{ $data->btn_dark_color }}">
                                                <input type="color" id="btn_dark_picker" value="{{ $data->btn_dark_color }}" class="form-control form-control-color" title="{{ transText('dark_button_color') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>                        
                            </div>
                            <br>


                            

                            <!-- Input Color -->                          
                            <div class="row color-inputs">
                                <div class="col-sm-12 col-md-12 col-lg-6">
                                    <div class="row">
                                        <div class="col-6 col-md-3 col-lg-3 d-flex align-items-center ps-md-3">
                                            <h5 class="d-none d-sm-block">{{ transText('input_color') }}</h5>
                                            <h5 class="d-none d-sm-block ms-auto">:</h5>
                                        
                                            <h5 class="d-block d-sm-none">{{ transText('input_color') }} :</h5>
                                        </div>
                                        
                                        <!-- Input Border Color Picker -->
                                        <div class="col-6 col-md-3 col-lg-3 mb-2">
                                            <div class="input-group align-items-center">
                                                <div class="input-group-text" id="input_border_box" style="width: 50px; height: 25px; background-color: {{ $data->input_border_color }};"></div>
                                                <input type="text" class="form-control text-center" id="input_border_color" name="input_border_color" value="{{ $data->input_border_color }}">
                                                <input type="color" id="input_border_picker" value="{{ $data->input_border_color }}" class="form-control form-control-color" title="{{ transText('input_border_color') }}">
                                            </div>
                                        </div> 



                                        <!-- Input Focus Border Color Picker -->
                                        <div class="col-6 col-md-3 col-lg-3 mb-2">
                                            <div class="input-group align-items-center">
                                                <div class="input-group-text" id="inp_focus_border_box" style="width: 50px; height: 25px; background-color: {{ $data->inp_focus_border }};"></div>
                                                <input type="text" class="form-control text-center" id="inp_focus_border" name="inp_focus_border" value="{{ $data->inp_focus_border }}">
                                                <input type="color" id="inp_focus_border_picker" value="{{ $data->inp_focus_border }}" class="form-control form-control-color" title="{{ transText('inp_focus_border_color') }}">
                                            </div>
                                        </div>
                                        <!-- Input Focus Background Color Picker -->
                                        <div class="col-6 col-md-3 col-lg-3 mb-2">
                                            <div class="input-group align-items-center">
                                                <div class="input-group-text" id="inp_focus_bg_box" style="width: 50px; height: 25px; background-color: {{ $data->inp_focus_bg }};"></div>
                                                <input type="text" class="form-control text-center" id="inp_focus_bg" name="inp_focus_bg" value="{{ $data->inp_focus_bg }}">
                                                <input type="color" id="inp_focus_bg_picker" value="{{ $data->inp_focus_bg }}" class="form-control form-control-color" title="{{ transText('inp_focus_bg_color') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-6">
                                    <div class="row">
                                        <!-- Input Selected Border Color Picker -->
                                        <div class="col-6 col-md-3 col-lg-3 mb-2">
                                            <div class="input-group align-items-center">
                                                <div class="input-group-text" id="inp_selected_border_box" style="width: 50px; height: 25px; background-color: {{ $data->inp_selected_border }};"></div>
                                                <input type="text" class="form-control text-center" id="inp_selected_border" name="inp_selected_border" value="{{ $data->inp_selected_border }}">
                                                <input type="color" id="inp_selected_border_picker" value="{{ $data->inp_selected_border }}" class="form-control form-control-color" title="{{ transText('inp_selected_border_color') }}">
                                            </div>
                                        </div> 
                                        <!-- Input Select Background Color Picker -->
                                        <div class="col-6 col-md-3 col-lg-3 mb-2">
                                            <div class="input-group align-items-center">
                                                <div class="input-group-text" id="inp_select_bg_box" style="width: 50px; height: 25px; background-color: {{ $data->inp_select_bg }};"></div>
                                                <input type="text" class="form-control text-center" id="inp_select_bg" name="inp_select_bg" value="{{ $data->inp_select_bg }}">
                                                <input type="color" id="inp_select_bg_picker" value="{{ $data->inp_select_bg }}" class="form-control form-control-color" title="{{ transText('inp_select_bg_color') }}">
                                            </div>
                                        </div> 
                                        <!-- Input Suggestions Box Color Picker -->
                                        <div class="col-6 col-md-3 col-lg-3 mb-2">
                                            <div class="input-group align-items-center">
                                                <div class="input-group-text" id="inp_suggest_bg_box" style="width: 50px; height: 25px; background-color: {{ $data->inp_suggest_bg }};"></div>
                                                <input type="text" class="form-control text-center" id="inp_suggest_bg" name="inp_suggest_bg" value="{{ $data->inp_suggest_bg }}">
                                                <input type="color" id="inp_suggest_bg_picker" value="{{ $data->inp_suggest_bg }}" class="form-control form-control-color" title="{{ transText('inp_suggest_bg_color') }}">
                                            </div>
                                        </div> 
                                        <!-- Input Search Spinner Color Picker -->
                                        <div class="col-6 col-md-3 col-lg-3 mb-2">
                                            <div class="input-group align-items-center">
                                                <div class="input-group-text" id="inp_search_spinner_box" style="width: 50px; height: 25px; background-color: {{ $data->inp_search_spinner }};"></div>
                                                <input type="text" class="form-control text-center" id="inp_search_spinner" name="inp_search_spinner" value="{{ $data->inp_search_spinner }}">
                                                <input type="color" id="inp_search_spinner_picker" value="{{ $data->inp_search_spinner }}" class="form-control form-control-color" title="{{ transText('inp_search_spinner_color') }}">
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                            <br>




                            <!-- Other Color -->                          
                            <div class="row color-inputs">
                                <div class="col-sm-12 col-md-12 col-lg-6">
                                    <div class="row">
                                        <!-- Body background Color Picker -->
                                        <div class="col-6 col-md-3 col-lg-3 d-flex align-items-center ps-md-3">
                                            <h5 class="d-none d-sm-block">{{ transText('bg_color') }}</h5>
                                            <h5 class="d-none d-sm-block ms-auto">:</h5>
                                        
                                            <h5 class="d-block d-sm-none">{{ transText('bg_color') }} :</h5>
                                        </div>
                                        <div class="col-6 col-md-3 col-lg-3 mb-2">
                                            <div class="input-group align-items-center">
                                                <div class="input-group-text" id="body_bg_color_box" style="width: 50px; height: 25px; background-color: {{ $data->body_bg_color }};"></div>
                                                <input type="text" class="form-control text-center" id="body_bg_color" name="body_bg_color" value="{{ $data->body_bg_color }}">
                                                <input type="color" id="body_bg_color_picker" value="{{ $data->body_bg_color }}" class="form-control form-control-color" title="{{ transText('bg_color') }}">
                                            </div>
                                        </div>

                                        <!-- Border Dashed Color Picker -->
                                        <div class="col-6 col-md-3 col-lg-3 d-flex align-items-center ps-md-3">
                                            <h5 class="d-none d-sm-block">{{ transText('border_dashed_color') }}</h5>
                                            <h5 class="d-none d-sm-block ms-auto">:</h5>
                                        
                                            <h5 class="d-block d-sm-none">{{ transText('border_dashed_color') }} :</h5>
                                        </div>
                                        <div class="col-6 col-md-3 col-lg-3 mb-2">
                                            <div class="input-group align-items-center">
                                                <div class="input-group-text" id="border_dashed_box" style="width: 50px; height: 25px; background-color: {{ $data->border_dashed }};"></div>
                                                <input type="text" class="form-control text-center" id="border_dashed" name="border_dashed" value="{{ $data->border_dashed }}">
                                                <input type="color" id="border_dashed_picker" value="{{ $data->border_dashed }}" class="form-control form-control-color" title="{{ transText('border_dashed_color') }}">
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-center col-sm-offset-2 col-sm-12 my-4">
                            <button type="submit" class="btn btn-success" id="btn_update">
                                {{ transText('update_and_apply_btn') }}
                            </button>                            
                                                       
                        </div>                        
                    </form>                    
                </div><!-- end card-body -->
            </div><!-- end card -->
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->
@endsection

@section('script')
     <script type="text/javascript">
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        
            const colorFields = [
                {picker: '#layout_left_picker', input: '#layout_left_color', box: '#layout_left_box'},
                {picker: '#layout_right_picker', input: '#layout_right_color', box: '#layout_right_box'},
                {picker: '#sidebar_left_picker', input: '#sidebar_left_color', box: '#sidebar_left_box'},
                {picker: '#sidebar_right_picker', input: '#sidebar_right_color', box: '#sidebar_right_box'},
                {picker: '#sidebar_text_picker', input: '#sidebar_text_color', box: '#sidebar_text_box'},
                {picker: '#sidebar_menu_hover_picker', input: '#sidebar_menu_hover_color', box: '#sidebar_menu_hover_box'},
                {picker: '#card_border_picker', input: '#card_border_color', box: '#card_border_box'},
                {picker: '#card_header_picker', input: '#card_header_color', box: '#card_header_box'},
                {picker: '#card_body_picker', input: '#card_body_color', box: '#card_body_box'},
                {picker: '#card_text_picker', input: '#card_text_color', box: '#card_text_box'},
                {picker: '#table_header_bg_picker', input: '#table_header_bg_color', box: '#table_header_bg_box'},
                {picker: '#table_header_text_picker', input: '#table_header_text_color', box: '#table_header_text_box'},
                {picker: '#table_text_picker', input: '#table_text_color', box: '#table_text_box'},
                {picker: '#table_header_border_picker', input: '#table_header_border_color', box: '#table_header_border_box'},
                {picker: '#btn_success_picker', input: '#btn_success_color', box: '#btn_success_box'},
                {picker: '#btn_danger_picker', input: '#btn_danger_color', box: '#btn_danger_box'},
                {picker: '#btn_info_picker', input: '#btn_info_color', box: '#btn_info_box'},
                {picker: '#btn_warning_picker', input: '#btn_warning_color', box: '#btn_warning_box'},
                {picker: '#btn_primary_picker', input: '#btn_primary_color', box: '#btn_primary_box'},
                {picker: '#btn_secondary_picker', input: '#btn_secondary_color', box: '#btn_secondary_box'},
                {picker: '#btn_dark_picker', input: '#btn_dark_color', box: '#btn_dark_box'},
                {picker: '#sidebar_text_hover_picker', input: '#sidebar_text_hover_color', box: '#sidebar_text_hover_box'},
                {picker: '#input_border_picker', input: '#input_border_color', box: '#input_border_box'},
                {picker: '#body_bg_color_picker', input: '#body_bg_color', box: '#body_bg_color_box'},
                {picker: '#border_dashed_picker', input: '#border_dashed', box: '#border_dashed_box'},
                {picker: '#inp_select_bg_picker', input: '#inp_select_bg', box: '#inp_select_bg_box'},
                {picker: '#inp_focus_border_picker', input: '#inp_focus_border', box: '#inp_focus_border_box'},
                {picker: '#inp_focus_bg_picker', input: '#inp_focus_bg', box: '#inp_focus_bg_box'},
                {picker: '#inp_selected_border_picker', input: '#inp_selected_border', box: '#inp_selected_border_box'},
                {picker: '#inp_suggest_bg_picker', input: '#inp_suggest_bg', box: '#inp_suggest_bg_box'},
                {picker: '#inp_search_spinner_picker', input: '#inp_search_spinner', box: '#inp_search_spinner_box'},
            ];

            function updateSidebarBackground() {
                const leftColor = $('#sidebar_left_picker').val();
                const rightColor = $('#sidebar_right_picker').val();

                const topleftColor = $('#layout_left_picker').val();
                const toprightColor = $('#layout_right_picker').val();

                const topTextColor = $('#sidebar_text_picker').val();
                const topTextHoverColor = $('#sidebar_text_hover_picker').val();

                const bodyBGcolor = $('#body_bg_color_picker').val();
                const inputbordercolor = $('#input_border_picker').val();

                // Sidebar and logo background
                $('.sidenav-menu').css('background', `linear-gradient(135deg, ${leftColor} 0%, ${rightColor} 60%)`);
                $('.sidenav-menu .logo').css('background', `linear-gradient(135deg, ${leftColor} 0%, ${rightColor} 60%)`);
                
                $('body').css('background-color', bodyBGcolor);
                $('.form-control').css('border', `1px solid ${inputbordercolor}`);
                
                // Topbar link text and hover
                $('.app-topbar .topbar-menu .topbar-item .topbar-link').each(function () {
                    const $this = $(this);

                    this.style.setProperty('color', topTextColor, 'important');

                    $this.off('mouseenter mouseleave');

                    $this.on('mouseenter', function () {
                        this.style.setProperty('color', topTextHoverColor, 'important');
                    }).on('mouseleave', function () {
                        this.style.setProperty('color', topTextColor, 'important');
                    });
                });

                // Apply text color
                $('.side-nav .side-nav-item .side-nav-link').each(function () {
                    this.style.setProperty('color', topTextColor, 'important');
                });
            
                // Add hover effect to sidebar links
                $('.side-nav .side-nav-item .side-nav-link').each(function () {
                    const $this = $(this);

                    $this.off('mouseenter mouseleave'); // Remove previous listeners (prevent stacking)

                    $this.on('mouseenter', function () {
                        $this.css({
                            'color': topTextHoverColor,
                        });
                    });
                    $this.on('mouseleave', function () {
                        $this.css({
                            'color': topTextColor,
                        });
                    });
                });

                // Topbar background
                $('.app-topbar').css({
                    'background': `linear-gradient(135deg, ${topleftColor} 0%, ${toprightColor} 60%)`
                });

                // User section background
                $('.nav-user').css({
                    'background': topleftColor,
                    'background-color': topleftColor,
                    'background-image': 'none'
                });
            
                // Sidebar toggle button color
                $('.sidenav-toggle-button').each(function () {
                    this.style.setProperty('color', topTextColor, 'important');
                });
            }


            // Initialize color pickers
            colorFields.forEach(({picker, input, box}) => {
                const $picker = $(picker);
                const $input = $(input);
                const $box = $(box);

                $picker.on('input', function () {
                    const color = $(this).val();
                    $input.val(color);
                    $box.css('background-color', color);

                    // Check if this is a layout/sidebar picker and update background
                    if (
                        picker === '#sidebar_left_picker' || 
                        picker === '#sidebar_right_picker' ||
                        picker === '#layout_left_picker' || 
                        picker === '#layout_right_picker' ||
                        picker === '#sidebar_text_hover_picker' ||
                        picker === '#sidebar_text_picker' ||
                        picker === '#body_bg_color_picker' ||
                        picker === '#input_border_picker' ||
                        picker === '#border_dashed_picker' ||
                        picker === '#inp_select_bg_picker' ||
                        picker === '#inp_focus_border_picker' ||
                        picker === '#inp_focus_bg_picker' ||
                        picker === '#inp_selected_border_picker' ||
                        picker === '#inp_suggest_bg_picker' ||
                        picker === '#inp_search_spinner_picker' // ✅ এই লাইনটি যোগ করুন
                    ) {
                        updateSidebarBackground();
                    }
                });

                // Set initial picker and box color
                $picker.val($input.val());
                $box.css('background-color', $input.val());
            });
            // Initial background update on page load
            updateSidebarBackground();


            let originalColorValues = {};
            let patternChanged = false;

            // পেজ লোডের সময় বর্তমান ইনপুট ফিল্ডের ভ্যালু ক্যাপচার
            function initializeOriginalColors() {
                let fields = [
                    'layout_left_color', 'layout_right_color',
                    'sidebar_left_color', 'sidebar_right_color',
                    'sidebar_menu_hover_color', 'sidebar_text_color', 'sidebar_text_hover_color',
                    'card_header_color', 'card_border_color', 'card_body_color', 'card_text_color',
                    'table_header_bg_color', 'table_header_text_color', 'table_text_color',
                    'table_header_border_color',
                    'btn_success_color', 'btn_danger_color', 'btn_info_color',
                    'btn_warning_color', 'btn_primary_color', 'btn_secondary_color', 'btn_dark_color', 'input_border_color', 'body_bg_color', 'border_dashed', 'inp_select_bg', 'inp_focus_border', 'inp_focus_bg', 'inp_selected_border', 'inp_suggest_bg', 'inp_search_spinner'
                ];

                fields.forEach(function (field) {
                    originalColorValues[field] = $('#' + field).val();
                });
            }

            // Function: ইনপুট চেঞ্জ হয়েছে কি না
            function hasColorChanged() {
                for (const key in originalColorValues) {
                    if ($('#' + key).val() !== originalColorValues[key]) {
                        return true;
                    }
                }
                return false;
            }

            // শুরুতে ইনিশিয়াল ইনপুট স্টেট সেট করুন
            initializeOriginalColors();

            // শুরুতে বাটন ডিজেবল
            $('#btn_save').prop('disabled', true);
            $('#btn_update').prop('disabled', true);

            // color_pattern পরিবর্তনের সময়
            $('#color_pattern').on('change', function () {
                let pattern = $(this).val();

                if (pattern !== "") {
                    patternChanged = true;

                    $.ajax({
                        url: "{{ url('/get-color-pattern') }}/" + pattern,
                        type: 'GET',
                        success: function (data) {
                            $('#color_id').val(data.id);
                            $('#user_info').val(data.user_info);
                            $('#color_patterns').val(data.color_pattern);

                            let fields = Object.keys(originalColorValues);
                            originalColorValues = {}; // reset

                            fields.forEach(function (field) {
                                let color = data[field];
                                originalColorValues[field] = color;

                                $('#' + field).val(color);
                                $('#' + field.replace('_color', '_picker')).val(color);
                                $('#' + field.replace('_color', '_box')).css('background-color', color);
                            });

                            $('#btn_save').prop('disabled', false);
                            $('#btn_update').prop('disabled', true);

                            updateSidebarBackground();
                        },
                        error: function () {
                            alert("No color pattern found.");
                        }
                    });
                }
            });

            // যেকোনো ইনপুট চেঞ্জ হলে
            $('input[type="color"], input[type="text"]').on('input', function () {
                let changed = hasColorChanged();

                if (changed) {
                    $('#btn_save').prop('disabled', true);
                    $('#btn_update').prop('disabled', false);
                } else {
                    if (patternChanged) {
                        $('#btn_save').prop('disabled', false);
                        $('#btn_update').prop('disabled', true);
                    } else {
                        $('#btn_save').prop('disabled', true);
                        $('#btn_update').prop('disabled', true);
                    }
                }
            });

            $('#btn_save').on('click', function () {
                var color_id = $('#color_id').val();

                $.ajax({
                    url: '{{ url("save_as_color") }}/' + color_id,
                    type: 'GET',
                    success: function (response) {
                        Swal.fire({
                            toast: true,
                            position: 'top-end', // top-right
                            icon: 'success',
                            title: response.message,
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            customClass: {
                                popup: 'small-toast'
                            }
                        }).then(() => {
                            location.reload();
                        });
                    },
                    error: function (xhr) {
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'error',
                            title: 'Something went wrong!',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            customClass: {
                                popup: 'small-toast'
                            }
                        });
                        console.log(xhr.responseText);
                    }
                });
            });

            $('.btn_new_color_pattern').on('click', function () {
                $('#color_id').val('');
                $('#new_pattern').show();
                $('#btn_update').hide();
                $('#btn_save_color_pattern').show();

                // input কে required করানো
                $('#new_color_pattern').attr('required', true);
            });

            $('#btn_save_color_pattern').on('click', function () {
                var newColorPattern = $('#new_color_pattern').val().trim();
                if (newColorPattern !== '') {
                    $('#color_patterns').val(newColorPattern);
                    $('#btn_update').prop('disabled', false);
                } else {
                    alert('Please enter a color pattern name');
                }
            });

            $('#btn_close_color_pattern').on('click', function (e) {
                e.preventDefault(); // রিলোড বন্ধ করবে

                let pid = {{ Js::from($data->id) }}; // Blade থেকে নিরাপদভাবে ডেটা পাঠানো
                $('#color_id').val(pid);
                $('#new_pattern').hide();
                $('#btn_update').show();
                $('#btn_save_color_pattern').hide();

                $('#new_color_pattern').attr('required', false);
            });

        });
    </script>
@endsection
