<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Card;
use App\Models\Post;
class CardController extends Controller{
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
    

}
