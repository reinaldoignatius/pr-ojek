<?php 
  include 'connectdb.php';

  $_SESSION["user_id"] = 1;

  include 'getinfo.php'
?>

<!DOCTYPE html>
<html>

<head>
	<title>Order</title>
	<link rel="stylesheet" href="css/history.css">
	<link rel="stylesheet" href="css/nav.css">
	<link rel="stylesheet" href="css/previousOrder.css">
</head>

<body>
	<?php
		include 'history.php';
	?>

	<div class="content">
		<ul id="drivers">
			<?php
				$orderQuery = "SELECT userOrders.id, driver_id, pickup, destination, rating, comment, date, name, picture FROM (SELECT * FROM orders WHERE user_id = " . $_SESSION['user_id'] . ") as userOrders JOIN users on driver_id = users.id";
				$orderResults = $db->query($orderQuery);
				
				while ($order = $orderResults->fetch_assoc()) {
					echo("<li id=" . $order['id'] . ">
								<table>
									<tr>
										<td class='prof-pic'><img src='storage/images/" . $order['picture'] . "'></td>
										<td>
											<ul>
												<li class='date'>" . $order['date'] . "</li>
												<li class='hide-button'><input type='button' value='HIDE' onclick='hideDriver(" . $order['id'] . ");'></li>
												<li class='name'>" . $order['name'] . "</li>
												<li class='location'>" . $order['pickup'] . " - " . $order['destination'] . "</li>
												<li class='rating'>
													You rated:  
													<span class='stars'>");
														for ($i = 0; $i < $order['rating']; ++$i) {
															echo("&#9734");
														}
										echo("</span>
												</li>
												<li class='comment-header'>You commented:</li>
												<li class='comment-content'>" . $order['comment'] . "</li>
											</ul>
										</td>
									</tr>
								</table>
								</li>");

				}
			?>
		</ul>
	</div>
</body>

</html>

<script>
	function hideDriver(orderId) {
		document.getElementById("drivers").removeChild(document.getElementById(orderId));
	}
</script>