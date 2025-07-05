<?php

// app/Helpers/LanguageHelper.php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Session;
use Modules\Core\Models\Language;

if (!function_exists('transText')) {
    function transText($messageId) {
        // ডিফল্ট ভাষা
        $locale = 'en';

        // superadmin ইউজার চেক করুন
        $superadmin = Auth::guard('web')->user();

        if ($superadmin) {
            // ডাটাবেজ থেকে user_language নিন
            $userLang = DB::table('user_access_table')
                ->where('rowId', $superadmin->rowId)
                ->value('user_language');

            // যদি ডাটাবেজে ভাষা থাকে, তাহলে সেটি ব্যবহার করুন
            if (!empty($userLang)) {
                $locale = $userLang;
            }
        }

        // এখন ভাষা অনুযায়ী ট্রান্সলেশন বের করুন
        $text = Language::where('message_id_to_call', $messageId)->first();

        if ($text && isset($text->$locale)) {
            return $text->$locale;
        }

        return $text->en ?? $messageId; // fallback
    }
}


