        <?php include 'admin-header.php'; ?>
        <main class="main-content">
            <header>
                <h1>Type Management</h1>
                <!--<button class="add-property">Add New Property</button>-->
            </header>
        
    
<?php
    $dbhost = "localhost";
    $dbname="hrs";
    $dbuser="root";
    $dbpass="";
    
    $conn = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
    $sql = "select * from type";
    $res = mysqli_query($conn,$sql);
    
    ?>

    <div class="formclass">
    <form name="edit" method="post" action=" ">
        Enter the type name:<select name="name" >
           <?php
           while ( $row = mysqli_fetch_assoc($res)){
           echo "<option> " .$row["type_name"]."</option>";
           }
           ?>
           </select>
        <button type="submit" name="sub">EDIT</button>
    </form>
        

<?php
    if(isset($_POST["save"]))
    {
         $id = $_POST['tid'];
         $tname = $_POST['type'];
         $tstatus = isset($_POST['status'])?'active':'not active';
       //  echo "hiii";

             $sql1 = "update type set type_name = '$tname', type_status = '$tstatus' where type_ID = '$id'";
           //  echo $sql1;
             $res1 = mysqli_query($conn,$sql1);
             if($res1)
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
       
        $sql = "select * from type where type_name = '$name'";
        $res = mysqli_query($conn,$sql);
        while ( $row = mysqli_fetch_assoc($res))
       {
            ?>
            <form name="edit1" method="post" action=" ">
                ID:
                <input type="text" name="tid" value="<?php echo $row["type_ID"];?>"><br>
                Type:
                <input type="text" name="type" value="<?php echo $row["type_name"];?>"><br>
                Status:
                <?php $checked = (($row["type_status"]=="active") ? " checked" : "");  ?>
                <input type="checkbox" name="status" value="<?php echo $row["type_status"];?>"<?php echo $checked; ?> >Active  <br>
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