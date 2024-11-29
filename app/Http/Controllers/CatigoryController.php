<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CatigoreGroup;
use App\Models\Catigory;
use App\Models\Group;
class CatigoryController extends Controller{
    public function index(){
        $Catigory = Catigory::get();
        $Groups = array();
        foreach ($Catigory as $key => $value) {
            $Groups[$key]['id'] = $value->id;
            $Groups[$key]['name'] = $value->catigore_name;
            $GuruhID = CatigoreGroup::where('catigory_id',$value->id)->get();
            $gurops = 0;
            $chanels = 0;
            foreach ($GuruhID as $key1 => $value1) {
                $group_id = $value1->group_id;
                $Group = Group::find($group_id);
                if($Group->group_type=='Group'){
                    $gurops = $gurops + 1;
                }else{
                    $chanels = $chanels + 1;
                }
            }
            $Groups[$key]['gurops'] = $gurops;
            $Groups[$key]['chanels'] = $chanels;
        }
        return view('catigory.index',compact('Groups'));
    }
    public function create(){
        $Group = Group::where('group_type','Group')->get();
        $Chanel = Group::where('group_type','Chanel')->get();
        return view('catigory.create',compact('Group','Chanel'));
    }
    public function story(Request $request){
        $validate = $request->validate([
            'catigore_name' => 'required',
        ]);
        $selectedGroups = $request->input('groups', []); 
        $selectedChannels = $request->input('channels', []); 
        $Catigory = Catigory::create([
            'catigore_name'=>$request->catigore_name
        ]);
        $catigory_id = $Catigory->id;
        $guruh = 0;
        $kanal = 0;
        foreach ($selectedGroups as $key => $value) {
            CatigoreGroup::create([
                'catigory_id' => $catigory_id,
                'group_id' => $value,
            ]);
            $guruh = $guruh+1;
        }
        foreach ($selectedChannels as $key => $value) {
            CatigoreGroup::create([
                'catigory_id' => $catigory_id,
                'group_id' => $value,
            ]);
            $kanal = $kanal+1;
        }
        return redirect()->route('catigore')->with('status', "Yangi auditoriya yaratildi. Auditoriya ".$guruh." ta guruh va ".$kanal." ta kanal mavjud");
    }
    public function delete($id){
        $Catigory = Catigory::find($id);
        $CatigoreGroup = CatigoreGroup::where('catigory_id',$Catigory->id)->get();
        foreach ($CatigoreGroup as $key => $value) {
            $value->delete();
        }
        $Catigory->delete();
        return redirect()->back()->with('status', "Auditoriya o'chirildi.");
    }
    public function update_name(Request $request, $id){
        $Catigory = Catigory::find($id);
        $Catigory->catigore_name = $request->catigore_name;
        $Catigory->save();
        return redirect()->back()->with('status', "Auditoriya nomi yangilandi.");
    }
    public function update($id){
        $Catigory = Catigory::find($id);
        $CatigoreGroup = CatigoreGroup::where('catigory_id',$Catigory->id)->get();
        $Guruh = array();
        $Kanal = array();
        $g = 0;
        $k = 0;
        foreach ($CatigoreGroup as $key => $value) {
            $Group = Group::find($value->group_id);
            if($Group->group_type=='Group'){
                $Guruh[$g]['id'] = $Group->id;
                $Guruh[$g]['name_group'] = $Group->name_group;
                $g++;
            }else{
                $Kanal[$k]['id'] = $Group->id;
                $Kanal[$k]['name_group'] = $Group->name_group;
                $k++;
            }
        }
        $Group1 = Group::get();
        $Group2 = array();
        foreach ($Group1 as $key => $value) {
            $CatigoreGroup2 = CatigoreGroup::where('catigory_id',$id)->where('group_id',$value->id)->first();
            if(!$CatigoreGroup2){
                $Group2[$key]['id'] = $value->id;
                $Group2[$key]['name_group'] = $value->name_group;
                $Group2[$key]['group_type'] = $value->group_type;
            }
        }
        return view('catigory.update',compact('Catigory','Guruh','Kanal','Group2'));
    }
    public function delete_group(Request $request, $id){
        $CatigoreGroup = CatigoreGroup::where('group_id',$id)->where('catigory_id',$request->catigory_id)->first();
        $CatigoreGroup->delete();
        if($request->type == 'Group'){
            return redirect()->back()->with('status', "Auditoriya guruhi o'chirildi.");
        }else{
            return redirect()->back()->with('status', "Auditoriya kanali o'chirildi.");
        }
    }
    public function add_chanel(Request $request, $id){
        $validate = $request->validate([
            'group_id' => 'required',
        ]);
        CatigoreGroup::create([
            'catigory_id' => $id,
            'group_id' => $request->group_id,
        ]);
        return redirect()->back()->with('status', "yangi auditoriya guruhi qo'shildi.");
    }
}
