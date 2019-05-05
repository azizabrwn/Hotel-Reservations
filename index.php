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
    "Your Hotel: ".$_SESSION["hotels"] . "<br>"."From ".$_SESSION['check-in']." to ".$_SESSION['check-out']." <br> <br> ";

    //Create second button that sends the displayed info to database
    echo"<form method=\"POST\" action=\"#\">";
    echo "<button type=\"submit\" name=\"confirm\">Confirm</button>";
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
<title>Hotel Booking</title>
</head>
<body>

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
       min="2019-05-11" max="2019-12-10">


<input type="submit" id="booking" name="submit" class="form-control"> <br> <br>
</form>



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>