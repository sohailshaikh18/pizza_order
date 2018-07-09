<?php
include('connection.php');

	if (isset($_POST['id']) && !empty($_POST['id'])) {
        $id = $_POST['id'];
        $price = $_POST['price'];
		$ip = $_SERVER['REMOTE_ADDR'];
		
		$CheckCart = mysqli_query($con,"select * from `cart` where `ip` LIKE '".$ip."' AND `pizza` = '".$id."' ");
		$CartData = mysqli_fetch_array($CheckCart);
		//print_r(count($CartData));die;
		if($CartData){
			$qty = $CartData['qty']+1;
			$price = $price*$qty;
			$data = mysqli_query($con,"UPDATE `cart` SET `qty`='".$qty."',`price`='".$price."' WHERE  `ip` = '".$ip."' AND `pizza` = '".$id."' ");
		}else{
			$data = mysqli_query($con,"INSERT INTO `cart` (`pizza`, `price`, `ip`, `qty`) VALUES ('$id', '$price', '$ip', '1');");
		}
		
		
		$Get = mysqli_query($con,"select COUNT(*) from `cart` where `ip` = '".$ip."'");
		$result = mysqli_fetch_row($Get);
		echo $result[0];
		die;
    }
?>