let currentPage = 1;

function loadArticles(page = 1) {
  fetch(`../includes/data.php?page=${page}`)
    .then((res) => res.json())
    .then((data) => {
      let list = document.getElementById("articleList");
      list.innerHTML = "";

      if (data.status === "success") {
        data.data.forEach((article, index) => {
          
          let words = article.content.split(" ");
          let preview =
            words.length > 10
              ? words.slice(0, 10).join(" ") +
                " ... <span class='read-more' onclick=\"window.location.href='article.php?id=" +
                article.id +
                "'\">Read More</span>"
              : article.content;

          let item = `
                                <div class="article-item" onclick="window.location.href='article.php?id=${article.id}'">
                                    <div class="article-header">
                                    <span class="article-title">${article.title}</span>
                                    
                                    </div>
                                    <p class="article-content">${preview}</p>
                                </div>
                                `;
          list.innerHTML += item;
        });

        renderPagination(data.totalPages, data.currentPage);
      } else {
        list.innerHTML = `<p style="color:red; text-align:center;">${data.message}</p>`;
      }
    })
    .catch((err) => console.error("Fetch error:", err));
}

function renderPagination(totalPages, currentPage) {
  let pagination = document.getElementById("pagination");
  pagination.innerHTML = "";

  for (let i = 1; i <= totalPages; i++) {
    let btn = document.createElement("button");
    btn.innerText = i;
    btn.classList.add("page-btn");
    if (i === currentPage) {
      btn.style.backgroundColor = "#007bff";
      btn.style.color = "#fff";
    }
    btn.onclick = () => loadArticles(i);
    pagination.appendChild(btn);
  }
}

window.onload = () => loadArticles();
