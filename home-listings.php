<?php $title = "Properties | TECHNEST RENTALS"; ?>
<?php include "technest-header.php"; ?>

    <header>
        <h1>Properties for Rent</h1>
    </header>

    <?php
        $conn = mysqli_connect("localhost","root","","hrs");
        $location = "";
        $price = 0;
        $type = [];
        $cat = [];
        $bhk = [] ;

        if(isset($_GET['search'])){
            $location = $_GET['location'];
        }
        if(isset($_POST['submit'])){
            $location = $_POST['location'];
            $price = $_POST['price'];
            $type = (isset($_POST['type'])?$_POST['type']:[]);
            $cat = (isset($_POST['cat'])?$_POST['cat']:[]);
            $bhk = (isset($_POST['bhk'])?$_POST['bhk']:[]);
        }
        $pricefilter = ($price == 0 ? '' : " AND p_price <= '$price'");
       // $typefilter =  ($type == '' ? '' : " AND p_type = '$type'");
       $count = count($type);
       $typefilter = "";
       for($a=0;$a<$count;$a++)
       {
        $andor = ($a>0) ? " OR " : " AND (";
        $typefilter =  $typefilter . ($type[$a] == '' ? '' :  $andor . "p_type = '$type[$a]'");
       }
       $typefilter .= empty($typefilter) ? "" : ")";
       //echo $typefilter;
       //exit;
       $count = count($cat);
       $catfilter = "";
       for($a=0;$a<$count;$a++)
       {
        $andor = ($a>0) ? " OR " : " AND (";
        $catfilter =  $catfilter . ($cat[$a] == '' ? '' : $andor . " p_category = '$cat[$a]'");
       }
       $catfilter .= empty($catfilter) ? "" : ")";

       $count = count($bhk);
       $bhkfilter = "";
       for($a=0;$a<$count;$a++)
       {
        $andor = ($a>0) ? " OR " : " AND ( ";
        $bhkfilter =  $bhkfilter . ($bhk[$a] == '' ? '' : $andor . " p_subcat = '$bhk[$a]'");
       } 

       $bhkfilter .= empty($bhkfilter) ? "" : ")";
       // $bhkfilter =  ($bhk == '' ? '' : " AND p_subcat = '$bhk'");

        $sql = "select p_id,p_title, p_location, p_price, p_type, p_image1 from property where p_status = 1
                AND p_booked = 1 
                AND p_owner_status = 1
                AND p_location LIKE '%$location%'" . 
                $pricefilter . $typefilter . $catfilter . $bhkfilter ;

        $res = mysqli_query($conn,$sql);

        $sqltype = "select * from type where type_status = 'active'";
        $restype = mysqli_query($conn, $sqltype);

        $sqlcat = "select * from category where category_status = 'active'";
        $rescat = mysqli_query($conn, $sqlcat);

        $sqlbhk = "select * from subcategory where s_status = 'active'";
        $resbhk = mysqli_query($conn, $sqlbhk);

        ?>
        <main>
            <div class="sidebar-propfilter">
                <form name="filterform" method="post" action="">
                    <!-- Sidebar for filtering -->
                    
                    <h2>Filter Options</h2>

                    <!-- Location Filter -->
                    <div class="filter-section">
                        <h3>Location</h3>
                        <!--<select class="filter-select" name="location">
                            <option value="any">Any Location</option>
                            <option value="new_york">New York</option>
                            <option value="los_angeles">Los Angeles</option>
                            <option value="chicago">Chicago</option>
                            <option value="san_francisco">San Francisco</option>
                        </select>-->
                        <input type="text" name="location" placeholder="Enter location..." value="<?php echo $location;?>">
                    </div>

                    <!-- Price Filter -->
                    <div class="filter-section">
                        <h3>Price Range</h3>
                        <input type="range" min="0" max="50000" value="<?php echo $price;?>" name="price" class="filter-range" id="price-range">
                        <p><span id="price-value">₹<?php echo $price;?></span></p>
                    </div>

                    <!-- Type Filter -->
                    <div class="filter-section">
                        <h3>Type</h3>
                        <?php
                        if(mysqli_num_rows($restype)>0){
                            $a=0;
                            while($rowtype = mysqli_fetch_assoc($restype)){ 
                                $checked = (in_array($rowtype['type_name'], $type)) ? " checked " : "" ;
                                ?>
                                <label><input type="checkbox" name="type[]" <?php echo $checked;?>value="<?php echo $rowtype['type_name'];?>"><?php echo ucfirst($rowtype['type_name'])?></label><br>
                            <?php
                            $a++;
                            }
                        } ?>
                        <!--<label><input type="checkbox" name="type" value="house"> House</label><br>
                        <label><input type="checkbox" name="type" value="condo"> Condo</label><br>-->
                    </div>

                    <div class="filter-section">
                        <h3>Furnished</h3>
                        <?php
                        if(mysqli_num_rows($rescat)>0){
                            while($rowcat = mysqli_fetch_assoc($rescat)){ 
                                $checked = (in_array($rowcat['category_name'] ,$cat)) ? " Checked " : "" ;?>
                                <label><input type="checkbox" name="cat[]" <?php echo $checked;?>value="<?php echo $rowcat['category_name'];?>"><?php echo ucfirst($rowcat['category_name'])?></label><br>
                            <?php
                            }
                        } ?>
                        <!--<label><input type="checkbox" name="type" value="house"> House</label><br>
                        <label><input type="checkbox" name="type" value="condo"> Condo</label><br>-->
                    </div>

                    <div class="filter-section">
                        <h3>BHK</h3>
                        <?php
                        if(mysqli_num_rows($resbhk)>0){
                            while($rowbhk = mysqli_fetch_assoc($resbhk)){ 
                                $checked = (in_array($rowbhk['s_name'] ,$bhk)) ? " Checked " : "" ;?>
                                <label><input type="checkbox" name="bhk[]" <?php echo $checked;?>value="<?php echo $rowbhk['s_name'];?>"><?php echo ucfirst($rowbhk['s_name'])?></label><br>
                            <?php
                            }
                        } ?>
                        <!--<label><input type="checkbox" name="type" value="house"> House</label><br>
                        <label><input type="checkbox" name="type" value="condo"> Condo</label><br>-->
                    </div>

                    <!--<button class="apply-fi"lters">Apply Filters</button>-->
                    <input type="submit" class="apply-filters" name="submit" value="Apply Filters">
                
                </form>
            </div>
            <div class="proplisting">
                <?php
                if(mysqli_num_rows($res) > 0)
                { 
                    while($row = mysqli_fetch_assoc($res)){
                    ?>
                    
                        <div class="property">
                            <img src="uploads/<?php echo $row['p_image1'];?>" alt="Property 1">
                            <h2><?php echo $row['p_title']; ?></h2>
                            <p><?php echo $row['p_location']; ?></p>
                            <p><?php echo $row['p_price']; ?></p>
                            <button class="view"><a href="prop-details.php?propid=<?php echo $row['p_id']; ?>">View</a></button>
                        </div> 
                    <?php
                    }
                }else{
                   // echo '<div class="property">';
                    echo '<h2> No properties added</h2>';
                   // echo '</div>';
                }
                ?>
            </div>

        </main>
        <script>
        // Get the price range slider and the span to display the selected price
        const priceRange = document.getElementById('price-range');
        const priceValue = document.getElementById('price-value');

        // Update the displayed price when the slider value changes
        priceRange.addEventListener('input', function() {
            priceValue.textContent = '₹' + priceRange.value;
        });
    </script>
    <?php include 'technest-footer.php'; ?>

</html>

   