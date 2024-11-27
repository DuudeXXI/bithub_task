<?php
// Database credentials
$host = 'localhost';
$dbname = 'bithub';
$username = 'root';
$password = 'root';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT id, title, status FROM tasks";
    $statement = $pdo->query($sql);

    $tasks = $statement->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $error) {
    echo "<script>console.error('Connection failed: " . $error->getMessage() . "');</script>";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bithub Tasklist</title>
</head>

<body>
    <div id="tasklist">
        <table border="1" style="margin-bottom: 40px;" cellpadding="10" cellspacing="0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Pavadinimas</th>
                    <th>Būsena</th>
                    <th>Veiksmas</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($tasks)): ?>
                    <?php foreach ($tasks as $task): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($task['id']); ?></td>
                            <td><?php echo htmlspecialchars($task['title']); ?></td>
                            <td><?php echo htmlspecialchars($task['status']); ?></td>
                            <td>
                                <form action="mark_done.php" method="POST" style="display:inline;">
                                    <input type="hidden" name="task_id" value="<?php echo $task['id']; ?>">
                                    <button type="submit">
                                    <?php echo $task['status'] == "Atlikta" ? "Grąžinti" : "Pažymėti kaip atlikta"; ?>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">Užduočių nerasta</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <form action="add_task.php" method="POST">
        <div>
            <label for="task">Įvesti užduotį:</label><br>
            <input type="text" name="task" required>
            <button type="submit">Pridėti</button>
        </div>
    </form>
</body>

</html>
