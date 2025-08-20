
@extends('layouts.app')

@section('title', 'Timetable')

@section('content')


<h2>{{ isset($timetable) ? 'Edit' : 'Create' }} Timetable</h2>

@if ($errors->any())
    <div style="color:red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ isset($timetable) ? route('timetable.update', $timetable->id) : route('timetable.store') }}">
    @csrf
    @if(isset($timetable))
        @method('PUT')
    @endif

    <label for="day_id">Day:</label>
    <select name="day_id" required>
        <option value="">Select Day</option>
        @foreach($days as $day)
            <option value="{{ $day->id }}" {{ (isset($timetable) && $timetable->day_id == $day->id) ? 'selected' : '' }}>
                {{ $day->name }}
            </option>
        @endforeach
    </select><br><br>

    <label for="time_slot_id">Time Slot:</label>
    <select name="time_slot_id" required>
        <option value="">Select Time Slot</option>
        @foreach($timeSlots as $slot)
            <option value="{{ $slot->id }}" {{ (isset($timetable) && $timetable->time_slot_id == $slot->id) ? 'selected' : '' }}>
                {{ $slot->slot }} 
            </option>
        @endforeach
    </select><br><br>

    <label for="subject_id">Subject:</label>
    <select name="subject_id" required>
        <option value="">Select Subject</option>
        @foreach($subjects as $subject)
            <option value="{{ $subject->id }}" {{ (isset($timetable) && $timetable->subject_id == $subject->id) ? 'selected' : '' }}>
                {{ $subject->name }}
            </option>
        @endforeach
    </select><br><br>

    <button type="submit">{{ isset($timetable) ? 'Update' : 'Create' }}</button>
</form>

@endsection
