<?php
session_start();
 include 'connect.php';
 include 'functions.php';
 if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if($_POST['do']=="update"){
        $id = $_POST["id"];

 
   
    $stmt = $con->prepare("UPDATE appointment SET 
                                  accepted=2
                           WHERE appointmentId = ?");
   $stmt->execute(array(  $id));
}
else if ($_POST['do']=="profile"){
     $userid        = $_POST['userid'];
     $firstname     = $_POST['firstname'];
     $lastname      = $_POST['lastname'];
     $email      = $_POST['email'];
     $phone      = $_POST['phone'];
     $gender      = $_POST['gender'];
     $pirthDate      = $_POST['pirthdate'];
     $stmt = $con->prepare("UPDATE patient SET 
                                    email = ?,
                                    firstName = ?,
                                    lastName = ?,
                                    phoneNum = ?,
                                    gender = ?,
                                    pirh_date = ?
                            WHERE userId = ?");
    $stmt->execute(array($email, $firstname, $lastname, $phone, $gender, $pirthDate, $userid));}
 }
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
<body>
<style>

    body {
        background-image: url('Mass Circles.svg');
    }
        .Appointment{
            width: 100%;
      
            /*  border: 2px solid red;*/
        margin-top: 50px;
            height: 300px;
            text-align: center;
        }
        .table{
            /* border: 1px solid black;
             border-collapse: collapse;
            width: 700px;
            margin-right: 500px;
            background-color: #fdfdfd;*/
            border-collapse: collapse;
            width: 100%;
            background-color: white;
            color: black;
        }
        .table th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        .table tr:hover {
            background-color: #675EF3;
            color: white;}

        .Appointment h1{
            text-align: center;
        }
    </style>

<?php  include('navbar.php'); 
$stmt = $con->prepare("SELECT * FROM patient WHERE userId = ?");
$stmt->execute(array($_SESSION['userid']));
$row = $stmt->fetch();
?>
<h1></h1><br><br>
<div class="Profile_card" style="width: 50%; margin: 50px auto;" >
<div class="profile_form" align="center">

    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" >
    <input type="hidden" name="do" value="profile">
        <div class="header_form">
            <h1>Profile</h1>

        </div>

        <div class="form-body">

            <!-- Firstname and Lastname -->
            <div class="horizontal-group">
                <div class="form-group left">
                    <input type="hidden" name="userid" value="<?php echo $row['userId'] ?>" id="">
                    <label for="firstname" class="label-title">First name *</label>
                    <br>
                    
                    <input type="text" id="firstname" name="firstname" value="<?php echo $row['firstName']?>" class="form-input" placeholder="enter your first name" />
                </div>
                <div class="form-group right">
                    <label for="lastname" class="label-title">Last name</label>
                    <br>
                    <input type="text" id="lastname" name="lastname" value="<?php echo $row['lastName']?>" class="form-input" placeholder="enter your last name" />
                </div>
             </div>

            <!-- Email -->
            <div class="form-group">
                <label  class="label-title">Email*</label>
                <br>
                <input type="email" id="email-form" name="email" value="<?php echo $row['email']?>" class="form-input" placeholder="enter your email" >
            </div>

            <!-- Mobile -->
            <div class="horizontal-group">
                <div class="form-group left">
                    <label class="label-title">Mobile *</label>
                    <br>
                    <input type="text" id="mobile" name="phone" value="<?php echo $row['phoneNum']?>" class="form-input" placeholder="enter your mobile" >
                </div>
            </div>

            <!-- Gender-->
            <center></center>
            <div class="horizontal-group">
                <div class="form-group  ">
                    <label class="label-title">Gender:</label>
                    <div class=" ">
                        <label for="male"><input type="radio" name="gender" value="male" id="male" <?php if($row['gender']=='male')  echo 'checked' ?>> Male</label>
                        <br>
                        <label for="female"><input type="radio" name="gender" value="female" id="female" <?php if($row['gender']=='female')  echo 'checked' ?> > Female</label>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label  class="label-title">Birth of Date *</label>
                <br>
                <input type="date" id="date" name="pirthdate" class="form-input" value="<?php echo $row['pirh_date']?>" >
            </div>


        </div>
        <input class="btn-form" type="submit" value="Save" >
    </form>
</div>

    <!--condation if there is left only 2 hours patient cant cancel the appoitment line 165 , 208-->
</div> <?php $stmt = $con->prepare("SELECT a.*,p.firstName,p.lastName,d.firstName as dn ,d.lastName as dl ,TIMESTAMPDIFF(HOUR,now(),date) as diff   FROM `appointment` a join patient p on p.userId=a.userId join patient d on d.userId=a.doctorId where a.userId =  ".$_SESSION['userid']);

$stmt->execute( );
$rows = $stmt->fetchAll();
 ?><div class="table-responsive">

    <div class="Appointment">
    <h1>My Appointment</h1>

    <table class="table" border="1" style="width: 95%; margin: auto;  ">
    <thead>
<tr>
  
    <th>Doctor name</th>
   
    <th>Date</th>
    <th>Time</th>
    <th>status</th>
    <th>Update</th>

</tr>
    </thead>
    <tbody>


    <!--all the patient appontment will shows here-->
<?php foreach ($rows as $row) {?>
    <tr>
        <form action="" method="post">
<input type="hidden" name="do" value="update">

<input type="hidden" name="id" value="<?php echo $row['appointmentId'] ?>">
 
 
    <td> <?php echo $row['dn'] ?> <?php echo $row['dl'] ?></td>
  
 
<td><?php echo date('Y-m-d', strtotime($row['date'])) ?></td>

<td> <?php echo date('H:i:s A', strtotime($row['date'])) ?>
    </td>       
 
   <td><?php if($row['accepted']==0) echo 'in hold';else if($row['accepted']==1) echo 'approved';else if($row['accepted']==2 )echo "denied" ?></td>
   
   
    <td>
    <?php if($row['diff']>2){?>

 
    <button type="submit"  >Cancel</button></td>       <?php }    ?>
 </form>
 
</tr>
    <?php } ?>
    </tbody>
  </table></div>

</div>

<!--footer-->






<?php include('footer.php'); ?>


</body>
</html>