<?php session_start() ?>
<!DOCTYPE html>
<?php
$username = "root";
$password = "root";
$servername = "localhost";
$database="Bookings";

$conn = new mysqli($servername, $username, $password,$database);

if(isset($_POST['submit'])){ //If the submit button is pressed, execute the following function:
    
    //User input is stored into session variables.
    $_SESSION['firstname'] = $_POST['firstname'];
    $_SESSION['lastname'] = $_POST['lastname'];
    $_SESSION['hotels'] = $_POST["hotels"];
    $_SESSION['check-in'] = $_POST['check-in'];
    $_SESSION['check-out'] = $_POST['check-out']; 

    //Culculate number of days at which hotel, for how much
    $dateTime1 = new DateTime($_SESSION['check-in']);
    $dateTime2 = new DateTime($_SESSION['check-out']);
    $interval = $dateTime1 ->diff($dateTime2);
    $daysBooked = $interval ->format('%R%a');
    //place holder for cost of booking
    $value;
    $dailyRate;

    switch($_SESSION['hotels']){
        case "The Dodgy Door" :
        $value = $daysBooked * 200;
        $dailyRate = 200;
        break;
        case "Cauliflower Cottage" :
        $value = $daysBooked * 500;
        $dailyRate = 500;
        break;
        case "Mystery Mansions" :
        $value = $daysBooked * 1000;
        $dailyRate = 1000;
    }


    //Display the user input before sending to database
    echo "Hi , ".$_SESSION['firstname']." ". $_SESSION['lastname']."<br>".
    "Your Hotel: ".$_SESSION["hotels"] . "<br>"."From ".$_SESSION['check-in']." to ".$_SESSION['check-out']." <br> ".
    "Daily rate: R".$dailyRate."<br>".
    "Your rate for ".$daysBooked ." days: R".$value."<br>"; 

    //Create second button that sends the displayed info to database
    echo"<br>"."<form method=\"POST\" action=\"#\">";
    echo "<button class=\"btn2\" type=\"submit\" name=\"confirm\">Confirm</button>";
    echo "</form> <br> <br>";

  

    if(isset($_POST["submit"])) //If the second button is clicked, execute the following function
    //Prepare and bind to prevent duplicates:
    {
    $stmt = $conn->prepare("INSERT INTO Bookings.Reservations(firstname, lastname,hotel,checkin,checkout)
    VALUES (?,?,?,?,?)");
    $stmt->bind_param("sssii",  $firstname, $lastname, $hotel, $checkin, $checkout);

    //Set parameters and execute
    $firstname = $_SESSION['firstname'];
    $lastname = $_SESSION['lastname'];
    $hotel = $_SESSION['hotels'];
    $checkin = $_SESSION['check-in'];
    $checkout = $_SESSION['check-out'];
    $stmt ->execute();
    }

    
}   
?>


<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
<link href="https://fonts.googleapis.com/css?family=PT+Serif  " rel="stylesheet">
<link rel="stylesheet"  type="text/css" href="main.css"> 
<title>Hotel Booking</title>
</head>
<body>
<div class="parallax"> 
  <div class=" p-2">
<div class="dropdown text-center">
  <h1>Welcome to Cape Town!</h1>
  <button class="dropbtn">Choose your hotel</button>
  <div class =" dropdown-content">
    <a href="#theDodgyDoor">The Dodgy Door (Budget Beater )</a>
    <a href="#cauliflower_cottage">Cauliflower Cottage (Affordable )</a>
    <a href="#mystery_mansions">Mystery Mansions ( Luxury )</a>
    <a href = "#book">Go straight to booking</a>
  </div>
</div>
</div>
</div>


<div class="parallax"></div>  
<div class="container">
    <div id="theDodgyDoor">
  <div class="row">
    <div class="col">
      <h3>The Dodgy Door Hotel</h3>
      <img src="img/hotel1.jpg" alt="The Dodgy Door" width="350" height="345">
      <p>A front view of The Dodgy Door Hotel</p>
    </div>
    <div class="col">
      <h3>Information</h3>
      <p>This hotel is great for those who don't earn enough to go on holiday, but want to anyway. It offers first class sea views,
          the soothing sound of pigeons (they nest in the roof) and bed bugs.   </p>
      <p>Price per night: R200 <br>
         Utilties: Bed, Mirror, Basin in room.</p> <br>
         <button><a href="#book">Book!</a></button>
    </div>
  </div>
</div>
</div>
<button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>
<div class="parallax"></div>
<div class="container">
    <div id="cauliflower_cottage">
  <div class="row">
    <div class="col">
      <h3>Cauliflower Cottage</h3>
      <img src="img/hotel2.jpg" alt="The Cauliflower Cottage" width="350" height="345">
      <p>A front view of Cauliflower Cottage</p>
    </div>
    <div class="col">
      <h3>Information</h3>
      <p>This cottage is ideal for those pretentious or depressed enough to want to leave the city behind.
          The aura here is so serene you can't help but sigh and say the only french word you know, bonjour, as it turns all your worries into cigarette smoke. </p>
      <p>Price per night: R500 <br>
         Utilties: Bed, couch, coffee table, ash-tray, croissants for breakfast.</p>
         <button><a href="#book">Book!</a></button>
  </div>
</div>
</div>
</div>

<div class="parallax"></div>
<div class="container">
    <div id="mystery_mansions">
  <div class="row">
    <div class="col">
      <h3>Mystery Mansions</h3>
      <img src="img/hotel3.jpg" alt="Mystery Mansions" width="350" height="345">
      <p>A front view of Mystery Mansions</p>
    </div>
    <div class="col">
      <h3>Information</h3>
      <p>This hotel has creaking floorboards, shadows that talk and a surprise behind every corner... .</p>
      <p>Price per night: R1000 <br>
         Utilties: Bed, couch, coffee table, en-suite bathroom and a large mirror to watch what's behind you...</p>  
         <button><a href="#book">Book!</a></button>           
</div>
</div>
</div>
</div>
<div class="parallax"></div> 
<div class="container">
<div id="book">
  <div class="row">
    <div class="col">
    <div>
    <h1>Book Your Stay!</h1>
<form method = "POST" action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>">
<label for="booking" required></label> <br> <br>
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
       value="2019-05-10"
       min="2019-05-11" max="2019-12-10"> <br> <br>


<br><input type="submit" id="booking" name="submit" class="form-control"> <br> <br>
</form>
<div>

</div>
</div>
</div>
</div>



<script>
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
document.getElementById("myBtn").style.display = "block";
} else {
document.getElementById("myBtn").style.display = "none";
}
}
function topFunction() {
document.body.scrollTop = 0; 
document.documentElement.scrollTop = 0; 
} </script>



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>