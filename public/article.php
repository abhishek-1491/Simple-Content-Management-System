<?php
// article.php
include "../includes/db.php";  // your database connection file

// Validate and fetch article ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid article ID");
}

$articleID = $_GET['id'];

// Fetch article from DB
$stmt = $conn->prepare("SELECT * FROM articles WHERE id = ?");
$stmt->bind_param("s", $articleID);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Article not found!");
}

$article = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($article['title']); ?> | Simple CMS</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

    <nav>
        <h1>Simple CMS</h1>
    </nav>

    <div class="article-container">
        <h1><?php echo $article['title']; ?></h1>
        
        <div class="article-content">
            <?php echo ($article['content']); ?>
        </div>
        <a href="index.php" class="back-link">Back to Articles</a>
    </div>

</body>

</html>