

<?php $__env->startSection('title', 'Timetable'); ?>

<?php $__env->startSection('content'); ?>

<nav class="navbar navbar-expand-lg navbar-light bg-warning">
    <div class="container-fluid">
        <a class="navbar-brand h1 mb-0" href="<?php echo e(route('timetable.index')); ?>">Time Table Entry</a>
        <div class="d-flex">
            <a class="btn btn-success btn-sm" href="<?php echo e(route('timetable.create')); ?>">Add Timetable</a>
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
                <?php $__empty_1 = true; $__currentLoopData = $timetables; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $timetable): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="text-center">
                        <td><?php echo e($timetable->id); ?></td>
                        <td><?php echo e($timetable->day->name); ?></td>
                        <td><?php echo e($timetable->timeSlot->slot); ?></td>
                        <td><?php echo e($timetable->subject->name); ?></td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <a href="<?php echo e(route('timetable.edit', $timetable->id)); ?>" class="btn btn-sm btn-primary">
                                    Edit
                                </a>
                                <form action="<?php echo e(route('timetable.destroy', $timetable->id)); ?>" method="POST" onsubmit="return confirm('Are you sure you want to delete this entry?');">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="5" class="text-center">No timetable entries found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\School_Timetable\resources\views/timetable/index.blade.php ENDPATH**/ ?>