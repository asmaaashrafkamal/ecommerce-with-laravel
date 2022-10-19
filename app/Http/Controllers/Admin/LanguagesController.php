<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LanguageRequest;
use App\Models\Language;
class LanguagesController extends Controller
{
 public function index(){
    $languages=Language::select()->paginate(PAGINATION_COUNT);
    return view('dashboard.languages.index',compact('languages'));
 }
 public function create(){
    return view('dashboard.languages.create');
 }
 public function store(LanguageRequest $request){
   try{
        Language::create($request->except(['_token']));
        return redirect()->route('admin.languages.create')->with(['success'=>'تم حفظ اللغة بنجاح']);
   }catch(\Exception $e){
    return redirect()->route('admin.languages.create')->with(['error'=>'هناك خطأ ما يرجي المحاولة فيما بعد']);
   }
 }
 public function edit($id){
    $language=Language::find($id);
    if(!$language){
      return redirect()->route('admin.languages')->with(['error'=>'هذه اللغة غير موجودة']);
    }
    return view('dashboard.languages.edit',compact('language'));
 }
 public function update($id,LanguageRequest $request){
    try{
        $language=Language::find($id);
        if(!$language){
        return redirect()->route('admin.languages.edit',$id)->with(['error'=>'هذه اللغة غير موجودة']);
        }
        $language->update($request->except('_token'));
        return view('dashboard.languages.update',compact('language'));
   }catch(\Exception $e){
    return redirect()->route('admin.languages.update',compact('language'))->with(['error'=>'هناك خطأ ما يرجي المحاولة فيما بعد']);
   }
 }
}
