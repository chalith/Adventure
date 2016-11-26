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
	<link rel="stylesheet" href="css/home/header-login-signup.css">
        <link rel="stylesheet" href="css/home/registration.css">
        <link rel="stylesheet" href="css/home/header-user-dropdown.css">
        
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
	<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
	<script src="jquery.json-2.4.min.js"></script>
	<script src="http://code.jquery.com/jquery-latest.js"></script>
	<script src="js/home/login.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script>
        $(document).ready(function(){
  $("#shopRegister").submit(function(e) {
    e.preventDefault();
  });
  var ccustomerregister = $("#content-customerregister");
  var cshopregister = $("#content-shopregister");
  
  /* display the shopregister page */
  $("#showshopregister").on("click", function(e){
    e.preventDefault();
    var newheight = cshopregister.height();
    var newwidth = cshopregister.width();
    $(cshopregister).css("display", "block");
    
    $(ccustomerregister).stop().animate({
      "left": "-"+newwidth+"px"
    }, 800, function(){ /* callback */ });
    
    $(cshopregister).stop().animate({
      "left": "0px"
    }, 800, function(){ $(ccustomerregister).css("display", "none"); });
    
    $("#page").stop().animate({
      "height": newheight+"px"
    }, 550, function(){ /* callback */ });
  });
  
  /* display the customerregister page */
  $("#showcustomerregister").on("click", function(e){
    e.preventDefault();
    var newheight = ccustomerregister.height();
    var newwidth = ccustomerregister.width();
	$(ccustomerregister).css("display", "block");
    
    $(ccustomerregister).stop().animate({
      "left": "0px"
    }, 800, function() { /* callback */ });
    $(cshopregister).stop().animate({
      "left": newwidth+"px"
    }, 800, function() { $(cshopregister).css("display", "none"); });
    
    $("#page").stop().animate({
      "height": newheight+"px"
    }, 550, function(){ /* callback */ });
  });
});





function s4() {
    return Math.floor((1 + Math.random()) * 0x10000).toString(16).substring(1);
}
function register(){
    var shopid=email=password=repassword=shopname=ownername=address=fax=about="";
    var tpnumbers;

    var shopid = "shop"+s4()+s4()+'-'+s4()+'-'+s4()+'-'+s4()+'-'+s4()+s4()+s4();

    
    email = document.forms["shopRegister"]["txtemail"].value;
    if(email=="") {alert("Please enter the email"); return;}
    password = document.forms["shopRegister"]["txtpassword"].value;
    if(password=="") {alert("Please enter the password"); return;}
    repassword = document.forms["shopRegister"]["txtrepassword"].value;
    if(repassword=="") {alert("Please enter the password again"); return;}
    shopname = document.forms["shopRegister"]["txtshopname"].value;
    if(shopname=="") {alert("Please enter the shop name"); return;}
    ownername = document.forms["shopRegister"]["txtownername"].value;
    if(ownername=="") {alert("Please enter the ownername"); return;}
    tpnumbers = [];
    for(var i=1;i<6;i++){

        var t = document.forms["shopRegister"]["txttpnumber"+i];

        if(typeof t != 'undefined'){
                var number = document.forms["shopRegister"]["txttpnumber"+i].value;
                var name = document.forms["shopRegister"]["txtname"+i].value;
                if((number!="")||(name!="")){
                    var temp = [number,name];
                    tpnumbers.push(temp);
                }
        }else{
                break;
        }

    }

    address = document.forms["shopRegister"]["txtaddress"].value;
    if(address=="") {alert("Please enter the address"); return;}
    fax = document.forms["shopRegister"]["txtfax"].value;
    about = document.forms["shopRegister"]["txtabout"].value;
    if(about=="") {alert("Please write about your services"); return;}
    if(password!=repassword) {alert("Passwords are missmatch"); return;}
    if(!testUpload()) {return;}
    var obj = {shopid:shopid,shopname:shopname,ownername:ownername,email:email,address:address,fax:fax,about:about,tpnumbers:tpnumbers,picture:"img/4-2.jpg",password:password};
    //alert();
    addshop(obj);

    //var data = JSON.parse(text);
    
}
function login(){
    email = document.forms["loginform"]["email"].value;
    if(email=="") {alert("Please enter the email"); return;}
    password = document.forms["loginform"]["password"].value;
    if(password=="") {alert("Please enter the password"); return;}
    var obj = {email:email,password:password};
    log(obj);
}
function log(obj){
    
    jQuery.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>" + "index.php/login_controller/log_in",
        dataType: 'json',
        data: obj,
        success: function(res) {

            if (res)
            {
                if(res.alert=="true"){
                    //loadHeader();
                    location.reload();
                    clearlogin();
                }
                else{
                    alert(res.alert);
                }
            }
        }

    });
}
function clearlogin(){
    document.forms["loginform"]["email"].value="";
    document.forms["loginform"]["password"].value="";
}
function loadHeader(){
//alert();
    //var tmp = document.getElementById("userheader").innerHTML;
    
    //document.getElementById("headernav").innerHTML = tmp;
}
function logout(){
    
    jQuery.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>" + "index.php/login_controller/log_out",
        success: function(res) {
            location.reload();
        }

    });
}

function addshop(obj){
    
    var ret=confirm("Do you want to register");
    if(ret==true){
        jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "index.php/register_controller/shop_register",
            dataType: 'json',
            data: obj,
            success: function(res) {

                if (res)
                {
                    alert(res.alert);
                    jQuery.ajax({
                        url: "<?php echo base_url(); ?>" + "index.php/register_controller/picture_upload",
                        type: "POST",             // Type of request to be send, called as method
                        data: new FormData(document.getElementById("shopRegister")), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                        contentType: false,       // The content type used when sending data to the server.
                        cache: false,             // To unable request pages to be cached
                        processData:false,
                        success: function(res) {

                            if (res)
                            {
                                alert(res);
                                clear();
                                location.reload();
                            }
                        }
                    });
                }
            }
            
        });
    }
    
}
function clear(){
    document.forms["shopRegister"]["txtpassword"].value="";
    document.forms["shopRegister"]["txtrepassword"].value="";
    document.forms["shopRegister"]["txtshopname"].value="";
    document.forms["shopRegister"]["txtownername"].value="";
    document.forms["shopRegister"]["txtemail"].value="";
    document.forms["shopRegister"]["txtaddress"].value="";
    document.forms["shopRegister"]["txtfax"].value="";
    document.forms["shopRegister"]["txtabout"].value="";
    //document.forms["shopRegister"]["file"].value="";
    document.getElementById("filein").innerHTML="<input class=\"form-control\" type=\"file\" name=\"file\" id=\"file\"/><img id=\"pic\" src=\"\" style=\"width: 50%;\"/>";
    for(var i=1;i<6;i++){

        var t = document.forms["shopRegister"]["txttpnumber"+i];

        if(typeof t != 'undefined'){
                document.forms["shopRegister"]["txttpnumber"+i].value="";
                document.forms["shopRegister"]["txtname"+i].value="";
        }else{
                break;
        }

    }
}
$(document).ready(function() {
    $("#submitregister").click(function(event) {
        event.preventDefault();
        register();
    });
    $("#submitlogin").click(function(event) {
        event.preventDefault();
        login();
    });
    var t = document.getElementById("txttpnumber");
    if(typeof t != 'undefined'){
   
        $(".logout").click(function(event) {
            event.preventDefault();
            logout();
        });
    }    
    $('#file').on("change",function(){
        var path = document.getElementById("file");
        readURL(path,"pic");
    });
	
});
function testUpload(){
	var path = document.getElementById("file");
	var extention = path.value.split(".").pop();
	if(path.value == ""){
		setError(path);
		showalert("Please select an image");
		return false;
	}
	else if(!((extention=="jpg")||(extention=="jpeg")||(extention=="bmp")||(extention=="gif")||(extention=="png"))){
		setError(path);
		showalert("Invalid file format");
		return false;
	}
	return true;
}

function readURL(input,imgtg) {
    
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#'+imgtg).attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}


$(document).ready(function(){

        var userMenu = $('.header-user-dropdown .header-user-menu');

        userMenu.on('touchend', function(e){

                userMenu.addClass('show');

                e.preventDefault();
                e.stopPropagation();

        });

        // This code makes the user dropdown work on mobile devices

        $(document).on('touchend', function(e){

                // If the page is touched anywhere outside the user menu, close it
                userMenu.removeClass('show');

        });

});
</script>

        </script>
</head>
<body>
    <div id="headernav">
            <?php
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
				<ul class="nav navbar-nav  header-limiter">
					<li><a href="#section1">Homepage</a></li>
					<li><a href="#section2">About Us</a></li>
					<li><a href="#section3">Services</a></li>
					<li><a href="#section4">Contact</a></li>
					<li><a href="http://www.facebook.com/templatemo" class="external" target="_blank">External</a></li>
					<li>
						<div class="header-user-menu user">
                                                    <img src="<?php echo $picture; ?>" alt="User Image"/>

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
				<ul class="nav navbar-nav  header-limiter">
					<li><a href="#section1">Homepage</a></li>
					<li><a href="#section2">About Us</a></li>
					<li><a href="#section3">Services</a></li>
					<li><a href="#section4">Contact</a></li>
					<li><a href="http://www.facebook.com/templatemo" class="external" target="_blank">External</a></li>
					<li class="login-signup">
						<li><a class="login-signup-btn" style="font-size:100%;" href="#" id="loginform">Login</a></li>
                                                <li><a class="login-signup-btn" style="font-size:100%;" href="#" type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Sign up</a></li>
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
                                    echo $alert;
                                    
                               ?>
                               <form name="loginform" id="loginform" role="form" method="post" action="<?php echo site_url('login_controller/log_in'); ?>">
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
                                        <form name="shopRegister" id="shopRegister" role="form" action="<?php echo site_url('shop_register/register'); ?>" method="post" accept-charset="utf-8">
                                                <div class="form-group">
							<label>Email</label>
							<input class="form-control" type="Email" name="txtemail" id="email" required="required" placeholder="Email" value=""/>
						</div>

						<div class="form-group">
							<label>Password</label>
							<input class="form-control" type="password" name="txtpassword" id="regpassword" required="required" placeholder="Password"/>
						</div>

						<div class="form-group">
							<label>Re enter password</label>
							<input class="form-control" type="password" name="txtrepassword" id="repassword" required="required" placeholder="Password"/>
						</div>
                                                <div class="form-group">
							<label>Select a picture</label>
                                                        <div id="filein">
							<input class="form-control" type="file" name="file" id="file"/>
                                                        <div class="picdiv"><img id="pic" src="" alt="No picture selected"/></div>
                                                        </div>
						</div>


						<div class="form-group">
							<label>Name of the shop</label>
							<input class="form-control" type="text" name="txtshopname" id="shopname" required="required" placeholder="ShopName" value=""/>
						</div>

						<div class="form-group">
							<label>Owner's Name</label>
							<input class="form-control" type="text" name="txtownername" id="ownername" required="required" placeholder="OwnerName" value=""/>
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
								<input class="form-control" type="text" name="txttpnumber1" id="tpnumber1" required="required" placeholder="TPNumber1" minlength="10" maxlength="10" value=""/>
								
								<input class="form-control" type="text" name="txtname1" id="name1" required="required" placeholder="Name" value=""/>
								</div>
							</div>
							<br><br>
						</div>

						<div class="form-group">
							<label>Address</label>
							<textarea class="form-control" name="txtaddress" id="address" required="required" placeholder="Address"></textarea>
						</div>

						<div class="form-group">
							<label>Fax</label>
							<input class="form-control" type="text" name="txtfax" id="fax" required="required" placeholder="Fax" maxlength="10" value=""/>
						</div>

						<div class="form-group">
							<label>About</label>
							<textarea class="form-control" name="txtabout" id="about" placeholder="About"></textarea>
						</div>

						<div class="form-inline">
                                                        <input class="btn btn-primary" id="submitregister" type="submit" value="Register"/>
                                                        <a class="btn btn-info" onclick="showLogin();">Sign In</a>
							<script>
								function showLogin(){
									$('.login').fadeToggle('slow');
									$(this).toggleClass('green');
									var container = $(".registration");
									container.hide();
									$('#frontpagebody').css('opacity','1');
									$('#registrationform').removeClass('green');
								}
							</script>
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
                                            <form name="customerRegister" id="customerRegister" role="form" method="post" accept-charset="utf-8">
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
