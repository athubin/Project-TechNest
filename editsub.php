        <?php include 'admin-header.php'; ?>

        <main class="main-content">
            <header>
                <h1>Sub-Category Management</h1>
                <!--<button class="add-property">Add New Property</button>-->
            </header>
        
    
<?php
    $dbhost = "localhost"; 
    $dbname="hrs";
    $dbuser="root";
    $dbpass="";
    
    $conn = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
    $sql = "select * from subcategory";
    $res = mysqli_query($conn,$sql);
    
    ?>

    <div class="formclass">
    <form name="edit" method="post" action=" ">
        Enter the Sub-Category name:<select name="name" >
           <?php
           while ( $row = mysqli_fetch_assoc($res)){
           echo "<option> " .$row["s_name"]."</option>";
           }
           ?>
           </select>
        <button type="submit" name="sub">EDIT</button>
    </form>
        

<?php
    if(isset($_POST["save"]))
    {
         $id = $_POST['sid'];
         $tname = $_POST['subcat'];
         $tstatus = isset($_POST['status'])?'active':'not active';

             $sql1 = "update subcategory set s_name = '$tname', s_status = '$tstatus' where sid = '$id' ";
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
       // print_r($_POST); exit;
        $name = $_POST["name"];
       
        $sql = "select * from subcategory where s_name = '$name' ";
        $res = mysqli_query($conn,$sql);
        while ( $row = mysqli_fetch_assoc($res))
       {
            ?>
            <form name="edit1" method="post" action=" ">
                ID:
                <input type="text" name="sid" value="<?php echo $row["sid"];?>"><br>
                Type:
                <input type="text" name="subcat" value="<?php echo $row["s_name"];?>"><br>
                Status:
                <?php $checked = (($row["s_status"]=="active") ? " checked" : "");  ?>
                <input type="checkbox" name="status" value="<?php echo $row["s_status"];?>"<?php echo $checked; ?> >Active  <br>
                <button type="submit" name="save" class="save">SAVE</button>
            </form>
        <?php
       }
       
    } 
        ?>
        </main>
        </div>
   
</div>
</body>
</html>