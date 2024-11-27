<?php
$host = 'localhost';
$dbname = 'bithub';
$username = 'root';
$password = 'root';

if (isset($_POST['task_id'])) {
    $task_id = intval($_POST['task_id']);

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT status FROM tasks WHERE id = :task_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':task_id', $task_id, PDO::PARAM_INT);
        $stmt->execute();
        $task = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($task) {
            $new_status = ($task['status'] === 'Atliekama') ? 'Atlikta' : 'Atliekama';

            $update_sql = "UPDATE tasks SET status = :new_status WHERE id = :task_id";
            $update_stmt = $pdo->prepare($update_sql);
            $update_stmt->bindParam(':new_status', $new_status, PDO::PARAM_STR);
            $update_stmt->bindParam(':task_id', $task_id, PDO::PARAM_INT);

            if ($update_stmt->execute()) {
                header("Location: index.php");
                exit();
            } else {
                echo "Error updating task status!";
            }
        } else {
            echo "Task not found!";
        }

    } catch (PDOException $error) {
        echo "Connection failed: " . $error->getMessage();
    }
} else {
    echo "No task ID provided!";
}
?>
