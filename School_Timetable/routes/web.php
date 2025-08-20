<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TimetableController;
use App\Http\Controllers\TimeTableEntryController;


Route::get('/', [TimetableController::class, 'index'])->name('/');
Route::get('/timetable/data', [TimetableController::class, 'data'])->name('timetable.data');

Route::get('/timetable', [TimeTableEntryController::class, 'index'])->name('timetable.index');
Route::get('/timetable/create', [TimeTableEntryController::class, 'create'])->name('timetable.create');
Route::post('/timetable/store', [TimeTableEntryController::class, 'store'])->name('timetable.store');
Route::get('/timetable/edit/{id}', [TimeTableEntryController::class, 'edit'])->name('timetable.edit');
Route::put('/timetable/update/{id}', [TimeTableEntryController::class, 'update'])->name('timetable.update');
Route::delete('/timetable/destroy/{id}', [TimeTableEntryController::class, 'destroy'])->name('timetable.destroy');
