<!DOCTYPE html>
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