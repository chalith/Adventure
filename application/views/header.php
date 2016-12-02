<html>
<?php
    $this->load->helper('url');
    //$this->load->view('registration');
    $headercontent = "";
    foreach ($_SESSION["headercontent"] as $ob){
        $headercontent = $headercontent.$ob;
    }
?>
    
<head>
    <script src="<?php echo base_url();?>js/home/header.js"></script>
        
    <title>FindYourRaft</title>
    <?php include 'styles.php'; ?>
</head>
<body>
    <div id="headernav">
            <?php
                $email=$id=$person=$picture="";
                session_start();    
            
                if(isset($_SESSION['email'])){
                    $email=$_SESSION['email'];
                    $id=$_SESSION['id'];
                    $person=$_SESSION['person'];
                    $picture=$_SESSION['picture'];
                }
            
                if($email!=""){
            ?>
            <div id="userheader">
            <nav class="navbar navbar-inverse navbar-fixed-top topbar">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>                        
				</button>
			</div>
                        <div class="single-page-nav sticky-wrapper header-login-signup header-user-dropdown" id="tmNavbar">
				<ul class="nav-content nav navbar-nav header-limiter">
                                        <li><a href="#" class="homebtn">Home</a></li>  
                                        <?php
                                            echo $headercontent;
                                        ?>
					<!--<li><a href="#section1">Homepage</a></li>
					<li><a href="#section2">About Us</a></li>
					<li><a href="#section3">Services</a></li>
					<li><a href="#section4">Contact</a></li>-->
                                </ul>
                                <ul class="login-signup-sec nav navbar-nav  header-limiter">
                                    <li>
                                            <div class="header-user-menu user">
                                                <img src="<?php echo base_url().$picture; ?>" alt="User Image"/>

                                                    <ul>
                                                            <li><a href="#">Profile</a></li>
                                                            <li><a href="#" class="highlight logout">Logout</a></li>
                                                    </ul>
                                            </div>
                                    </li>
                                </ul>
                            
			</div>
                        <div class="navbar-header header-user-dropdown navbar-toggle left" style="width: 90px; padding: 0; margin-left: 1px;">
                            <div class="header-limiter">
				<div class="header-user-menu user">
                                    <img src="<?php echo $picture; ?>" alt="User Image"/>

                                        <ul>
                                                <li><a href="#">Profile</a></li>
                                                <li><a href="#" class="highlight logout">Logout</a></li>
                                        </ul>
                                </div>
                            </div>
			</div>
		</div>
		
	</nav>
        </div>
        <?php
            }else{
        ?>
	<nav class="navbar navbar-inverse navbar-fixed-top topbar">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>                        
				</button>
			</div>   
			<div class="single-page-nav sticky-wrapper header-login-signup" id="tmNavbar">
                            <ul class="nav-content nav navbar-nav  header-limiter">
                                    <li><a href="#" class="homebtn">Home</a></li>  
                                    <?php
                                        echo $headercontent;
                                    ?>

                                    <!--<li><a href="#section1">Homepage</a></li>
                                    <li><a href="#section2">About Us</a></li>
                                    <li><a href="#section3">Services</a></li>
                                    <li><a href="#section4">Contact</a></li>-->
                            </ul>
                            <ul class="login-signup-sec nav navbar-nav  header-limiter">
                                    <li class="login-signup">
                                            <li><a class="login-signup-btn" style="font-size:85%;" href="#" id="loginformbtn">Login</a></li>
                                            <li><a class="login-signup-btn" style="font-size:85%;" href="#" type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Sign up</a></li>
                                    </li>
                            </ul>
			</div>
		</div>
		<div class="login">
		  <div class="arrow-up"></div>
		  <div class="formholder">
			<div class="randompad">
			   <fieldset>
                               <?php 
                                    //echo $alert;
                                    
                               ?>
                               <form name="loginform" id="loginform" role="form" method="post" action="">
				 <label>User Name</label>
                                 <input name="email" type="email" required="required" placeholder="shomeone@somthing.com" />
				 <label>Password</label>
				 <input name="password" type="password" required="required" placeholder="password"/>
				 <input id="submitlogin" type="submit" value="Login" />
                               </form>
			   </fieldset>
			</div>
		  </div>
		</div>
	</nav>
        <?php
             }
        ?>
        </div>
    
    
    
    
    

    <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-body" id="regbody">
          <center>
    <div id="w">
        	<div id="page">
			<div id="content-shopregister">
				<div class="content"><br>
				<a href="#" class="slidelink left feature-content-link blue-btn" id="showcustomerregister">&larr; Customer Registration</a><br><br><br>
				<div class="modal-content">
					<div class="modal-header">Register Shop
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                        <form name="shopRegister" id="shopRegister" role="form" action="" method="post" accept-charset="utf-8">
                                                <div class="form-group">
							<label>Email<span style="color:red">*</span></label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                                            <input class="form-control" type="Email" name="txtemail" id="email" required="required" placeholder="Email" value=""/>
                                                        </div>
						</div>

						<div class="form-group">
							<label>Password<span style="color:red">*</span></label>
							<div class="input-group">
                                                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                                            <input class="form-control" type="password" name="txtpassword" id="regpassword" required="required" placeholder="Password"/>
                                                        </div>
                                                </div>

						<div class="form-group">
							<label>Re enter password<span style="color:red">*</span></label>
							<div class="input-group">
                                                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                                            <input class="form-control" type="password" name="txtrepassword" id="repassword" required="required" placeholder="Password"/>
                                                        </div>
                                                </div>
                                                <div class="form-group">
							<label>Select a picture</label>
                                                        <div id="filein">
							<div class="input-group">
                                                            <span class="input-group-addon"><i class="glyphicon glyphicon-picture"></i></span>
                                                            <input class="form-control" type="file" name="file" id="file"/>
                                                        </div>
                                                        <div class="picdiv"><img id="pic" src="" alt="No picture selected"/></div>
                                                        </div>
						</div>


						<div class="form-group">
							<label>Name of the shop<span style="color:red">*</span></label>
                                                        <div class="input-group">
                                                           <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                                                            <input class="form-control" type="text" name="txtshopname" id="shopname" required="required" placeholder="ShopName" value=""/>
                                                        </div>
                                                </div>

						<div class="form-group">
							<label>Owner's Name<span style="color:red">*</span></label>
							<div class="input-group">
                                                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                                            <input class="form-control" type="text" name="txtownername" id="ownername" required="required" placeholder="OwnerName" value=""/>
                                                        </div>
                                                </div>        
						<script>
							var i = 1;
							function addTP(){
								if(i>=1){
									alert("Number of contact numbers are too much !!!");
									return;
								}
								var tp = Array();
								var name = Array();
								for(var j=1;j<=i;j++){
									tp.push(document.getElementById("tpnumber"+j).value);
									name.push(document.getElementById("name"+j).value);
								}
								i++;
								var out="<div class=\"form-inline\"><input class=\"form-control\" type=\"text\" name=\"txttpnumber"+i+"\" id=\"tpnumber"+i+"\" required=\"required\" placeholder=\"TPNumber"+i+"\" maxlength=\"10\"/><label>Name</label><input class=\"form-control\" type=\"text\" name=\"txtname"+i+"\" id=\"name"+i+"\" required=\"required\" placeholder=\"Name\"/></div>";
								document.getElementById("contactnumber").innerHTML += out;
								for(var j=1;j<i;j++){
									if(tp[j-1]!=""){
										document.getElementById("tpnumber"+j).value = tp[j-1];
									}
									if(name[j-1]!=""){
										document.getElementById("name"+j).value = name[j-1];
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
                                                                        <input class="form-control" type="tel" name="txttpnumber1" id="tpnumber1" placeholder="TPNumber1" minlength="10" maxlength="10" value=""/>
                                                                    </div>
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                                                        <input class="form-control" type="text" name="txtname1" id="name1" placeholder="Name" value=""/>
                                                                    </div>
                                                                </div>
							</div>
							<br><br>
						</div>

						<div class="form-group">
							<label>Address<span style="color:red">*</span></label>
							<div class="input-group">
                                                            <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                                                            <textarea class="form-control" name="txtaddress" id="address" required="required" placeholder="Address"></textarea>
                                                        </div>
                                                </div>

						<div class="form-group">
							<label>Fax</label>
							<div class="input-group">
                                                            <span class="input-group-addon"><i class="glyphicon glyphicon-phone-alt"></i></span>
                                                            <input class="form-control" type="tel" name="txtfax" id="fax" placeholder="Fax" minlength="10" maxlength="10" value=""/>
                                                        </div>
                                                </div>

						<div class="form-group">
							<label>About</label>
							<div class="input-group">
                                                            <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign"></i></span>
                                                            <textarea class="form-control" name="txtabout" id="about" placeholder="About"></textarea>
                                                        </div>
                                                </div>    
                            
						<div class="form-inline">
                                                        <input class="btn btn-primary" id="submitshopregister" type="submit" value="Register"/>
                                                        <a class="btn btn-info" onclick="showLogin();">Sign In</a>
						</div>
					</form>
                                            </div>
				</div>
				</div>
			</div><!-- /end #content-shopregister -->
      
      
			<div id="content-customerregister">
				<div class="content"><br>
        		<a href="#" class="slidelink right feature-content-link blue-btn" id="showshopregister">Register Your Shop &rarr;</a><br><br><br>
				<div class="modal-content">
					<div class="modal-header">Register Customer
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Customer registration form starts here-->
                                                <form  name="customerRegister" id="customerRegister" role="form" method="post" action="<?php echo base_url('index.php/welcome/registerCustomer'); ?>" accept-charset="utf-8">


                                                    <div class="form-group">
                                                        <label>Email:<span style="color:red">*</span></label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                                            <input class="form-control" type="email" name="customeremail" id="customeremail" required>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Password:<span style="color:red">*</span></label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                                            <input class="form-control" type="password" name="customerpass" id="customerpass" required>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Confirm Password:<span style="color:red">*</span></label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                                            <input class="form-control" type="password" name="customerconfpass" required id="customerconfpass"><span style="color:red;"></span>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Name:</label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                                            <input type="text" class="form-control" id="customername" name="customername">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>User-Name:<span style="color:red">*</span></label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                                            <input class="form-control" type="text" name="customerusername" id="customerusername" required>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Address:</label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                                                            <input class="form-control" type="text" name="customeraddress" id="customeraddress">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Contact:</label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                                                            <input class="form-control" type="text" name="customertp" id="customertp">
                                                        </div>
                                                    </div>

                                                    <div class="form-inline">
                                                        <input class="btn btn-primary" id="submitregister" type="submit" value="Register"/>
                                                        <a class="btn btn-info" onclick="showLogin();">Sign In</a>
                                                    </div>

                                                    <!-- nds here -->
                                                </form>
                                        </div>
                                	
				</div>
				</div>
			</div><!-- /end #content-cutomerregister -->
			
		</div><!-- /end #page -->
	</div><!-- /end #w -->
        </center>
              </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

</body>
</html>
