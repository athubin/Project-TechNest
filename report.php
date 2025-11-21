<!--<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Report</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* General Styles */
        body {
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(to bottom, #f2f7ff, #d6e4f2);
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background: #ffffff;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
            border-radius: 12px;
        }

        h1 {
            text-align: center;
            color: #34495e;
            font-size: 2.5em;
            margin-bottom: 20px;
        }

        .card-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .card {
            flex: 1 1 250px;
            max-width: 300px;
            background: linear-gradient(135deg, #6a93ff, #a3d4ff);
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            padding: 20px;
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            color: white;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
        }

        .card h2 {
            font-size: 2.5em;
            margin: 0;
        }

        .card p {
            margin: 10px 0 0;
            font-size: 1.2em;
        }

        .chart-container {
            margin: 40px auto;
            max-width: 800px;
            text-align: center;
        }

        .details {
            margin-top: 40px;
        }

        .details h2 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 20px;
            font-size: 1.8em;
        }

        .details table {
            width: 100%;
            border-collapse: collapse;
            background: #f9fcff;
            border-radius: 10px;
            overflow: hidden;
        }

        .details th, .details td {
            text-align: left;
            padding: 12px 15px;
            border-bottom: 1px solid #dce6f5;
        }

        .details th {
            background: #eaf4ff;
            color: #2c3e50;
            font-size: 1em;
            font-weight: 600;
        }

        .details tr:nth-child(even) {
            background-color: #f4f9ff;
        }

        .details tr:hover {
            background-color: #e0ecff;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 0.9em;
            color: #7f8c8d;
        }
    </style>
</head>
<body>-->

<?php include 'admin-header.php'; ?>

<?php
    $conn = mysqli_connect('localhost','root','','hrs');

    $sql = 'select * from tenant';
    $res = mysqli_query($conn,$sql);
    $row = mysqli_num_rows($res);

    $sql1 = 'select * from owner';
    $res1 = mysqli_query($conn,$sql1);
    $row1 = mysqli_num_rows($res1);

    $sql2 = 'SELECT * FROM login WHERE MONTH(login_date) = MONTH(CURDATE())AND YEAR(login_date) = YEAR(CURDATE())';
    $res2 = mysqli_query($conn,$sql2);
    $row2 = mysqli_num_rows($res2);

    $sql3 = 'select * from property';
    $res3 = mysqli_query($conn,$sql3);
    $row3 = mysqli_num_rows($res3);

    $sql4 = 'select * from property where p_status = 0';
    $res4 = mysqli_query($conn,$sql4);
    $row4 = mysqli_num_rows($res4);

    $sql5 = 'select * from booking';
    $res5 = mysqli_query($conn,$sql5);
    $row5 = mysqli_num_rows($res5);

    /*$sql6 = "SELECT DATE_FORMAT(booking_date, '%Y-%m') AS booking_month, COUNT(*) AS total_bookings FROM booking
             GROUP BY YEAR(booking_date), MONTH(booking_date)
             ORDER BY YEAR(booking_date) DESC, MONTH(booking_date) DESC";
              date("F Y") */
    $sql6 = "SELECT DATE_FORMAT(booking_date, '%M %Y') AS booking_month, COUNT(*) AS total_bookings FROM booking
             GROUP BY YEAR(booking_date), MONTH(booking_date)
             ORDER BY YEAR(booking_date), MONTH(booking_date)";
             
    
    $res6 = mysqli_query($conn,$sql6);
   // $row6 = mysqli_num_rows($res6);

    $monthdata = array(" ");
    $cntdata = array("0");

    if ($res6->num_rows > 0) {
    while ($row6 = $res6->fetch_assoc()) {
        $monthdata[] = $row6['booking_month'];
        $cntdata[] = $row6['total_bookings'];
    }
    //print_r($monthdata); 
    //print_r($cntdata); exit;
}

?>

    <div class="reportcontainer">
        <h1>Admin Report</h1>
        
        <div class="card-container">
            <div class="card" style="background: linear-gradient(135deg, #ff6a6a, #ff9473);">
                <h2><?php echo $row; ?></h2>
                <p>Tenants Registered</p>
            </div>
            <div class="card" style="background: linear-gradient(135deg, #6eff7d, #94ffba);">
                <h2><?php echo $row1; ?></h2>
                <p>Owners Registered</p>
            </div>
            <div class="card" style="background: linear-gradient(135deg, #6a93ff, #d094ff);">
                <h2><?php echo $row2; ?></h2>
                <p>New Registrations This Month</p>
            </div>
        </div>

        <!-- Chart Container -->
        <div class="chart-container">
            <h2>Bookings Trend</h2>
            <canvas id="bookingsChart"></canvas>
        </div>
        
        <div class="admindetails">
            <h2>Additional Details</h2>
            <table>
                <thead>
                    <tr>
                        <th>Metric</th>
                        <th>Value</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Total Properties</td>
                        <td><?php echo $row3; ?></td>
                    </tr>
                    <tr>
                        <td>Pending Applications</td>
                        <td><?php echo $row4; ?></td>
                    </tr>
                    <tr>
                        <td>Total Bookings</td>
                        <td><?php echo $row5; ?></td>
                    </tr>
                    <!--<tr>
                        <td>Inactive Accounts</td>
                        <td>20</td>
                    </tr>-->
                </tbody>
            </table>
        </div>

        <button id="downloadBtn">Download PDF</button>
        
        <div class="footer">
            <p>&copy; 2024 Admin Panel. All rights reserved.</p>
        </div>
    </div>
 
    <!-- Chart.js Script -->
    <script>

        document.getElementById("downloadBtn").
        addEventListener('click', function(){
            window.print();
        });
        const bookingsMonth = <?php echo json_encode($monthdata); ?>;
        const bookingsCount = <?php echo json_encode($cntdata); ?>;
        console.log(bookingsMonth);
        console.log(bookingsCount);
        const ctx = document.getElementById('bookingsChart').getContext('2d');
        const bookingsChart = new Chart(ctx, {
            type: 'line', // You can change this to 'bar', 'pie', etc.
            data: {
                labels: bookingsMonth,
                //labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July','August','September','October','November','December'],
                datasets: [{
                    label: 'Bookings',
                    //data: [0,0,0,0,0,0,0,0,0,0,2,3], // Example data
                    data: bookingsCount,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderWidth: 2,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            color: '#34495e'
                        }
                    },
                    title: {
                        display: true,
                        text: 'Monthly Bookings',
                        color: '#34495e',
                        font: {
                            size: 18
                        }
                    }
                },
                scales: {
                    x: {
                        ticks: {
                            color: '#34495e'
                        }
                    },
                    y: {
                        ticks: {
                            color: '#34495e'
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>
