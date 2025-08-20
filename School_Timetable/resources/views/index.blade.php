@extends('layouts.app')

@section('title', 'Timetable')

@section('content')
    
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f5f5f5;
            padding: 20px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
            background: white;
        }
        th, td {
            border: 1px solid #999;
            padding: 12px;
            text-align: center;
        }
        th {
            background-color: #e3f2fd;
        }
        caption {
            font-size: 24px;
            margin-bottom: 15px;
        }
    </style>

<h2>The Garden School - Grade 1 Timetable</h2>
<p><strong>Assembly:</strong> 9:00 - 9:20</p>

<table id="timetable">
    <thead>
        <tr>
            <th>Day / Time</th>
        </tr>
    </thead>
    <tbody></tbody>
</table>

<p><strong>Snack Break:</strong> 10:45 - 11:10</p>
<p><strong>Lunch:</strong> 12:30 - 01:10</p>
<p><strong>Break:</strong> 2:30 - 2:35</p>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
    $.ajax({
        url: '/timetable/data',
        type: 'GET',
        success: function (res) {
            const days = res.days;
            const slots = res.slots;
            const subjects = res.subjects;
            const grid = res.grid;

            // Subject ID to Name map
            const subjectMap = {};
            subjects.forEach(s => {
                subjectMap[s.id] = s.name;
            });

            // Build header row
            let headerRow = '<tr><th>Day / Time</th>';
            slots.forEach(slot => {
                headerRow += `<th>${slot.slot}</th>`;
            });
            headerRow += '</tr>';
            $('#timetable thead').html(headerRow);

            // Build rows
            let bodyHtml = '';
            days.forEach(day => {
                bodyHtml += `<tr><td><strong>${day.name}</strong></td>`;
                slots.forEach(slot => {
                    const subjectId = (grid[day.id] && grid[day.id][slot.id]) ? grid[day.id][slot.id] : null;
                    const subjectName = subjectId ? subjectMap[subjectId] : '-';
                    bodyHtml += `<td>${subjectName}</td>`;
                });
                bodyHtml += '</tr>';
            });

            $('#timetable tbody').html(bodyHtml);
        },
        error: function () {
            alert("Failed to load timetable.");
        }
    });
});
</script>

@endsection
