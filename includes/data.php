<?php
include "db.php"; 

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 10; 
$offset = ($page - 1) * $limit;


$totalQuery = mysqli_query($conn, "SELECT COUNT(*) as total FROM articles");
$totalRow = mysqli_fetch_assoc($totalQuery);
$totalRecords = $totalRow['total'];
$totalPages = ceil($totalRecords / $limit);


$query = "SELECT * FROM articles ORDER BY id DESC LIMIT $limit OFFSET $offset";
$result = mysqli_query($conn, $query);

$data = [];
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    echo json_encode([
        "status" => "success",
        "data" => $data,
        "totalPages" => $totalPages,
        "currentPage" => $page
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => "No articles found"
    ]);
}

mysqli_close($conn);
