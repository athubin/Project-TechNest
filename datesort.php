<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sort Reports Month-wise</title>
  <style>
    /* styles.css */
body {
  font-family: Arial, sans-serif;
  margin: 20px;
  padding: 0;
  background-color: #f9f9f9;
}

.report-container {
  max-width: 800px;
  margin: 0 auto;
  background: #fff;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

h1 {
  text-align: center;
  color: #333;
}

.filter-container {
  display: flex;
  align-items: center;
  margin-bottom: 20px;
  gap: 10px;
}

label {
  font-size: 16px;
  color: #555;
}

select {
  padding: 8px;
  font-size: 16px;
  border: 1px solid #ccc;
  border-radius: 4px;
  background: #fff;
}

#reports {
  display: grid;
  grid-template-columns: 1fr;
  gap: 10px;
}

.report {
  padding: 15px;
  border: 1px solid #ddd;
  border-radius: 4px;
  background-color: #f4f4f4;
  color: #333;
  transition: background-color 0.3s;
}

.report:hover {
  background-color: #eaeaea;
}
</style>
</head>
<body>
  <div class="report-container">
    <h1>Admin Reports</h1>
    <div class="filter-container">
      <label for="monthFilter">Sort by Month:</label>
      <select id="monthFilter">
        <option value="all" selected>All Months</option>
        <option value="january">January</option>
        <option value="february">February</option>
        <option value="march">March</option>
        <option value="april">April</option>
        <option value="may">May</option>
        <option value="june">June</option>
        <option value="july">July</option>
        <option value="august">August</option>
        <option value="september">September</option>
        <option value="october">October</option>
        <option value="november">November</option>
        <option value="december">December</option>
      </select>
    </div>

    <label for="yearFilter">Sort by Year:</label>
      <select id="yearFilter">
        <option value="all" selected>All Years</option>
        <option value="2022">2022</option>
        <option value="2023">2023</option>
        <option value="2024">2024</option>
        <option value="2025">2025</option>
      </select>

      <input type = "date" >
   <!-- <div id="reports">
      <div class="report" data-month="january">Report 1 - January</div>
      <div class="report" data-month="february">Report 2 - February</div>
      <div class="report" data-month="march">Report 3 - March</div>
      <div class="report" data-month="april">Report 4 - April</div>
      <!-- Add more reports as needed -->
    <!--</div>-->
  </div>
  <script>
    document.querySelectorAll("#monthFilter, #yearFilter").forEach((filter) =>
  filter.addEventListener("change", function () {
    const selectedMonth = document.getElementById("monthFilter").value;
    const selectedYear = document.getElementById("yearFilter").value;

    const reports = document.querySelectorAll(".report");

    reports.forEach((report) => {
      const reportMonth = report.getAttribute("data-month");
      const reportYear = report.getAttribute("data-year");

      // Show the report if it matches the selected month AND year or if "All" is selected
      if (
        (selectedMonth === "all" || selectedMonth === reportMonth) &&
        (selectedYear === "all" || selectedYear === reportYear)
      ) {
        report.style.display = "block"; // Show the report
      } else {
        report.style.display = "none"; // Hide the report
      }
    });
  })
);

  </script>
</body>
</html>
