<!DOCTYPE html>
<html>
<head>
    <title>Task List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Task List</h2>
        <a href="<?php echo base_url('index.php/tasks/add'); ?>" class="btn btn-primary">Add Task</a>
    </div>

    <div class="mb-3">
        <span class="badge bg-secondary">Total: <?php echo $counts['total']; ?></span>
        <span class="badge bg-success">Completed: <?php echo $counts['completed']; ?></span>
        <span class="badge bg-warning text-dark">Pending: <?php echo $counts['pending']; ?></span>
    </div>
    <?php $status = isset($_GET['status']) ? $_GET['status'] : 'pending';
        $sort = isset($_GET['sort']) ? $_GET['sort'] : 'title';?>
    <form method="get" class="mb-3 row g-2">
        <div class="col-auto">
            <select name="status" class="form-select">
                <option value="pending" <?= $status === 'pending' ? 'selected' : '' ?>>Pending</option>
                <option value="completed" <?= $status === 'completed' ? 'selected' : '' ?>>Completed</option>
                <option value="all" <?= $status === 'all' ? 'selected' : '' ?>>All</option>
            </select>
        </div>
        <div class="col-auto">
            <select name="sort" class="form-select">
                <option value="due_date" <?= $sort === 'due_date' ? 'selected' : '' ?>>Due Date</option>
                <option value="priority" <?= $sort === 'priority' ? 'selected' : '' ?>>Priority</option>
                <option value="title" <?= $sort === 'title' ? 'selected' : '' ?>>Title</option>
            </select>
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary">Apply</button>
        </div>
    </form>

    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Due Date</th>
                <th>Priority</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tasks as $task): 
                date_default_timezone_set('Asia/Dubai');  // Dubai timezone
                $due = strtotime($task->due_date);          
                $now = time();
                //if due date is - 
                // 1. greater than time now 2. lesser than 24 hours 3. status is pending
                $highlight = ($due >= $now && $due <= $now + 86400 && $task->status == 'pending') ? 'table-danger' : ''; 
            ?>
            <tr class="<?php echo $highlight; ?>">
                <td><?php echo $task->title; ?></td>
                <td><?php echo $task->description; ?></td>
                <td><?php echo $task->due_date; ?></td>
                <td><?php echo $task->priority; ?></td>
                <td>
                    <?php echo ucfirst($task->status); ?>
                </td>
                <td>
                    <?php if($task->status == 'pending'): ?>
                        <a href="<?php echo base_url('index.php/tasks/complete/'.$task->id); ?>" class="btn btn-success btn-sm">Mark Completed</a>
                    <?php else: ?>
                        <span class="text-success fw-bold">Completed</span>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
