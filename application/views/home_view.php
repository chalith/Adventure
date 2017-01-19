<!DOCTYPE html>
<html>
    <?php
    $this->load->helper('url');
    //$this->load->view('registration');
    $_SESSION["headercontent"] = array(
        'nav1' => '<li><a href="#section1">About</a></li>',
        'nav2' => '<li><a href="#section2">Activities</a></li>',
        'nav3' => '<li><a href="#section3">Providers</a></li>',
        'nav4' => '<li><a href="#section4">Special Offers</a></li>'
    );
    ?>

    <head>

        <title>FindYourRaft</title>
        <?php include 'styles.php'; ?>
        <script>
            $(document).ready(function () {
                var providers = $("#providersrow");
                var container = $("#myCarousel");
                $("#left-carousel-control").on("click", function (e) {
                    e.preventDefault();
                    var margin = parseInt($('#providersrow').css('margin-left'));
                    var newwidth = container.width();
                    var length = providers.width();
                    if ((margin < 0) && (margin > (-newwidth))) {
                        $(providers).stop().animate({
                            "margin-left": 0
                        }, 800, function () { /* callback */
                        });
                    } else if (margin < 0) {
                        $(providers).stop().animate({
                            "margin-left": (margin + newwidth) + "px"
                        }, 800, function () { /* callback */
                        });
                    }
                });

                $("#right-carousel-control").on("click", function (e) {
                    e.preventDefault();
                    var margin = parseInt($('#providersrow').css('margin-left'));
                    var newwidth = container.width();
                    var length = providers.width();
                    if (((newwidth - margin) < length) && ((length - (newwidth - margin)) < newwidth)) {
                        $(providers).stop().animate({
                            "margin-left": (newwidth - length) + "px"
                        }, 800, function () { /* callback */
                        });
                    } else if ((newwidth - margin) < length) {
                        $(providers).stop().animate({
                            "margin-left": (margin - newwidth) + "px"
                        }, 800, function () { /* callback */
                        });
                    }
                });



                var add = $("#advertisements");
                var addcontainer = $("#myCarousel2");
                $("#left-carousel-control2").on("click", function (e) {
                    e.preventDefault();
                    var margin = parseInt($('#advertisements').css('margin-left'));
                    var newwidth = addcontainer.width();
                    var length = add.width();
                    if ((margin < 0) && (margin > (-newwidth))) {
                        $(add).stop().animate({
                            "margin-left": 0
                        }, 800, function () { /* callback */
                        });
                    } else if (margin < 0) {
                        $(add).stop().animate({
                            "margin-left": (margin + newwidth) + "px"
                        }, 800, function () { /* callback */
                        });
                    }
                });

                $("#right-carousel-control2").on("click", function (e) {
                    e.preventDefault();
                    var margin = parseInt($('#advertisements').css('margin-left'));
                    var newwidth = addcontainer.width();
                    var length = add.width();
                    if (((newwidth - margin) < length) && ((length - (newwidth - margin)) < newwidth)) {
                        $(add).stop().animate({
                            "margin-left": (newwidth - length) + "px"
                        }, 800, function () { /* callback */
                        });
                    } else if ((newwidth - margin) < length) {
                        $(add).stop().animate({
                            "margin-left": (margin - newwidth) + "px"
                        }, 800, function () { /* callback */
                        });
                    }
                });

                $(".featurebtn").on("click", function (e) {
                    window.location = "index.php/welcome/getGeneralFeatures/" + e.target.id;
                });
                $(".provider").on("click", function (e) {
                    var curid = $(e.target).parents().attr('id');
                    if (typeof curid == 'undefined') {
                        var curid = e.target.id;
                    }
                    window.location = "index.php/welcome/getShopView/" + curid;
                });
            });

//JQuery for follow button
            function followShop() {
                var text = document.getElementById('followButton').innerHTML;

                if (text === "Follow Us") {
                    document.getElementById('followButton').innerHTML = "Following..";
                    $("#followButton").removeClass("btn btn-success").addClass("btn btn-danger");
                } else {
                    document.getElementById('followButton').innerHTML = "Follow Us";
                    $("#followButton").removeClass("btn btn-danger").addClass("btn btn-success");
                }

            }

            function specialoffersubmit() {
                var sotitle = sodetails = "";
                alert("h");
                sotitle = document.forms["so"]["sotitle"].value;
                sodetails = document.forms["so"]["sodetails"].value;
                alert(sotitle);
                var obj = {'sotitle': sotitle, 'sodetails': sodetails};
                call(obj);
            }

            function call(obj) {
                var ret = confirm("Do you want to save the changes?");

                if (ret === true) {
                    alert("in");
                    jQuery.ajax({
                        type: "POST",
                        url: "<?php echo base_url(); ?>" + "index.php/shopoffers_controller/insertSpecialOffers",
                        dataType: "json",
                        data: obj,
                        success: function (res) {

                            alert(res.alert1.msg);
                            alert(res.alert2.msg);



                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            alert(jqXHR.responseText);
                            alert("hmmm");
                        }
                    });
                }
            }

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
                        <!-- Trigger the modal with a button -->








                        <div class="container">
                            <div class="row text-center inner">
                                <?php
                                if ($activities != NULL) {
                                    foreach ($activities as $object) {
                                        ?>
                                        <div class="col-sm-4">
                                            <div class="feature-content" style="max-height: 500px; overflow: hidden; margin-bottom: 50px;">
                                                <div class="activityimg"><img src="<?php echo base_url() . $object->image; ?>" alt="Image"></div>
                                                <h2 class="feature-content-title blue-text"><?php echo $object->name; ?></h2>
                                                <p class="feature-content-description"><?php
                                                    $descr = $object->description;
                                                    echo substr($descr, 0, 200) . ".....";
                                                    ?></p>
                                                <a href="#" id="<?php echo $object->activityID; ?>" class="featurebtn feature-content-link blue-btn">See Details</a>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
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
                                                if ($providers != NULL) {
                                                    foreach ($providers as $object) {
                                                        ?>
                                                        <td>
                                                            <div id="<?php echo $object->id; ?>" class="provider testimonial-content col-lg-3 col-md-3 col-sm-6 col-xs-6 col-xxs-12">
                                                                <div id="<?php echo $object->id; ?>" class="providerimg"><img src="<?php echo base_url() . $object->picture; ?>" alt="Image"></div>
                                                                <h2><?php echo $object->shopName; ?></h2>
                                                                <p><?php
                                                                    $descr = $object->about;
                                                                    echo substr($descr, 0, 72) . ".....";
                                                                    ?></p>
                                                                <br>
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

                <!--                Follow button-->

                <button id="followButton" style="position:fixed; top:400px; right:30px;" class="btn btn-success" onclick="followShop();">Follow Us</button>


                <div id="section4">
                    <!-- Start Contact Area -->

                    <?php
                    if (isset($_SESSION['person'])) {
                        if ($_SESSION['person'] == 'provider') {
                            ?>
                            <section id="contact-area" class="contact-section">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-sm-12 text-center inner">
                                            <div style="color: white;" class="container">

                                                <div class="row">



                                                    <form id="so" name="so" method="post" class="contact-form" action="">

                                                        
                                                            <div class="col-sm-6 contact-form-right">
                                                                <h1 style="color:#336699;"><i>Special Offers</i></h1> 
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" name="sotitle" id="sotitle" placeholder="Catchy Title!">
                                                                    <br>
                                                                    <textarea name="sodetails" rows="6" class="form-control" id="sodetails" placeholder="Your message here..."></textarea>
                                                                    <button type="submit" class="btn btn-info" onclick="specialoffersubmit();">Submit</button>
                                                                </div>
                                                            </div>


                                                           

                                                    </form>



                                                </div>
                                            </div>

                                        </div>
                                        </section><br><br>
                                        <!-- End Contact Area -->
                                        <?php
                                            }
                                            
                                            }
                                        if ($advertisements != NULL) {
                                            ?>
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
                                                                        foreach ($advertisements as $object) {
                                                                            ?>                                                               
                                                                            <td>
                                                                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 col-xxs-12">
                                                                                    <div class="testimonial-content">
                                                                                        <img src="<?php echo base_url() . $object["shoppic"]; ?>" alt="Image">
                                                                                        <h2><?php echo $object["title"]; ?></h2>
                                                                                        <a style="font-size:120%;"><?php echo $object["shopname"]; ?></a>
                                                                                        <p><?php echo $object["description"]; ?></p>
                                                                                        <br>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <?php
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
                                            <?php
                                        } else {
                                            ?>
                                            <center><h1>No special offers for this season</h1></center><br><br>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>


                                <!-- Start Footer Area -->
                                <?php include 'footer.php'; ?>
                        <!-- End Footer Area -->


                </div>

                <script src="js/jquery-1.11.2.min.js"></script>
                <script src="js/jquery.scrollUp.min.js"></script> <!-- https://github.com/markgoodyear/scrollup -->
                <script src="js/jquery.singlePageNav.min.js"></script> <!-- https://github.com/ChrisWojcik/single-page-nav -->
                <script src="js/parallax.js-1.3.1/parallax.js"></script> <!-- http://pixelcog.github.io/parallax.js/ -->
                <script>

                                                                // HTML document is loaded. DOM is ready.
                                                                $(function () {

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