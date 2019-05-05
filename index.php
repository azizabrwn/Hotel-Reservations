<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel="stylesheet" href="style.css">
<title>Hotel Booking</title>
</head>
<body>

<form method = "POST" action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>">
<label for="booking" required>Book</label> <br> <br>
Name:<input type=" text" id="booking" name="firstname" class="form-control"  required> <br>
Last Name:<input type=" text" id="booking" name="lastname" class="form-control"  required> <br>
Hotel:
<select name="hotels" required>
<option value="The Dodgy Door">The Dodgy Door</option>
<option value="Cauliflower Cottage">Cauliflower Cottage</option>
<option value="Mystery Mansions">Mystery Mansions</option> 
</select> <br> <br>
<label for="check-in">Check In:</label> <br>
<input type="date" id="check-in" name="check-in"
       value="2019-05-10"
       min="2019-05-10" max="2019-12-10"> <br>

<label for="check-out">Check Out</label> <br>
       <input type="date" id="check-out" name="check-out"
       value="2019-06-10"
       min="2019-06-10" max="2019-12-10">


<input type="submit" id="booking" name="submit" class="form-control"> <br> <br>
</form>

<?php
//Display user input to user


if(isset($_POST['submit'])){
$_SESSION['firstname'] = $_POST['firstname'];
$_SESSION['lastname'] = $_POST['lastname'];
$_SESSION['hotels'] = $_POST["hotels"];
$_SESSION['check-in'] = $_POST['check-in'];
$_SESSION['check-out'] = $_POST['check-out'];

echo "Hi , ".$_SESSION['firstname']." ". $_SESSION['lastname']."<br>"."You booked from ".$_SESSION['check-in']." to ".$_SESSION['check-out']." at ".$_SESSION['hotels']."<br>";
echo  "<button type='submit' name='submit2'>Confirm</button>";
};





?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>