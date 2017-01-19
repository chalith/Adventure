<!DOCTYPE html>
<html lang="en">
<?php
    $this->load->helper('url');
    //$this->load->view('registration');
    $_SESSION["headercontent"] = array(
        'nav1' => '<li><a href="#section1">About</a></li>',
        'nav2' => '<li><a href="#section2">Packages</a></li>',
    );
    ?>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>FindYourRaft</title>

    <!-- Bootstrap Core CSS -->
    <?php include 'styles.php'; ?>
        
    <!-- Custom CSS -->
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
    <div>
    <!-- Navigation -->
        <?php include('header.php'); ?>
        

    <!-- Image Background Page Header -->
    <!-- Note: The background image is set within the business-casual.css file. -->
    <header id="section1" class="business-header" style="background: url('<?php echo base_url().$picture; ?>') center center no-repeat scroll; background-size: 100%;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="tagline"><?php echo $name; ?></h1>
                </div>
            </div>
        </div>
    </header>

    <!-- Page Content -->
    <div class="container">

        <hr>

        <div class="row">
            <div class="col-sm-8 panel-default">
                <ul class="list-group col-lg-12">
                    <?php if($owner!=""){ ?>
                    <li class="list-group-item"><?php echo $owner; ?></li>
                    <?php }if($about!=""){ ?>
                    <li class="list-group-item"><?php echo $about; ?></li>
                    <?php } ?>
                </ul>
                
            </div>
            <div class="col-sm-4">
                <h2>Contact</h2>
                <address>
                    <?php echo $address; ?>
                <address>
                <?php if(count($mobilenumbers)>0){ ?>
                    <abbr title="Phone">Phone :</abbr>
                    <?php
                        foreach($mobilenumbers as $obj){
                            echo $obj->mobileNumber." : ".$obj->contactName."<br>"; 
                        }
                    ?>
                    <br>
                <?php } ?>
                    <abbr title="Email">EMail :</abbr> <a href="mailto:#"> <?php echo $email; ?></a>
                </address>
            </div>
        </div>
        <!-- /.row -->

        <hr>

        <div id="section2" class="row">
            <center><h1 class="tagline">Packages</h1></center>
            <?php foreach($packages as $obj){?>
                <div class="col-sm-3 panel">
                    <img class="img-circle img-responsive img-center" src="<?php echo base_url().$obj->picture; ?>" alt="">
                    <li class="list-group-item">
                    <h2><?php echo $obj->packageName; ?></h2>
                    </li>
                    <li class="list-group-item">
                    <p><?php echo $obj->about; ?></p>
                    </li>
                    <li class="list-group-item">
                        <?php if($obj->durationDays!="") echo $obj->durationDays."days ";
                        if($obj->durationHours!="") echo $obj->durationHours."hours "; ?>
                    </li>
                    <li class="list-group-item">
                        <?php if($obj->durationDays!="") echo "meals: ".$obj->meals; ?>
                    </li>
                    <li class="list-group-item">
                        <?php if($obj->price!="") echo "price: ".$obj->price; ?>
                    </li>
                </div>
            <?php } ?>
        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Your Website 2014</p>
                </div>
            </div>
            <!-- /.row -->
        </footer>

    </div>
    <!-- /.container -->

    </div>
</body>

</html>
