<?php

namespace App\Http\Controllers;

use App\Holiday;
use App\Calendar;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    //カレンダーページ
    public function index(Request $request)
    {
        //Holidayクラスのデータを全てを$listに代入
        $list = Holiday::all();
        //Calendarクラスインスタンス化時に$listを渡す
        $cal = new Calendar($list);
        $tag = $cal->showCalendarTag($request->month, $request->year);

        //cal_tag: ビュー変数
        return view('calendar.index', ['cal_tag' => $tag]);
    }
    
    //休日データ登録ページ
    public function getHoliday(Request $request)
    {
        $data = new Holiday();
        $list = Holiday::all();
        return view('calendar.holiday', ['list' => $list, 'data' => $data]);
    }

    //休日データ登録
    public function postHoliday(Request $request)
    {
        //バリデーション処理
        $validateData = $request->validate([
            'day' => 'required|date_format:Y-m-d',
            'description' => 'required',
        ]);

        if (isset($request->id)) {
            $holiday = Holiday::where('id', '=', $request->id)->first();
            $holiday->day = $request->day;
            $holiday->description = $request->description;
            $holiday->save();
        } else {
            $holiday = new Holiday();
            $holiday->day = $request->day;
            $holiday->description = $request->description;
            $holiday->save();
        }
        
        //休日データ取得
        $data = new Holiday();
        $list = Holiday::all();
        return view('calendar.holiday', ['list' => $list, 'data' => $data]);
    }
    
    //データ更新
    public function getHolidayId($id)
    {
        $data = new Holiday();
        if (isset($id)) {
            $data = Holiday::where('id', '=', $id)->first();
        }

        $list = Holiday::all();
        return view('calendar.holiday', ['list' => $list, 'data' => $data]);
    }

    //データ削除
    public function deleteHoliday(Request $request)
    {
        if (isset($request->id)) {
            $holiday = Holiday::where('id', '=', $request->id)->first();
            $holiday->delete();
        }

        $data = new Holiday();
        $list = Holiday::all();
        return view('calendar.holiday', ['list' => $list, 'data' => $data]);
    }

}
