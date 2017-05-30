<?php
session_start();
include("includes/db.conn.php");
include("includes/conf.class.php");
include("language.php");
include("includes/ajaxprocess.class.php");
$pos2 = strpos($_SERVER['HTTP_REFERER'],$_SERVER['SERVER_NAME']);
if(!$pos2){
	header('Location: booking-failure.php?error_code=9');
}
include("includes/details.class.php");
$bsibooking = new bsiBookingDetails();
$bsiCore->clearExpiredBookings();
?>
<?php
$con = mysqli_connect("localhost","root","","info");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>
<?=$bsiCore->config['conf_hotel_name']?>
</title>
<link rel="stylesheet" href="css/style.css" type="text/css" media="screen"/>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>

<script type="text/javascript">
	$().ready(function() {
		$("#form1").validate();
    });        
</script>
<script type="text/javascript">
$(document).ready(function(){
	$('#btn_exisitng_cust').click(function() {
	    $('#exist_wait').html("<img src='images/ajax-loader.gif' border='0'>")
		var querystr = 'actioncode=2&existing_email='+$('#email_addr_existing').val(); 
		$.post("ajaxreq-processor.php", querystr, function(data){ 						 
			if(data.errorcode == 0){
				$('#title').html(data.title)
				$('#fname').val(data.first_name)
				$('#lname').val(data.surname)
				$('#str_addr').val(data.street_addr)
				$('#city').val(data.city)
				$('#state').val(data.province)
				$('#zipcode').val(data.zip)
				$('#country').val(data.country)
				$('#phone').val(data.phone)
				$('#fax').val(data.fax)
				$('#email').val(data.email)
				$('#exist_wait').html("")
			}else { 
				alert(data.strmsg);
				$('#fname').val('')
				$('#lname').val('')
				$('#str_addr').val('')
				$('#city').val('')
				$('#state').val('')
				$('#zipcode').val('')
				$('#country').val('')
				$('#phone').val('')
				$('#fax').val('')
				$('#email').val('')
				$('#exist_wait').html("")
			}	
		}, "json");
	});
});
function myPopup2(booking_id){
		var width = 730;
		var height = 650;
		var left = (screen.width - width)/2;
		var top = (screen.height - height)/2;
		var url='terms-and-services.php?bid='+booking_id;
		var params = 'width='+width+', height='+height;
		params += ', top='+top+', left='+left;
		params += ', directories=no';
		params += ', location=no';
		params += ', menubar=no';
		params += ', resizable=no';
		params += ', scrollbars=yes';
		params += ', status=no';
		params += ', toolbar=no';
		newwin=window.open(url,'Chat', params);
		if (window.focus) {newwin.focus()}
		return false;
   }
</script>
</head>

<body>
<div id="content" align="center">
 <h1>
  <?=$bsiCore->config['conf_hotel_name']?>
 </h1>
 <?php $bookingDetails = $bsibooking->generateBookingDetails(); ?>
 <div id="wrapper" style="width:600px !important;">
  <h2 align="left" style="padding-left:5px;"><?=BOOKING_DETAILS_TEXT?></h2>
  <hr color="#e1dada"  style="margin-top:3px;"/>
  <br />
  <table cellpadding="4" cellspacing="1" border="0" width="100%" bgcolor="#FFFFFF" style="font-size:13px;">
   <tr>
    <td bgcolor="#f2f2f2" align="center"><strong><?=CHECKIN_DATE_TEXT?></strong></td>
    <td bgcolor="#f2f2f2" align="center"><strong><?=CHECKOUT_DATE_TEXT?></strong></td>
    <td bgcolor="#f2f2f2" align="center"><strong><?=TOTAL_NIGHT_TEXT?></strong></td>
    <td bgcolor="#f2f2f2" align="center"><strong><?=TOTAL_ROOMS_TEXT?></strong></td>
   </tr>
   <tr>
    <td align="center" bgcolor="#f5f9f9"><?=$bsibooking->checkInDate?></td>
    <td align="center" bgcolor="#f5f9f9"><?=$bsibooking->checkOutDate?></td>
    <td align="center" bgcolor="#f5f9f9"><?=$bsibooking->nightCount?></td>
    <td align="center" bgcolor="#f5f9f9"><?=$bsibooking->totalRoomCount?></td>
   </tr>
   <tr>
    <td bgcolor="#f2f2f2" align="center"><strong><?=NUMBER_OF_ROOM_TEXT?></strong></td>
    <td bgcolor="#f2f2f2" align="center"><strong><?=ROOM_TYPE_TEXT?></strong></td>
    <td bgcolor="#f2f2f2" align="center"><strong><?=MAXI_OCCUPENCY_TEXT?></strong></td>
   </tr>
   <?php		
		foreach($bookingDetails as $bookings){		
			echo '<tr>';
			echo '<td align="center" bgcolor="#f5f9f9">'.$bookings['roomno'].'</td>';
			echo '<td align="center" bgcolor="#f5f9f9">'.$bookings['roomtype'].' ('.$bookings['capacitytitle'].')</td>';				
			echo '<td align="center" bgcolor="#f5f9f9">'.$bookings['capacity'].' Adult</td>';
				
			echo '<td align="right" bgcolor="#f5f9f9" style="padding-right:5px;">'.'</td>';
			echo '</tr>';		
		}
	 ?>
  </table>
 </div> 
 <html>
<head>
<meta charset="utf-8">
<title>Registration</title>
<link rel="stylesheet" href="css1/style.css" />
</head>
<body>
<?php
require('db.php');
// If form submitted, insert values into the database.
if (isset($_REQUEST['first_name'])){
        // removes backslashes
	$first_name = stripslashes($_REQUEST['first_name']);
        //escapes special characters in a string
	$first_name = mysqli_real_escape_string($con,$first_name); 
	$surname = stripslashes($_REQUEST['surname']);
	$surname = mysqli_real_escape_string($con,$surname);
	$title = stripslashes($_REQUEST['title']);
	$title = mysqli_real_escape_string($con,$title);
	$street_addr = stripslashes($_REQUEST['street_addr']);
	$street_addr = mysqli_real_escape_string($con,$street_addr);
	$city = stripslashes($_REQUEST['city']);
	$city = mysqli_real_escape_string($con,$city);
	$province = stripslashes($_REQUEST['province']);
	$province = mysqli_real_escape_string($con,$province);
	$zip = stripslashes($_REQUEST['zip']);
	$zip = mysqli_real_escape_string($con,$zip);
	$country = stripslashes($_REQUEST['country']);
	$country = mysqli_real_escape_string($con,$country);
	$phone = stripslashes($_REQUEST['phone']);
	$phone = mysqli_real_escape_string($con,$phone);
	$fax = stripslashes($_REQUEST['fax']);
	$fax = mysqli_real_escape_string($con,$fax);
	$email = stripslashes($_REQUEST['email']);
	$email = mysqli_real_escape_string($con,$email);
	$additional_comments = stripslashes($_REQUEST['additional_comments']);
	$additional_comments = mysqli_real_escape_string($con,$additional_comments);
	$ip = stripslashes($_REQUEST['ip']);
	$ip = mysqli_real_escape_string($con,$ip);
        $query = "INSERT into `bsi_clients` (first_name,surname,title,street_addr,city, province,zip,country,phone,fax, email, additional_comments, ip)
VALUES ('$first_name','$surname', '$title' , '$street_addr' , '$city' ,'$province','$zip', '$country' , '$phone' ,'$fax',  '$email', '$additional_comments' , '$ip')";
        $result = mysqli_query($con,$query);
        if($result){
            echo "<div class='form'>
			<br>
<h3>You are registered successfully.</h3>";
        }
    }else{
?>
<div class="form">
<h1>Registration</h1>
<form name="registration" action="" method="post">
<input type="text" name="first_name" placeholder="first_name" required />
<input type="text" name="surname" placeholder="surname" required />
<input type="text" name="title" placeholder="title" required />
<input type="text" name="street_addr" placeholder="street_addr" required />
<input type="text" name="city" placeholder="city" required />
<input type="text" name="province" placeholder="province" required />
<input type="text" name="zip" placeholder="zip" required />
<input type="text" name="country" placeholder="country" required />
<input type="text" name="phone" placeholder="phone" required />
<input type="text" name="fax" placeholder="fax" required />
<input type="email" name="email" placeholder="email" required />
<input type="text" name="additional_comments" placeholder="additional_comments" required />
<input type="text" name="ip" placeholder="ip" required />
<input type="submit" name="submit" value="Register" />
</form>
</div>
<?php } ?>
</body>
</html>
</div>
</body>
</html>
