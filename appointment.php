<?php
session_start();
 include 'connect.php';
 include 'functions.php';

 if($_SERVER['REQUEST_METHOD'] == 'POST'){

 }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="HomePage.css">
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>
<?php  include('navbar.php'); ?>



<!--card1-->

<!--
function will search on the appointment page with data
first will check if he a doctor then will search for a match with first or last name
if there is no match all doctors will show up
-->
<div class="Second_part" style="height: 100%;">
    
    
    <?php
    if(isset($_GET['search']))
    $rows = getAllTable('*', "patient  where  isAdmin = 2 and ( firstName like '%".$_GET['search']."%' or lastName like '%".$_GET['search']."%' ) ", '', '', 'userId', 'ASC');
    else
    $rows = getAllTable('*', 'patient where isAdmin = 2', '', '', 'userId', 'ASC');
        foreach($rows as $row){
    ?>

<!--this is the card for all doctors each time admin add one the same code will be used
 and the information will change 
 -->
            
    <a href="card.php?doctorid=<?php echo $row['userId']?>" class="link" >

        <div class="card" >
            <img src="undraw_doctor.svg" style="width: 100%">
            <h1><?php echo $row['firstName'] ?> <?php echo $row['lastName'] ?></h1>
            <p class="Dr_title"><?php echo $row['bio'] ?></p>
            <p class="Dr_title"><?php echo $row['Specialization'] ?></p>
            <p><?php echo $row['University'] ?></p>
            <div style="margin: 24px 0">
                <a href="#" class="Dr_link"><i class="fa fa-twitter"></i></a>
                <a href="#" class="Dr_link"><i class="fa fa-linkedin"></i></a>
                <a href="#" class="Dr_link"><i class="fa fa-facebook"></i></a>

            </div>
            <p ><a style="background-color: blue;color: white;" href="card.php?doctorid=<?php echo $row['userId']?>" class="Dr_button">Book an appointment</a></p>
        </div>
    </a>
    <?php }?>
  
    
</div>

 


<footer class="footer-distributed">

    <div class="footer-left">

        <h3 style="color: red">Yake<span>System</span></h3>

        <p class="footer-links">
            <a href="HomePage.html">Home</a>
            ·
            <a href="Appointment.html">Appointment</a>
            ·
            <a href="patient.html">Patient</a>
            ·
            <a href="#">About</a>
            ·
            <a href="#">Contact</a>
        </p>



        <?php
        require_once 'connect.php';
$stmt = $con->prepare("SELECT * FROM settings ");
$stmt->execute( );
$row = $stmt->fetch();
?>
        <div class="footer-icons">

            <a href="<?php echo $row['facebook']?>"><i class="fa fa-facebook"></i></a>
            <a href="<?php echo $row['twiter']?>"><i class="fa fa-twitter"></i></a>
            <a href="<?php echo $row['in_']?>"><i class="fa fa-linkedin"></i></a>
            <a href="<?php echo $row['git']?>"><i class="fa fa-github"></i></a>

        </div>

    </div>

    <div class="footer-right">

        <p>Contact Us</p>

        <form action="#" method="post">

            <input type="text" name="email" placeholder="Email">
            <textarea name="message" placeholder="Message"></textarea>
            <button>Send</button>

        </form>

    </div>
<style>
    .footer-distributed{
        position: relative;
    }
</style>
</footer>

</body>
</html>