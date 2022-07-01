<?php
    session_start();
    include 'connect.php';
    include 'functions.php';
    if(isset($_SESSION['user'])){
        header('Location: index.php');
    }
    if(isset($_SESSION['ID_admin'])){
        header('Location: admin/index.php');
    }
    if(isset($_SESSION['ID_doctor'])){
        header('Location: doctor/index.php');
    }
    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        if(isset($_POST['login'])){

            $email = $_POST['email'];
            $pass = $_POST['password'];
            $hashedPass = sha1($pass);
            $stmt = $con->prepare("SELECT
                                        *
                                    FROM
                                        patient
                                    WHERE
                                        email = ?
                                    AND
                                        `password` = ?");
            $stmt->execute(array($email, $hashedPass));

            $get = $stmt->fetch();

            $check = $stmt->rowCount();

            if($check > 0){
                $_SESSION['email'] = $email; // Register Session Name
                $_SESSION['user'] = $get['firstName']; // Register Session Name
                $_SESSION['userid'] = $get['userId']; // Register Session Name
                $type = $get['isAdmin'];
if( $type==1){
    $_SESSION['ID_admin'] = $get['userId']; 
  
header('Location: admin/index.php');
}
else if( $type==2){
    $_SESSION['ID_doctor'] = $get['userId'];   
header('Location: doctor/index.php');
}else if( $type==0){
    
             header('Location: index.php');
                exit();
}
            }
        }else{
            
            $formErrors = array();

            $firstname   = $_POST['firstname'];
            $lastname   = $_POST['lastname'];
            $email      = $_POST['email'];
            $password   = $_POST['password'];
            $password2  = $_POST['confirmpassword'];
            $address  = $_POST['address'];
            $phone  = $_POST['phone'];
            
            if(isset($firstname)){

                $filterUser = filter_var($firstname, FILTER_SANITIZE_STRING);

                if(strlen($filterUser) < 4){

                    $formErrors [] = 'first name Must Be Lager Than 4 Characters';

                }

            }

            if(isset($lastname)){

                $filterUser = filter_var($lastname, FILTER_SANITIZE_STRING);

                if(strlen($filterUser) < 5){

                    $formErrors [] = 'last name Must Be Lager Than 5 Characters';

                }

            }

            if(isset($password) && isset($password2)){

                if(empty($password)){

                    $formErrors[] = 'Sorry Password Cant Be Empty ';

                }

                if(sha1($password) !== sha1($password2)){

                    $formErrors[] = 'Sorry Password Is Not Match';

                }

            }

            if(isset($email)){

                $filterEmail = filter_var($email, FILTER_SANITIZE_EMAIL);

                if(filter_var($filterEmail, FILTER_VALIDATE_EMAIL) != true){

                    $formErrors[] = 'Sorry This Email Is Not Valid';

                }

            }
            if(isset($address)){

                $filterUser = filter_var($address, FILTER_SANITIZE_STRING);

                if(strlen($filterUser) < 5){

                    $formErrors [] = 'address Must Be Lager Than 5 Characters';

                }

            }
            if(isset($phone)){

                $filterUser = filter_var($phone, FILTER_SANITIZE_STRING);

                if(strlen($filterUser) < 5){

                    $formErrors [] = 'Phone Must Be Lager Than 5 Characters';

                }

            }

            if(empty($formErrors)){

                    // Insert Userinfo Into Database

                    $stmt = $con->prepare("INSERT INTO 
                                                patient(email, `password`, firstName, lastName, `address`, `phoneNum`)
                                            VALUES(:zemail, :zpass, :zfirst, :zlast, :zaddress, :zphone)");
                    $stmt->execute(array(
                        'zemail'  => $email,
                        'zpass'  => sha1($password),
                        'zfirst'  => $firstname,
                        'zlast'  =>  $lastname,
                        'zaddress'  =>  $address,
                        'zphone'  =>  $phone
                    ));

                    //Echo Success Message

                    $successMas = 'Congerat You Are Now Regestiret User';                    

            

            }

        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="SignUPandLogIn.css">
</head>
<body>
<div>
    <section>
        <div class="form">
            <ul class="tabs">
                <li class="active" data-cont=".log-in">log in</li>
                <li data-cont=".sign-up">sign up</li>
            </ul>
            <div class="content">

                <form class="log-in" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                    <label >Email</label>
                    <input type="email" name="email" required>
                    <label for="password">Password</label>
                    <input type="password" name="password" required>
                    <div class="btns">
                        <a href="#" class="option-btn">forget password ?</a>
                        <input type="submit" class="btn" name="login" value="LOG IN">
                    </div>
                </form>

                <form class="sign-up" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">

                    <!-- accept name contains 3 and more char -->
                    <label >First Name <abbr title="This field is required" aria-label="required">*</abbr></label>
                    <input type="text" name="firstname" minlength="3" required>

                    <!-- required -->
                    <label >Last name <abbr title="This field is required" aria-label="required">*</abbr></label>
                    <input type="text" name="lastname" required>

                    <!-- required -->
                    <label >Email <abbr title="This field is required" aria-label="required">*</abbr> </label>
                    <input type="email" name="email" id="mail" required>

                    <!-- has pattern -->
                    <label for="password">Password <abbr title="This field is required" aria-label="required">*</abbr></label>
                    <input type="password" name="password"  required>

                    <!-- matches password -->
                    <label for="confirmpassword">confirm password <abbr title="This field is required" aria-label="required">*</abbr></label>
                    <input type="password" name="confirmpassword"  required>
                    <!-- matches password -->
                    <label for="address">address <abbr title="This field is required" aria-label="required">*</abbr></label>
                    <input type="text" name="address" id="address" required>
                    <!-- matches password -->
                    <label for="phone">phone Number <abbr title="This field is required" aria-label="required">*</abbr></label>
                    <input type="text" name="phone" id="phone" required>

                    <div class="btns">
                        <input type="submit" id="sign-up" name="signup" class="btn" value="Sign Up">
                    </div>
                </form>
            </div>
        </div>
        <div class="the-errors text-center">
            <?php  
            
                if(!empty($formErrors)){

                    foreach($formErrors as $error){

                        echo "<div class='masg error'>" . $error . "</div>";

                    }

                }

                if(isset($successMas)){

                    echo "<div class='masg success'>" . $successMas . "</div>";

                }

            ?>
        </div>
    </section>


    <script src="main.js"></script>

<script>

    let tabs = document.querySelectorAll(".tabs li");
    let tabsArr = Array.from(tabs);
    let divs = document.querySelectorAll(".content > form");
    let divsArr = Array.from(divs);

    tabsArr.forEach((el) => {
        el.addEventListener("click", function (e) {
            tabsArr.forEach((el) => {
                el.classList.remove("active");
            });
            e.currentTarget.classList.add("active");
            divsArr.forEach((div) => {
                div.style.display = "none";
            });
            document.querySelector(e.currentTarget.dataset.cont).style.display = 'block';
        });
    });


    // form validation

    const email = document.getElementById("mail");

    email.addEventListener("input", function () {
        if (email.validity.typeMismatch) {
            email.setCustomValidity("I am expecting an e-mail address!");
            email.reportValidity();
        } else {
            email.setCustomValidity("");
        }
    });


    let password = document.getElementById("password");
    let passPattern = /^[A-Za-z]\w{7,14}$/;

    password.oninput = () => {
        if (!password.value.match(passPattern)) {
            password.setCustomValidity(`- between 6 to 20 characters
        - at least one numeric digit,
        - at least one uppercase letter
        - at least one lowercase letter`);
            password.reportValidity();
        } else {
            password.setCustomValidity("");
        }
    }

    let confPass = document.getElementById("confirmpassword");

    confPass.oninput = () => {
        if(!confPass.value.match(password.value)){
            confPass.setCustomValidity("confirmed password must match passwored!");
            confPass.reportValidity();
        }else {
            confPass.setCustomValidity("");
        }
    }

</script>
</div>

</body>
</html>