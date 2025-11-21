        <?php include 'admin-header.php'; ?>

        <main class="main-content">
            <header>
                <h1>Sub-Category Management</h1>
                <!--<button class="add-property">Add New Property</button>-->
            </header>

            <div class = "newtype">
                <h2>Add Sub-Category</h2>
                <form class="tform" action="subvalidation.php" method=post>
                    Enter new sub-category: <input type="text" name="sub" value="1 BHK"><br>
                    Sub-Category Status: 
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