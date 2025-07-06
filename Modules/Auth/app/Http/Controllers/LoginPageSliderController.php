<?php

namespace Modules\Auth\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Auth\Models\LoginPageSlider;

class LoginPageSliderController extends Controller
{
    
    public function index()
    {
        $data = LoginPageSlider::orderBy('id', 'asc')->get();
        return view('auth::login_slider.index', compact('data'));
    }

    public function status(Request $request)
    {
        LoginPageSlider::where('id', $request->id)->update(['status' => $request->status]);
        return response()->json(['success' => true]);
    }

    public function fetch()
    {
        $data = LoginPageSlider::orderBy('id', 'asc')->get();
        return response()->json($data);
    }

    public function create(){}

    public function store(Request $request) {
        // Validation
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'id' => 'nullable|integer',
        ]);

        // Insert or update
        LoginPageSlider::updateOrCreate(
            [ 'id' => $request->id ],
            [
                'title' => $request->title,
                'description' => $request->description,
                'status' => 'A',
            ]
        );

        $message = $request->id != 0 ? transText('f_upd_msg') : transText('f_ins_msg');

        return response()->json(['success' => true, 'message' => $message]);
    }


    public function show($id){}

    public function edit($id)
    {
        $data = LoginPageSlider::find($id);
        return response()->json($data);
    }

    public function update(Request $request, $id) {}

    public function destroy($id) 
    {
        $data = LoginPageSlider::where('id', $id)->first();

        if (!$data) {
            return response()->json(['error' => 'Data not found.']);
        }
        $data->delete();
        return response()->json();
    }
}
