function openAddForm() {
  document.getElementById("addModal").style.display = "flex";
}

function closeAddForm() {
  document.getElementById("addModal").style.display = "none";
}

document.getElementById("addForm").addEventListener("submit", function (e) {
  e.preventDefault();

  let formData = new FormData(this);

  fetch("add.php", {
    method: "POST",
    body: formData,
  })
    .then((res) => res.json())
    .then((data) => {
      if (data.status === "success") {
        alert("Article added successfully!");
        closeAddForm();
        loadArticles();
      } else {
        alert("Failed to add: " + data.message);
      }
    })
    .catch((err) => console.error("Error:", err));
});

function loadArticles(page = 1) {
  fetch("../includes/data.php?page=" + page)
    .then((res) => res.json())
    .then((data) => {
      let tbody = document.querySelector("table tbody");
      tbody.innerHTML = "";

      if (data.status === "success") {
        data.data.forEach((article, index) => {
          let row = `
            <tr>
              <td>${(page - 1) * 10 + index + 1}</td>
              <td>${article.title}</td>
              <td>${article.content}</td>
              <td>
                <button class="action-btn edit" onclick="openEditForm(this,'${
                  article.id
                }')">Edit</button>
                <button class="action-btn delete" onclick="confirmDelete(this,'${
                  article.id
                }')">Delete</button>
              </td>
            </tr>`;
          tbody.innerHTML += row;
        });

        // build pagination
        buildPagination(data.totalPages, data.currentPage);
      } else {
        let row = `
          <tr>
            <td colspan="4" style="text-align:center; color:red;">
              ${data.message}
            </td>
          </tr>`;
        tbody.innerHTML = row;
      }
    })
    .catch((err) => console.error("Fetch error:", err));
}

function buildPagination(totalPages, currentPage) {
  let container = document.getElementById("pagination");
  container.innerHTML = "";

  for (let i = 1; i <= totalPages; i++) {
    let btn = document.createElement("button");
    btn.innerText = i;
    btn.className = "page-btn";
    if (i === currentPage) {
      btn.style.background = "#007bff";
      btn.style.color = "#fff";
    }
    btn.onclick = () => loadArticles(i);
    container.appendChild(btn);
  }
}

window.onload = () => loadArticles();

let currentRow = null;

function openEditForm(button, id) {
  currentRow = button.closest("tr");
  document.getElementById("articleID").value = id;
  document.getElementById("editTitle").value = currentRow.cells[1].innerText;
  document.getElementById("editContent").value = currentRow.cells[2].innerText;
  document.getElementById("editModal").style.display = "flex";
}

function closeEditForm() {
  document.getElementById("editModal").style.display = "none";
}

document.getElementById("editForm").addEventListener("submit", function (e) {
  e.preventDefault();

  let formData = new FormData(this);

  fetch("update.php", {
    method: "POST",
    body: formData,
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.status === "success") {
        alert("Article updated successfully!");
        closeEditForm();
        loadArticles();
      } else {
        alert("Update failed: " + data.message);
      }
    })
    .catch((error) => console.error("Error:", error));
});

function confirmDelete(button, id) {
  let row = button.closest("tr");
  let title = row.cells[1].innerText;

  if (confirm(`Are you sure you want to delete "${title}"?`)) {
    let formData = new FormData();
    formData.append("articleID", id);

    fetch("delete.php", {
      method: "POST",
      body: formData,
    })
      .then((res) => res.json())
      .then((data) => {
        if (data.status === "success") {
          alert("Article deleted successfully!");
          loadArticles();
        } else {
          alert("Delete failed: " + data.message);
        }
      })
      .catch((err) => console.error("Error:", err));
  }
}
