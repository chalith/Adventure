function s4() {
    return Math.floor((1 + Math.random()) * 0x10000).toString(16).substring(1);
}
function register(){
    var shopid=email=password=repassword=shopname=ownername=address=fax=about="";
    var tpnumbers;

    var shopid = "shop"+s4()+s4()+'-'+s4()+'-'+s4()+'-'+s4()+'-'+s4()+s4()+s4();

    email = document.forms["shopRegister"]["txtemail"].value;
    if(email=="") return;
    password = document.forms["shopRegister"]["txtpassword"].value;
    if(password=="") return;
    repassword = document.forms["shopRegister"]["txtrepassword"].value;
    if(repassword=="") return;
    shopname = document.forms["shopRegister"]["txtshopname"].value;
    if(shopname=="") return;
    ownername = document.forms["shopRegister"]["txtownername"].value;
    if(ownername=="") return;
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
    for(var i=0;i<tpnumbers.length;i++){
        var n=tpnumbers[i][0];
        if((n.length!=10)||(n.isNaN)) { alert("Telephone number is invalid"); return;}        
    }
    address = document.forms["shopRegister"]["txtaddress"].value;
    if(address=="") return;
    fax = document.forms["shopRegister"]["txtfax"].value;
    if(fax!=""){
        if((fax.length!=10)||(fax.isNaN)) { alert("Fax number is invalid"); return;}
    }
    about = document.forms["shopRegister"]["txtabout"].value;
    //if(about=="") {alert("Please write about your services"); return;}
    if(!validateEmail(email)) return;
    if(password!=repassword) {alert("Passwords are missmatch"); return;}
    //if(!testUpload()) {return;}
    var obj = {shopid:shopid,shopname:shopname,ownername:ownername,email:email,address:address,fax:fax,about:about,tpnumbers:tpnumbers,picture:"img/shop/cover/noimg.png",password:password};
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
                    alert(res.alert.msg);
                    var path = document.getElementById("file");
                    if(res.alert.bool&&(path.value!="")){
                        //alert(res.alert);
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
                                }
                            }
                        });
                    }
                    if(res.alert.bool){
                        location.reload();
                    }
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
function testUpload(){
	var path = document.getElementById("file");
	var extention = path.value.split(".").pop();
	/*if(path.value == ""){
		setError(path);
		showalert("Please select an image");
		return false;
	}
	else */if(!((extention=="jpg")||(extention=="jpeg")||(extention=="bmp")||(extention=="gif")||(extention=="png"))){
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
        $('.homebtn').on('click',function (){
            window.location="<?php echo base_url(); ?>";
        });
        
        $('#loginformbtn').click(function(){
          $('.login').fadeToggle('slow');
          $(this).toggleClass('activebtn');
        });
        $(document).mouseup(function (e)
        {
                var container = $(".login");

                if (!container.is(e.target) // if the target of the click isn't the container...
                        && container.has(e.target).length === 0) // ... nor a descendant of the container
                {
                        container.hide();
                        $('#loginformbtn').removeClass('activebtn');
                }
        });
        $('input[type="submit"]').mousedown(function(){
            $(this).css('background', '#2ecc71');
          });
          $('input[type="submit"]').mouseup(function(){
            $(this).css('background', '#1abc9c');
          });
        $("#submitshopregister").click(function(event) {
        //event.preventDefault();
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

function showLogin(){
        $('.login').fadeToggle('slow');
        $(this).toggleClass('green');
        var container = $(".registration");
        container.hide();
        $('#frontpagebody').css('opacity','1');
        $('#registrationform').removeClass('green');
}