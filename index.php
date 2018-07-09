<?php
include('connection.php');
$data = mysqli_query($con,"select * from pizza");
$Get = mysqli_query($con,"select COUNT(*) from `cart` where `ip` = '".$_SERVER['REMOTE_ADDR']."'");
$result = mysqli_fetch_row($Get);
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
				<div class="col-md-12">
					<?php
					while($row = mysqli_fetch_array($data)){ ?>
						<div class="col-md-3 <?= 'pizza'.$row['id']?>" style="padding:10px;">
							<div class="col-md-12">
							<img src="images/<?= $row['image']?>" class="thumbnail">
							</div>
							<div class="col-md-12"><b><?= $row['name']?></b> - <?= $row['size']?></div>
							<div class="col-md-12">Rs. <?= $row['price']?>/-  <span class="add-repsonse" style="color:green;"></span>
							<button class="btn btn-xs btn-primary pull-right buy-pizza" data-id="<?= $row['id']?>" data-price="<?= $row['price']?>">Buy Now</button>
							</div>
						</div>
					<?php } ?>
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
$(document).on('click','.buy-pizza',function(){
	var id = $(this).attr('data-id');
	var price = $(this).attr('data-price');
	$('.pizza'+id+' .add-repsonse').html('');
	$.ajax({
		type: 'POST',
		data:'id='+id+'&price='+price,
		url: 'savedata.php',
		success: function(data){
		   $('.pizza'+id+' .add-repsonse').html('<b>Added In Cart</b>');
		   $('.pizza'+id+' .add-repsonse').hide(2000);
		   $('.cart-count').html(data);
		},
		error: function(){
			// do something on error
		}
	});
});
</script>
    </body>
</html>