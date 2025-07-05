<?php

namespace Modules\Core\Http\Controllers;


use Modules\Auth\Models\UserAccess;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class LanguageSelectController extends Controller 
{
     public function switch(string $locale)
    {
        // 'language' টেবিল থেকে সকল কলাম নামগুলো নিয়ে আসি
        $columns = Schema::getColumnListing('language');

        // ভ্যালিড ভাষার জন্য ফিল্টার করি: দুই অক্ষরের কলাম যেগুলো বিশেষ কিছু নয়
        $excludedColumns = ['row_id', 'apply_on_type', 'message_id_to_call', 'remarks', 'created_at', 'updated_at'];

        $validLocales = array_filter($columns, function ($column) use ($excludedColumns) {
            return strlen($column) === 2 && !in_array($column, $excludedColumns);
        });

        // যদি প্রাপ্ত $locale ভ্যালিড ভাষার মধ্যে থাকে, তাহলে সেশন ও অ্যাপ ভাষা সেট করি
        if (in_array($locale, $validLocales)) {
            session(['locale' => $locale]);
            app()->setLocale($locale);


            // যদি লগইনকৃত সুপারঅ্যাডমিন থাকে, তাহলে তার ভাষা আপডেট করি
            if ($superadmin = Auth::guard('web')->user()) {
                $superadmin->update(['user_language' => $locale]);
            }
        }

        // পূর্ববর্তী পেজে রিডাইরেক্ট করি
        return redirect()->back();
    }
}
