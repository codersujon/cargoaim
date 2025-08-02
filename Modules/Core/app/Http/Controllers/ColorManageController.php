<?php

namespace Modules\Core\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Core\Models\ColorManage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ColorManageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        $data = null;

        // return $user->userId;

        if ($user && $user->userId) {
            $data = ColorManage::where('user_info', $user->userId)
                            ->where('active_color', 1)
                            ->first();
        }

        if (!$data) {
            $data = ColorManage::where('color_pattern', 'default')->first();
        }

        // return $data;

        $colorPatterns = ColorManage::where('user_info', $user->userId)->orderBy('id', 'asc')->get();

        return view('core::color.index', compact('data', 'colorPatterns'));
    }

    public function getColorPattern($pattern)
    {
        $user = Auth::user();
        
        $data = ColorManage::where('color_pattern', $pattern)->where('user_info', $user->userId)->first();

        if ($data) {
            return response()->json($data);
        } else {
            return response()->json(['error' => 'Not found'], 404);
        }
    }

    public function create()
    {
        // return view('core::create');
    }

    public function store(Request $request) 
    {
       

        $validatedData = $request->validate([
            'layout_left_color' => 'required|string',
            'layout_right_color' => 'required|string',
            // validate অন্য fields গুলো
        ]);
    
        DB::transaction(function () use ($request) {
             $user = Auth::user();

            // আগের active pattern কে inactive করা
            ColorManage::where('active_color', 1)->update(['active_color' => 0]);
    
            // নতুন বা আপডেট করা color pattern insert/update করা
            ColorManage::updateOrCreate(
                ['id' => $request->id],
                [
                    'user_info' => $user->userId,
                    'color_pattern' => $request->color_pattern,
                    'layout_left_color' => $request->layout_left_color,
                    'layout_right_color' => $request->layout_right_color,
    
                    'sidebar_left_color' => $request->sidebar_left_color,
                    'sidebar_right_color' => $request->sidebar_right_color,
                    'sidebar_menu_hover_color' => $request->sidebar_menu_hover_color,
                    'sidebar_text_color' => $request->sidebar_text_color,
                    'sidebar_text_hover_color' => $request->sidebar_text_hover_color,
    
                    'card_border_color' => $request->card_border_color,
                    'card_header_color' => $request->card_header_color,
                    'card_body_color' => $request->card_body_color,
                    'card_text_color' => $request->card_text_color,
    
                    'table_header_bg_color' => $request->table_header_bg_color,
                    'table_header_text_color' => $request->table_header_text_color,
                    'table_text_color' => $request->table_text_color,
                    'table_header_border_color' => $request->table_header_border_color,
                    
                    'btn_success_color' => $request->btn_success_color,
                    'btn_danger_color' => $request->btn_danger_color,
                    'btn_info_color' => $request->btn_info_color,
                    'btn_warning_color' => $request->btn_warning_color,
                    'btn_primary_color' => $request->btn_primary_color,
                    'btn_secondary_color' => $request->btn_secondary_color,
                    'btn_dark_color' => $request->btn_dark_color,
                    'input_border_color' => $request->input_border_color,
                    'body_bg_color' => $request->body_bg_color,
                    'border_dashed' => $request->border_dashed,
                    'inp_select_bg' => $request->inp_select_bg,
                    'inp_focus_border' => $request->inp_focus_border,
                    'inp_focus_bg' => $request->inp_focus_bg,
                    'inp_selected_border' => $request->inp_selected_border,
                    'inp_suggest_bg' => $request->inp_suggest_bg,
                    'inp_search_spinner' => $request->inp_search_spinner,
                    'active_color' => 1,
                ]
            );
        });
    
        $message = $request->id != 0 ? 'Updated successfully!!!' : 'Inserted successfully!!!';
        return redirect()->back()->with('success', $message);
    }

    public function show($id)
    {
        return view('core::show');
    }

    public function edit($id)
    {
        return view('core::edit');
    }

    public function update(Request $request, $id)
    {
        $user = Auth::user();

        if ($request->ajax()) {
            $color = ColorManage::find($id);
    
            if ($color) {
                $color->update([
                    'user_info' => $user->userId,
                    'layout_left_color' => '#6379c3',
                    'layout_right_color' => '#546ee5',
    
                    'sidebar_left_color' => '#6379c3',
                    'sidebar_right_color' => '#546ee5',
                    'sidebar_menu_hover_color' => '#435EFF',
                    'sidebar_text_color' => '#ffffffb3',
                    'sidebar_text_hover_color' => '#ffffff',
    
                    'card_border_color' => '#000000',
                    'card_header_color' => '#ffffff',
                    'card_body_color' => '#ffffff',
                    'card_text_color' => '#23272B',
    

                    'table_header_bg_color' => '#EEF2F7',
                    'table_header_text_color' => '#23272B',
                    'table_text_color' => '#23272B',
                    'table_header_border_color' => '#eef2f7',
    
                    'btn_success_color' => '#218838',
                    'btn_danger_color' => '#C82333',
                    'btn_info_color' => '#138496',
                    'btn_warning_color' => '#E0A800',
                    'btn_primary_color' => '#0069D9',
                    'btn_secondary_color' => '#5A6268',
                    'btn_dark_color' => '#23272B',
                    'input_border_color' => '#ced4da',
                    'body_bg_color' => '#fafdff',
                    'border_dashed' => '#ECECEC',
                    'inp_select_bg' => '#ECECEC',
                    'inp_focus_border' => '#ECECEC',
                    'inp_focus_bg' => '#ECECEC',
                    'inp_selected_border' => '#ECECEC',
                    'inp_suggest_bg' => '#ECECEC',
                    'inp_search_spinner' => '#ECECEC',
                    'active_color' => 1,
                ]);
            }
    
            return response()->json(['success' => true, 'message' => 'Reset successfully.']);
        }
        return redirect()->back();
    }

    public function destroy($id) {}


    public function saveColor($id)
    {
        $colorStatus = ColorManage::where('active_color', 1)->first();
        if ($colorStatus) {
            $colorStatus->update(['active_color' => 0]);
        }

        $saveAsColorStatus = ColorManage::where('id', $id)->first();
        if ($saveAsColorStatus) {
            $saveAsColorStatus->update(['active_color' => 1]);
        }

        return response()->json(['success' => true, 'message' => 'Save successfully.']);
      
    }
}
