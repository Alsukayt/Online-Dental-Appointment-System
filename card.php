<?php
session_start();
include 'connect.php';
 include 'functions.php';

 if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['rating'])){
        if(isset($_SESSION['userid'])){
            $rating = $_POST['rate'];
            $doctorid = $_POST['doctorid'];
            $userid = $_SESSION['userid'];

            $stmt = $con->prepare("INSERT INTO 
                                        rating(rating, userid , doctorid)
                                    VALUES(:zrating, :zuserid, :zdoctorid)");
            $stmt->execute(array(
                'zrating'  => $rating,
                'zuserid'  => $userid,
                'zdoctorid'  => $doctorid
            ));
        }else{
            header('location: login.php');
        }

        /*after the patient select an appointment the function prepare will check if the patient have appointment on the same day
         if not the appointment will insert on the table and the massage will appears  appointment saved
        */

    }elseif(isset($_POST['book'])){
        if(isset($_SESSION['userid'])){
            $doctorid = $_POST['doctorid'];
            $date = $_POST['date'];
            $username = $_SESSION['user'];
            $userid = $_SESSION['userid'];
           
            $stmt = $con ->prepare("SELECT * from appointment where userId = ".$userid." and DATE_FORMAT(date,'%Y-%m-%d') = '".date('Y-m-d', strtotime($date))."'");
        
	 	$stmt->execute();

	 	$count = $stmt->rowCount();
        if($count==0){
    $stmt = $con->prepare("INSERT INTO 
                                        appointment(patientName, `date`, doctorId, userId)
                                        VALUES(:zusername, :zdate, :zdoctorid, :zuserid)");
            $stmt->execute(array(
                'zusername'      => $username,
                'zdate'     => $date,
                'zdoctorid'       => $doctorid,
                'zuserid'     => $userid
            ));
            $message = " Appointment saved";}
        else{
                $message = " You have Appointment this day ";
            }
        }else{
            header('location: login.php');
        }
    }elseif(isset($_POST['comm'])){
        if(isset($_SESSION['userid'])){
            $doctorid = $_POST['doctorid'];
            $message = $_POST['message'];
            $username = $_SESSION['user'];
            $userid = $_SESSION['userid'];
            $stmt = $con->prepare("INSERT INTO 
                                        comment(comment, patientName, `date`, patientId, doctorId)
                                        VALUES(:zcomment, :zusername, now(), :zuserid, :zdoctorid)");
            $stmt->execute(array(
                'zcomment'      => $message,
                'zusername'     => $username,
                'zuserid'       => $userid,
                'zdoctorid'     => $doctorid
            ));
            $message = " comment saved";
        }else{
            header('location: login.php');
        }
    }
    elseif(isset($_POST['question'])){
         $email = $_POST['email'];
         $message = $_POST['message'];
         $stmt = $con->prepare("INSERT INTO question(`date`, question, email)
                                            VALUES(now(), :zquestion, :zemail)");
        $stmt->execute(array('zquestion' => $message, 'zemail' => $email));
     }
 }
?>
<?php
$doctorid = isset($_GET['doctorid']) && is_numeric($_GET['doctorid']) ? intval($_GET['doctorid']) : 0;

$stmt = $con->prepare("SELECT * FROM patient WHERE userId = ?");
$stmt->execute(array($doctorid));
$doctor = $stmt->fetch();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="HomePage.css">
     <script src="https://kit.fontawesome.com/ec292494c9.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.css" />
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"  crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightslider/1.1.6/css/lightslider.css">
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="css/mobiscroll.javascript.min.css" rel="stylesheet" />
    <script src="js/mobiscroll.javascript.min.js"></script>
    <style>
        body {
            background-image: url('Mass Circles.svg');
        }
    </style>
</head>
<script>
    var url = 'https://wati-integration-service.clare.ai/ShopifyWidget/shopifyWidget.js?44776';
    var s = document.createElement('script');
    s.type = 'text/javascript';
    s.async = true;
    s.src = url;
    var options = {
        "enabled":true,
        "chatButtonSetting":{
            "backgroundColor":"#4dc247",
            "ctaText":"",
            "borderRadius":"25",
            "marginLeft":"0",
            "marginBottom":"50",
            "marginRight":"50",
            "position":"right"
        },
        "brandSetting":{
            "brandName":"Yake",
            "brandSubTitle":"Typically replies within a day",
            "brandImg":"https://cdn.clare.ai/wati/images/WATI_logo_square_2.png",
            "welcomeText":"Hi there!\nI am doctor <?php echo $doctor['firstName'].' '.$doctor['lastName']?>\nHow can I help you?",
            "messageText":"Hello, I have a question about (write your question here )",
            "backgroundColor":"#0a5f54",
            "ctaText":"Start Chat",
            "borderRadius":"20",
            "autoShow":true,
            "phoneNumber":"<?php echo $doctor['whatsapp']?>"
        }
    };
    s.onload = function() {
        CreateWhatsappChatWidget(options);
    };
    var x = document.getElementsByTagName('script')[0];
    x.parentNode.insertBefore(s, x);
</script>
<body>
<?php  include('navbar.php'); ?>
<?php if (isset($message)) {

echo "	<script>
alert('$message');
window.location='card.php?doctorid=".$_GET['doctorid']."'
</script>";
}

?>
<div class="Doctor_pagef">

    <img class="Doctor_profile" src="Doctor-rafiki.svg">

  <div class="Doctor_textf">
      <h1><?php echo $doctor['firstName'].' '.$doctor['lastName'] ?></h1>
      <!--<p class="Dr_title"><?php /*echo $row['Specialization'] */?></p>-->
      <h2><?php echo $doctor['bio'] ?></h2>
      <h3><?php echo $doctor['University'] ?></h3>
  </div>

  <form class="form-rating" action="<?php echo $_SERVER['PHP_SELF'] ?>?doctorid=<?php echo $doctor['userId']?>" method="POST">
  <input type="hidden" name="doctorid" value="<?php echo $doctor['userId']?>">
    <div class="rate">
        <h3>User Rating:</h3>    
            <input type="radio" id="star5" name="rate" value="5" />
            <label for="star5" title="text">5 stars</label>
            <input type="radio" id="star4" name="rate" value="4" />
            <label for="star4" title="text">4 stars</label>
            <input type="radio" id="star3" name="rate" value="3" />
            <label for="star3" title="text">3 stars</label>
            <input type="radio" id="star2" name="rate" value="2" />
            <label for="star2" title="text">2 stars</label>
            <input type="radio" id="star1" name="rate" value="1" />
            <label for="star1" title="text">1 star</label>
    </div>
    <input type="submit" class="btn mt-5" name="rating" value="Rating">
    <?php  
        $where = "where doctorid =" .$doctor['userId'];
        
        if(countRating($where)!= 0 && sumRating($where)!=0){
            $total = sumRating($where) / countRating($where);?>
            <h2 style="margin-left: 300px" class="sum-rating"><?php echo sprintf('%.2f', $total) ?>% Rating</h2>
        <?php }
        else{
            echo '<h2  style="margin-left: 300px" class="sum-rating">0% Rating </h2>';
        }
    ?>
    
    </form>
    


    <div class="divider">
        
    </div>

    <!--Appointment start here-->

    <div class="Appointment_list">

      

        <div class="Appointment_card" >
            <div class="icon">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-alarm" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <circle cx="12" cy="13" r="7" />
                    <polyline points="12 10 12 13 14 13" />
                    <line x1="7" y1="4" x2="4.25" y2="6" />
                    <line x1="17" y1="4" x2="19.75" y2="6" />
                </svg>
            </div>
            <h1>Appointment Details</h1>
            <p class="Dr_title">Payment <?php echo $doctor['price']?> $</p><br>
         <a href="<?php echo $doctor['map_link']?>" target="_blank" rel="noopener noreferrer"><i class="fas fa-map-marker"></i></a>   
            <p>Qassim Clinic</p>
            <a  class="zoom" href="<?php echo $doctor['zoom']?>" target="_blank">Join me in zoom for consultation</a>
            <div style="margin: 24px 0">


               <!--patient select appoitnment fron here then send it to php-->
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>?doctorid=<?php echo $doctor['userId']?>" method="POST">
                    <input type="hidden" name="doctorid" value="<?php echo $doctor['userId'] ?>">
                    <input class="Appointment_input" type="datetime-local" step=1 name="date" id="datefield" max="2030-08-26">

                    <p><button name="book" class="Dr_button">Book an appointment</button></p>
                </form>
            </div>
            
        </div>


    </div>

    <!--function that patient cant select before current day-->
<script>
let dateInput = document.getElementById("datefield");
dateInput.min = new Date().toISOString().split(".")[0];
</script>


    <!--Patient  Comments-->
<br>
    <div class="Doctor_pageS">

        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-message-2" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
            <path d="M12 20l-3 -3h-2a3 3 0 0 1 -3 -3v-6a3 3 0 0 1 3 -3h10a3 3 0 0 1 3 3v6a3 3 0 0 1 -3 3h-2l-3 3" />
            <line x1="8" y1="9" x2="16" y2="9" />
            <line x1="8" y1="13" x2="14" y2="13" />
        </svg>

        <h1>Patient  Comments</h1>




            <div class="footer-right">

                <p>Your comment:</p>

                <form action="<?php echo $_SERVER['PHP_SELF'] ?>?doctorid=<?php echo $doctor['userId']?>" method="POST">
                    <input type="hidden" name="doctorid" value="<?php echo $doctor['userId'] ?>">
                    <textarea name="message" placeholder="Message"></textarea>
                    <input type="submit" name="comm" value="Send">
                </form>
                
            </div>


        <!--all comment appears here , this function will take all comment of doctor and show it here -->
            <div class="commint-show" style="border: 2px solid black;">
        <?php
            $rows = getAllTable('c.*', 'comment c join patient p on p.userId = c.doctorId ', 'where userId = "'.$doctor['userId'] .'" and approve = 1 ', '', 'commentId', 'ASC');
            foreach($rows as $row){
        ?>
                <div class="commints" style="border: 1px dotted grey">
                    <h2 style="text-align: left;">Patient <?php echo $row['patientName'] ?></h2>
                    <h5 style="text-align: left;">Posted on <?php echo $row['date'] ?></h5>
                    <p style="text-align: left;padding: 10px;" ><?php echo $row['comment'] ?></p>
                </div>
        <?php } ?>
    </div>
    </div>
 





<footer class="footer-distributed">

    <div class="footer-left">

        <h3>Yake<span>System</span></h3>

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

        <form action="<?php echo $_SERVER['PHP_SELF'] ?>?doctorid=<?php echo $_GET['doctorid']?>" method="POST">

            <input type="email" name="email" placeholder="Email">
            <textarea name="message" placeholder="Message"></textarea>
            <input type="submit" name="question" value="Send">

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