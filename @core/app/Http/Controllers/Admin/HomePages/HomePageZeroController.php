<?php

namespace App\Http\Controllers\Admin\HomePages;

use App\Cause;
use App\CauseCategory;
use App\Helpers\FlashMsg;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomePageZeroController extends Controller
{
    private const BASE_PATH = 'backend.pages.home.home-00.';

    public function __construct(){
        $this->middleware('auth:admin');
    }

    public function header_area()
    {
        $all_donations = Cause::where(['status'=>'publish'])->get();
        return view(self::BASE_PATH. 'header-area',compact('all_donations'));
    }

    public function update_header_area(Request $request)
    {
        $this->validate($request,[
            'home_page_00_header_area_text_loop' => 'nullable|string',
            'home_page_00_header_area_title' => 'nullable|array',
            'home_page_00_header_area_button_1_title' => 'nullable|array',
            'home_page_00_header_area_button_1_url' => 'nullable|array',
            'home_page_00_header_area_button_2_title' => 'nullable|array',
            'home_page_00_header_area_button_2_url' => 'nullable|array',
            'home_page_00_header_area_image' => 'required|array',
            'home_page_00_header_area_image.*' => 'required|string',
        ]);

        //save repeater values
        $all_fields = [
            'home_page_00_header_area_text_loop',
            'home_page_00_header_area_title',
            'home_page_00_header_area_button_1_title',
            'home_page_00_header_area_button_1_url',
            'home_page_00_header_area_button_2_title',
            'home_page_00_header_area_button_2_url',
            'home_page_00_header_area_image',
            'home_page_00_header_area_image',
        ];
        foreach ($all_fields as $field){
            $value = $request->$field ?? [];
            update_static_option($field,serialize($value));
        }

        return redirect()->back()->with(FlashMsg::settings_update());
    }

    
    public function projects_area()
    {
        $all_categories = CauseCategory::where(['status' => 'publish'])->get();
        return view(self::BASE_PATH. 'projects-area',compact('all_categories'));
    }

    public function update_projects_area(Request $request)
    {
        $this->validate($request,[
            'home_page_00_projects_area_categories' => 'nullable|array',
            'home_page_00_projects_area_title' => 'nullable|string',
        ]);

        //save repeater values
        $all_fields = [
            'home_page_00_projects_area_categories',
            'home_page_00_projects_area_title',
        ];
        foreach ($all_fields as $field){
            $value = $request->$field ?? [];
            update_static_option($field,serialize($value));
        }

        return redirect()->back()->with(FlashMsg::settings_update());
    }


}
