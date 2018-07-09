<?php
include('connection.php');

	if (isset($_POST['Qty']) && !empty($_POST['Qty'])) {
        $Qty = $_POST['Qty'];
        $Amount = $_POST['Amount'];
		$ip = $_SERVER['REMOTE_ADDR'];
		
		$CartData = mysqli_query($con,"select * from `cart` where `ip` LIKE '".$ip."'");
		
		
		$CheckOrder = mysqli_query($con,"select `code` from `order_payment` where 1=1 ORDER BY `id` DESC LIMIT 1 ");
		$OrderData = mysqli_fetch_array($CheckOrder);
		if($OrderData){
			$ExpoCode = explode('-',$OrderData['code']);
			$code = $ExpoCode[1]+1;
			$Newcode = 'code-'.$code;
		}else{
			$Newcode = 'code-1';
		}
		
		while($row = mysqli_fetch_array($CartData)){
			$data = mysqli_query($con,"INSERT INTO `order` (`pizza`, `price`, `ip`, `qty`,`code`) VALUES ('".$row['pizza']."', '".$row['price']."', '".$ip."', '".$row['qty']."','$Newcode');");
		}
		$data = mysqli_query($con,"INSERT INTO `order_payment` (`total_amt`, `ip`, `total_qty`,`code`) VALUES ('$Amount', '$ip','$Qty','$Newcode');");
		$CartData = mysqli_query($con,"DELETE from `cart` where `ip` LIKE '".$ip."'");
		if($data){
			echo 'success'; die;
		}else{
			echo 'failed';die;
		}
    }
?>