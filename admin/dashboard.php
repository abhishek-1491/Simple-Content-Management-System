<?php

session_start();

if (!isset($_SESSION['admin'])) {
  header('Location: login.php');
  exit;
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="../public/assets/css/style.css">
  <style>
    td:nth-child(3) {

      max-width: 250px;

      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }
  </style>
</head>

<body>
  <nav class="navbar">
    <h1>Simple CMS</h1>
    <button class="btn" onclick="window.location.href='logout.php'">Logout</button>
  </nav>
  
  <div class="main-container">
    <div class="header-row">
      <h2>All Articles</h2>
      <button class="btn add-btn" onclick="openAddForm()">+ Add Article</button>
    </div>
    <table>
      <thead>
        <tr>
          <th>Sr. No</th>
          <th>Title</th>
          <th>Content</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>

      </tbody>
    </table>
    <div id="pagination" style="margin-top:15px; text-align:center;"></div>

  </div>

  <!-- Edit Modal -->
  <div id="editModal" class="modal">
    <div class="modal-content">
      <span class="close" onclick="closeEditForm()">X</span>
      <h3>Edit Article</h3>
      <form id="editForm">
        <input type="hidden" id="articleID" name="articleID">
        <label for="editTitle">Title:</label>
        <input type="text" id="editTitle" name="articleTitle" required>
        <label for="editContent">Content:</label>
        <input type="text" id="editContent" name="articleContent" required>
        <br>
        <button type="submit" class="btn save-btn">Save</button>
        <button type="button" class="btn cancel-btn" onclick="closeEditForm()">Cancel</button>
      </form>
    </div>
  </div>

  <!-- Add Modal -->
  <div id="addModal" class="modal">
    <div class="modal-content">
      <span class="close" onclick="closeAddForm()">X</span>
      <h3>Add New Article</h3>
      <form id="addForm">
        <label for="addTitle">Title:</label>
        <input type="text" id="addTitle" name="articleTitle" required>
        <label for="addContent">Content:</label>
        <input type="text" id="addContent" name="articleContent" required>
        <br>
        <button type="submit" class="btn save-btn">Save</button>
        <button type="button" class="btn cancel-btn" onclick="closeAddForm()">Cancel</button>
      </form>
    </div>
  </div>

 <script src="js/script.js"></script>
</body>


</html>