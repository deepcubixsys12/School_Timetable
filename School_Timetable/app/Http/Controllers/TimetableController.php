<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Day;
use App\Models\TimeSlot;
use App\Models\Subject;
use App\Models\Timetable;

class TimetableController extends Controller
{
   public function index()
{
    return view('index');
}

public function data()
{
    $days = Day::orderBy('id')->get();
    $slots = TimeSlot::orderBy('order')->get();
    $subjects = Subject::orderBy('name')->get();

    $entries = Timetable::with(['day','timeSlot','subject'])->get();

    // Build a nested structure: day_id → time_slot_id → subject_id
    $grid = [];
    foreach ($entries as $e) {
        $grid[$e->day_id][$e->time_slot_id] = $e->subject_id;
    }

    return response()->json([
        'days'=>$days,'slots'=>$slots,'subjects'=>$subjects,'grid'=>$grid
    ]);
}

public function save(Request $r)
{
    $data = $r->input('grid'); // Expecting [day_id][slot_id] = subject_id
    Timetable::truncate();

    foreach ($data as $day_id => $row) {
        foreach ($row as $slot_id => $subject_id) {
            if ($subject_id) {
                Timetable::create([
                    'day_id' => $day_id,
                    'time_slot_id' => $slot_id,
                    'subject_id' => $subject_id
                ]);
            }
        }
    }
    return response()->json(['status'=>'success']);
}

}
