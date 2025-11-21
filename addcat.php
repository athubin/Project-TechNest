        <?php include 'admin-header.php'; ?>

        <main class="main-content">
            <header>
                <h1>Category Management</h1>
                <!--<button class="add-property">Add New Property</button>-->
            </header>

            <div class = "newtype">
                <h2>Add Category</h2>
                <form class="tform" action="catvalidation.php" method="post">
                    Enter new category: <input type="text" name="cat" value="Furnished"><br>
                    Category Status: 
                    <select name="status">
                        <option value="active" selected>Active</option>
                        <option value="deactive">De-Active</option>
                    </select><br>
                    <button type="submit" name="typesubmit">SAVE</button>
                    <a href="property-category.php"><button type="button">CANCEL</button></a>
                </form>
            </div>
        </main>
    </div>
</body>
</html>