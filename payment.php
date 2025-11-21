<?php include 'technest-header.php'; ?>

<?php include 'tenant-header.php'; ?>

<div class="tenantcontent">
    
    <div class="payment-container">
        <h2>Tenant Payment</h2>

        <?php

        $bid = $_GET['bid'];
       // $prent = $_SESSION['prent'];
        $tid = $_SESSION['tenantid'];
        //$sql = "select * from booking,property where tenant_ID = '$tid' AND booking.p_id = property.p_id";
        $sql = "select start_date,tenure,p_id,end_date from booking where tenant_ID = '$tid' AND booking_id = '$bid' ";
        $res = mysqli_query($conn,$sql);
        $row = mysqli_fetch_assoc($res);
        $pid = $row['p_id'];

        $sql3 = "select p_title, p_location, p_price, owner_ID from property where p_id = '$pid' ";
        $res3 = mysqli_query($conn,$sql3);
        $row3 = mysqli_fetch_assoc($res3);
        $prent = $row3['p_price'];
        $date = $row['start_date'];
        $tenure = $row['tenure'];
        $title = $row3['p_title'];
        $location = $row3['p_location'];
        $ownerid = $row3['owner_ID'];
        $enddate = $row['end_date'];

        $bns = date("Y-m-01",strtotime($date)); /*start day of tenure start month */
        $bn = date("Y-m-t",strtotime($enddate)); /* last day of tenure end date */

        $bn=date_create($bn);
        date_add($bn,date_interval_create_from_date_string("1 Days")); 
        /* start day of next month after end tenure date, for calculating no of months in tenure*/
  
        $bn = date_format($bn,'Y-m-d');
        $bns = date_create($bns);
        $bn=date_create($bn);
       // print_r($bn);
       // print_r($bns);
        $interval = $bn->diff($bns);

       // echo $nofmonths = ($bn->diff($bns))->m; /* no of months in tenure */
       $nofmonths = ($interval->y * 12) + $interval->m;
        
        $enddate = date_create($enddate);
        $edate=date_format($enddate,"F Y");
        $noofdays2 = date_format($enddate,"d"); /* no of days in end month of tenure for rent calc*/
         
        $mrent = round(($prent / 30),2);

        $pid = $row['p_id'];
        $sql2 = "select owner_name,owner_bank,owner_accno,owner_ifsc,owner_branch,owner_upi from owner,property where owner.owner_ID = property.owner_ID";
        $res2 = mysqli_query($conn,$sql2);
        $row2 = mysqli_fetch_assoc($res2);

        $oname = $row2['owner_name'];
        $obank = $row2['owner_bank'];
        $oacct = $row2['owner_accno'];
        $oifsc = $row2['owner_ifsc'];
        $obranch = $row2['owner_branch'];
        $upi = $row2['owner_upi'];     

        /* for calculating no of days in start month of tenure */
        $date=date_create($date);
        $sdate=date_format($date,"F Y");
        $startday=date_format($date,"d");
        $endday = date_format($date,"t");
        $noofdays = ($endday - $startday) + 1;

        /* end of for calculating no of days in start month of tenure */

        $dates=[]; $paydate=[]; $cnt = 0;
        //for($a = 0; $a < $tenure; $a++){
          for($a = 0; $a < $nofmonths; $a++){
          date_add($date,date_interval_create_from_date_string($cnt." Months"));
          $dates[$a] = date_format($date,"F Y");
          $cnt = 1;
        }
          

          $upiId = trim($upi);
          ?>
        
        <form class = "" action="paymentsave.php" method="post" enctype="multipart/form-data">
          <input type="hidden" name="bid" value="<?php echo $bid; ?>">
          <input type="hidden" name="payrent" value="<?php echo $prent; ?>"> 
          <input type="hidden" name="ownerid" value="<?php echo $ownerid; ?>">
          <input type="hidden" name="title" value="<?php echo $title; ?>"> 
        <div class="payment-form" id="paymentForm">
            <div id="paymentInstructions" class="payment-instructions"></div>

            
            <!-- Month and Year Selection 
            <select id="monthSelect" name="paymonth" required onchange="calculateMonthlyRent('<?php echo $sdate;?>','<?php echo $noofdays;?>','<?php echo $mrent;?>')">
            <option value="" disabled selected>Select Month</option>
              <?php// for($a=0; $a< $tenure; $a++) { ?>
              <option name="month" value="<?php// echo $dates[$a]; ?>"><?php echo $dates[$a]; ?></option>
            <?php// } ?>
            </select>-->

            <select id="monthSelect" name="paymonth" required 
              onchange="calculateMonthlyRent('<?php echo $sdate;?>','<?php echo $noofdays;?>','<?php echo $mrent;?>','<?php echo $edate;?>','<?php echo $noofdays2;?>')">
              <option value="" disabled selected>Select Month</option>
              <?php 

              $paidMonths = [];
              $query = "select distinct payment_month from payment where booking_id = '$bid' ";

              $result = mysqli_query($conn, $query);

              if ($result) {
                  while ($row = mysqli_fetch_assoc($result)) {
                      $paidMonths[] = $row['payment_month'];
                  }
                }
              // Assuming $paidMonths is an array containing months for which payment is already made
              //$paidMonths = ["December 2024", "2023-02"]; // Example data; replace this with dynamic fetching of paid months
              //for ($a = 0; $a < $tenure; $a++) { 
                for($a = 0; $a < $nofmonths; $a++){
                  $disabled = "";
                  if (in_array($dates[$a], $paidMonths)) { // Check if the month is not in the paid list
                    $disabled = "disabled" ;
                  }
              ?>
                  <option name="month" value="<?php echo $dates[$a]; ?>" <?php echo $disabled; ?>><?php echo $dates[$a]; ?></option>
              <?php 
              } 
              ?>
            </select>

            
          
            <div class ="rencalc">
              <span>Rent Rs:</span>
              <input type="text" class="rencalc" id="rentcalc" name="rentpayable" value=<?php echo $prent; ?> readonly>
            </div>
            <br>
            
        </div>

        <div class="payment-option">
            <button type="button" class="pay-in-person-button" onclick="selectPaymentMethod('inPerson')">Pay In Person</button>
            <button type="button" class="upi-button" onclick="selectPaymentMethod('upi')">UPI</button> 
          <!-- <button type="button" class="upi-button"><a href = "qr-payment.php?bid=<?php echo $bid;?>">UPI</a></button>-->
           <!-- <button type="button" class="upi-button" onclick="selectPaymentMethod('UPI')"><a href = "qr-payment.php?bid=<?php echo $bid;?> ">UPI</a></button> -->
            <!-- <button class="bank-transfer-button" onclick="selectPaymentMethod('bankTransfer')">Bank Transfer</button> -->
            <button type="button" class="bank-transfer-button" id="showDetails" onclick="selectPaymentMethod('bankTransfer')">Bank Transfer</button>
            <input id="paymethod" type="hidden" name="paymethod">
        </div>

                
        <div class="overlay" id="overlay"></div>
        <div class="modal" id="ownerModal">
        
            <h2>Owner Bank Details</h2>
            <p><strong>Owner Name:</strong><?php echo "$oname"; ?></p>
            <p><strong>Bank Name:</strong><?php echo "$obank"; ?></p>
            <p><strong>Account Number:</strong><?php echo "$oacct"; ?></p>
            <p><strong>IFSC Code:</strong><?php echo "$oifsc"; ?></p>
            <p><strong>Bank Branch:</strong><?php echo "$obranch"; ?></p>
            <button id="closeModal" type="button">Close</button>
        </div>

       

          <!--<div class="success-message" id="successMessage">
              Payment receipt has been submitted successfully!
          </div>--> 

          <?php
          $upiUrl = "upi://pay?pa=" . urlencode($upiId) 
        . "&pn=" . urlencode("Landlord's Property") 
        . "&tn=" . urlencode("Rent Payment") 
        . "&am=" . urlencode($prent) // Payment amount
        . "&cu=INR"; // Currency

          // Generate the QR code URL
          $qrCodeUrl = "https://api.qrserver.com/v1/create-qr-code/?data=" . urlencode($upiUrl) . "&size=200x200";
          ?>

            <div class='qrcontainer' id='qrcontainer'>
              <h1>Property Details</h1>
              <p><strong>Property Name:</strong><?php echo $title; ?></p>
              <p><strong>Description:</strong><?php echo $location; ?></p>

              <h3>Pay Rent</h3>
              <p class="qr-instruction">Scan the QR code below to pay your rent:</p>

              <!-- Display the QR Code -->
              <img src="<?php echo $qrCodeUrl; ?>" alt="UPI QR Code for Rent Payment">

              <!--<button type="button">Continue</button>-->
              
            </div>

            <div class="ss" id="ss" >
              <label for = "receiptUpload">Upload Receipt: </label>   
              <input type="file" id="receiptUpload" name="reciept" accept=".jpg, .jpeg, .png, .pdf">
                    
              
                  
              <!--<button class="upi-button" onclick="submitPayment()">Submit Payment</button>-->
              <button class="upi-button" type="submit" name="paysubmit">Submit Payment</button>
            </div>


        </form>
      </div> 
    </div>
</div>
<script>

  function calculateMonthlyRent(startmonth, days, prent, endmonth, enddays){
    var selectedMonth = document.getElementById('monthSelect').value;
    
    if(selectedMonth == startmonth){
      //const rent = Math.ceil(prent * days);
      const rent = Math.round(prent * days);
      document.getElementById('rentcalc').value = rent;
      document.getElementById('rentcalc').innerHTML = "Rent Rs: " + rent;
    }else if(selectedMonth == endmonth){
      const rent = Math.round(prent * enddays);
      document.getElementById('rentcalc').value = rent;
      document.getElementById('rentcalc').innerHTML = "Rent Rs: " + rent;
    }else{
      //const rent = Math.ceil(prent* 30);
      const rent = Math.round(prent* 30);
      document.getElementById('rentcalc').value = rent;
    }
  }

  function selectPaymentMethod(method) { 
    const paymentForm = document.getElementById('paymentForm');
    const paymentInstructions = document.getElementById('paymentInstructions');
    //const receiptUpload = document.getElementById('receiptUpload');
    const receiptUpload = document.getElementById('ss');
    const successMessage = document.getElementById('successMessage');
    const monthSelect = document.getElementById('monthSelect');
    //const yearSelect = document.getElementById('yearSelect');
    const paymode = document.getElementById('paymethod');
    const qrcode = document.getElementById('qrcontainer');

    paymentForm.style.display = 'block';
    //successMessage.style.display = 'none';
    monthSelect.style.display = 'block';
    //yearSelect.style.display = 'block';

    
    if (method === 'inPerson') {
     
      paymentInstructions.innerText = "Please visit the office to complete your payment in person.";
      receiptUpload.style.display = 'block';
      monthSelect.style.display = 'block';
      //yearSelect.style.display = 'block';
      qrcode.style.display = 'none';
      paymode.value = "inPerson";
    } else if (method === 'upi') {
      paymentInstructions.innerText = "Please transfer the amount using UPI and upload the receipt below.";
      receiptUpload.style.display = 'block';
      monthSelect.style.display = 'block';
      //yearSelect.style.display = 'block';
      qrcode.style.display = 'block';
      paymode.value = "UPI";
    } else if (method === 'bankTransfer') {
      paymentInstructions.innerText = "Please complete the bank transfer and upload the receipt below.";
      receiptUpload.style.display = 'block';
      monthSelect.style.display = 'block';
     // yearSelect.style.display = 'block';
     qrcode.style.display = 'none';
     paymode.value = "Bank Transfer";
    }
  }

  function submitPayment() {
    const paymentForm = document.getElementById('paymentForm');
    //const successMessage = document.getElementById('successMessage');

    paymentForm.style.display = 'none';
    //successMessage.style.display = 'block';
  }

   // Get references to modal elements
   const showDetailsButton = document.getElementById('showDetails');
        const ownerModal = document.getElementById('ownerModal');
        const overlay = document.getElementById('overlay');
        const closeModalButton = document.getElementById('closeModal');
        const receiptUpload = document.getElementById('ss');

        // Function to open the modal
        showDetailsButton.addEventListener('click', () => {
            ownerModal.style.display = 'block';
            overlay.style.display = 'block';
        });

        // Function to close the modal
        closeModalButton.addEventListener('click', () => {
            ownerModal.style.display = 'none';
            overlay.style.display = 'none';
            receiptUpload.style.display = 'block';
        });

        // Close modal when clicking on the overlay
        overlay.addEventListener('click', () => {
            ownerModal.style.display = 'none';
            overlay.style.display = 'none';
        });

</script>

</body>
</html>
