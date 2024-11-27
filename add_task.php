<?php
$host = 'localhost';
$dbname = 'bithub';
$username = 'root';
$password = 'root';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['task'])) {
    $task = trim($_POST['task']);

    if (!empty($task)) {
        try {
            $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "INSERT INTO tasks (title) VALUES (:task)";
            $statement = $pdo->prepare($sql);

            $statement->bindParam(':task', $task);

            if ($statement->execute()) {
                header("Location: /");
                exit();
            } else {
                echo "Error adding task!";
            }
        } catch (PDOException $error) {
            echo "Connection failed: " . $error->getMessage();
        }
    } else {
        echo "Užduočių laukas negali būti tuščias!";
    }
}
?>