<?php 
  include 'connectdb.php';

  $_SESSION["user_id"] = 1;

  include 'getinfo.php'
?>

<!DOCTYPE html>
<html>

<head>
	<title>Order</title>
	<link rel="stylesheet" href="css/order.css">
	<link rel="stylesheet" href="css/nav.css">
	<link rel="stylesheet" href="css/selectDriver.css">
</head>

<body>
	<?php
		include 'order.php';
		include 'getDriver.php';
	?>

	<div class="content">
		<div class="content-header">
			Preferred Drivers:
		</div>
		<div class="content-body">
			<?php
				if (count($preferredDrivers) == 0) {
					echo ("<div class='no-content'>Nothing to display :(</div>");
				} else {
					echo("<ul>");
					for ($i = 0; $i < count($preferredDrivers); ++$i) {
						echo("<li>
									<table>
										<tr>
											<td class='prof-pic'><img src='data:image/jpeg;base64," . base64_encode($preferredDrivers[$i]['picture']) . "'></td>
											<td class='driver-info'>
												<ul>
													<li class='driver-name'>" . $preferredDrivers[$i]['name'] . "</li>
													<li class='rating'>
														<span class='average-rating'>	&#9734 " . number_format($preferredDrivers[$i]['avgrate'], 1) . "</span>
														<span class='votes'>(" . $preferredDrivers[$i]['votes'] . " votes)</span>
													</li>
													<li class='choose'><input type='button' name='choose' id='choose' value='I CHOOSE YOU!' onclick='choose(" . $preferredDrivers[$i]['id'] . ");'><li>
												</ul>
											</td>
										</tr>
									</table>
									</li>");
					}
					echo("</ul>");
				}
			?>
		</div>
	</div>

	<div class="content">
		<div class="content-header">
			Other Drivers:
		</div>
		<div clas="content-body">
			<?php
				if (count($otherDrivers) == 0) {
					echo (
						"<div class='no-content'>Nothing to display :(</div>"
					);
				} else {
					echo("<ul>");
					for ($i = 0; $i < count($otherDrivers); ++$i) {
						echo("<li>
									<table>
										<tr>
											<td class='prof-pic'><img src='data:image/jpeg;base64," . base64_encode($otherDrivers[$i]['picture']) . "'></td>
											<td class='driver-info'>
												<ul>
													<li class='driver-name'>" . $otherDrivers[$i]['name'] . "</li>
													<li class='rating'>
														<span class='average-rating'>	&#9734 " . number_format($otherDrivers[$i]['avgrate'], 1) . "</span>
														<span class='votes'>(" . $otherDrivers[$i]['votes'] . " votes)</span>
													</li>
													<li><input type='button' class='choose' name='choose' id='choose' value='I CHOOSE YOU!' onclick='choose(" . $otherDrivers[$i]['id'] . ");'><li>
												</ul>
											</td>
										</tr>
									</table>
									</li>");
					}
					echo("</ul>");
				}
			?>
		</div>
	</div>

	<form id="form" action="/wbd/completeOrder.php" method="POST">
		<input type="hidden" name="pickup" id="pickup" value="<?php echo($pickingPoint);?>">
		<input type="hidden" name="destination" id="destination" value="<?php echo($destination);?>">
		<input type="hidden" name="driver" id="driver">
	</form>
	
</body>
</html>

<script>
	function choose(driverId) {
		document.getElementById("driver").value = driverId;
		document.getElementById("form").submit();
	}
</script>