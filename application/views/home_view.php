<!DOCTYPE html>
<html>
    <?php
        $this->load->helper('url');
        //$this->load->view('registration');
    ?>
    
<head>
        <title>FindYourRaft</title>
	<meta charset="utf-8">
        
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=ABeeZee:400,400italic">
        
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="css/home/login.css">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/home/style.css">
	
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
	<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
	<script src="jquery.json-2.4.min.js"></script>
	<script src="http://code.jquery.com/jquery-latest.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
<script>
$(document).ready(function(){
  var providers = $("#providersrow");
  var container = $("#myCarousel");
  $("#left-carousel-control").on("click", function(e){
      e.preventDefault();
	var margin = parseInt($('#providersrow').css('margin-left'));
    var newwidth = container.width();
	var length = providers.width();
	if((margin<0)&&(margin>(-newwidth))){
                $(providers).stop().animate({
		  "margin-left": 0
		}, 800, function(){ /* callback */ });
        }
	else if(margin<0){
		$(providers).stop().animate({
		  "margin-left": (margin+newwidth)+"px"
		}, 800, function(){ /* callback */ });
	}
  });
  
  $("#right-carousel-control").on("click", function(e){
    e.preventDefault();
	var margin = parseInt($('#providersrow').css('margin-left'));
    var newwidth = container.width();
	var length = providers.width();
	if(((newwidth-margin)<length)&&((length-(newwidth-margin))<newwidth)){
                $(providers).stop().animate({
		  "margin-left": (newwidth-length)+"px"
		}, 800, function(){ /* callback */ });
        }
	else if((newwidth-margin)<length){
		$(providers).stop().animate({
		  "margin-left": (margin-newwidth)+"px"
		}, 800, function(){ /* callback */ });
	}
  });
  
  
  
  var add = $("#advertisements");
  var addcontainer = $("#myCarousel2");
  $("#left-carousel-control2").on("click", function(e){
	e.preventDefault();
	var margin = parseInt($('#advertisements').css('margin-left'));
    var newwidth = addcontainer.width();
	var length = add.width();
	if((margin<0)&&(margin>(-newwidth))){
                $(add).stop().animate({
		  "margin-left": 0
		}, 800, function(){ /* callback */ });
        }
	else if(margin<0){
		$(add).stop().animate({
		  "margin-left": (margin+newwidth)+"px"
		}, 800, function(){ /* callback */ });
	}
  });
  
  $("#right-carousel-control2").on("click", function(e){
    e.preventDefault();
	var margin = parseInt($('#advertisements').css('margin-left'));
    var newwidth = addcontainer.width();
	var length = add.width();
	if(((newwidth-margin)<length)&&((length-(newwidth-margin))<newwidth)){
                $(add).stop().animate({
		  "margin-left": (newwidth-length)+"px"
		}, 800, function(){ /* callback */ });
        }
	else if((newwidth-margin)<length){
		$(add).stop().animate({
		  "margin-left": (margin-newwidth)+"px"
		}, 800, function(){ /* callback */ });
	}
  });
});
</script>
</head>

<body>
        <div>
            <?php include('header.php'); ?>
	<div id="frontpagebody">
            
	<div id="section1">
		<header id="header-area" class="intro-section">
			<div class="container">
				<div class="row">
					<div class="col-sm-12 text-center">
						<div class="header-content">
							<h1>Find Your Raft</h1>
							<h4>For your hunger of the adventure</h4>
						</div>
					</div>
				</div>
			</div>
		</header>
	</div>
	<div id="section2">
		<!-- Start Feature Area -->
		<section id="feature-area" class="about-section">
			<div class="container">
				<div class="row text-center inner">
					<div class="col-sm-4">
						<div class="feature-content">
							<img src="<?php echo base_url('img/rsz_img05.jpg');?>" alt="Image">
							<h2 class="feature-content-title green-text">Waterfall Trekking</h2>
							<p class="feature-content-description">Water fall trekking gives travellers a close view of incredible scenery of a waterfall. Trekking is mainly focused in view of stunningly beautiful waterfalls hidden inside the rain forests in Kitulgala. 
							</p>
                                                        <a href="<?php echo base_url('index.php/welcome/getGeneralFeatures/WT');?>" class="feature-content-link green-btn" >See Details</a>

						</div>
					</div>
					<div class="col-sm-4">
						<div class="feature-content">
							<img src="<?php echo base_url('img/rsz_cycle2.jpg');?>" alt="Image">
							<h2 class="feature-content-title blue-text">Cycling Trips</h2>
							<p class="feature-content-description">Our Mountain Cycling tracks cover Tea Estates, Rubber Estates and other scenic locations, towns and sleepy hamlets. This is a great way to experience the sceneries and the local village lifestyles.</p>
							<a href="<?php echo base_url('index.php/welcome/getGeneralFeatures/Cycle');?>" class="feature-content-link blue-btn">See Details</a>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="feature-content">
							<img src="<?php echo base_url('img/rsz_jumping.jpg');?>" alt="Image">
							<h2 class="feature-content-title red-text">Confidence Jumps in natural stream slides</h2>
							<p class="feature-content-description">The trek to natural rock pools and waterfalls of kataran-Oya" -1.5KM. There are 7 natural extremely beautiful where you will be able to experience many adeventures. 
							</p>
							<a href="<?php echo base_url('index.php/welcome/getGeneralFeatures/Jump');?>" class="feature-content-link red-btn">See Details</a>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- End Feature Area -->

		<!-- Start Blog Area -->
			</div>
			<div id="section3">
				<!-- Start Services Area -->
				<section id="services-area" class="services-section">
					<div class="container">
						<div class="row">
							<div class="col-sm-12 text-center inner our-service">
								<div class="service">
									<h1>Adventure Kitulgala</h1>
									<p>Kitulgala is a small village in middle of the Sri Lanka surrounded with misty mountains. It has won the attraction of many adventure seekers in Sri Lanka. There are more than houndred providers who is willing to provide you a memmorable adventure experience.</p>
									</div>
								</div>
							</div>
						</div>
					</section>
					<!-- End Services Area -->

					<!-- Start Testimornial Area -->
					<section id="testimornial-area">
                                            
						<div class="container">
							<div id="myCarousel" class="carousel slide pro" data-ride="carousel">
							  <!-- Indicators -->
							  <ol class="carousel-indicators">
								<li class="active"></li>
								<li></li>
								<li></li>
								<li></li>
							  </ol>

							  <!-- Wrapper for slides -->
							  <div class="carousel-inner pro" role="listbox">
								<div class="row text-center providers">
								<table id="providersrow">
								<tr>
								<?php
                                                                    if($providers!=NULL){
                                                                    foreach ($providers as $object){
                                                                ?>
                                                                    <td>
								<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 col-xxs-12">
									<div class="testimonial-content">
                                                                            <img src="<?php echo $object->picture; ?>" alt="Image">
										<h2><?php echo $object->shopName; ?></h2>
										<p><?php echo $object->about; ?></p>
										<br>
									</div>
								</div>
								</td>
								<?php
                                                                    }
                                                                    }
                                                                ?>
								</tr>
                                                                </table>
							</div>
							  </div>

							  <!-- Left and right controls -->
							  <a class="left carousel-control" id="left-carousel-control" href="#myCarousel">
								<span class="glyphicon glyphicon-chevron-left"></span>
								<span class="sr-only">Previous</span>
							  </a>
							  <a class="right carousel-control" id="right-carousel-control" href="#myCarousel">
								<span class="glyphicon glyphicon-chevron-right"></span>
								<span class="sr-only">Next</span>
							  </a>
							</div>

						</div>
					</section>
					<!-- End Testimornial Area -->
				</div>
				<div id="section4">
					<!-- Start Contact Area -->
					<section id="contact-area" class="contact-section">
						<div class="container">
							<div class="row">
								<div class="col-sm-12 text-center inner">
									<div style="color: white;" class="contact-content">
										<h1>Special Offers</h1>
										<div class="row">                            
											<div class="col-sm-12">
												<p>There are special occational offers given by providers
												<br>Check them below</p>
												</div>                            
											</div>

										</div>
									</div>
								</div>
								
							</div>
						</section><br><br>
						<!-- End Contact Area -->
						<section id="testimornial-area2">
						<div class="container">
							<div id="myCarousel2" class="carousel slide pro" data-ride="carousel">
							  <!-- Indicators -->
							  <ol class="carousel-indicators">
								<li class="active"></li>
								<li></li>
								<li></li>
								<li></li>
							  </ol>

							  <!-- Wrapper for slides -->
							  <div class="carousel-inner pro" role="listbox">
								<div class="row text-center providers">
								<table id="advertisements">
								<tr>
                                                                <?php
                                                                    if($advertisements!=NULL){
                                                                    foreach ($advertisements as $object){
                                                                ?>                                                               
								<td>
								<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 col-xxs-12">
									<div class="testimonial-content">
                                                                            <img src="<?php echo $object["shoppic"]; ?>" alt="Image">
										<h2><?php echo $object["title"]; ?></h2>
                                                                                <a style="font-size:120%;"><?php echo $object["shopname"]; ?></a>
										<p><?php echo $object["description"]; ?></p>
										<br>
									</div>
								</div>
								</td>
                                                                <?php
                                                                    }
                                                                    }
                                                                ?>
								</tr>
								</table>
							</div>
						</div>
						<!-- Left and right controls -->
							  <a class="left carousel-control" id="left-carousel-control2" href="#myCarousel">
								<span class="glyphicon glyphicon-chevron-left"></span>
								<span class="sr-only">Previous</span>
							  </a>
							  <a class="right carousel-control" id="right-carousel-control2" href="#myCarousel">
								<span class="glyphicon glyphicon-chevron-right"></span>
								<span class="sr-only">Next</span>
							  </a>
							</div>

						</div>
					</section>
					</div>
            </div>
					

					<!-- Start Footer Area -->
					<footer id="footer-area">
						<div class="container">
							<div class="row text-center">
								<div class="col-sm-12">
									<div class="footer-content">
										<h1>FindYourAdventure</h1>
										<p>“Find your adventure package”</p>
										</div>                
									</div>
								</div>
							</div>
							<hr>
							<div class="container">
								<div class="row">
									<div class="col-sm-12 text-center">             
										<p class="copy">Copyright © 2084 Group 12 </p>
									</div>
								</div>
							</div>
						</footer>
						<!-- End Footer Area -->
					</div>

						<script src="js/jquery-1.11.2.min.js"></script>
						<script src="js/jquery.scrollUp.min.js"></script> <!-- https://github.com/markgoodyear/scrollup -->
						<script src="js/jquery.singlePageNav.min.js"></script> <!-- https://github.com/ChrisWojcik/single-page-nav -->
						<script src="js/parallax.js-1.3.1/parallax.js"></script> <!-- http://pixelcog.github.io/parallax.js/ -->
						<script>

    // HTML document is loaded. DOM is ready.
    $(function() {  

    // Parallax
        $('.intro-section').parallax({
        	imageSrc: 'img/bg-1.jpg',
        	speed: 0.2
        });
        $('.services-section').parallax({
        	imageSrc: 'img/bg-2.jpg',
        	speed: 0.2
    	});
        $('.contact-section').parallax({
        	imageSrc: 'img/bg-3.jpg',
        	speed: 0.2
        });    

        // jQuery Scroll Up / Back To Top Image
        $.scrollUp({
                scrollName: 'scrollUp',      // Element ID
		        scrollDistance: 300,         // Distance from top/bottom before showing element (px)
		        scrollFrom: 'top',           // 'top' or 'bottom'
		        scrollSpeed: 1000,            // Speed back to top (ms)
		        easingType: 'linear',        // Scroll to top easing (see http://easings.net/)
		        animation: 'fade',           // Fade, slide, none
		        animationSpeed: 300,         // Animation speed (ms)		        
		        scrollText: '', // Text for element, can contain HTML		        
		        scrollImg: true            // Set true to use image		        
            });

        // ScrollUp Placement
        $( window ).on( 'scroll', function() {

            // If the height of the document less the height of the document is the same as the
            // distance the window has scrolled from the top...
            if ( $( document ).height() - $( window ).height() === $( window ).scrollTop() ) {

                // Adjust the scrollUp image so that it's a few pixels above the footer
                $('#scrollUp').css( 'bottom', '80px' );

            } else {      
                // Otherwise, leave set it to its default value.
                $('#scrollUp').css( 'bottom', '30px' );        
            }
        });

        $('.single-page-nav').singlePageNav({
        	offset: $('.single-page-nav').outerHeight(),
        	speed: 1500,
        	filter: ':not(.external)',
        	updateHash: true
        });

        $('.navbar-toggle').click(function(){
        	$('.single-page-nav').toggleClass('show');
        });

        $('.single-page-nav a').click(function(){
        	$('.single-page-nav').removeClass('show');
        });
        
    });
</script>
</body>
</html>