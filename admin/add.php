<?php
include "../includes/db.php"; 

header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = $_POST['articleTitle'];
    $content = $_POST['articleContent'];

    if (empty($title) || empty($content)) {
        echo json_encode([
            "status" => "error",
            "message" => "Title and Content are required."
        ]);
        exit;
    }

    // Secure insert with prepared statement
    $sql = "INSERT INTO articles (title, content) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ss", $title, $content);
        if (mysqli_stmt_execute($stmt)) {
            echo json_encode([
                "status" => "success",
                "message" => "Article added successfully!"
            ]);
        } else {
            echo json_encode([
                "status" => "error",
                "message" => "Database error: " . mysqli_error($conn)
            ]);
        }
        mysqli_stmt_close($stmt);
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Failed to prepare query."
        ]);
    }
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Invalid request method."
    ]);
}
