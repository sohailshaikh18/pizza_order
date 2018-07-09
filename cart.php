<?php
include('connection.php');
$CartCount = mysqli_query($con,"select COUNT(*) from `cart` where `ip` = '".$_SERVER['REMOTE_ADDR']."'");
$result = mysqli_fetch_row($CartCount);

$CartData = mysqli_query($con,"select `p`.`name`,`p`.`image`,`p`.`toppings`,`p`.`size`,`p`.`price` as `pprice`, `c`.`qty`, `c`.`price` FROM `cart` as `c` LEFT JOIN `pizza` as `p` ON `c`.`pizza` = `p`.`id`  where `ip` = '".$_SERVER['REMOTE_ADDR']."'");

?>
<!doctype html>
<html lang="en">
	<head>
        <!-- title -->
        <title>Order Pizza</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </head>
    <body>
        <header style="background-color:black;color:#fff;">
        <div class="container">
            <div class="row">
				<div class="col-md-12 text-center">
					<h3>Order Pizza <a href="cart.php" class="btn btn-success">CART <span class="cart-count"><?=$result[0]?></span></a></h3>
				</div>
            </div>
        </div>
        </header>
        <div class="container">
            <div class="row">
				<div class="col-md-12 response-div">
					<?php if(mysqli_fetch_array($CartData) >0){?>
					<table class="table table-responsive table-striped table-bordered table-condensed" style="margin-top:30px;">
					<tr>
					<th colspan="6">
					 <h3 class="text-center">Your Cart</h3>
					</th>
					</tr>
					<tr>
					<th>Sr.No.</th>
					<th>Item</th>
					<th>Size</th>
					<th>Price</th>
					<th>Qty.</th>
					<th>Amount</th>
					</tr>
					<?php
					$i=1;
					$TotalAmt=0;
					$TotalQty=0;
					while($row = mysqli_fetch_array($CartData)){ ?>
						<tr>
						<td><?= $i?></td>
						<td><img src="images/<?= $row['image']?>" style="height:60px;width:auto;"> <?= $row['name']?></td>
						<td><?= $row['size']?></td>
						<td><?= $row['pprice']?></td>
						<td>
						<?php 
							$TotalQty+=$row['qty'];
							echo $row['qty'];
						?>
						</td>
						<td>
						<?php 
							$TotalAmt+=$row['price'];
							echo $row['price'].' Rs.';
						?>
						</td>
						</tr>
					<?php $i++; } ?>
					<tr>
					<td colspan="5" class="text-right">Total Amount</td>
					<td><?=$TotalAmt?> Rs./-</td>
					</tr>
					<tr>
					<td colspan="6">
					<button class="placeorder btn btn-primary pull-right" data-qty="<?=$TotalQty?>" data-amt="<?=$TotalAmt?>">Place Order</button>
					</td>
					</tr>
					</table>
					<?php }else{
						echo '<br><br><br><br><h4 class="text-center">Your cart is empty.!</h4><br><br><center><a href="index.php" class="btn btn-warning btn-md"> Order Now</a></center><br><br><br><br><br><br>';
					} ?>
				</div>
            </div>
        </div>
		
		
        <footer style="background-color:black;color:#fff;">
        <div class="container">
            <div class="row">
				<div class="col-md-12 text-center">
				</div>
            </div>
        </div>
        </footer>
<script>
$(document).on('click','.placeorder',function(){
	var Qty = $(this).attr('data-qty');
	var Amount = $(this).attr('data-amt');
	$('.response-div').html('');
	$.ajax({
		type: 'POST',
		data:'Qty='+Qty+'&Amount='+Amount,
		url: 'placeorder.php',
		success: function(data){
		   $('.response-div').html('<div style="margin-top:30px;" class="alert alert-success">Thank You, You will receive your order in 30 Mins.</div>');
		},
		error: function(){
			$('.response-div').html('<div style="margin-top:30px;" class="alert alert-danger">Failed to place order.</div>');
		}
	});
});
</script>
    </body>
</html>