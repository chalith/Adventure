
<!DOCTYPE html>
<html>
    <head>
        <title>FindYourRaft</title>
        <!--
        Conquer Template
        http://www.templatemo.com/tm-476-conquer
        -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="<?php echo base_url('css/bootstrap.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('css/home/style.css') ?>">
        <link rel="stylesheet" href="<?php echo base_url('css/hovereffects.css') ?>">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>




    </head>
    <body>
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>                        
                    </button>
                </div>   
                <div class="single-page-nav sticky-wrapper" id="tmNavbar">
                    <ul class="nav navbar-nav">
                        <li><a href="#section1">Homepage</a></li>
                        <li><a href="#section2">About Us</a></li>
                        <li><a href="#section3">Services</a></li>
                        <li><a href="#section4">Contact</a></li>
                        <li><a href="http://www.facebook.com/templatemo" class="external" target="_blank">External</a></li>
                    </ul>
                </div>   
            </div>
        </nav>   
        <?php foreach ($generalfeature as $generalfeature) { ?>

            <div id="section1">
                <header id="header-area" class="intro-section">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12 text-center">
                                <div class="header-content">
                                    <h1><?php echo $generalfeature->name; ?></h1>
                                    <h4>Another Wonder of Kthulgala</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </header>
            </div>




            <div id = "section3">
                <section id="testimornial-area">
                    <div class = "container">
                        <div class="row">

                            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                <div class="hovereffect">
                                    <img class="img-responsive" src="<?php echo base_url('img/conjum.jpg'); ?>" alt="">
                                    <div class="overlay">
                                        <h2>Effect 11</h2>
                                        <p> 
                                            <a href="#">LINK HERE</a>
                                        </p> 
                                    </div>
                                </div>
                            </div>


                            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                <div class="hovereffect">
                                    <img class="img-responsive" src="<?php echo base_url('img/bg-3.jpg'); ?>" alt="">
                                    <div class="overlay">
                                        <h2>Effect 11</h2>
                                        <p> 
                                            <a href="#">LINK HERE</a>
                                        </p> 
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                <div class="hovereffect">
                                    <img class="img-responsive" src="<?php echo base_url('img/bg-1.jpg'); ?>" alt="">
                                    <div class="overlay">
                                        <h2>Effect 11</h2>
                                        <p> 
                                            <a href="#">LINK HERE</a>
                                        </p> 
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                <div class="hovereffect">
                                    <img class="img-responsive" src="<?php echo base_url('img/bg-2.jpg'); ?>" alt="">
                                    <div class="overlay">
                                        <h2>Effect 11</h2>
                                        <p> 
                                            <a href="#">LINK HERE</a>
                                        </p> 
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="tm-box">
                                    <div class="tm-box-description">
                                        <h1><?php echo $generalfeature->name; ?></h1>
                                        <p class="tm-box-p"> <i>"<?php echo $generalfeature->description; ?>"</i></p>
                                        <p class="tm-box-p" style="float:center;"><b>Adventure Providers : </b></p>
    <!--								<table class = "table">
                                                <tbody>
                                                //<?php
//										$query = "SELECT * FROM shops WHERE shop_package_gf='{$name}'";
//										$result = mysqli_query($connection, $query);
//										if (!$result){
//					            			echo "database error";
//					        			}
//					        			else{
//					        				while($row = mysqli_fetch_assoc($result)){
//					        					echo "<tr><td><a href=#>".$row["shop_name"]."</a></td></tr>";
//					        				}
//					        			}
//
//									
                                        ?>
                                        </tbody>
                                </table>-->
                                    </div>                    
                                </div>
                            </div>

                            <!-- Get the adventure providers -->


                        </div>
                </section>
            </div>
            <div id="section4">
                <!-- Start Contact Area -->
                <section id="contact-area" class="contact-section">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12 text-center inner">
                                <div class="contact-content">
                                    <h1>contact form</h1>
                                    <div class="row">                            
                                        <div class="col-sm-12">
                                            <p>Nunc diam leo, fringilla vulputate elit lobortis, consectetur vestibulum quam. Sed id <br>
                                                felis ligula. In euismod libero at magna dapibus, in rutrum velit lacinia. <br>
                                                Etiam a mi quis arcu varius condimentum.</p>
                                        </div>                            
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <form action="#" method="post" class="contact-form">
                                    <div class="col-sm-6 contact-form-left">
                                        <div class="form-group">
                                            <input name="name" type="text" class="form-control" id="name" placeholder="Name">
                                            <input type="email" name="email" class="form-control" id="mail" placeholder="Email">
                                            <input name="subject" type="text" class="form-control" id="subject" placeholder="Subject">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 contact-form-right">
                                        <div class="form-group">
                                            <textarea name="message" rows="6" class="form-control" id="comment" placeholder="Your message here..."></textarea>
                                            <button type="submit" class="btn btn-default">Send</button>
                                        </div>
                                    </div>                        
                                </form>    
                            </div>                
                        </div>
                    </div>
                </section>
                <!-- End Contact Area -->
            </div>

            <!-- Start Footer Area -->
            <footer id="footer-area">
                <div class="container">
                    <div class="row text-center">
                        <div class="col-sm-12">
                            <div class="footer-content">
                                <h1>Use it free!</h1>
                                <p>“Conquer is free Bootstrap template from templatemo website. 
                                    <br>No backlink is required to use this layout.”</p>
                            </div>                
                        </div>
                    </div>
                </div>
                <hr>
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12 text-center">             
                            <p class="copy">Copyright © 2084 Your Company Name 

                                | Design: <a rel="nofollow" href="http://www.templatemo.com" target="_parent">template mo</a></p>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- End Footer Area -->

            <script src="<?php echo base_url('js/jquery-1.11.2.min.js'); ?>"></script>
            <script src="<?php echo base_url('js/jquery.scrollUp.min.js'); ?>"></script> <!-- https://github.com/markgoodyear/scrollup -->
            <script src="<?php echo base_url('js/jquery.singlePageNav.min.js'); ?>"></script> <!-- https://github.com/ChrisWojcik/single-page-nav -->
            <script src="<?php echo base_url('js/parallax.js-1.3.1/parallax.js'); ?>"></script> <!-- http://pixelcog.github.io/parallax.js/ -->
            <script>

                // HTML document is loaded. DOM is ready.
                $(function () {

                    // Parallax
                    $('.intro-section').parallax({
                        imageSrc: "<?php echo base_url() . $generalfeature->image;
                                } ?>",
                    speed: 0.2
                });
                $('.services-section').parallax({
                    imageSrc: '<?php echo base_url('img/bg-2.jpg'); ?>',
                    speed: 0.2
                });
                $('.contact-section').parallax({
                    imageSrc: '<?php echo base_url('img/bg-3.jpg'); ?>',
                    speed: 0.2
                });

                // jQuery Scroll Up / Back To Top Image
                $.scrollUp({
                    scrollName: 'scrollUp', // Element ID
                    scrollDistance: 300, // Distance from top/bottom before showing element (px)
                    scrollFrom: 'top', // 'top' or 'bottom'
                    scrollSpeed: 1000, // Speed back to top (ms)
                    easingType: 'linear', // Scroll to top easing (see http://easings.net/)
                    animation: 'fade', // Fade, slide, none
                    animationSpeed: 300, // Animation speed (ms)		        
                    scrollText: '', // Text for element, can contain HTML		        
                    scrollImg: true            // Set true to use image		        
                });

                // ScrollUp Placement
                $(window).on('scroll', function () {

                    // If the height of the document less the height of the document is the same as the
                    // distance the window has scrolled from the top...
                    if ($(document).height() - $(window).height() === $(window).scrollTop()) {

                        // Adjust the scrollUp image so that it's a few pixels above the footer
                        $('#scrollUp').css('bottom', '80px');

                    } else {
                        // Otherwise, leave set it to its default value.
                        $('#scrollUp').css('bottom', '30px');
                    }
                });

                $('.single-page-nav').singlePageNav({
                    offset: $('.single-page-nav').outerHeight(),
                    speed: 1500,
                    filter: ':not(.external)',
                    updateHash: true
                });

                $('.navbar-toggle').click(function () {
                    $('.single-page-nav').toggleClass('show');
                });

                $('.single-page-nav a').click(function () {
                    $('.single-page-nav').removeClass('show');
                });

            });

        </script>
    </body>
</html>

