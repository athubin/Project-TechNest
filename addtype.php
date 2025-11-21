
<?php include 'admin-header.php'; ?>
        <main class="main-content">
            <header>
                <h1>Type Management</h1>
                <!--<button class="add-property">Add New Property</button>-->
            </header> 

            <div class = "newtype">
                <h2>Add Type</h2> 
                <form class="tform" action="typevalidation.php" method="post">
                    Enter new type: <input type="text" name="type" value="Home"><br>
                    Type Status: 
                    <select name="status">
                        <option value="active" selected>Active</option>
                        <option value="deactive">De-Active</option>
                    </select><br>
                    <a href="typevalidation.php"><button type="submit" name="typesubmit" value="submit">SAVE</button></a>
                    <a href="property-category.php"><button type="button">CANCEL</button></a>
                </form>
            </div>
        </main>
    </div>
</body>
</html>