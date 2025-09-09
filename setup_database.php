<?php
require_once 'config.php';

// SQL to create table
$sql = "CREATE TABLE IF NOT EXISTS test_info (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    comments TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Table test_info created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?>
