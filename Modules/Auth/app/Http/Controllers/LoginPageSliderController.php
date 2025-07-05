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
        return view('auth::loginslider.index', compact('data'));
    }

    public function status(Request $request)
    {
        LoginPageSlider::where('id', $request->id)->update(['status' => $request->status]);
        return response()->json(['success' => true]);
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
                'status' => 1,
            ]
        );

        if ($request->id != 0) {
            return redirect()->back()->with('success', 'Updated successfully!!!');
        } else {
            return redirect()->back()->with('success', 'Inserted successfully!!!');
        }
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
        $data = LoginPageSlider::find($id);

        if (!$data) {
            return response()->json(['error' => 'Data not found.']);
        }
        $data->delete();
        return response()->json();
    }
}
