<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
	// include 'admin/config/Connection.php';

	// $connection = Connection::database();

	// include 'admin/function/visitor.php';

	// insertIP();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">

	<link rel="apple-touch-icon" href="images/logo.png">
    <link rel="shortcut icon" href="images/logo.png">

	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Coda">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.1/css/lightbox.min.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/mobile.css">
	<title>Home</title>
</head>
<body>

	<div id="container">
		
	</div><!--end of container-->

	<div id="overlay">
		<div class="main-container">
			<a href="http://www.ginen.co.za" id="logo">
				<img src="images/logo.png" alt="logo">
			</a>

			<nav>
				<div class="bar-wrap">
					<div id="bar1" class="bar"></div>
					<div id="bar2" class="bar"></div>
					<div id="bar3" class="bar"></div>
				</div>

				<ul class="navbar">
					<li><a href="#">Home</a></li>
					<li><a href="#section-2">Services</a></li>
					<li><a href="#section-1">About</a></li>
					<li><a href="#section-3">Gallery</a></li>
					<li><a href="contact.php">Contact</a></li>
				</ul>
			</nav>
		</div>

		<h1 class="line anim-typewriter">Great innovation never ends.</h1>
	</div><!-- End overlay-->

	<div id="square-shape">
		<img src="images/triangle.png">
	</div><!-- End square-shape-->

	<section id="section-1">
		<h1>About Us</h1>
		<img class="underline" src="images/underline1.png">
		<h5>The glue that holds our relationship with our customers is trust.</h5>
		<div class="main-container">

			<div id="about-section1">
				<img src="images/1.png" width="100%">
			</div>


			<div id="about-section2">
				<p>GINEN is a registered company that was established in Gauteng, South Africa. 
				It is a private company specialized in electrical, information technology, 
				plumbing and piping practices. It has been founded in 2019 by a group of shareholders 
				with individual expertise, skills and competence in the following fields:</p>

				<ul>
					<li>Electrical</li>
					<li>Web Application</li>
					<li>Piping & Plumbing</li>
				</ul>

				<p>Electricity is the only thing that is fast enough to carry the messages that makes us who we are. 
					Without electricity we wouldn't have had internet, cars or even the modern industrialization.
				</p>
			</div>
		</div>
	</section>


	<section class="service">		
	
		<div id="first-part">

			<h1>Our Services</h1>
			<img class="underline" src="images/underline1.png">
			<h5>We are real and honest with our customers</h5>

			<div class="main-container">
				<ul>
					<li>
						<span class="fa fa-plug fa-3x"></span>
						<h3>Electrical</h3>
						<p>We specialize in installations of electrical equipment, switchgears, fittings, cables, distribution boxes, transformers, sub-stations and lightings. 
						</p>
						<a href="#" class="btn-purchase">Read more...</a>
					</li>
					<li>
						<span class="fa fa-laptop fa-3x"></span>
						<h3>Web Aplication</h3>
						<p>We develop customized web applications, create database systems and the acquisition of third party developed software. We provide constant version updates. 
						</p>
						<a href="#" class="btn-purchase">Read more...</a>
					</li>
					<li>
						<span class="fa fa-wrench fa-3x"></span>
						<h3>Piping & Plumbing</h3>
						<p>We do plumb works, in buildings and habitable areas. The work consists of installation of sinks, sanitary, taps, bathroom sinks, showers, bathtubs, jacuzzi.
						</p>
						<a href="#" class="btn-purchase">Read more...</a>
					</li>
				</ul>
			</div>
		<!-- </div> -->
	</section>


	<section id="section-3">
		<h1>Gallery</h1>
		<img class="underline" src="images/underline1.png">

		<div class="main-container">

			<div class="gallery-section1">
				<a href="http://www.ntozonkefinancialservices.co.za" data-lightbox="image-1" target="_blank" data-title="Website">
					<img src="images/gallery/3.png" width="100%">
				</a>
			</div>


			<div class="gallery-section1">
				<a href="http://www.merl-eng.com" data-lightbox="image-1" target="_blank" data-title="Website">
					<img src="images/gallery/2.png" width="100%">
				</a>			
			</div>


			<div class="gallery-section1">
				<a href="http://www.lumaypro.co.za" data-lightbox="image-1" target="_blank" data-title="Website">
					<img src="images/gallery/1.png" width="100%">
				</a>
			</div>
		</div>
	</section>



	<section id="section-4">
		<h1>Cards</h1>
		<img class="underline" src="images/underline1.png">

		<div id="shadow">
			<p class="shad" id="show">Show Shadow</p>
			<p id="hide">Hide Shadow</p>
		</div>

		<div class="main-container">
		
			<div class="card-section1">
				<img src="images/img_avatar.png" alt="Avatar" width="320">
				
				<h4><b>Karel Kuwana Luhonda</b></h4> 
				<p>Architect & Engineer</p> 
			</div>


			<div class="card-section1">
				<img src="images/img_avatar.png" alt="Avatar" width="320" height="320">
				
				<h4><b>Manley Louis</b></h4> 
				<p>Web & Application Developer</p> 
			</div>
					

			<div class="card-section1">
				<img src="images/img_avatar.png" alt="Avatar" width="320">
				
				<h4><b>Ludovic Muya Mukengeshayi</b></h4> 
				<p>Architect & Engineer</p> 
			</div>

		</div>
	</section>

	<section id="section-5">
		<h1>Quotation</h1>
		<img class="underline" src="images/underline1.png">

		<div class="main-container">

			<form action="quote.php" method="post">
				<h3>Get a quote</h3>
				<?php
					if(isset($_GET['quote']))
					{
						echo '<div id="msg" class="success">Request has been sent</div>';
					}

					if(@$_GET['err'] == 1)
					{
						echo '<div id="msg" class="danger">All fields are required</div>';
					}
					if(@$_GET['err'] == 2)
					{
						echo '<div id="msg" class="danger">Invalid email</div>';
					}
				?>
				<input type="text" name="txtname" placeholder="Name " id="bar">
				<input type="text" name="txtcompany" placeholder="Comany name ">
				<input type="text" name="txtemail" placeholder="Email ">
				<input type="text" name="txtphone" placeholder="Phone ">
				<input type="text" name="txtsite" placeholder="Website (Optional) ">
				<textarea name="txtbody" rows="12"></textarea>
				<input type="submit" value="Send">

				<div id='quote'>
					<div class="quote_label">
						<label>Quote Type:</label>
					</div>

					<div class="quote_value">
						We are the best
					</div>
				</div>
			</form>
		</div>	
	</section>


	<footer>
		<div class="main-container">
			
			<div id="footer-1">
				<a href="http://www.ginen.co.za" id="logo">
					<img src="images/logo.png" alt="logo">
				</a>

				<h6>Electrical - Web Application - Piping & Plimbing</h6>

				<p> <a href="#">Ginen</a> &copy; 2019 - 2020. All Rights Reserved.</p>
			</div>

			<div id="footer-2">
				<ul>
					<li><span class="fa fa-location-arrow"></span> 406 Roslyn ave, Waterklof Glen Pretoria 0181</li>
					<li><span class="fa fa-phone"></span>+(27) 76 540 3918</li>
					<li><span class="fa fa-envelope"></span><a href="mailto:info@ginen.co.za">info@ginen.co.za</a></li>
				</ul>
			</div>

			<div id="footer-3">
				<h3>About the company</h3>
				<p>GINEN is a registered company that was established in Gauteng, South Africa. 
				It is a private company specialized in electrical, information technology, 
				plumbing and piping practices.
				</p>


				<ul>
					<li><span class="fa fa-facebook"></span> </li>
					<li><span class="fa fa-twitter"></span></li>
					<li><span class="fa fa-linkedin"></span></li>
				</ul>
			</div>
			</div>

		</div>
	</footer>


<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.1/js/lightbox-plus-jquery.min.js"></script> -->
<script src="js/style.js"></script>
<script src="admin/js/main.js"></script>



<script>
    // lightbox.option({
    //   'resizeDuration': 200,
    //   'wrapAround': true
    // })

    // Hide successfull message after 10 seconds
    // setTimeout(function(){
    // 	$("#msg").fadeOut(3000);
    // }, 10000);

    $(document).ready(function(){
    	$(window).scroll(function(){
    		var position = $(document).scrollTop();

    		if(position >120 && position <=482)
    		{
	    		$('#about-section1').addClass('about1-animation');
	    		$('#about-section2').addClass('about2-animation');
    		}
    	});
    });



    $('a[href*="#"]:not([href="#"])').click(function(event) {
		    // On-page links
		    if 
		    (
		      location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') 
		      && 
		      location.hostname == this.hostname
		    ) {
		      // Figure out element to scroll to
		      var target = $(this.hash);
		      target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
		      // Does a scroll target exist?
		      if (target.length) {
		        // Only prevent default if animation is actually gonna happen
		        event.preventDefault();
		        $('html, body').animate({
		          scrollTop: target.offset().top
		        }, 1000, function() {
		          // Callback after animation
		          // Must change focus!
		          var $target = $(target);
		          $target.focus();
		          if ($target.is(":focus")) { // Checking if the target was focused
		            return false;
		          } else {
		            $target.attr('tabindex','-1'); // Adding tabindex for elements not focusable
		            $target.focus(); // Set focus again
		          };
		        });
		      }
		    }
		  });
</script>
</body>
</html>