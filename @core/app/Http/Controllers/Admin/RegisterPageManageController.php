<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\FlashMsg;
use App\Http\Controllers\Controller;
use App\Mail\BasicMail;
use App\Mail\SubscriberMessage;
use App\Newsletter;
use App\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class RegisterPageManageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('permission:register-page-manage');
    }

    public function register_page_setting()
    {
        $pages = Page::select('id', 'title', 'slug')->get();

        return view('backend.pages.register-page-manage', compact('pages'));
    }

    public function update_register_page_setting(Request $request){

        $this->validate($request,[
            'register_page_terms_of_service_url' => 'nullable|string',
            'register_page_privacy_policy_url' => 'nullable|string',
            'recaptcha_2_site_key' => 'nullable|string',
        ]);

        $data = [
            'register_page_terms_of_service_url',
            'register_page_privacy_policy_url',
            'recaptcha_2_site_key',
        ];

        foreach ($data as $item){
            if($request->has($item)){
                update_static_option($item,$request->$item);
            }
        }

        return redirect()->back()->with(FlashMsg::settings_update());

    }
}
