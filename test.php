<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="stylesheet" src="css/booking.css">
    <title>Responsive Table</title>
    <!--<style>
        /* Basic Styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
            padding: 20px;
            display: flex;
            justify-content: center;
        }

        .bookcontainer {
            width: 100%;
            max-width: 1000px;
            margin: auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Table Header */
        .tableheader {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            background-color: #3a4d63;
            color: #ffffff;
            padding: 15px;
        }

        .tableheader .cell {
            font-weight: bold;
            padding: 10px;
            text-align: center;
        }

        /* Table Rows */
        .table-row {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            padding: 15px;
            border-bottom: 1px solid #ddd;
        }

        .table-row .cell {
            padding: 10px;
            text-align: center;
            color: #333333;
        }

        /* Alternating Row Color */
        .table-row:nth-child(even) {
            background-color: #f9f9f9;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .tableheader, .table-row {
                grid-template-columns: repeat(2, 1fr);
                grid-template-rows: auto;
                display: flex;
                flex-wrap: wrap;
            }

            .tableheader .cell, .table-row .cell {
                flex: 1 1 50%;
                text-align: left;
                padding: 10px;
            }

            /* Add labels for smaller screens */
            .tableheader .cell {
                display: none;
            }

            .table-row .cell:before {
                content: attr(data-label);
                font-weight: bold;
                color: #3a4d63;
                margin-right: 10px;
            }
        }
    </style>-->
</head>
<body>

<div class="bookcontainer">
    <div class="tableheader">
        <div class="cell">Request ID</div>
        <div class="cell">Property Title</div>
        <div class="cell">Request Date</div>
        <div class="cell">Status</div>
        <div class="cell">Action</div>
    </div>
    
    <!-- Sample Table Rows -->
    <div class="table-row">
        <div class="cell" data-label="Request ID">12345</div>
        <div class="cell" data-label="Property Title">Beachfront Villa</div>
        <div class="cell" data-label="Request Date">12/11/2024</div>
        <div class="cell" data-label="Status">Pending</div>
        <div class="cell" data-label="Action"><button>View</button></div>
    </div>
    
    <div class="table-row">
        <div class="cell" data-label="Request ID">67890</div>
        <div class="cell" data-label="Property Title">Mountain Cabin</div>
        <div class="cell" data-label="Request Date">15/11/2024</div>
        <div class="cell" data-label="Status">Approved</div>
        <div class="cell" data-label="Action"><button>View</button></div>
    </div>
    
    <!-- Add more rows as needed -->
</div>

</body>
</html>
