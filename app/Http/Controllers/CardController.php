<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Card;
use App\Models\Post;
use App\Models\Group;
use App\Models\Catigory;
use App\Models\CatigoreGroup;
use App\Models\CardItem;
use App\Models\PostJob;
use Carbon\Carbon;

class CardController extends Controller{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(){
        $Card = Card::get();
        return view('card.index',compact('Card'));
    }
    public function create(){
        $Post = Post::get();
        return view('card.create',compact('Post'));
    }
    public function card_create_typing(Request $request){
        $type = $request->query('q'); // AJAX orqali kelgan qiymatni olamiz
        $data = '';
        switch ($type) {
            case 'one_data':
                $data =  '<div id="one_data_table" class="mt-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="all_data_start1">Sanani kiriting:</label>
                                    <input type="date" name="all_data_start1" id="all_data_start1" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="one_data_time1">Yuborish vaqti:</label>
                                    <input type="time" name="one_data_time1" id="one_data_time1" class="form-control" required>
                                </div>
                            </div>
                          </div>';
                break;
            case 'all_data':
                $data =  '<div id="all_data_table" class="mt-3">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="all_data_start2">Boshlanish sanasi:</label>
                                    <input type="date" name="all_data_start2" id="all_data_start2" class="form-control" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="all_data_end2">Tugash sanasi:</label>
                                    <input type="date" name="all_data_end2" id="all_data_end2" class="form-control" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="one_data_time2">Yuborish vaqti:</label>
                                    <input type="time" name="one_data_time2" id="one_data_time2" class="form-control" required>
                                </div>
                            </div>
                          </div>';
                break;
            case 'week_data':
                $weekDays = [
                    "monday" => "Dushanba",
                    "tuesday" => "Seshanba",
                    "wednesday" => "Chorshanba",
                    "thursday" => "Payshanba",
                    "friday" => "Juma",
                    "saturday" => "Shanba",
                    "sunday" => "Yakshanba"
                ];
                $dayOptions = '';
                foreach ($weekDays as $day => $label) {
                    $dayOptions .= '<div class="col-md-3">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" name="week_days[]" id="' . $day . '" value="' . $day . '">
                                            <label class="form-check-label" for="' . $day . '">' . $label . '</label>
                                        </div>
                                    </div>';
                }
                $data = '<div id="week_data_table" class="mt-3">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="all_data_start3">Boshlanish sanasi:</label>
                                    <input type="date" name="all_data_start3" id="all_data_start3" class="form-control" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="all_data_end3">Tugash sanasi:</label>
                                    <input type="date" name="all_data_end3" id="all_data_end3" class="form-control" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="one_data_time3">Yuborish vaqti:</label>
                                    <input type="time" name="one_data_time3" id="one_data_time3" class="form-control" required>
                                </div>
                            </div>
                            <label>Hafta kunlarini tanlang:</label>
                            <div class="row">' . $dayOptions . '</div>
                          </div>';
                break;
            default:
                $data = "Noma'lum tur.";
        }
        return response()->json(['message' => $data]);
    }
    public function story(Request $request){
        $validated = $request->validate([
            'card_name' => 'required',
            'post_id' => 'required',
            'card_type' => 'required',
        ]);
        $cardData = [
            'post_id' => $request->post_id,
            'card_name' => $request->card_name,
            'card_type' => $request->card_type,
            'count_group' => 0,
            'status' => false,
        ];
        if ($request->card_type == 'one_data') {
            $cardData = array_merge($cardData, $this->handleOneData($request));
        } elseif ($request->card_type == 'all_data') {
            $cardData = array_merge($cardData, $this->handleAllData($request));
        } else {
            $cardData = array_merge($cardData, $this->handleWeekData($request));
        }
        Card::create($cardData);
        return redirect()->route('card')->with('status', "Yangi targ'ibot rejasi yaratildi.");
    }
    protected function handleOneData($request){
        return [
            'start_date' => $request->all_data_start1,
            'end_date' => '',
            'time' => $request->one_data_time1,
            'monday' => 'off',
            'tuesday' => 'off',
            'wednesday' => 'off',
            'thursday' => 'off',
            'friday' => 'off',
            'saturday' => 'off',
            'sunday' => 'off',
        ];
    }
    protected function handleAllData($request){
        return [
            'start_date' => $request->all_data_start2,
            'end_date' => $request->all_data_end2,
            'time' => $request->one_data_time2,
            'monday' => 'off',
            'tuesday' => 'off',
            'wednesday' => 'off',
            'thursday' => 'off',
            'friday' => 'off',
            'saturday' => 'off',
            'sunday' => 'off',
        ];
    }
    protected function handleWeekData($request){
        $weekDays = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
        $selectedDays = $request->input('week_days', []);
        $weekData = [];
        foreach ($weekDays as $day) {
            $weekData[$day] = in_array($day, $selectedDays) ? 'on' : 'off';
        }
        return array_merge($weekData, [
            'start_date' => $request->all_data_start3,
            'end_date' => $request->all_data_end3,
            'time' => $request->one_data_time3,
        ]);
    }
    public function card_delete($id){
        $Card = Card::find($id);
        $Card->delete();
        return redirect()->back()->with('status', "Targ'ibot rejasi o'chirildi.");
    }
    public function show_play($id){
        $Card = Card::find($id);
        $CardItem = CardItem::where('card_items.card_id',$id)->join('groups', 'card_items.group_id', '=', 'groups.id')->get();
        $Post = Post::find($Card->post_id)->description;
        return view('card.show_play',compact('Card','CardItem','Post'));
    }
    public function card_groups_delete(Request $request, $id){
        $CardItem = CardItem::where('card_id',$request->card_id)->where('group_id',$id)->first();
        $CardItem->delete();
        $Card = Card::find($request['card_id']);
        $Card->count_group = $Card->count_group-1;
        $Card->save();
        return redirect()->back()->with('status', "Biriktirilgan guruh o'chirildi");
    }
    public function fetchGroups($groupType){
        $data = [];
        if ($groupType == 'all_channels_groups') {
            $Group = Group::get();
            foreach ($Group as $key => $value) {
                array_push($data, ['id' => $value->id, 'name' => $value->name_group."(".$value->group_type.")"]);
            }
        } elseif ($groupType == 'all_channels') {
            $Group = Group::where('group_type','Chanel')->get();
            foreach ($Group as $key => $value) {
                array_push($data, ['id' => $value->id, 'name' => $value->name_group."(".$value->group_type.")"]);
            }
        } elseif ($groupType == 'all_groups') {
            $Group = Group::where('group_type','Group')->get();
            foreach ($Group as $key => $value) {
                array_push($data, ['id' => $value->id, 'name' => $value->name_group."(".$value->group_type.")"]);
            }
        } elseif ($groupType == 'audience_groups') {
            $Catigory = Catigory::get();
            foreach ($Catigory as $key => $value) {
                array_push($data, ['id' => $value->id, 'name' => $value->catigore_name]);
            }
        }
        return response()->json($data);
    }
    public function card_groups_plus(Request $request){
        $validated = $request->validate([
            'card_id' => 'required|exists:cards,id',  
            'group_type' => 'required|string',        
            'week_days' => 'required|array|min:1',             
        ]);
        if($request->group_type == 'audience_groups'){
            $tt = 0;
            foreach ($validated['week_days'] as $key => $value) {
                $catigory_id = $value;
                $CatigoreGroup = CatigoreGroup::where('catigory_id',$catigory_id)->get();
                foreach ($CatigoreGroup as $key2 => $value2) {
                    $CardItem = CardItem::where('group_id',$value2['group_id'])->where('card_id',$request->card_id)->first();
                    if(!$CardItem){
                        CardItem::create([
                            'group_id' => $value2['group_id'],
                            'card_id' => $request->card_id,
                        ]);
                        $tt = $tt+1;
                    }
                }
            }
            $Card = Card::find($validated['card_id']);
            $Card->count_group = $tt;
            $Card->save();
            return redirect()->back()->with('status', "Targ'ibotga.".$tt." ta guruh qo'shildi");
        }else{
            $kk = 0;
            foreach ($validated['week_days'] as $key => $value) {
                $CardItems = CardItem::where('card_id',$validated['card_id'])->where('group_id',$value)->first();
                if(!$CardItems){
                    CardItem::create([
                        'card_id' => $validated['card_id'],
                        'group_id' => $value,
                    ]);
                    $kk = $kk + 1;
                }
            }
            $Card = Card::find($validated['card_id']);
            $Card->count_group = $kk;
            $Card->save();
            return redirect()->back()->with('status', "Targ'ibotga.".$kk." ta guruh qo'shildi");
        }
    }
    protected function getDaysBetweenDates($startDate, $endDate){
        $start = Carbon::createFromFormat('Y-m-d', $startDate);
        $end = Carbon::createFromFormat('Y-m-d', $endDate);
        $days = [];
        while ($start <= $end) {
            $days[] = $start->format('Y-m-d');  
            $start->addDay(); 
        }
        return $days;
    }
    protected function getDatesWithWeekdayBetweenDates($startDate, $endDate, $weekday){
        $start = Carbon::createFromFormat('Y-m-d', $startDate);
        $end = Carbon::createFromFormat('Y-m-d', $endDate);
        $weekday = strtolower($weekday); 
        $dates = [];
        while ($start <= $end) {
            if ($start->format('l') === ucfirst($weekday)) {
                $dates[] = $start->format('Y-m-d'); 
            }
            $start->addDay(); 
        }
        return $dates;
    }
    public function card_run(Request $request){
        $Card = Card::find($request->card_id)->card_type;
        if($Card=='one_data'){
            $id = $request->card_id;
            $Card = Card::find($id);
            $post_id = $Card->post_id;
            $data = $Card->start_date;
            $time = $Card->time;
            $status = '$Card->time';
            $count = 0;
            foreach (CardItem::where('card_id',$id)->get() as $key => $value) {
                $count = $count + 1;
                PostJob::create([
                    'post_id'=>$post_id,
                    'chat_id'=>Group::find($value->group_id)->tg_id,
                    'chat_type'=>Group::find($value->group_id)->group_type,
                    'day'=>$data,
                    'time'=>$time,
                    'status'=>'waiting',
                ]);
            }
            $Card->status = true;
            $Card->save();
            return redirect()->back()->with('status', $count." ta bot topshiriqlari qo'shildi");
        }elseif($Card=='all_data'){
            $id = $request->card_id;
            $Card = Card::find($id);
            $StartData = $Card->start_date;
            $EndData = $Card->end_date;
            $time = $Card->time;
            $Kunlar = $this->getDaysBetweenDates($StartData,$EndData);
            $CardItem = CardItem::where('card_items.card_id',$id)->join('groups', 'card_items.group_id', '=', 'groups.id')->get();
            $count = 0;
            foreach ($Kunlar as $key => $value) {
                $data = $value;
                foreach ($CardItem as $key2 => $value2) {
                    PostJob::create(attributes: [
                        'post_id'=>$Card->post_id,
                        'chat_id'=>$value2->tg_id,
                        'chat_type'=>$value2->group_type,
                        'day'=>$data,
                        'time'=>$time,
                        'status'=>'waiting',
                    ]);
                    $count = $count + 1;
                }
            }
            $Card->status = true;
            $Card->save();
            return redirect()->back()->with('status', $count." ta bot topshiriqlari qo'shildi");
        }else{
            $id = $request->card_id;
            $Card = Card::find($id);
            $StartData = $Card->start_date;
            $EndData = $Card->end_date;
            $time = $Card->time;
            $Kunlar = [];
            if($Card['monday']=='on'){$Kunlar = array_merge($Kunlar,$this->getDatesWithWeekdayBetweenDates($StartData, $EndData, 'Monday'));}
            if($Card['tuesday']=='on'){$Kunlar = array_merge($Kunlar,$this->getDatesWithWeekdayBetweenDates($StartData, $EndData, 'Tuesday'));}
            if($Card['wednesday']=='on'){$Kunlar = array_merge($Kunlar,$this->getDatesWithWeekdayBetweenDates($StartData, $EndData, 'Wednesday'));}
            if($Card['thursday']=='on'){$Kunlar = array_merge($Kunlar,$this->getDatesWithWeekdayBetweenDates($StartData, $EndData, 'Thursday'));}
            if($Card['friday']=='on'){$Kunlar = array_merge($Kunlar,$this->getDatesWithWeekdayBetweenDates($StartData, $EndData, 'Friday'));}
            if($Card['saturday']=='on'){$Kunlar = array_merge($Kunlar,$this->getDatesWithWeekdayBetweenDates($StartData, $EndData, 'Saturday'));}
            if($Card['sunday']=='on'){$Kunlar = array_merge($Kunlar,$this->getDatesWithWeekdayBetweenDates($StartData, $EndData, 'Sunday'));}
            $CardItem = CardItem::where('card_items.card_id',operator: $id)->join('groups', 'card_items.group_id', '=', 'groups.id')->get();
            $count = 0;
            foreach ($Kunlar as $key => $value) {
                $data = $value;
                foreach ($CardItem as $key2 => $value2) {
                    error_log('Some message here.'.$value2);
                    PostJob::create([
                        'post_id'=>$Card->post_id,
                        'chat_id'=>$value2->tg_id,
                        'chat_type'=>$value2->group_type,
                        'day'=>$data,
                        'time'=>$time,
                        'status'=>'waiting',
                    ]);
                    $count = $count + 1;
                }
            }
            $Card->status = true;
            $Card->save();
            return redirect()->back()->with('status', $count." ta bot topshiriqlari qo'shildi");
        }
    }

}