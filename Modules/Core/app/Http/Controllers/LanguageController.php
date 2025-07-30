<?php

namespace Modules\Core\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Core\Models\Language;
use Illuminate\Support\Facades\DB;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Language::orderBy('language.row_id', 'desc')->get();
        return view('core::language.index', compact('data'));
    }

    public function fetch()
    {
        $data = Language::orderBy('language.apply_on_type', 'asc')->get();

        return response()->json($data);
    }

    public function create(){}

    public function store(Request $request) 
    {
        $customMessages = [
            'en.required' => 'The English field is required.',
            'bn.required' => 'The Bangla field is required.',
            'cn.required' => 'The China field is required.',
            'th.required' => 'The Thailand field is required.',
            'vn.required' => 'The Vietnam field is required.',
            'kh.required' => 'The Cambodia field is required.',
            // 'module.required' => 'The Module field is required.',
            'apply_on_type.required' => 'The Type field is required.',
            'message_id_to_call.required' => 'The Message field is required.',
            'remarks.required' => 'The Remarks field is required.',
        ];

        $validated = $request->validate([
            'apply_on_type' => 'required|string',
            'message_id_to_call' => 'required|string',
            'en' => 'required|string',
            'bn' => 'required|string',
            'cn' => 'required|string',
            'th' => 'required|string',
            'vn' => 'required|string',
            'kh' => 'required|string',
            // 'module' => 'required|string',
            'remarks' => 'required|string',
        ], $customMessages);

        $data = Language::updateOrCreate(
            ['row_id' => $request->row_id],
            $validated
        );

        $message = $request->row_id != 0 ? transText('f_upd_msg') :  transText('f_ins_msg');

        return response()->json(['success' => true, 'message' => $message, 'data' => $data]);
    }

    public function show($id){}

    public function edit($id){
        $data = Language::where('row_id', $id)->first();
        return response()->json($data);
    }

    public function update(Request $request, $id) {}

    public function destroy($id) {
        $data = Language::where('row_id', $id)->first();

        if (!$data) {
            return response()->json(['error' => 'Data not found.']);
        }
        $data->delete();
        return response()->json();
    }
}
