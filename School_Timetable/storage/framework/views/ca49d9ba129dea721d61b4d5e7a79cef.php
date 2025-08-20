<!-- resources/views/timetable/create_edit.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title><?php echo e(isset($timetable) ? 'Edit' : 'Create'); ?> Timetable</title>
</head>
<body>

<h2><?php echo e(isset($timetable) ? 'Edit' : 'Create'); ?> Timetable</h2>

<?php if($errors->any()): ?>
    <div style="color:red;">
        <ul>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?>

<form method="POST" action="<?php echo e(isset($timetable) ? route('timetable.update', $timetable->id) : route('timetable.store')); ?>">
    <?php echo csrf_field(); ?>
    <?php if(isset($timetable)): ?>
        <?php echo method_field('PUT'); ?>
    <?php endif; ?>

    <label for="day_id">Day:</label>
    <select name="day_id" required>
        <option value="">Select Day</option>
        <?php $__currentLoopData = $days; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($day->id); ?>" <?php echo e((isset($timetable) && $timetable->day_id == $day->id) ? 'selected' : ''); ?>>
                <?php echo e($day->name); ?>

            </option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select><br><br>

    <label for="time_slot_id">Time Slot:</label>
    <select name="time_slot_id" required>
        <option value="">Select Time Slot</option>
        <?php $__currentLoopData = $timeSlots; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slot): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($slot->id); ?>" <?php echo e((isset($timetable) && $timetable->time_slot_id == $slot->id) ? 'selected' : ''); ?>>
                <?php echo e($slot->start_time); ?> - <?php echo e($slot->end_time); ?>

            </option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select><br><br>

    <label for="subject_id">Subject:</label>
    <select name="subject_id" required>
        <option value="">Select Subject</option>
        <?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($subject->id); ?>" <?php echo e((isset($timetable) && $timetable->subject_id == $subject->id) ? 'selected' : ''); ?>>
                <?php echo e($subject->name); ?>

            </option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select><br><br>

    <button type="submit"><?php echo e(isset($timetable) ? 'Update' : 'Create'); ?></button>
</form>

</body>
</html>
<?php /**PATH D:\School_Timetable\resources\views/timetable/edit.blade.php ENDPATH**/ ?>