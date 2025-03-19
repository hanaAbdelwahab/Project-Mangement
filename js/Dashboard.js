document.addEventListener("DOMContentLoaded", function () {
    // Mock Quiz History Data
    const historyData = [
        { date: "March 1, 2025", score: "85%" },
        { date: "March 5, 2025", score: "90%" },
        { date: "March 10, 2025", score: "75%" }
    ];

    const historyList = document.getElementById("history-list");
    const historyButton = document.querySelector(".view-history");

    historyButton.addEventListener("click", function () {
        if (historyList.innerHTML.trim() === "") {  // Load only if empty
            historyData.forEach(entry => {
                const li = document.createElement("li");
                li.textContent = `📅 ${entry.date} - Score: ${entry.score}`;
                historyList.appendChild(li);
            });
        }
        historyList.classList.toggle("hidden"); // Toggle visibility properly
    });

    // Overview Performance Chart
    const overviewButton = document.querySelector(".view-overview");
    const performanceChart = document.getElementById("performanceChart");

    overviewButton.addEventListener("click", function () {
        performanceChart.classList.toggle("hidden");

        if (!performanceChart.classList.contains("hidden") && !performanceChart.dataset.chartInitialized) {
            new Chart(performanceChart, {
                type: "bar",
                data: {
                    labels: ["March 1", "March 5", "March 10"],
                    datasets: [{
                        label: "Performance (%)",
                        data: [85, 90, 75],
                        backgroundColor: ["#FFB74D", "#4CAF50", "#FF7043"]
                    }]
                }
            });
            performanceChart.dataset.chartInitialized = "true";
        }
    });
});
