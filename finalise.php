<?php 
	session_start() ; 
        
        $_SESSION['orderConfirmFinalised'] = true;
		
		foreach ($_POST as $key => $value) 
        {
            $_SESSION[$key] = $value;
        }
		
		
		
	$containsAllNeededInfo = false;
	if(!empty($_POST))
	{
		if((isset($_SESSION['ProductName']) && isset($_SESSION['Email']) && isset($_POST['cardCharge'])))
		{
			$containsAllNeededInfo = true;			
			foreach ($_POST as $key => $value) 
			{
				$_SESSION[$key] = $value; 
			} 
		}		
	 }
	 if(!$containsAllNeededInfo)
	 {
		header("LOCATION: http://grid-tools-downloads.com/Will/TMF/index.php");
	 }



	 
        
	$delivery_time = 0;			

	if ($_SESSION["courier"] == "DPD") {
		$delivery_time = 3;		
	} else if ($_SESSION["courier"] == "Royal Mail") {
		$delivery_time = 2;		
	} else if ($_SESSION["courier"] == "Tesco") {
		$delivery_time = 1;		
	} else if ($_SESSION["courier"] == "Arrow XL") {
		$delivery_time = 7;		
	} else if ($_SESSION["courier"] == "UPS") {
		$delivery_time = 1;		
	} else if ($_SESSION["courier"] == "Yodal") {
		$delivery_time = 5;		
	} else if ($_SESSION["courier"] == "FedEx") {
		$delivery_time = 3;
	}
	
	if ($_SESSION["Size"] == "Small") {
		
	} else if ($_SESSION["Size"] == "Medium") {
		$delivery_time = $delivery_time * 1.5;
	} else if ($_SESSION["Size"] == "Large") { 
		$delivery_time = $delivery_time * 2;
	} 
	
	// Option to write data to .csv file
	$handle = fopen("purchases.csv", "a");

        
        $i=1;
            
        $head[0] ="header";
        $line[0] ="values";
        foreach ($_SESSION as $key => $value) 
        {
            $head[$i] = $key;
            $line[$i] = $_SESSION[$key];
            $i++;
        }
        
        fputcsv($handle, $head);
	fputcsv($handle, $line); # $line is an array of string values here
	fclose($handle);
        
        
        
          //Item & Delivery stuff
//	$line[0] = $_SESSION["Price"]; // Cost
//	$line[1] = $_SESSION["Dist"]; // Dist
//	$line[2] = $delivery_time; // Estimated Delivery
//	$line[3] = $_SESSION["Name"]; // Item
//	$line[4] = $_SESSION["Size"]; // Item Size
//	
//        
//        //Shipping stuff
//	$line[6] = $_SESSION["courier"]; // Shipping Company
//	$line[7] = $_SESSION["delivery_cost"]; // Shipping Cost
//	$line[8] = $_SESSION["country"]; // shipping Location
//       
//                //Person
//        /*
//                $_SESSION["Email"] = $_GET['Email'];
//        $_SESSION["ConfirmEmail"] = $_GET['ConfirmEmail'];
//        $_SESSION["county"] = $_GET['county'];
//	$_SESSION["country"] = $_GET['country'];
//	$_SESSION["post_code"] = $_GET['post_code'];
//	$_SESSION["line2"] = $_GET['line2'];
//	$_SESSION["line1"] = $_GET['line1'];
//	$_SESSION["name"] = $_GET['name'];	
//	*/
//    
//        //payment stuff
//	$line[9] = $_GET["cardCharge"]; // Transaction Fee
//        $line[5] = $_GET["cardType"]; // Payment Method

?>
<html>
	<head>
		<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">
		<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/grids-responsive-min.css">
		<link rel="stylesheet" href="css/layouts/store.css">
		<title></title>

	</head>

	<body>
		<?php include('includes/header.php') ?>

		<div class="content pure-u-1 pure-u-md-3-4">
			<h1 class="brand-title">Order Finalised</h1> 
			
			<div style="padding-top:20px;">
			<b>Estimated delivery time - <?php echo $delivery_time ?> days </b>
			</div>
			<div style="padding-top:20px;">
			<b>Total cost: <?php echo $_SESSION["Total_Final_Cost"] ?>.00</b>
			</div>
			<div style="padding-top:20px;">
			<b>Delivery Address:<br><?php echo $_SESSION["line1"] ?><br> <?php echo $_SESSION["line2"] ?><br> <?php echo $_SESSION["county"] ?><br> <?php echo $_SESSION["post_code"] ?><br> <?php echo $_SESSION["country"] ?></b>
			</div>
			
		</div>			
		
		<?php include('includes/footer.php') ?>
	</body>	
</html>




