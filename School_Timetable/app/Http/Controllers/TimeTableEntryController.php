<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Day;
use App\Models\TimeSlot;
use App\Models\Subject;
use App\Models\Timetable;


class TimeTableEntryController extends Controller
{
      public function index()
  {
    $timetables = Timetable::all();
    return view('timetable.index', compact('timetables'));
  }

 
  public function store(Request $request)
  {
   
    $request->validate([
                'day_id' => 'required|exists:days,id',
                'time_slot_id' => 'required|exists:time_slots,id',
                'subject_id' => 'required|exists:subjects,id',
            ]);

        TimeTable::create($request->all());

        return redirect()->route('timetable.index')->with('success', 'Timetable created successfully!');

  }

  public function update(Request $request, $id)
  {
  $request->validate([
            'day_id' => 'required|exists:days,id',
            'time_slot_id' => 'required|exists:time_slots,id',
            'subject_id' => 'required|exists:subjects,id',
        ]);

        $timetable = TimeTable::findOrFail($id);
        $timetable->update($request->all());

        return redirect()->route('timetable.index')->with('success', 'Timetable updated successfully!');
  
  }
 
  public function destroy($id)
  {
    $timetable = Timetable::find($id);
    $timetable->delete();
    return redirect()->route('timetable.index')
      ->with('success', 'timetable deleted successfully');
  }
 
  public function create()
  {
    return view('timetable.create_edit', [
            'days' => Day::all(),
            'timeSlots' => TimeSlot::all(),
            'subjects' => Subject::all(),
        ]);
  }
 

  /**
   * Show the form for editing the specified post.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {

      $timetable = TimeTable::findOrFail($id);

        return view('timetable.create_edit', [
            'timetable' => $timetable,
            'days' => Day::all(),
            'timeSlots' => TimeSlot::all(),
            'subjects' => Subject::all(),
        ]);
  }
}
