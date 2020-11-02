<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Section;
use Session;

class SectionsController extends Controller
{
    //
    public function sections(){
        Session::put('page', 'sections'); 
        $sections = Section::get();
        return view('admin.sections.sections')->with(compact('sections'));
    }
    public function updateSectionStatus(Request $request){
        if($request->ajax()){
            $data = $request->all();
            $id = $data['section_id'];
            $status;
            if($data['status']=="Active"){
                $status = 0;
            }elseif($data['status']=="Inactive"){
                $status = 1;
            }
            $section = Section::where('id', $id)->update([
                'status'=> $status
            ]);
            return response()->json([
                'status'=> $status,
                'section_id'=> $id
            ]);
        }
    }
}
