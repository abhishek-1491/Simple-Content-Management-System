<?php
include('../includes/db.php');


$id = isset($_POST['articleID']) ? $_POST['articleID'] : 0;
$title = isset($_POST['articleTitle']) ? $_POST['articleTitle'] : '';
$content = isset($_POST['articleContent']) ? $_POST['articleContent'] : '';

if ($id <= 0 || empty($title) || empty($content)) {
    echo json_encode(["status" => "error", "message" => "Missing or invalid fields"]);
    exit;
}


$sql = "UPDATE articles SET title = ?, content = ?, updated_at = NOW() WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);


if ($stmt) {
    mysqli_stmt_bind_param($stmt, "sss", $title, $content, $id);

    if (mysqli_stmt_execute($stmt)) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode([
            "status" => "error", 
            "message" => "Execution failed: " . mysqli_stmt_error($stmt)
        ]);
    }

    mysqli_stmt_close($stmt);
} else {
    echo json_encode([
        "status" => "error", 
        "message" => "Prepare failed: " . mysqli_error($conn)
    ]);
}

mysqli_close($conn);
?>
