<?php
include('../includes/db.php');

$id = isset($_POST['articleID']) ? $_POST['articleID'] : 0;

if ($id <= 0) {
    echo json_encode(["status" => "error", "message" => "Invalid ID"]);
    exit;
}

$sql = "DELETE FROM articles WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "i", $id);

    if (mysqli_stmt_execute($stmt)) {
        if (mysqli_stmt_affected_rows($stmt) > 0) {
            echo json_encode(["status" => "success"]);
        } else {
            echo json_encode(["status" => "error", "message" => "No record found with that ID"]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => mysqli_stmt_error($stmt)]);
    }

    mysqli_stmt_close($stmt);
} else {
    echo json_encode(["status" => "error", "message" => mysqli_error($conn)]);
}

mysqli_close($conn);
?>
