        <?php include 'admin-header.php'; ?>

        <main class="main-content">
            <header>
                <h1>Category Management</h1>
                <!--<button class="add-property">Add New Property</button>-->
            </header>
        
    
<?php
    $dbhost = "localhost";
    $dbname="hrs";
    $dbuser="root";
    $dbpass="";
    
    $conn = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
    $sql = "select * from category";
    $res = mysqli_query($conn,$sql);
    ?>

    <div class="formclass">
    <form name="edit" method="post" action=" ">
        Enter the category name:<select name="name" >
           <?php
           while ( $row = mysqli_fetch_assoc($res)){
           echo "<option> " .$row["category_name"]."</option>";
           }
           ?>
           </select>
        <button type="submit" name="sub">EDIT</button>
    </form>
        

<?php
    if(isset($_POST["save"]))
    {
         $id = $_POST['cid'];
         $tname = $_POST['category'];
         $tstatus = isset($_POST['status'])?'active':'not active';
        // echo "hiii";

             $sql1 = "update category set category_name = '$tname', category_status = '$tstatus' where category_ID = '$id'";
             //echo $sql1;
             $res = mysqli_query($conn,$sql1);

             if($res)
            {
                $msg = "Record edited successfully";
            }
            else
            {
                $msg =  "Record not edited";
            } 
            echo $msg;
            
    }    

    if(isset($_POST["sub"]))
    {
        $name = $_POST["name"];
       
        $sql = "select * from category where category_name = '$name'";
        $res = mysqli_query($conn,$sql);
        while ( $row = mysqli_fetch_assoc($res))
       {
            ?>
            <form name="edit1" method="post" action=" ">
                ID:
                <input type="text" name="cid" value="<?php echo $row["category_ID"];?>"><br>
                Type:
                <input type="text" name="category" value="<?php echo $row["category_name"];?>"><br>
                Status:
                <?php $checked = (($row["category_status"]=="active") ? " checked" : "");  ?>
                <input type="checkbox" name="status" value="<?php echo $row["category_status"];?>"<?php echo $checked; ?> >Active  <br>
                <button type="submit" name="save" class="save">SAVE</button>
            </form>
        <?php
       }
       
       
        ?>
        </main>
        </div>
    <?php
    }
    
?>
</div>
</body>
</html>