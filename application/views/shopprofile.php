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
        
    
    <div class="modal fade" id="myModaleditprovider" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">

            <!--            Modal content-->
            <div class="modal-content">
                <div class="modal-body" id="regbody">
                    <center>
                        <div class="w" id="w">
                            <div class="page" id="page2">
                                <div class="animated-modal-1" id="content-editcustprofile">
                                    <div class="content"><br>
                                        <div class="modal-content">
                                            <div class="modal-header">Edit Shop Details
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <div class="modal-body">
                                                <form name="shopRegister" id="shopRegister" role="form" action="" method="post" accept-charset="utf-8">
                                                    <div class="form-group">
                                                        <label>Email<span style="color:red">*</span></label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                                            <input class="form-control" type="Email" name="txtemail" id="email" required="required" placeholder="Email" value="<?php echo $shopemail; ?>"/>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Select a picture</label>
                                                        <div id="fileshopin">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class="glyphicon glyphicon-picture"></i></span>
                                                                <input class="form-control" type="file" name="fileshop" id="fileshop"/>
                                                            </div>
                                                            <div class="picdiv"><img id="resetshoppic" src="" alt="No picture selected"/></div>
                                                        </div>
                                                    </div>


                                                    <div class="form-group">
                                                        <label>Name of the shop<span style="color:red">*</span></label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                                                            <input class="form-control" type="text" name="txtresetshopname" id="resetshopname" required="required" placeholder="ShopName" value="<?php echo $name; ?>"/>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Owner's Name<span style="color:red">*</span></label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                                            <input class="form-control" type="text" name="txtresetownername" id="resetownername" required="required" placeholder="OwnerName" value="<?php echo $owner; ?>"/>
                                                        </div>
                                                    </div>        
                                                    <script>
                                                        var i = 1;
                                                        function addTP() {
                                                            if (i >= 1) {
                                                                alert("Number of contact numbers are too much !!!");
                                                                return;
                                                            }
                                                            var tp = Array();
                                                            var name = Array();
                                                            for (var j = 1; j <= i; j++) {
                                                                tp.push(document.getElementById("tpnumber" + j).value);
                                                                name.push(document.getElementById("name" + j).value);
                                                            }
                                                            i++;
                                                            var out = "<div class=\"form-inline\"><input class=\"form-control\" type=\"text\" name=\"txttpnumber" + i + "\" id=\"tpnumber" + i + "\" required=\"required\" placeholder=\"TPNumber" + i + "\" maxlength=\"10\"/><label>Name</label><input class=\"form-control\" type=\"text\" name=\"txtname" + i + "\" id=\"name" + i + "\" required=\"required\" placeholder=\"Name\"/></div>";
                                                            document.getElementById("contactnumber").innerHTML += out;
                                                            for (var j = 1; j < i; j++) {
                                                                if (tp[j - 1] != "") {
                                                                    document.getElementById("tpnumber" + j).value = tp[j - 1];
                                                                }
                                                                if (name[j - 1] != "") {
                                                                    document.getElementById("name" + j).value = name[j - 1];
                                                                }
                                                            }
                                                        }
                                                    </script>

                                                    <div class="form-inline">
                                                        <label>Contact Number</label>
                                                        <div class="form-group" id="contactnumber">
                                                            <div class="form-inline">
                                                                <div class="input-group">
                                                                    <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                                                                    <input class="form-control" type="tel" name="txtresettpnumber1" id="resettpnumber1" placeholder="TPNumber1" minlength="10" maxlength="10" value="<?php echo $mobilenumbers[0]->mobileNumber; ?>"/>
                                                                </div>
                                                                <div class="input-group">
                                                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                                                    <input class="form-control" type="text" name="txtresetname1" id="resetname1" placeholder="Name" value="<?php echo $mobilenumbers[0]->contactName; ?>"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br><br>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Address<span style="color:red">*</span></label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                                                            <textarea class="form-control" name="txtresetaddress" id="resetaddress" required="required" placeholder="Address"><?php echo $address; ?></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Fax</label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="glyphicon glyphicon-phone-alt"></i></span>
                                                            <input class="form-control" type="tel" name="txtresetfax" id="resetfax" placeholder="Fax" minlength="10" maxlength="10" value="<?php echo $fax; ?>"/>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>About</label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign"></i></span>
                                                            <textarea class="form-control" name="txtresetabout" id="resetabout" placeholder="About"><?php echo $about ?></textarea>
                                                        </div>
                                                    </div>    

                                                </form>
                                               </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary" id="resetsavechanges" onclick="editprovider();">Save changes</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>  <!--content-editcustprofile ends here-->
                                
                            </div>
                        </div>
                    </center>
                </div>
            </div>
        </div>
    </div>
    <!-- Image Background Page Header -->
    <!-- Note: The background image is set within the business-casual.css file. -->
    <header id="section1" class="business-header" style="background: url('<?php echo base_url().$shoppicture; ?>') center center no-repeat scroll; background-size: 100%;">
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
                <?php 
                if(isset($_SESSION['id'])&&($shopid==$_SESSION['id']))
                {
                ?>
                <button class="btn btn-default" type="button" data-toggle="modal" data-target="#myModaleditprovider">Edit Profile</button>
                <?php
                }if(($person != "")&&($person == "customer"))
                {
                ?>
                <!--                Follow button-->

                <button id="followButton" style="position:fixed; top:500px; right:30px;" class="btn btn-success" onclick="">Follow Us</button>
                <script>
                //JQuery for follow button
                    isfollow();
                    function follow(){
                        var followerid = "<?php echo $shopid ?>";
                        var followingid = "<?php echo $id ?>";
                        jQuery.ajax({
                            type: "POST",
                            url: "<?php echo base_url(); ?>" + "index.php/follow_controller/follow/"+followerid+"/"+followingid,
                            dataType: 'json',
                            success: function (res) {
                                if(res){
                                    var btn = document.getElementById('followButton');
                                    btn.innerHTML = "Following..";
                                    btn.onclick = function(){unfollow();};
                                    $("#followButton").removeClass("btn btn-success").addClass("btn btn-danger");
                                }
                            },
                            error: function (jqXHR, textStatus, errorThrown) {
                                alert(jqXHR.responseText);
                            }
                        });    
                    }
                    function unfollow(){
                        var followerid = "<?php echo $shopid ?>";
                        var followingid = "<?php echo $id ?>";
                        jQuery.ajax({
                            type: "POST",
                            url: "<?php echo base_url(); ?>" + "index.php/follow_controller/unfollow/"+followerid+"/"+followingid,
                            dataType: 'json',
                            success: function (res) {
                                if(res){
                                    var btn = document.getElementById('followButton');
                                    btn.innerHTML = "Follow Us";
                                    btn.onclick = function(){follow();};
                                    $("#followButton").removeClass("btn btn-danger").addClass("btn btn-success");
                                }
                            },
                            error: function (jqXHR, textStatus, errorThrown) {
                                alert(jqXHR.responseText);
                            }
                        });
                    }
                    function isfollow(){
                        var followerid = "<?php echo $shopid ?>";
                        var followingid = "<?php echo $id ?>";
                        jQuery.ajax({
                            type: "POST",
                            url: "<?php echo base_url(); ?>" + "index.php/follow_controller/isfollow/"+followerid+"/"+followingid,
                            dataType: 'json',
                            success: function (res) {
                                if(res=="1"){
                                    var btn = document.getElementById('followButton');
                                    btn.innerHTML = "Following..";
                                    btn.onclick = function(){unfollow();};
                                    $("#followButton").removeClass("btn btn-success").addClass("btn btn-danger");
                                }else{
                                    var btn = document.getElementById('followButton');
                                    btn.innerHTML = "Follow Us";
                                    btn.onclick = function(){follow();};
                                    $("#followButton").removeClass("btn btn-danger").addClass("btn btn-success");
                                }
                            },
                            error: function (jqXHR, textStatus, errorThrown) {
                                alert(jqXHR.responseText);
                            }
                        });
                    }
                </script>
                <?php
                }
                ?>
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
                    <abbr title="Email">EMail :</abbr> <a href="mailto:#"> <?php echo $shopemail; ?></a>
                </address>
            </div>
        </div>
        <!-- /.row -->

        <hr>
        <?php if($shoppackages)
        {
        ?>
        <div id="section2" class="row">
            <center><h1 class="tagline">Packages</h1></center>
            <?php foreach($shoppackages as $obj){?>
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
        <?php        
        }
        ?>
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
