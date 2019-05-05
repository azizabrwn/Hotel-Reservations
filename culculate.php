<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Culculate</title>
</head>
<body>
<?php
//Culculate total price of the user's stay

$priceOfStay = new Culculation();

class Culculation
{
    //Properties

    //Amount of days
    public $dateTime1 = new DateTime($_SESSION['check-in']);
    public $dateTime2 = new DateTime($_SESSION['check-out']);
    public $interval = $this->dateTime1 ->diff($this->dateTime2);
    public $daysBooked = $this->interval ->format('%R%a');
    public $hotelName = $_SESSION['hotels'];
    // Placeholder for cost of booking
    public $value; 

    //Methods
    
    public function culculateRate()
    {
        switch($hotelName){
            case 'The Dodgy Door' :
            return $this->value = $this->daysBooked * 50;
            break;
            case 'Cauliflower Cottage' :
                $this->value = $this ->daysBooked * 500;
                break;
                case 'Mystery Mansions' :
                $this ->value = $this->daysBooked * 1000;
                break;
                default:
                echo "Invalid booking";
        }
    }

}
//insert into database
if(isset($_POST["submit"]))
        {
        $firstname = $_SESSION['firstname'];
        $lastname = $_SESSION['lastname'];
        $hotel = $_SESSION['hotels'];
        $checkin = $_SESSION['check-in'];
        $checkout = $_SESSION['check-out'];
    
        $query = "INSERT INTO Bookings.Reservations(firstname, lastname,hotel,checkin,checkout)
        VALUES ($firstname,$lastname,$hotel,$checkin,$checkout)";
        if(mysqli_query($conn, $query))
        {
            echo "<script>alert('Inserted successfully');</script>";
        } else
        {
          echo "<script>alert('Failed to insert')</script>";  
        } 
        };
        //Prepare and bind:
    /*if(isset($_POST["submit2"]))
    { 
    $sql = $stmt = $conn->prepare("INSERT INTO Bookings.Reservations(firstname, lastname,hotel,checkin,checkout)
    VALUES (?,?,?,?,?)");
    $stmt->bind_param("sssii",  $firstname, $lastname, $hotel, $checkin, $checkout);

    //Set parameters and execute
    $firstname = $_SESSION['firstname'];
    $lastname = $_SESSION['lastname'];
    $hotel = $_SESSION['hotels'];
    $checkin = $_SESSION['check-in'];
    $checkout = $_SESSION['check-out'];
    $stmt ->execute();
    };
    if($conn->query($sql)===TRUE){
        echo "insertion a success";
    } else {
        echo "Error creating table :" .$conn->error;
    }
    */
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>