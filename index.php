<?php
session_start();

// Initialize the tasks array if it doesn't exist
if (!isset($_SESSION['tasks'])) {
    $_SESSION['tasks'] = [];
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $task = htmlspecialchars(trim($_POST['task']));
    if ($task) {
        $_SESSION['tasks'][] = $task;
    }
}

// Handle task deletion
if (isset($_GET['delete'])) {
    unset($_SESSION['tasks'][$_GET['delete']]);
    $_SESSION['tasks'] = array_values($_SESSION['tasks']); // Reindex array
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List App</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>To-Do List</h1>
        <form method="POST">
            <input type="text" name="task" placeholder="Add a new task" required>
            <button type="submit">Add</button>
        </form>
        <ul>
            <?php foreach ($_SESSION['tasks'] as $index => $task): ?>
                <li>
                    <?php echo $task; ?>
                    <a href="?delete=<?php echo $index; ?>">❌</a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>
</html>