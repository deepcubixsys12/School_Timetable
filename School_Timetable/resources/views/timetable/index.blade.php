@extends('layouts.app')

@section('title', 'Timetable')

@section('content')

<nav class="navbar navbar-expand-lg navbar-light bg-warning">
    <div class="container-fluid">
        <a class="navbar-brand h1 mb-0" href="{{ route('timetable.index') }}">Time Table Entry</a>
        <div class="d-flex">
            <a class="btn btn-success btn-sm" href="{{ route('timetable.create') }}">Add Timetable</a>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <div class="row mb-3">
        <div class="col">
            <h3 class="text-center">Timetable List</h3>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover align-middle">
            <thead class="table-light">
                <tr class="text-center">
                    <th>#</th>
                    <th>Day</th>
                    <th>Time Slot</th>
                    <th>Subject</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($timetables as $timetable)
                    <tr class="text-center">
                        <td>{{ $timetable->id }}</td>
                        <td>{{ $timetable->day->name }}</td>
                        <td>{{ $timetable->timeSlot->slot }}</td>
                        <td>{{ $timetable->subject->name }}</td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('timetable.edit', $timetable->id) }}" class="btn btn-sm btn-primary">
                                    Edit
                                </a>
                                <form action="{{ route('timetable.destroy', $timetable->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this entry?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No timetable entries found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
