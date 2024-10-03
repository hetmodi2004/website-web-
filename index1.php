<?php 
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Decoration Management System</title>
    <link rel="stylesheet" href="./index.css">
</head>

<body>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    
    <div class="navbar">
        <h3 style="color:black; margin-left: 1050px; font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;font-size: 30px;">
            HM DECORATION
        </h3>
        <a class="active" href="./index.php"><i class="fa fa-fw fa-home"></i> HOME</a>
        <a href="./about.php"><i class="fa fa-fw fa-search"></i> ABOUT US </a>
        <a href="./package.php"><i class="fa fa-fw fa-folder-open"></i> SERVICE </a>
        <a href="./contact.php"><i class="fa fa-phone"></i> CONTACT US </a>
        <a href="./come.php"><i class="fa fa-book"></i> UPCOMING EVENTS</a>
    </div>

    <div style="margin-left:50px;">
        <p style="font-size:25px;color:black;">Welcome, <?php echo htmlspecialchars($username); ?>!</p>
    </div>
    
    <div style="margin-left:1200px;">
    <a href="logout.php" class="fa fa-sign-out" style="font-size:20px"><br/>SIGN OUT</a> 
</div>


    <header>
        <h1 id="t1" style="font-family:initial;margin-top: -10px;">Let us do the beauty designs,<br>that you never seen before.</h1>
        <a href="./package.php" style="justify-content:left;display:flex;margin-top:30px; color: brown;font-family: cursive;font-size:25px;margin-left:45px;">
            BOOK SERVICE
        </a>
    </header>
    
    <div>
        <img id="img1" src="./imgs/img1.jpeg" alt="Decoration Image">
    </div>

    <div>
       <u><h3 id="t2" style="color:red;font-family:initial;font-size:x-large;">WELCOME TO DECORATION COMPANY</h3></u> 
        <p id="t3" style="font-size:50px;font-family: cursive">Let's make you Beautiful than ever</p>
        <h3 id="t3">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live
            the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language
            ocean. A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a
            paradisematic country, in which roasted parts of sentences fly into your mouth. Even the all-powerful
            Pointing has no control about the blind texts it is an almost unorthographic life. One day however a small
            line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar. The Big Oxmox
            advised her not to do so, and created a situation that would put her into the center of attention.</h3>
    </div>
</body>

</html>
