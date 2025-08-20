<?php $__env->startSection('title', 'Grade 1 Timetable'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-4">
    <h2 class="mb-4 text-center">📚 Grade 1 Timetable - The Garden School</h2>

    <div class="mb-3 text-center">
        <button class="btn btn-primary me-2" id="loadBtn">Load Timetable</button>
        <button class="btn btn-success" id="saveBtn">Save Timetable</button>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered text-center" id="timetable">
            <thead>
                <tr id="slotHeader">
                    <th>Day / Time</th>
                </tr>
            </thead>
            <tbody id="timetableBody"></tbody>
        </table>
    </div>

    <div class="text-muted mt-3">
        <p><strong>Snack Break:</strong> 10:45 - 11:10</p>
        <p><strong>Lunch:</strong> 12:30 - 1:10</p>
        <p><strong>Break:</strong> 2:30 - 2:35</p>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('styles'); ?>
<style>
    table td, table th {
        vertical-align: middle;
    }
    .break-row {
        background-color: #f5f5f5;
        font-weight: bold;
        text-align: center;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
    let days = [], slots = [], subjects = [];

    function renderTable(data) {
        const grid = data.grid || {};
        days = data.days;
        slots = data.slots;
        subjects = data.subjects;

        // Render table header
        const $thead = $('#slotHeader');
        $thead.empty().append('<th>Day / Time</th>');
        slots.forEach(slot => {
            $thead.append(`<th data-slot-id="${slot.id}">${slot.slot}</th>`);
        });

        const $tbody = $('#timetableBody').empty();

        days.forEach(day => {
            const $tr = $('<tr>').attr('data-day-id', day.id).append(`<td><strong>${day.name}</strong></td>`);

            slots.forEach(slot => {
                const subjectId = (grid[day.id] && grid[day.id][slot.id]) || '';
                const $select = $('<select>').addClass('form-select form-select-sm')
                    .append(`<option value="">--</option>`);
                subjects.forEach(subject => {
                    $select.append(`<option value="${subject.id}" ${subject.id == subjectId ? 'selected' : ''}>${subject.name}</option>`);
                });
                $tr.append($('<td>').append($select));
            });

            $tbody.append($tr);

            // Append break rows after Monday for visual reference
            if (day.name === 'Monday') {
                const snack = $('<tr>').addClass('break-row').append(`<td colspan="${slots.length + 1}">🍎 Snack Break: 10:45 - 11:10</td>`);
                const lunch = $('<tr>').addClass('break-row').append(`<td colspan="${slots.length + 1}">🍽️ Lunch: 12:30 - 1:10</td>`);
                const brk = $('<tr>').addClass('break-row').append(`<td colspan="${slots.length + 1}">🧃 Break: 2:30 - 2:35</td>`);
                $tbody.append(snack, lunch, brk);
            }
        });
    }

    function loadTimetable() {
        $.getJSON("<?php echo e(route('timetable.data')); ?>", function (res) {
            renderTable(res);
        });
    }

    function saveTimetable() {
        const grid = {};

        $('#timetableBody tr').each(function () {
            const $row = $(this);
            const dayId = $row.data('day-id');
            if (!dayId) return; // Skip break rows

            grid[dayId] = {};

            $row.find('td:gt(0)').each(function (i) {
                const slotId = $('#slotHeader th').eq(i + 1).data('slot-id');
                const subjectId = $(this).find('select').val();
                grid[dayId][slotId] = subjectId || null;
            });
        });

        $.ajax({
            url: "<?php echo e(route('timetable.save')); ?>",
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
            },
            data: { grid },
            success: function () {
                alert("✅ Timetable saved successfully!");
            },
            error: function () {
                alert("❌ Error saving timetable.");
            }
        });
    }

    $('#loadBtn').click(loadTimetable);
    $('#saveBtn').click(saveTimetable);

    // Auto-load on page load
    loadTimetable();
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\School_Timetable\resources\views/welcome.blade.php ENDPATH**/ ?>