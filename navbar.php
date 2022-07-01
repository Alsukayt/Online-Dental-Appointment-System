<nav class="topnav">
    <a class="active" href="index.php">Home</a>
    <a href="appointment.php">Appointment</a>
    <?php
    if(isset($_SESSION['userid'])){
        echo '<a href="patient.php">Patient</a>';
    }
    ?>


    <!--search box will take the data to appointment.php -->
    <div class="search_container">
        <form action="appointment.php" method="GET">
            <input type="text" placeholder="Search.." name="search">
            <button class="search" type="submit"><i class="fa fa-search"></i> Search</button>
        </form>
    </div>

</nav>
