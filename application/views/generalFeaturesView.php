
<!DOCTYPE html>
<html>
    <?php
        $this->load->helper('url');
        //$this->load->view('registration');
        $_SESSION["headercontent"]=array(
            'nav1'=>'<li><a href="#section1">About</a></li>',
        );
    ?>
    <head>
        <title>FindYourRaft</title>
        <?php include 'styles.php'; ?>
    </head>
    <body>
        <?php include('header.php'); ?>   
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
                            <div class="col-lg-12">
                                <div class="tm-box">
                                    <div class="tm-box-description">
                                        <h1><?php echo $generalfeature->name; ?></h1>
                                        <p class="tm-box-p"> <i>"<?php echo $generalfeature->description; ?>"</i></p>
                                        <p class="tm-box-p" style="float:center;"><b>Adventure Providers : </b></p>
    								
                                         
                                                
                                    </div>                    
                                </div>
                            </div>

                            <!-- Get the adventure providers -->


                        </div>
                        
                        <div class="row">
                            <div class="tm-box-description">  
                            <h2>See also.....</h2>
                            </div>
                            <?php 
                                foreach ($activities as $obj) {
                                    if($generalfeature->activityID != $obj->activityID) {
                            ?>

                            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                <div class="hovereffect">
                                    <div class="featureimg"><img class="img-responsive" src="<?php echo base_url($obj->image); ?>" alt=""></div>
                                    <div class="overlay">
                                        <h2><?php echo $obj->name; ?></h2>
                                        <p> 
                                            <a href="<?php echo base_url("index.php/welcome/getGeneralFeatures/".$obj->activityID); ?>">Check Us!</a>
                                        </p> 
                                    </div>
                                </div>
                            </div>
                            
                            <?php
                                    }
                                }
                            ?>

                        </div>

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
            <?php include 'footer.php'; ?>
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

