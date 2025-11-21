<!-- <html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/adminprofile.css">
    <title>Admin Dashboard - Home Rental System</title>
</head>
<body>
<div class = "profile">
    <button id="openModal"><img src="images/admin.jpg" width=25px height=25px></button>

    <div id="modal" class="modal">
        <div class="modal-content">
            <span class="close-button" id="closeModal">&times;</span>
            <h2>Admin Profile</h2>
            <p><strong>Name:</strong> Admin User</p>
            <p><strong>Email:</strong> admin@example.com</p>
            <p><strong>Role:</strong> Administrator</p>
        </div>
    </div>

    <script>
        const modal = document.getElementById('modal');
        const openModalButton = document.getElementById('openModal');
        const closeModalButton = document.getElementById('closeModal');

        openModalButton.addEventListener('click', () => {
            modal.style.display = 'block';
        });

        closeModalButton.addEventListener('click', () => {
            modal.style.display = 'none';
        });

        window.addEventListener('click', (event) => {
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        });
    </script>
</div>
    <div class="container">
   
        <nav class="sidebar">
            <h2>Admin Dashboard</h2>
            <ul>
                <li><a href="admin.php">Dashboard</a></li>
                <li><a href="#">Manage Properties</a></li>
                <li><a href="#">Property Category</a></li>
                <li><a href="#">Manage Users</a></li>
                <li><a href="#">Reports</a></li>
                <li><a href="#">Settings</a></li>
                <li><a href="#">Logout</a></li>
            </ul>
        </nav> -->

        <?php include 'adminheader.php'; ?>

        <main class="main-content">
            <header>
                <h1>Property Categories</h1>
                <!--<button class="add-property">Add New Property</button>-->
            </header>

            <section class="property-list">
                <h2>Manage Properties</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Type</td>
                            <td>Active</td>
                            <td>
                                <a href="addtype.php"><button>Add</button></a>
                                <a href="edittype.php"><button>Edit</button></a>
                                <a href="viewtype.php"><button>View</button></a>
                            </td>
                        </tr>
                        <tr>
                            <td>Category</td>
                            <td>Active</td>
                            <td>
                                <a href="addcat.php"><button>Add</button></a>
                                <a href="editcategory.php"><button>Edit</button></a>
                                <a href="viewcat.php"><button>View</button></a>
                            </td>
                        </tr>
                        <tr>
                            <td>Sub-Category</td>
                            <td>Active</td>
                            <td>
                                <a href="addsub.php"><button>Add</button></a>
                                <a href="editsub.php"><button>Edit</button></a>
                                <a href="viewsub.php"><button>View</button></a>
                            </td>
                        </tr>
                        <!-- Add more property rows as needed -->
                    </tbody>
                </table>
            </section>

            <?php
                if(isset($_GET['msg']))
                {  
                    ?>
                    <div id="hide">
                        <?php
                            echo $_GET['msg'];
                        ?>
                    </div>
                <?php
                } ?>

                <script>
                    setTimeout(function(){
                    document.getElementById("hide").style.display = "none"; 
                    }, 3000);
                </script>
            
                
        </main>