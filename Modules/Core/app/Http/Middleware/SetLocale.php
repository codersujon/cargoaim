<?php

namespace Modules\Core\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SetLocale
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $superadmin = Auth::guard('web')->user();

        if ($superadmin) {
            $userId = $superadmin->rowId;

            // ডাটাবেজ থেকে ইউজারের ভাষা বের করুন
            $locale = DB::table('user_access_table')->where('rowId', $userId)->value('user_language');

            // fallback যদি language না থাকে
            $locale = $locale ?? 'en';

            // সিস্টেম ভাষা সেট করুন
            app()->setLocale($locale);

            // সেশনেও সেট করুন যেন view-তে ব্যবহার করা যায়
            session(['locale' => $locale]);
        } else {
            // যদি লগইন না করা থাকে, সেশন থেকে ভাষা নিন
            $locale = Session::get('locale', 'en');
            app()->setLocale($locale);
        }


        return $next($request);
    }
}
