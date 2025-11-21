        <?php include 'admin-header.php'; ?>

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