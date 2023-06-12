<?php
session_start();
?>
<?php
$current_page = 'about';
?>
<html>
<head>
    <title>About page</title>
    <link rel="stylesheet" type="text/css" href="indexS.css">
	<link rel="stylesheet" type="text/css" href="topnavS.css">
	<link rel="stylesheet" type="text/css" href="footerS.css">
	    <?php if ($theme === 'dark'): ?>
        <link rel="stylesheet" type="text/css" href="dark-theme.css">
    	<?php endif; ?>
    <style>
        body {
            background-color: #f7edf4;
        }
    </style>

<style>
  .carousel-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    overflow: hidden;
 }

  .carousel-inner {
    display: flex;
    align-items: center;
    max-width: 100%;
    width: 800px;
    margin: 0 auto;
    overflow: hidden;
  }

  .carousel-item {
    flex: 0 0 100%;
    opacity: 0;
    transition: opacity 0.6s ease-in-out;
  }

  .carousel-item.active {
    opacity: 1;
  }

  .carousel-item-next,
  .carousel-item-prev {
    position: absolute;
    top: 0;
    width: 100%;
  }

  .carousel-control-prev,
  .carousel-control-next {
    z-index: 1;
  }

.carousel-control-prev-icon,
.carousel-control-next-icon {
  background-color: #8d96ff;
}

.carousel-control-prev,
.carousel-control-next {
  color: #8d96ff;
}

.play-button {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 80px;
  height: 80px;
  /* background-color: rgba(0, 0, 0, 0.5); */
  border-radius: 50%;
  cursor: pointer;
 
}

.play-button::before {
  content: '\f144'; 
  font-family: 'Font Awesome 5 Free';
  font-weight: 900;
  font-size: 36px;
  color: #ffffff;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
} 
	.container {
      max-width: 800px;
      margin: 0 auto;
      padding: 20px;
    }

</style>
	<script src="https://kit.fontawesome.com/8988d285da.js" crossorigin="anonymous"></script>
	<title>About Page</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

	
	<link rel="stylesheet" type="text/css" href="topnavS.css">
	<link rel="stylesheet" type="text/css" href="indexS.css">

</head>
	<div class="topnav">
	<a href="home.php" class="search_logo" style="background-color: transparent; ">    
<img src="stack-removebg-preview.png" width="250" height="auto" ></a>
    <a class="<?php if ($current_page == 'home') {echo 'active';} ?>" href="home.php">Home</a>
    <a class="<?php if ($current_page == 'about') {echo 'active';} ?>" href="index.php">About</a>
    <a class="<?php if ($current_page == 'profile') {echo 'active';} ?>" href="profile.php">My Profile</a>
    <a href="logout.php">Log Out</a>
    <form action="search.php" method="get" style="float:right;">
        <input type="text" name="query" placeholder="Search..."><br>
        <!-- <button type="submit" style="margin-right:80px;">Search</button> -->
    </form>
</div>
	
<body>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>


	<div class="container">
		<br>
		<br>
    <h1>About This Page</h1>
    
    <p style="text-align: center;">
      Welcome to <span class="gradient">Stack Paraflow!</span> Here's a brief explanation of what this page is about and how it works.
    </p>
    
    <h2>What is This Page About?</h2>
    
    <p>
      This page is designed to provide assistance and information on various topics. It aims to be a helpful resource for users seeking answers, explanations, examples, and guidance.
    </p>
    
    <h2>How Does It Work?</h2>
    
    <p>
      The page operates as community based platform to help users on various topics on programming and also to help with errors and debugging of code. You can also use our search bar and use keywords to find similar questions or answers that you need.
    </p>
    
    <h2>Features</h2>
    
    <p>
      Here are some key features of this page:
    </p>
    
    <ul>
      <li>Provides answers and explanations on a wide range of topics.</li>
      <li>Offers code examples and programming assistance.</li>
      <li>Supports natural language queries and conversations.</li>
      <li>Can assist with general knowledge questions and research.</li>
      <li>Continuously learning and improving its knowledge base.</li>
    </ul>
    
    <p>
      We hope you find this page helpful and informative. If you have any further questions or need assistance, feel free to ask!
    </p>
		  <p>
			  In the next section there is a simple tutorial on how to use the page.
		  </p>
  </div>
<div class="carousel-container">
  <div id="carouselExampleIndicators" class="carousel slide">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2" class="active" aria-current="true"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item">
        <img src="questionsec2.png" class="d-block w-100" alt="First Slide">
      </div>
      <div class="carousel-item active">
        <img src="answersec1.png" class="d-block w-100" alt="Second Slide">
      </div>
      <div class="carousel-item">
		  <div class="video-container">
		  <video class="d-block w-100" controls>
        	<source src="siteusevid.mp4" type="video/mp4" class="d-block w-100" alt="Third Slide">
		  </video>
			<div class="play-button">
  <i class="fas fa-play"></i>
</div>

		</div>
		</div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
</div>
	<br>
<footer>
    <div class="footer-container">
        <div class="footer-section">
            <h3>About</h3>
            <p>An academic project.</p>
        </div>
        <div class="footer-section">
            <h3>Quick Links</h3>
            <ul>
                <li><a href="https://webstuff.run-eu-central1.goorm.site/my_repo/home.php">Home</a></li>
                <li><a href="https://webstuff.run-eu-central1.goorm.site/my_repo/index.php">About</a></li>
                <li><a href="https://webstuff.run-eu-central1.goorm.site/my_repo/profile.php">My profile</a></li>
                <li><a href="#">Services</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </div>
        <div class="footer-section">
            <h3>Contact</h3>
            <p>123 Street, City</p>
            <p>Email: info@example.com</p>
            <p>Phone: 123-456-7890</p>
        </div>
    </div>
</footer>
</body>
	<script>
  const playButton = document.querySelector('.play-button');

  playButton.addEventListener('click', function() {
    playButton.style.display = 'none';
  });
</script>

</html>
