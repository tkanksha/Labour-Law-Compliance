// Compliance Doughnut Chart
new Chart(document.getElementById("complianceDoughnut"), {
  type: 'doughnut',
  data: {
    labels: ["Compliant", "Pending"],
    datasets: [{
      label: "Compliance Status",
      data: [19, 6],
      backgroundColor: ["#4CAF50", "#FF9800"]
    }]
  },
  options: {
    responsive: true,
    plugins: {
      legend: {
        position: 'bottom'
      }
    }
  }
});

// Compliance Trend (Line Chart)
new Chart(document.getElementById("complianceTrend"), {
  type: 'line',
  data: {
    labels: ["Jan", "Feb", "Mar", "Apr"],
    datasets: [{
      label: "Compliance %",
      data: [68, 72, 78, 82],
      borderColor: "#3e95cd",
      fill: false,
      tension: 0.3
    }]
  },
  options: {
    responsive: true,
    plugins: {
      legend: {
        display: true
      }
    }
  }
});

function filterArticles() {
  const input = document.getElementById("articleSearch").value.toLowerCase();
  const articles = document.querySelectorAll("#articlesContainer .article-card");

  articles.forEach(article => {
    const tags = article.getAttribute("data-tags").toLowerCase();
    const title = article.querySelector("h3").innerText.toLowerCase();
    if (title.includes(input) || tags.includes(input)) {
      article.style.display = "block";
    } else {
      article.style.display = "none";
    }
  });
}
