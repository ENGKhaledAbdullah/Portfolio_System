<?php
define("ROOT_PATH","/Portfolio_System/");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Portfolio-System</title>
    <!-- swiper css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />

    <!-- box icons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="./assets/fontawesome-v6.4.2/fontawesome-v6.4.2/css/all.min.css">
    <link rel="stylesheet" href="./assets/bootstrap-5.3.2-dist/bootstrap-5.3.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo ROOT_PATH;?>assets/css/main.css">
    <!-- <link rel="stylesheet" href="./assets/css/main.css"> -->
    <!-- <link rel="stylesheet" href="/assets/css/main.css"> -->

</head>
<body>
    <!-- header design -->
<header class="header">
    <a href="<?php echo ROOT_PATH;?>" class="logo">Pfolio</a>
    <form method="post" id="search-form" action="/Portfolio_System/partials/portfolio.php">
        <input class="form-control me-2" id="search-bar" type="search" name="username" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" id="btn-search" type="submit"><i class="bx bx-search"></i></button>
    </form>
    <nav class="navbar">
        
        <a href="#home" class="active">Home</a>
        <a href="#about">About</a>
        <!-- <a href="#services">Services</a> -->
        <!-- <a href="#portfolio">Portfolio</a> -->
        <a href="<?php echo ROOT_PATH;?>partials/register.php">Register</a>
        <a href="#contact">Contact Us</a>
    </nav>

    <div class="bx bx-moon" id="darkMode-icon"></div>

    <div class="bx bx-menu" id="menu-icon"></div>
</header>