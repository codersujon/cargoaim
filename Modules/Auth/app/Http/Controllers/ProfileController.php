<?php

namespace Modules\Auth\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Auth\Models\Profile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function index()
    {
        $data = Profile::first();
        return view('auth::profile.index', compact('data'));
    }

    public function create() {}

    public function store(Request $request) {
        $emp = Profile::find($request->id);

        $images = ['logo', 'fav_icon'];
        $fileNames = ['', ''];

        foreach ($images as $index => $image) {
            if ($request->hasFile($image) && $request->file($image)->isValid()) {
                $fileName = 'bscImg' . ($index + 1) . time() . '.' . $request->$image->getClientOriginalExtension();
                $request->$image->move(public_path('upload/'), $fileName);

                if ($request->id > 0) {
                    $imagePath = public_path('upload/' . $emp->$image);
                    if (File::exists($imagePath)) {
                        unlink($imagePath);
                    }
                }
                $fileNames[$index] = $fileName;
            } else {
                $fileNames[$index] = $emp->$image ?? '0';
            }
        }
        $fileName1 = $fileNames[0];
        $fileName2 = $fileNames[1];

        Profile::updateOrCreate([ 'id' => $request->id ],[
            'name' => $request->name,
            'email' => $request->email,
            'contact' => $request->contact,
            'other_contact' => $request->other_contact,
            'address' => $request->address,
            'fb_link' => $request->fb_link,
            'whatsapp_link' => $request->whatsapp_link,
            'twiter_link' => $request->twiter_link,
            'instra_link' => $request->instra_link,
            'youTube_link' => $request->youTube_link,
            'telegram_link' => $request->telegram_link,
            'viber_link' => $request->viber_link,
            'botim_link' => $request->botim_link,
            'location' => $request->location,
            'message' => $request->message,
            'copyright' => $request->copyright,

            'logo' => $fileName1,
            'fav_icon' => $fileName2,
        ]);

        if ($request->id != 0) {
            return redirect()->back()->with('success', transText('f_upd_msg'));
        } else {
            return redirect()->back()->with('success', transText('f_ins_msg'));
        }
    }

    public function show($id) {}

    public function edit($id)
    {
        $data = Profile::find($id);
        return response()->json($data);
    }

    public function update(Request $request, $id) {}

    public function destroy($id) {}
}
