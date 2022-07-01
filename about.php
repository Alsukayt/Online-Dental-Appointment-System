<?php session_start();
if(isset($_SESSION['ID_doctor']))
header('location: doctor/index.php');
if(isset($_SESSION['ID_admin']))
header('location: admin/index.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="HomePage.css">
    <meta charset="UTF-8">
    <title>Title</title>
     <script src="https://kit.fontawesome.com/ec292494c9.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.css" />
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"  crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightslider/1.1.6/css/lightslider.css">
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>

<body class="container">

<?php  include('navbar.php'); ?>
 

<div class="First_Part">

 
    <img class="Fsvg" src="undraw_medicine.svg" c>

<section class="Title">

        <h1>To Make Patient Life Better</h1>

         <p>Provide a link between Patient and all dental clinic in the area
         </p>

</section>





    <!--sign in button-->
    <?php 
        if(isset($_SESSION['userid'])){?>
            <a href="logout.php"><button class="sign1_button" onclick="document.getElementById('id01').style.display='block'" >Logout</button></a>
    <?php }else{?>
            <a href="login.php"><button class="sign1_button" onclick="document.getElementById('id01').style.display='block'" >Sign Up & Login</button></a>
    <?php }?>

 
<br>
    <br>
  

    <script>
        // Get the modal
        let modal = document.getElementById('id02');

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>-->

    <!--<section class="Sign_up">
        <form action="" method="post">

            <input type="text" placeholder="Email" id="email">
            <input type="password" placeholder="Password" id="password">
            <br>
            <br>
            <input type="submit" value="Sign up" class="sign_button" >

        </form>
    </section>-->


</div>

<!--second part-->

<!--<img  class="Doctor_Second" src="Doctor-rafiki.svg">-->
<div class="second_part">
<section class="cards" id="services">
    <h2 class="titleS">Services</h2>
    <div class="content">
        <div class="cardS">
            <div class="icon">
                <i class="fa-solid fa-house-chimney"></i>
            </div>
            <div class="info">
                <h3>Make an appointment at home</h3>
                <p>Book a faster appointment</p>
            </div>
        </div>
        <div class="cardS">
            <div class="icon">
                <i class="fa-brands fa-searchengin"></i>
            </div>
            <div class="info">
                <h3>Search for all dental clinic in the area</h3>
                <p>all dental clinic in the area in your hand</p>
            </div>
        </div>
        <div class="cardS">
            <div class="icon">
                <i class="fas fa-edit"></i>
            </div>
            <div class="info">
                <h3>Customer can see people's opinions</h3>
                <p>Opinions about the doctor, and his evaluation, and number of years of experience.</p>
            </div>
        </div>
        <div class="cardS">
            <div class="icon">
                <i class="fa-solid fa-globe"></i>
            </div>
            <div class="info">
                <h3>communicate with the doctor</h3>
                <p>The patient can communicate with the doctor from home</p>
            </div>
        </div>
    </div>
</section>
</div>





<!--
&lt;!&ndash;card1&ndash;&gt;
<div class="Second_part">
    <a href="card1.html" class="link" >
 <div class="card" >
     <img src="undraw_doctor.svg" style="width: 100%">
     <h1>Mohammed Alsukayt</h1>
     <p class="Dr_title">Dentist Specialized in Periodontics</p>
     <p>Qassim University</p>
     <div style="margin: 24px 0">
         <a href="#" class="Dr_link"><i class="fa fa-twitter"></i></a>
         <a href="#" class="Dr_link"><i class="fa fa-linkedin"></i></a>
         <a href="#" class="Dr_link"><i class="fa fa-facebook"></i></a>

     </div>
     <p><button class="Dr_button">Book an appointment</button></p>
 </div>
    </a>
&lt;!&ndash;card2&ndash;&gt;
    <a href="card2.html" class="link">
<div class="card" style="margin-top: 110px">
    <img src="undraw_doctor.svg" style="width: 100%">
    <h1>Ryan Alzabin</h1>
    <p class="Dr_title">Specialized in Pediatric Dentistry</p>
    <p>Qassim University </p>
    <div style="margin: 24px 0">
        <a href="#" class="Dr_link"><i class="fa fa-twitter"></i></a>
        <a href="#" class="Dr_link"><i class="fa fa-linkedin"></i></a>
        <a href="#" class="Dr_link"><i class="fa fa-facebook"></i></a>


    </div>
    <p><button class="Dr_button">Book an appointment</button></p>

</div>
    </a>
    <br>
    &lt;!&ndash;card3&ndash;&gt;
    <div class="card3">
        <img src="undraw_doctor.svg" style="width: 100%">
        <h1>Saleh ahmed</h1>
        <p class="Dr_title">Specialized in Implantology</p>
        <p>Qassim University</p>
        <div style="margin: 24px 0">
            <a href="#" class="Dr_link"><i class="fa fa-twitter"></i></a>
            <a href="#" class="Dr_link"><i class="fa fa-linkedin"></i></a>
            <a href="#" class="Dr_link"><i class="fa fa-facebook"></i></a>


        </div>
        <p><button class="Dr_button">Book an appointment</button></p>

</div>

    &lt;!&ndash;card4&ndash;&gt;
    <div class="card4">
        <img src="undraw_doctor.svg" style="width: 100%">
        <h1>Ali Yousif</h1>
        <p class="Dr_title">Specialized in Prosthodontics,</p>
        <p>Qassim University</p>
        <div style="margin: 24px 0">
            <a href="#" class="Dr_link"><i class="fa fa-twitter"></i></a>
            <a href="#" class="Dr_link"><i class="fa fa-linkedin"></i></a>
            <a href="#" class="Dr_link"><i class="fa fa-facebook"></i></a>


        </div>
        <p><button class="Dr_button">Book an appointment</button></p>

    </div>
</div>-->
<br>
<br>
<!--third part-->

<!--
<div class="Contact_container">
    <h3>Contact Form</h3>
    <form action="/action_page.php">
        <br>
        <label>Email</label>

        <input class="contact" type="text" id="fname" name="firstname" placeholder="Your name..">

        <label > Name</label>
        <input class="contact" type="text" id="lname" name="lastname" placeholder="Your last name..">

        <label >City</label>
        <select  class="contact" id="City" name="City"  >
            <option></option>
            <option value="Buraydah">Buraydah</option>
            <option value="Albukayriyah">Albukayriyah</option>
            <option value="Unaizah">Unaizah</option>
        </select>

        <label >Subject</label>
        <textarea class="contact" id="subject" name="subject" placeholder="Write something.." style="height:200px"></textarea>

        <input class="contact" id="submit" type="submit" value="Submit">
    </form>
</div>-->


<!--footer-->


<?php print_r($_SESSION); include('footer.php');
 ?>
</body>
</html>