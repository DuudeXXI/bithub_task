To use code:

1. open mysql -> mysql -u "username" -p
2. type -> "password" | if exist
3. Create database -> CREATE DATABASE "name"; | if exist -> USE "database name";
4. Create table ->
CREATE TABLE tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    status ENUM('Atliekama', 'Atlikta') DEFAULT 'Atliekama'
);
5. Update database credentials inside code according to your database;
6. Use.
