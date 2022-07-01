<?php
include 'connect.php';

$stmt = $con->prepare("SELECT * FROM settings ");
$stmt->execute( );
$row = $stmt->fetch();
 if(isset($_POST['question'])){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
     $email = $_POST['email'];
     $message = $_POST['message'];
     $stmt = $con->prepare("INSERT INTO question(`date`, question, email)
                                        VALUES(now(), :zquestion, :zemail)");
    $stmt->execute(array('zquestion' => $message, 'zemail' => $email));
    }
 }

?>

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

        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">

            <input type="email" name="email" placeholder="Email">
            <textarea name="message" placeholder="Message"></textarea>
            <input type="submit" name="question" value="Send">

        </form>

    </div>
    <script src="https://unpkg.com/swiper/swiper-bundle.js"></script>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
 <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"  crossorigin="anonymous"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" crossorigin="anonymous"></script>
   <style>
       .footer-distributed{
           position: relative;
       }
   </style>
</footer>