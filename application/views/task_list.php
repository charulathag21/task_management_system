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

    <form method="get" class="mb-3 row g-2">
        <div class="col-auto">
            <select name="status" class="form-select">
                <option value="pending" <?php if($_GET['status']??''=='pending') echo 'selected'; ?>>Pending</option>
                <option value="completed" <?php if($_GET['status']??''=='completed') echo 'selected'; ?>>Completed</option>
                <option value="all" <?php if($_GET['status']??''=='all') echo 'selected'; ?>>All</option>
            </select>
        </div>
        <div class="col-auto">
            <select name="sort" class="form-select">
                <option value="due_date" <?php if($_GET['sort']??''=='due_date') echo 'selected'; ?>>Due Date</option>
                <option value="priority" <?php if($_GET['sort']??''=='priority') echo 'selected'; ?>>Priority</option>
                <option value="title" <?php if($_GET['sort']??''=='title') echo 'selected'; ?>>Title</option>
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
                $due = strtotime($task->due_date);
                $now = time();
                $highlight = ($due >= $now && $due <= $now + 86400) ? 'table-danger' : '';
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
