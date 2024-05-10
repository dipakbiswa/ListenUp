<?php 
    include 'dbcon.php';

?>
<!DOCTYPE html>
<html  >
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="generator" content="ListenUp v5.8.4, ListenUp.com">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <link rel="shortcut icon" href="assets2/images/logo.png" type="image/x-icon">
  <meta name="description" content="ListenUp | Listener">
  
  
  <title>ListenUp | Listener</title>
  <link rel="stylesheet" href="assets2/web/assets2/mobirise-icons2/mobirise2.css">
  <link rel="stylesheet" href="assets2/web/assets2/mobirise-icons/mobirise-icons.css">
  <link rel="stylesheet" href="assets2/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets2/bootstrap/css/bootstrap-grid.min.css">
  <link rel="stylesheet" href="assets2/bootstrap/css/bootstrap-reboot.min.css">
  <link rel="stylesheet" href="assets2/dropdown/css/style.css">
  <link rel="stylesheet" href="assets2/socicon/css/styles.css">
  <link rel="stylesheet" href="assets2/theme/css/style.css">
  <link rel="preload" href="https://fonts.googleapis.com/css?family=Jost:100,200,300,400,500,600,700,800,900,100i,200i,300i,400i,500i,600i,700i,800i,900i&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
  <noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Jost:100,200,300,400,500,600,700,800,900,100i,200i,300i,400i,500i,600i,700i,800i,900i&display=swap"></noscript>
  <link rel="preload" as="style" href="assets2/mobirise/css/mbr-additional.css"><link rel="stylesheet" href="assets2/mobirise/css/mbr-additional.css" type="text/css">

  
  
  
</head>
<body>
  
  <section data-bs-version="5.1" class="menu menu2 cid-tIJFaJiacD" once="menu" id="menu2-0">
    
    <nav class="navbar navbar-dropdown navbar-fixed-top navbar-expand-lg">
        <div class="container">
            <div class="navbar-brand">
                <span class="navbar-logo">
                    <a href="index.php">
                        <img src="assets2/images/logo.png" alt="Mobirise Website Builder" style="height: 3rem;">
                    </a>
                </span>
                <span class="navbar-caption-wrap"><a class="navbar-caption text-black display-7" href="index.php">ListenUp</a></span>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-bs-toggle="collapse" data-target="#navbarSupportedContent" data-bs-target="#navbarSupportedContent" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <div class="hamburger">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav nav-dropdown nav-right" data-app-modern-menu="true">
                    <li class="nav-item dropdown">
                        <a class="nav-link link text-black dropdown-toggle display-4" href="index.php" data-toggle="dropdown-submenu" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">Not a Listner</a><div class="dropdown-menu" aria-labelledby="dropdown-442"><a class="text-black dropdown-item display-4" href="artist.php"><span class="mobi-mbri mobi-mbri-login mbr-iconfont mbr-iconfont-btn"></span>I am an Artist</a><a class="text-black show dropdown-item display-4" href="advertiser.php"><span class="mobi-mbri mobi-mbri-user mbr-iconfont mbr-iconfont-btn"></span>I am an Advertiser</a></div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link link text-black dropdown-toggle display-4" href="index.php" data-toggle="dropdown-submenu" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">I am a Listner</a><div class="dropdown-menu" aria-labelledby="dropdown-442"><a class="text-black dropdown-item display-4" href="login.php"><span class="mobi-mbri mobi-mbri-login mbr-iconfont mbr-iconfont-btn"></span>Login</a><a class="text-black show dropdown-item display-4" href="signup.php"><span class="mobi-mbri mobi-mbri-user mbr-iconfont mbr-iconfont-btn"></span>Signup</a></div>
                    </li>
                </ul>
                
                
            </div>
        </div>
    </nav>
</section>

<section data-bs-version="5.1" class="header14 cid-tIJGwbI49P mbr-fullscreen" id="header14-3">

    

    
    

    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-12 col-md-6 image-wrapper">
                <img src="assets2/images/screely-1688192657085.png" alt="Mobirise Website Builder">
            </div>
            <div class="col-12 col-md">
                <div class="text-wrapper">
                    <h1 class="mbr-section-title mbr-fonts-style mb-3 display-2"><strong>Listen Audiobook That Keep Your Knowledge&nbsp;Up</strong></h1>
                    <p class="mbr-text mbr-fonts-style display-7">
                        Lifetime free plan, Listen book in English, Hindi and Bengali.</p>
                    <div class="mbr-section-btn mt-3"><a class="btn btn-success display-4" href="login.php">Login</a>
                        <a class="btn btn-black-outline display-4" href="signup.php">Create
                            account &gt;</a></div>
                </div>
            </div>
        </div>
    </div>
</section>

<section data-bs-version="5.1" class="slider4 mbr-embla cid-tIJMmJxZOt" id="slider4-6">
    
    
    <div class="position-relative text-center">
        <div class="mbr-section-head">
            <h4 class="mbr-section-title mbr-fonts-style align-center mb-0 display-2"><strong>Most popular Audiobooks</strong></h4>
            
        </div>
        <div class="embla mt-4" data-skip-snaps="true" data-align="center" data-contain-scroll="trimSnaps" data-auto-play-interval="5" data-draggable="true">
            <div class="embla__viewport container-fluid">
                <div class="embla__container">

                    <?php 
                    $fetch_audiobook_query = "select * from audiobook";
                    $fetch_audiobook_query_run = mysqli_query($conn, $fetch_audiobook_query);
                    while($row = mysqli_fetch_assoc($fetch_audiobook_query_run)){?>
                    <div class="embla__slide slider-image item" style="margin-left: 1rem; margin-right: 1rem;">
                        <div class="slide-content">
                            <div class="item-wrapper">
                                <div class="item-img">
                                    <img src="assets/banner/<?php echo $row['banner_name']; ?>">
                                </div>
                            </div>
                            <div class="item-content">
                                <h5 class="item-title mbr-fonts-style display-7"><strong><?php echo $row['title']; ?></strong></h5>
                                <h6 class="item-subtitle mbr-fonts-style mt-1 display-7">
                                    <em><?php echo $row['artist_name']; ?></em>
                                </h6>
                                
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <button class="embla__button embla__button--prev">
                <span class="mobi-mbri mobi-mbri-arrow-prev mbr-iconfont" aria-hidden="true"></span>
                <span class="sr-only visually-hidden visually-hidden">Previous</span>
            </button>
            <button class="embla__button embla__button--next">
                <span class="mobi-mbri mobi-mbri-arrow-next mbr-iconfont" aria-hidden="true"></span>
                <span class="sr-only visually-hidden visually-hidden">Next</span>
            </button>
        </div>
    </div>
</section>

<section data-bs-version="5.1" class="gallery5 mbr-gallery cid-tIJMJjK6f7" id="gallery5-7">
    

    
    

    <div class="container">
        <div class="mbr-section-head">
            <h3 class="mbr-section-title mbr-fonts-style align-center m-0 display-2"><strong>Looking for a genre?</strong></h3>
            <h4 class="mbr-section-subtitle mbr-fonts-style align-center mb-0 mt-2 display-5">Choose from thousands of audiobooks</h4>
        </div>
        <div class="row mbr-gallery mt-4">
            <?php 
            $fetch_category_query = "select * from category";
            $fetch_category_query_run = mysqli_query($conn, $fetch_category_query);
            while($row_category = mysqli_fetch_assoc($fetch_category_query_run)){?>
            <div class="col-12 col-md-6 col-lg-3 item gallery-image">
                <div class="item-wrapper" data-toggle="modal" data-bs-toggle="modal" data-target="#tILexrLAq2-modal" data-bs-target="#tILexrLAq2-modal">
                    <img class="w-100" src="assets/category_banner/<?php echo $row_category['image_name']; ?>" data-slide-to="0" data-bs-slide-to="0" data-target="#lb-tILexrLAq2" data-bs-target="#lb-tILexrLAq2">
                    <div class="icon-wrapper">
                        <span class="mobi-mbri mobi-mbri-search mbr-iconfont mbr-iconfont-btn"></span>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>



    </div>
</section>

<section data-bs-version="5.1" class="people5 mbr-embla cid-tIKbJBZwlr" id="people5-8">

    

    
    

    <div class="position-relative text-center">
        <h3 class="mb-4 mbr-fonts-style display-2">
            <strong>What Our Fantastic Users Say</strong>
        </h3>

        <div class="embla" data-skip-snaps="true" data-align="center" data-auto-play-interval="5" data-draggable="true">
            <div class="embla__viewport container-fluid">
                <div class="embla__container">
                    <div class="embla__slide slider-image item" style="margin-left: 7rem; margin-right: 7rem;">
                        <div class="user">
                            <div class="user_image">
                                <div class="item-wrapper position-relative">
                                    <img src="assets2/images/team3.jpg" alt="Mobirise Website Builder">
                                </div>
                            </div>
                            <div class="user_text mb-4">
                                <p class="mbr-fonts-style display-7">This site is brilliant! I’m a regular audiobook listener and can always find something quickly with just a few clicks.&nbsp;<br></p>
                            </div>
                            <div class="user_name mbr-fonts-style mb-2 display-7">
                                <strong>Alexa</strong>
                            </div>
                            
                        </div>
                    </div>
                    <div class="embla__slide slider-image item" style="margin-left: 7rem; margin-right: 7rem;">
                        <div class="user">
                            <div class="user_image">
                                <div class="item-wrapper position-relative">
                                    <img src="assets2/images/team2.jpg" alt="Mobirise Website Builder">
                                </div>
                            </div>
                            <div class="user_text mb-4">
                                <p class="mbr-fonts-style display-7">I love the clean and simple design. The site has great features too, like the online audio player and personal bookshelf.&nbsp;<br></p>
                            </div>
                            <div class="user_name mbr-fonts-style mb-2 display-7">
                                <strong>Linda</strong>
                            </div>
                            
                        </div>
                    </div>
                    <div class="embla__slide slider-image item" style="margin-left: 7rem; margin-right: 7rem;">
                        <div class="user">
                            <div class="user_image">
                                <div class="item-wrapper position-relative">
                                    <img src="assets2/images/team1.jpg" alt="Mobirise Website Builder">
                                </div>
                            </div>
                            <div class="user_text mb-4">
                                <p class="mbr-fonts-style display-7">As an English teacher it’s an excellent resource for my students. With thousands of free eBooks from numerous sources.&nbsp;<br></p>
                            </div>
                            <div class="user_name mbr-fonts-style mb-2 display-7">
                                <strong>Herbert</strong>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            <button class="embla__button embla__button--prev">
                <span class="mobi-mbri mobi-mbri-arrow-prev mbr-iconfont" aria-hidden="true"></span>
                <span class="sr-only visually-hidden visually-hidden">Previous</span>
            </button>
            <button class="embla__button embla__button--next">
                <span class="mobi-mbri mobi-mbri-arrow-next mbr-iconfont" aria-hidden="true"></span>
                <span class="sr-only visually-hidden visually-hidden">Next</span>
            </button>
        </div>
    </div>
</section>

<section data-bs-version="5.1" class="pricing2 cid-tIKkYcm8hy" id="pricing2-j">
    

    
    
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-6 align-center col-lg-4">
                <div class="plan">
                    <div class="plan-header">
                        <h6 class="plan-title mbr-fonts-style mb-3 display-5">
                            <strong>Free</strong></h6>
                        <div class="plan-price">
                            <p class="price mbr-fonts-style m-0 display-1">₹<strong>0</strong></p>
                            <p class="price-term mbr-fonts-style mb-3 display-7"><strong>Lifetime</strong></p>
                        </div>
                    </div>
                    <div class="plan-body">
                        <div class="plan-list mb-4">
                            <ul class="list-group mbr-fonts-style list-group-flush display-7">
                                <li class="list-group-item"><span style="background-color: transparent; font-size: 1.2rem;">Days: 365</span></li><li class="list-group-item"><span style="background-color: transparent; font-size: 1.2rem;">Ads Free: NO</span><br></li><li class="list-group-item"><span style="background-color: transparent; font-size: 1.2rem;">Premium Books: NO</span><br></li>
                            </ul>
                        </div>
                        <div class="mbr-section-btn text-center">
                            <a href="signup.php" class="btn btn-primary display-4">Get started</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 align-center col-lg-4">
                <div class="plan">
                    <div class="plan-header">
                        <h6 class="plan-title mbr-fonts-style mb-3 display-5">
                            <strong>Monthly</strong>
                        </h6>
                        <div class="plan-price">
                            <p class="price mbr-fonts-style m-0 display-1"><strong>₹199</strong><br></p>
                            <p class="price-term mbr-fonts-style mb-3 display-7"><strong>Per month</strong></p>
                        </div>
                    </div>
                    <div class="plan-body">
                        <div class="plan-list mb-4">
                            <ul class="list-group mbr-fonts-style list-group-flush display-7">
                                <li class="list-group-item"><span style="background-color: transparent; font-size: 1.2rem;">Days: 30</span></li><li class="list-group-item"><span style="background-color: transparent; font-size: 1.2rem;">Ads Free: YES</span></li><li class="list-group-item"><span style="background-color: transparent; font-size: 1.2rem;">Premium Books: YES</span></li>
                            </ul>
                        </div>
                        <div class="mbr-section-btn text-center">
                            <a href="signup.php" class="btn btn-primary display-4">Get started</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 align-center col-lg-4">
                <div class="plan">
                    <div class="plan-header">
                        <h6 class="plan-title mbr-fonts-style mb-3 display-5">
                            <strong>Yearly</strong>
                        </h6>
                        <div class="plan-price">
                            <p class="price mbr-fonts-style m-0 display-1"><strong>₹365</strong><br></p>
                            <p class="price-term mbr-fonts-style mb-3 display-7"><strong>Per year</strong></p>
                        </div>
                    </div>
                    <div class="plan-body">
                        <div class="plan-list mb-4">
                            <ul class="list-group mbr-fonts-style list-group-flush display-7">
                                <li class="list-group-item"><span style="background-color: transparent; font-size: 1.2rem;">Days: 365</span></li><li class="list-group-item"><span style="background-color: transparent; font-size: 1.2rem;">Ads Free: YES</span><br></li><li class="list-group-item"><span style="background-color: transparent; font-size: 1.2rem;">Premium Books: YES</span><br></li>
                            </ul>
                        </div>
                        <div class="mbr-section-btn text-center">
                            <a href="signup.php" class="btn btn-primary display-4">Get started</a>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</section>

<section data-bs-version="5.1" class="content17 cid-tIKcp8n3Sr" id="content17-a">

    

    
    
    
    <div class="container">
        
            <div class="row justify-content-center">
                <div class="col-12 col-md-10">
                    <div class="section-head align-center mb-4">
                        <h3 class="mbr-section-title mb-0 mbr-fonts-style display-2"><strong>Great reasons to use digital books</strong></h3>
                        
                    </div>
                    
                    <div id="bootstrap-toggle" class="toggle-panel accordionStyles tab-content">
                        <div class="card mb-3">
                            <div class="card-header" role="tab" id="headingOne">
                                <a role="button" class="collapsed panel-title text-black" data-toggle="collapse" data-bs-toggle="collapse" data-core="" href="#collapse1_6" aria-expanded="false" aria-controls="collapse1">
                                    <h6 class="panel-title-edit mbr-fonts-style mb-0 display-7"><strong>Convenience</strong></h6>
                                    <span class="sign mbr-iconfont mbri-arrow-down"></span>
                                </a>
                            </div>
                            <div id="collapse1_6" class="panel-collapse noScroll collapse" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body">
                                    <p class="mbr-fonts-style panel-text display-7">Listen anytime, anywhere, online or offline. Stream audio directly in your browser or download and play while disconnected.<br></p>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-header" role="tab" id="headingTwo">
                                <a role="button" class="collapsed panel-title text-black" data-toggle="collapse" data-bs-toggle="collapse" data-core="" href="#collapse2_6" aria-expanded="false" aria-controls="collapse2">
                                    <h6 class="panel-title-edit mbr-fonts-style mb-0 display-7"><strong>Mobile</strong>
                                </h6>
                                    <span class="sign mbr-iconfont mbri-arrow-down"></span>
                                </a>

                            </div>
                            <div id="collapse2_6" class="panel-collapse noScroll collapse" role="tabpanel" aria-labelledby="headingTwo">
                                <div class="panel-body">
                                    <p class="mbr-fonts-style panel-text display-7">Listen on your mobile, tablet, or desktop. Audio file formats are supported and played on all devices.<br></p>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-header" role="tab" id="headingThree">
                                <a role="button" class="collapsed panel-title text-black" data-toggle="collapse" data-bs-toggle="collapse" data-core="" href="#collapse3_6" aria-expanded="false" aria-controls="collapse3">
                                    <h6 class="panel-title-edit mbr-fonts-style mb-0 display-7"><strong>Education</strong></h6>
                                    <span class="sign mbr-iconfont mbri-arrow-down"></span>
                                </a>
                            </div>
                            <div id="collapse3_6" class="panel-collapse noScroll collapse" role="tabpanel" aria-labelledby="headingThree">
                                <div class="panel-body">
                                    <p class="mbr-fonts-style panel-text display-7">Learn by listening and become a proficient reader. Access native speakers to help you learn a language.<br></p>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-header" role="tab" id="headingThree">
                                <a role="button" class="collapsed panel-title text-black" data-toggle="collapse" data-bs-toggle="collapse" data-core="" href="#collapse4_6" aria-expanded="false" aria-controls="collapse4">
                                    <h6 class="panel-title-edit mbr-fonts-style mb-0 display-7"><strong>Learning English</strong></h6>
                                    <span class="sign mbr-iconfont mbri-arrow-down"></span>
                                </a>
                            </div>
                            <div id="collapse4_6" class="panel-collapse noScroll collapse" role="tabpanel" aria-labelledby="headingThree">
                                <div class="panel-body">
                                    <p class="mbr-fonts-style panel-text display-7">Improve your pronunciation, expand your vocabulary and better your listening skills in your target language (see Free Audio Books for English Learners).<br></p>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-header" role="tab" id="headingThree">
                                <a role="button" class="collapsed panel-title text-black" data-toggle="collapse" data-bs-toggle="collapse" data-core="" href="#collapse5_6" aria-expanded="false" aria-controls="collapse5">
                                   <h6 class="panel-title-edit mbr-fonts-style mb-0 display-7"><strong>Adaptable</strong></h6>
                                        <span class="mbr-iconfont mobi-mbri-arrow-down mobi-mbri"></span>
                                </a>
                            </div>
                            <div id="collapse5_6" class="panel-collapse noScroll collapse" role="tabpanel" aria-labelledby="headingThree">
                                <div class="panel-body">
                                    <p class="mbr-fonts-style panel-text display-7">Find a narrator you like, change the playback speed, and adjust the volume to create the perfect listening experience.<br></p>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-header" role="tab" id="headingThree">
                                <a role="button" class="collapsed panel-title text-black" data-toggle="collapse" data-bs-toggle="collapse" data-core="" href="#collapse6_6" aria-expanded="false" aria-controls="collapse6">
                                    <h6 class="panel-title-edit mbr-fonts-style mb-0 display-7"><strong>Sharing</strong></h6>
                                    <span class="mbr-iconfont mobi-mbri-arrow-down mobi-mbri"></span>
                                </a>
                            </div>
                            <div id="collapse6_6" class="panel-collapse noScroll collapse" role="tabpanel" aria-labelledby="headingThree">
                                <div class="panel-body">
                                    <p class="mbr-fonts-style panel-text display-7">Things are always better together. Share your favourite digital books and listen with friends and family.<br></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>

<section data-bs-version="5.1" class="footer5 cid-tIKdHgLB8M" once="footers" id="footer5-b">

    

    

    <div class="container">
        <div class="media-container-row">
            <div class="col-md-2 col-6">
                <div class="media-wrap">
                    <a href="advertiser.php">
                        <img src="assets2/images/logo.png" alt="Mobirise Website Builder">
                    </a>
                </div>
            </div>
            <div class="col-10 col-6">
                <p class="mbr-text align-right links mbr-fonts-style display-7">
                    <a href="#" class="text-black text-primary">About</a> &nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="advertiser.php" class="text-black">Become an Advertiser</a> &nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="artist.php" class="text-black text-primary">Become an Artist</a> &nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="#" class="text-black">Contact</a>
                </p>
            </div>
        </div>
        <!-- <div class="media-container-row">
            <div class="col-md-12"> -->
        <div class="footer-lower">
            <div class="media-container-row">
                <div class="col-md-12">
                    <hr>
                </div>
            </div>
            <div class="media-container-row">
                <div class="col-md-6 copyright">
                    <p class="mbr-text mbr-fonts-style display-7">
                        © Copyright 2023 ListenUp - All Rights Reserved
                    </p>
                </div>
                <div class="col-md-6">
                    <div class="social-list align-right">
                        <div class="soc-item">
                            <a href="#" target="_blank">
                                <span class="socicon-twitter socicon mbr-iconfont mbr-iconfont-social"></span>
                            </a>
                        </div>
                        <div class="soc-item">
                            <a href="#" target="_blank">
                                <span class="socicon-facebook socicon mbr-iconfont mbr-iconfont-social"></span>
                            </a>
                        </div>
                        <div class="soc-item">
                            <a href="#" target="_blank">
                                <span class="socicon-youtube socicon mbr-iconfont mbr-iconfont-social"></span>
                            </a>
                        </div>
                        <div class="soc-item">
                            <a href="#" target="_blank">
                                <span class="socicon-instagram socicon mbr-iconfont mbr-iconfont-social"></span>
                            </a>
                        </div>
                        <div class="soc-item">
                            <a href="#" target="_blank">
                                <span class="socicon-behance socicon mbr-iconfont mbr-iconfont-social"></span>
                            </a>
                        </div>
                        <div class="soc-item">
                            <a href="#" target="_blank">
                                <span class="socicon-vimeo socicon mbr-iconfont mbr-iconfont-social"></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- </div>
            </div> -->
        </div>

    </div>
</section>
<!-- <section class="display-7" style="padding: 0;align-items: center;justify-content: center;flex-wrap: wrap;    align-content: center;display: flex;position: relative;height: 4rem;">
    <a href="index.php/2993502" style="flex: 1 1;height: 4rem;position: absolute;width: 100%;z-index: 1;">
        <img alt="" style="height: 4rem;" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==">
    </a>
    <p style="margin: 0;text-align: center;" class="display-7">Made with &#8204;</p>
    <a style="z-index:1" href="https://mobirise.com/builder/no-code-website-builder.html">No Code Website Builder</a>
</section> -->




<script src="assets2/bootstrap/js/bootstrap.bundle.min.js"></script>  <script src="assets2/smoothscroll/smooth-scroll.js"></script>  <script src="assets2/ytplayer/index.js"></script>  <script src="assets2/dropdown/js/navbar-dropdown.js"></script>  <script src="assets2/embla/embla.min.js"></script>  <script src="assets2/embla/script.js"></script>  <script src="assets2/mbr-switch-arrow/mbr-switch-arrow.js"></script>  <script src="assets2/theme/js/script.js"></script>  
  
  
</body>
</html>