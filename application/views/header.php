<html>
    <?php
    $this->load->helper('url');
    //$this->load->view('registration');
    $headercontent = "";
    foreach ($_SESSION["headercontent"] as $ob) {
        $headercontent = $headercontent . $ob;
    }
    $email = $id = $person = $picture = "";

    //session_start();


    if (isset($_SESSION['email'])) {
        $email = $_SESSION['email'];
        $id = $_SESSION['id'];
        $person = $_SESSION['person'];
        $picture = $_SESSION['picture'];
    }
            
    ?>

    <head>
        <title>FindYourRaft</title>
        <?php include 'styles.php'; ?>
        <script>
            function s4() {
                return Math.floor((1 + Math.random()) * 0x10000).toString(16).substring(1);
            }
            function register() {
                var shopid = email = password = repassword = shopname = ownername = address = fax = about = "";
                var tpnumbers;

                var shopid = "shop" + s4() + s4() + '-' + s4() + '-' + s4() + '-' + s4() + '-' + s4() + s4() + s4();

                email = document.forms["shopRegister"]["txtemail"].value;
                if (email == "")
                    return;
                password = document.forms["shopRegister"]["txtpassword"].value;
                if (password == "")
                    return;
                repassword = document.forms["shopRegister"]["txtrepassword"].value;
                if (repassword == "")
                    return;
                shopname = document.forms["shopRegister"]["txtshopname"].value;
                if (shopname == "")
                    return;
                ownername = document.forms["shopRegister"]["txtownername"].value;
                if (ownername == "")
                    return;
                tpnumbers = [];
                for (var i = 1; i < 6; i++) {

                    var t = document.forms["shopRegister"]["txttpnumber" + i];

                    if (typeof t != 'undefined') {
                        var number = document.forms["shopRegister"]["txttpnumber" + i].value.trim();
                        var name = document.forms["shopRegister"]["txtname" + i].value;
                        if ((number != "") || (name != "")) {
                            var temp = [number, name];
                            tpnumbers.push(temp);
                        }
                    } else {
                        break;
                    }

                }
                for (var i = 0; i < tpnumbers.length; i++) {
                    var n = tpnumbers[i][0];
                    if ((n.length != 10) || (n.isNaN)) {
                        alert("Telephone number is invalid");
                        return;
                    }
                }
                address = document.forms["shopRegister"]["txtaddress"].value;
                if (address == "")
                    return;
                fax = document.forms["shopRegister"]["txtfax"].value.trim();
                if (fax != "") {
                    if ((fax.length != 10) || (fax.isNaN)) {
                        alert("Fax number is invalid");
                        return;
                    }
                }
                about = document.forms["shopRegister"]["txtabout"].value;
                //if(about=="") {alert("Please write about your services"); return;}
                if (!validateEmail(email))
                    return;
                if (password != repassword) {
                    alert("Passwords are missmatch");
                    return;
                }
                //if(!testUpload()) {return;}
                var obj = {shopid: shopid, shopname: shopname, ownername: ownername, email: email, address: address, fax: fax, about: about, tpnumbers: tpnumbers, picture: "img/shop/cover/noimg.png", password: password};
                //alert();
                addshop(obj);

                //var data = JSON.parse(text);

            }
            function login() {
                email = document.forms["loginform"]["email"].value;
                if (email == "")
                    return;
                password = document.forms["loginform"]["password"].value;
                if (password == "")
                    return;
                var obj = {email: email, password: password};
                log(obj);
            }
            function log(obj) {
                jQuery.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>" + "index.php/login_controller/log_in",
                    dataType: 'json',
                    data: obj,
                    success: function (res) {
                        if (res)
                        {
                            if (res.alert == "true") {
                                //loadHeader();
                                location.reload();
                                clearlogin();
                            } else {
                                alert(res.alert);
                            }
                        }
                    }
                });
            }
            function clearlogin() {
                document.forms["loginform"]["email"].value = "";
                document.forms["loginform"]["password"].value = "";
            }
            function loadHeader() {
                //alert();
                //var tmp = document.getElementById("userheader").innerHTML;

                //document.getElementById("headernav").innerHTML = tmp;
            }
            function logout() {

                jQuery.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>" + "index.php/login_controller/log_out",
                    success: function (res) {
                        location.reload();
                    }

                });
            }

            function addshop(obj) {

                var ret = confirm("Do you want to register");
                if (ret == true) {
                    jQuery.ajax({
                        type: "POST",
                        url: "<?php echo base_url(); ?>" + "index.php/register_controller/shop_register",
                        dataType: 'json',
                        data: obj,
                        success: function (res) {

                            if (res)
                            {
                                alert(res.alert.msg);
                                var path = document.getElementById("file").files.length;
                                if (res.alert.bool && (path != 0)) {
                                    //alert(res.alert);
                                    jQuery.ajax({
                                        url: "<?php echo base_url(); ?>" + "index.php/register_controller/picture_upload/file/provider/r",
                                        type: "POST", // Type of request to be send, called as method
                                        data: new FormData(document.getElementById("shopRegister")), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                                        contentType: false, // The content type used when sending data to the server.
                                        cache: false, // To unable request pages to be cached
                                        processData: false,
                                        success: function (res) {

                                            if (res)
                                            {
                                                alert(res);
                                                location.reload();
                                            }
                                        },
                                        error: function (jqXHR, textStatus, errorThrown) {
                                            alert(jqXHR.responseText);
                                        }
                                    });
                                } else {
                                    location.reload();
                                }
                            }
                        }

                    });
                }

            }
            /*function clear() {
             document.forms["shopRegister"]["txtpassword"].value = "";
             document.forms["shopRegister"]["txtrepassword"].value = "";
             document.forms["shopRegister"]["txtshopname"].value = "";
             document.forms["shopRegister"]["txtownername"].value = "";
             document.forms["shopRegister"]["txtemail"].value = "";
             document.forms["shopRegister"]["txtaddress"].value = "";
             document.forms["shopRegister"]["txtfax"].value = "";
             document.forms["shopRegister"]["txtabout"].value = "";
             //document.forms["shopRegister"]["file"].value="";
             document.getElementById("filein").innerHTML = "<div class=\"input-group\"><span class=\"input-group-addon\"><i class=\"glyphicon glyphicon-picture\"></i></span><input class=\"form-control\" type=\"file\" name=\"file\" id=\"file\"/></div><div class=\"picdiv\"><img id=\"pic\" src=\"\" alt=\"No picture selected\"/></div>";
             for (var i = 1; i < 6; i++) {
             
             var t = document.forms["shopRegister"]["txttpnumber" + i];
             
             if (typeof t != 'undefined') {
             document.forms["shopRegister"]["txttpnumber" + i].value = "";
             document.forms["shopRegister"]["txtname" + i].value = "";
             } else {
             break;
             }
             
             }
             }
             function cusclear() {
             document.forms["customerRegister"]["customeremail"].value = "";
             document.forms["customerRegister"]["customerpass"].value = "";
             document.forms["customerRegister"]["customerconfpass"].value = "";
             document.forms["customerRegister"]["customername"].value = "";
             document.forms["customerRegister"]["customeraddress"].value = "";
             document.forms["customerRegister"]["customertp"].value = "";
             document.getElementById("cusfilein").innerHTML = "<div class=\"input-group\"><span class=\"input-group-addon\"><i class=\"glyphicon glyphicon-picture\"></i></span><input class=\"form-control\" type=\"file\" name=\"customerpic\" id=\"customerpic\"/></div><div class=\"picdiv\"><img id=\"cuspic\" src=\"\" alt=\"No picture selected\"/></div>";
             }*/
            function testUpload() {
                var path = document.getElementById("file");
                var extention = path.value.split(".").pop();
                /*if(path.value == ""){
                 setError(path);
                 showalert("Please select an image");
                 return false;
                 }
                 else */if (!((extention == "jpg") || (extention == "jpeg") || (extention == "bmp") || (extention == "gif") || (extention == "png"))) {
                    setError(path);
                    showalert("Invalid file format");
                    return false;
                }
                return true;
            }

            function readURL(input, imgtg) {

                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#' + imgtg).attr('src', e.target.result);
                    };

                    reader.readAsDataURL(input.files[0]);
                }
            }

            $(window).load(function () {
                getMsgCount("");
                getNotifyCount();
                setAllCount();
                loadNotifications();
            });


            $(document).ready(function () {
                setInterval("getMsgCount(\"\");", 500);
                setInterval("getNotifyCount();", 500);
                setInterval("setAllCount();", 500);
                setInterval("loadNotifications();", 3000);
                var userMenu = $('.header-user-dropdown .header-user-menu');

                userMenu.on('touchend', function (e) {

                    userMenu.addClass('show');

                    e.preventDefault();
                    e.stopPropagation();

                });

                // This code makes the user dropdown work on mobile devices

                $(document).on('touchend', function (e) {

                    // If the page is touched anywhere outside the user menu, close it
                    userMenu.removeClass('show');

                });
                $('.homebtn').on('click', function () {
                    
                    window.location = "<?php echo base_url(); ?>";
                });
                
                $('.profile').on('click', function () {
                    window.location = "<?php echo base_url(); ?>"+ "index.php/welcome/getShopProfileView/<?php echo $id; ?>";
                });
                $('#loginformbtn').click(function () {
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
                $('input[type="submit"]').mousedown(function () {
                    $(this).css('background', '#2ecc71');
                });
                $('input[type="submit"]').mouseup(function () {
                    $(this).css('background', '#1abc9c');
                });
                $("#submitshopregister").click(function (event) {
                    //event.preventDefault();
                    register();
                });
                $("#submitlogin").click(function (event) {
                    login();
                });
                $("#loginform").submit(function (e) {
                    e.preventDefault();
                });
                $("#customerRegister").submit(function (e) {
                    e.preventDefault();
                });

                var t = document.getElementById("txttpnumber");
                if (typeof t != 'undefined') {

                    $(".logout").click(function (event) {
                        event.preventDefault();
                        logout();
                    });
                }
                $('#file').on("change", function () {
                    var path = document.getElementById("file");
                    readURL(path, "pic");
                });
                $('#customerpic').on("change", function () {
                    var path = document.getElementById("customerpic");
                    readURL(path, "cuspic");
                });





                $("#shopRegister").submit(function (e) {
                    e.preventDefault();
                });
                var ccustomerregister = $("#content-customerregister");
                var cshopregister = $("#content-shopregister");

                /* display the shopregister page */
                $("#showshopregister").on("click", function (e) {
                    var newheight = cshopregister.height();
                    var newwidth = cshopregister.width();
                    $(cshopregister).css("display", "block");

                    $(ccustomerregister).stop().animate({
                        "left": "-" + newwidth + "px"
                    }, 800, function () { /* callback */
                    });

                    $(cshopregister).stop().animate({
                        "left": "0px"
                    }, 800, function () {
                        $(ccustomerregister).css("display", "none");
                    });

                    $("#page").stop().animate({
                        "height": newheight + "px"
                    }, 550, function () { /* callback */
                    });
                });

                /* display the customerregister page */
                $("#showcustomerregister").on("click", function (e) {
                    e.preventDefault();
                    var newheight = ccustomerregister.height();
                    var newwidth = ccustomerregister.width();
                    $(ccustomerregister).css("display", "block");

                    $(ccustomerregister).stop().animate({
                        "left": "0px"
                    }, 800, function () { /* callback */
                    });
                    $(cshopregister).stop().animate({
                        "left": newwidth + "px"
                    }, 800, function () {
                        $(cshopregister).css("display", "none");
                    });

                    $("#page").stop().animate({
                        "height": newheight + "px"
                    }, 550, function () { /* callback */
                    });
                });


//                onclick edit customer details
                var ccustprofile = $("#content-editcustprofile");
                var ccustpass = $("#content-editcustpass");

                /* display the password reset page */
                $("#showeditcustpass").on("click", function (e) {
                    var newheight = ccustpass.height();
                    var newwidth = ccustpass.width();
                    $(ccustpass).css("display", "block");

                    $(ccustprofile).stop().animate({
                        "left": "-" + newwidth + "px"
                    }, 800, function () { /* callback */
                    });

                    $(ccustpass).stop().animate({
                        "left": "0px"
                    }, 800, function () {
                        $(ccustprofile).css("display", "none");
                    });

                    $("#page2").stop().animate({
                        "height": newheight + "px"
                    }, 550, function () { /* callback */
                    });
                });

                /* display the reset profile details page */
                $("#showeditcustprofile").on("click", function (e) {
                    e.preventDefault();
                    var newheight = ccustprofile.height();
                    var newwidth = ccustprofile.width();
                    $(ccustprofile).css("display", "block");

                    $(ccustprofile).stop().animate({
                        "left": "0px"
                    }, 800, function () { /* callback */
                    });
                    $(ccustpass).stop().animate({
                        "left": newwidth + "px"
                    }, 800, function () {
                        $(ccustpass).css("display", "none");
                    });

                    $("#page2").stop().animate({
                        "height": newheight + "px"
                    }, 550, function () { /* callback */
                    });
                });

            });
            function showLogin() {
                $('.login').fadeToggle('slow');
                $(this).toggleClass('green');
                var container = $(".registration");
                container.hide();
                $('#frontpagebody').css('opacity', '1');
                $('#registrationform').removeClass('green');
            }
            //Register Customer
            function registercustomer() {
                var custid = custemail = custpass = custconfpass = custname = custaddress = custtp = custcontact = "";
                custid = "customer" + s4() + s4() + '-' + s4() + '-' + s4() + '-' + s4() + '-' + s4() + s4() + s4();

                custemail = document.forms["customerRegister"]["customeremail"].value;
                if (custemail == "")
                    return;

                custpass = document.forms["customerRegister"]["customerpass"].value;
                if (custpass == "")
                    return;
                custconfpass = document.forms["customerRegister"]["customerconfpass"].value;
                if (custconfpass == "")
                    return;

                custname = document.forms["customerRegister"]["customername"].value;
                custaddress = document.forms["customerRegister"]["customeraddress"].value;
                custtp = document.forms["customerRegister"]["customertp"].value.trim();

                if (custtp && (custtp.trim().length != 10 || custtp.isNaN)) {
                    alert("Invalid Phone Number!");
                    return;
                }

                if (custpass != custconfpass) {
                    alert("Passwords Mismatch!");
                    return;
                }
                var obj = {custid: custid, custname: custname, custemail: custemail, custaddress: custaddress, custtp: custtp, cuspic: "img/customer/cover/noimg.png", custpass: custpass};
                addcustomer(obj);

            }

            function addcustomer(obj) {

                var ret = confirm("Do you want to register");

                if (ret === true) {
                    //alert("inside ret");
                    jQuery.ajax({
                        type: "POST",
                        url: "<?php echo base_url(); ?>" + "index.php/register_controller/registerCustomer",
                        dataType: "json",
                        data: obj,
                        success: function (res) {
                            alert(res.alert.msg);
                            var path = document.getElementById("customerpic").files.length;
                            if (res.alert.bool && (path != 0)) {
                                jQuery.ajax({
                                    url: "<?php echo base_url(); ?>" + "index.php/register_controller/picture_upload/customerpic/customer/r",
                                    type: "POST", // Type of request to be send, called as method
                                    data: new FormData(document.getElementById("customerRegister")), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                                    contentType: false, // The content type used when sending data to the server.
                                    cache: false, // To unable request pages to be cached
                                    processData: false,
                                    success: function (res) {
                                        if (res)
                                        {
                                            alert(res);
                                            location.reload();
                                        }
                                    },
                                    error: function (jqXHR, textStatus, errorThrown) {
                                        alert(jqXHR.responseText);
                                    }
                                });
                            } else {
                                location.reload();
                            }
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            alert(jqXHR.responseText);
                        }


                    });
                    console.log("saddd");
                }

            }
            //Customer registration ends here
            function loadNotifications() {
                jQuery.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>" + "index.php/notification_controller/get_Notifications",
                    dataType: 'json',
                    success: function (res) {
                        var notification = "";

                        for (var i = 0; i < res.length; i++) {
                            notification += "<div class=\"panel col-md-15 notification\">" +
                            "<div class=\"media-body\">"+
                            "<b>" + res[i].name + "</b><h5  class=\"media-heading\">" + "Special Offers" + "</h5>" +
                            "<small > " + res[i].notification + "</small>";
                            if(res[i].type==="Reservation"){
                                notification += "<button id=" + res[i].id + " class=\"btn setview btn-danger\" onclick=\"delete"+res[i].type+"();\">Delete</button>";
                            }
                            notification += "<button id=" + res[i].id + " class=\"btn setview btn-primary\" onclick=\"set"+res[i].type+"Viewed();\">Set as read</button>"+
                            "</div>" +
                            "</div>";
                        }
                        document.getElementById("notifications").innerHTML = notification;
                    }
                });
            }
            function setReviewedReservationViewed(){
                setViewed(event.target.id,"reviewedreservation");
            }
            function setNotificationViewed(){
                setViewed(event.target.id,"notification");
            }
            function setReservationViewed(){
                setAccepted(event.target.id,"notification");
            }
            function deleteReviewedReservation(){
                deleteNotfy(event.target.id,"reviewedreservation");
            }
            function deleteNotification(){
                deleteNotfy(event.target.id,"notifications");
            }
            function deleteReservation(){
                deleteNotfy(event.target.id,"reservations");
            }
            function setViewed(curid,which) {
                jQuery.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>" + "index.php/notification_controller/set_Viewed/" + curid + "/" + which,
                    dataType: 'json',
                    success: function (res){
                        //alert(res);
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        //alert(jqXHR.responseText);
                    }
                });
                loadNotifications();
                getNotifyCount();
                setAllCount();

            }
            function setViewed(curid,which) {
                jQuery.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>" + "index.php/notification_controller/set_Viewed/" + curid + "/" + which,
                    dataType: 'json',
                    success: function (res){
                        //alert(res);
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        //alert(jqXHR.responseText);
                    }
                });
                loadNotifications();
                getNotifyCount();
                setAllCount();

            }
            function deleteNotfy(curid,which) {
                jQuery.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>" + "index.php/notification_controller/delete_Notify/" + curid + "/" + which,
                    dataType: 'json',
                    success: function (res){
                        //alert(res);
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        //alert(jqXHR.responseText);
                    }
                });
                loadNotifications();
                getNotifyCount();
                setAllCount();

            }
            function setAccepted(curid,which) {
                jQuery.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>" + "index.php/notification_controller/set_Accepted/" + curid + "/" + which,
                    dataType: 'json',
                    success: function (res){
                        //alert(res);
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        //alert(jqXHR.responseText);
                    }
                });
                loadNotifications();
                getNotifyCount();
                setAllCount();

            }
            var msgcount = 0;
            var notifycount = 0;
            function getMsgCount(sid) {
                jQuery.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>" + "index.php/message_controller/get_ReceivedMsgCount/" + sid,
                    dataType: 'json',
                    success: function (res) {
                        msgcount = res.count;
                        //if(msgcount!="0")
                        $(".msgcount").html(res.count);
                    }
                });
            }
            function getNotifyCount() {
                jQuery.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>" + "index.php/notification_controller/get_NotificationCount",
                    dataType: 'json',
                    success: function (res) {
                        //if(res.count!="0"){
                        $(".notifycount").html(res.count);
                        //}
                        notifycount = res.count;
                    }
                });
            }
            function setAllCount() {
                var allcount = parseInt(msgcount) + parseInt(notifycount);
                if (allcount !== 0) {
                    $(".allcount").html(allcount);
                } else {
                    $(".allcount").html("");
                }
            }

            // onclick methhod to edit customer profile details
            function editcustomer() {
                var custresetname = custresetaddress = custresettp = "";

                custresetname = document.forms["custdetailsreset"]["custresetname"].value;
                if (custresetname == "")
                    return;


                custresetaddress = document.forms["custdetailsreset"]["custresetaddress"].value;
                if (custresetaddress == "")
                    return;

                custresettp = document.forms["custdetailsreset"]["custresettp"].value.trim();
                if ((custresettp!="")&&(custresettp.trim().length != 10 || custresettp.isNaN)) {
                    alert("Invalid Phone Number!");
                    return;
                }

                var obj = {custresetname: custresetname, custresetaddress: custresetaddress, custresettp: custresettp};
                updatecustomer(obj);

            }

            function updatecustomer(obj) {

                var ret = confirm("Do you want to save changes?");

                if (ret === true) {
                    //alert("inside ret");
                    jQuery.ajax({
                        type: "POST",
                        url: "<?php echo base_url(); ?>" + "index.php/register_controller/editCustomer",
                        dataType: "json",
                        data: obj,
                        success: function (res) {
                            alert(res.alert.msg);
                            var path = document.getElementById("custresetpic").files.length;
                                
                            if (res.alert.bool && (path != 0)) {
                                jQuery.ajax({
                                    url: "<?php echo base_url(); ?>" + "index.php/register_controller/picture_upload/custresetpic/customer/e",
                                    type: "POST", // Type of request to be send, called as method
                                    data: new FormData(document.getElementById("custdetailsreset")), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                                    contentType: false, // The content type used when sending data to the server.
                                    cache: false, // To unable request pages to be cached
                                    processData: false,
                                    success: function (res) {
                                        if (res)
                                        {
                                            alert(res);
                                            //claercus();
                                        }
                                    }
                                });
                            }
                            if (res.alert.bool) {
                                location.reload();
                            }
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            alert(jqXHR.responseText);
                        }



                    });
                    console.log("saddd");
                }
            }


            //onclick method to reset customer passwords
            function editcustomerpassword() {
                var resetoldpass = resetnewpass = resetconfnewpass = "";
                alert("1");
                resetoldpass = document.forms["custpasswordreset"]["custpassresetoldpass"].value;
                if (resetoldpass == "")
                    return;

                resetnewpass = document.forms["custpasswordreset"]["custpassresetnewpass"].value;
                if (resetnewpass == "")
                    return;

                resetconfnewpass = document.forms["custpasswordreset"]["custpassresetconfpass"].value;
                if (resetconfnewpass == "")
                    return;


                if (resetnewpass !== resetconfnewpass) {
                    alert("Passwords Mismatch!");
                    resturn;
                }
                alert(resetnewpass);
                alert(resetoldpass);
                var obj = {resetoldpass: resetoldpass, resetnewpass: resetnewpass};
                resetpasswords(obj);

            }


            function resetpasswords(obj) {
                var ret = alert("Do you want to save the changes?");

                if (ret === true) {
                    jQuery.ajax({
                        type: "POST",
                        url: "<?php echo base_url(); ?>" + "index.php/register_controller/changeCustomerPassword",
                        dataType: "json",
                        data: obj,
                        success: function (res) {
                            alert(res.alert.msg);

                            if (res.alert.bool) {
                                location.reload();
                            }
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            alert(jqXHR.responseText);
                            location.reload();
                        }
                    });
                    console.log("sad");

                }
            }
//            
//            function deleteAccount(){
//             var ret = confirm("Do you want to delete you account?");
//
//                if (ret === true) {
//                    //alert("inside ret");
//                    jQuery.ajax({
//                        type: "POST",
//                        url: "<?php echo base_url(); ?>" + "index.php/register_controller/deleteCustomerAccount",
//                        dataType: "json",
//                        
//                        success: function (res) {
//                            alert("You are no longer registered in the system");
//                        }
//                    });
//            }
        </script>
    </head>
    <?php
    include 'message.php';
    ?>

    <!--    Edit Customer Details form-->
    <div id="myModalmessage" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Message</h4>
                </div>
                <div class="modal-body" >
                    <?php
                    include 'message.php';
                    ?>
                </div>
            </div>

        </div>
    </div>
    <div id="myModalnotify" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Notifications</h4>
                </div>
                <div class="modal-body">
                    <div class="" id="notifications">
                        

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
    
    <?php
        if ($person == "customer") {
    ?>
    <script>
        jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "index.php/Customer_controller/getCustomer/<?php echo $id ?>",
            dataType: 'json',
            success: function (res){
                $("#custresetemail").val(res.email);
                $("#custresetname").val(res.name);
                $("#custresetaddress").val(res.address);
                $("#custresettp").val(res.telephone);
                $("#custnewpic").attr("src",res.picture);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                //alert(jqXHR.responseText);
            }
        });
    </script>
    <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
                
            <!--            Modal content-->
            <div class="modal-content">
                <div class="modal-body" id="regbody">
                    <center>
                        <div class="w" id="w">
                            <div class="page" id="page2">
                                <div class="animated-modal-1" id="content-editcustprofile">
                                    <div class="content"><br>
                                        <a href="#" class="slidelink right feature-content-link blue-btn" id="showeditcustpass"> Reset Password &rarr;</a><br><br><br>
                                        <div class="modal-content">
                                            <div class="modal-header">Edit Personal Details
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <div class="modal-body">
                                                <center>
                                                    <form name="custdetailsreset" id="custdetailsreset" role="form" method="post" action="">
                                                        <input type="hidden" class="form-control" required="required" id="custresetemail" name="custresetemail" placeholder="Name" value="" >
                                                        <div class="form-group">
                                                            <label>Reset Name:</label>
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                                                <input type="text" class="form-control" required="required" id="custresetname" name="custresetname" placeholder="Name" value="" >
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Reset Address:</label>
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                                                                <input class="form-control" type="text" required="required" name="custresetaddress" id="custresetaddress" placeholder="Address" >
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Reset Contact:</label>
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                                                                <input class="form-control" type="text" required="required" name="custresettp" id="custresettp" minlength="10" maxlength="10" placeholder="TPNumber" ">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Select a picture</label>
                                                            <div id="custresetfilein">
                                                                <div class="input-group">
                                                                    <span class="input-group-addon"><i class="glyphicon glyphicon-picture"></i></span>
                                                                    <input class="form-control" type="file" required="required" name="custresetpic" id="custresetpic" />
                                                                </div>
                                                                <div class="picdiv"><img id="custnewpic" src="" alt="No picture selected"/></div>
                                                            </div>
                                                        </div>


                                                    </form>

                                                </center>
                                                <br>
                                                <button type="button" class="btn btn-danger" onclick="deleteAccount();">Delete Account</button>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary" id="savechanges" onclick="editcustomer();">Save changes</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>  <!--content-editcustprofile ends here-->
                                <div class="animated-modal-2" id="content-editcustpass">
                                    <div class="content"><br>
                                        <a href="#" class="slidelink left feature-content-link blue-btn" id="showeditcustprofile">&larr; Edit Profile </a><br><br><br>
                                        <div class="modal-content">
                                            <div class="modal-header">Reset Password
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <center>
                                                    <form name="custpasswordreset" id="custpasswordreset" role="form" method="post" action="">

                                                        <div class="form-group">
                                                            <label>Old Password:<span style="color:red">*</span></label>
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                                                <input class="form-control" type="password" name="custpassresetoldpass" id="custpassresetoldpass" placeholder="Password"  required="required">
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label>New Password:<span style="color:red">*</span></label>
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                                                <input class="form-control" type="password" name="custpassresetnewpass" id="custpassresetnewpass" placeholder="Password"  required="required">
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Confirm Password:<span style="color:red">*</span></label>
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                                                <input class="form-control" type="password" name="custpassresetconfpass" required id="custpassresetconfpass" placeholder="Password"><span style="color:red;"></span>
                                                            </div>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-info" data-dismiss="modal" style="margin-left:100px;">Close</button>
                                                            <button type="button" class="btn btn-primary" id="savepasswordchanges" style="margin-right:150px;" onclick="editcustomerpassword();">Save changes</button>
                                                        </div>

                                                    </form>
                                                </center>
                                            </div>

                                        </div>
                                    </div>
                                </div> <!--  end content-editcustpass -->
                            </div>
                        </div>
                    </center>
                </div>
            </div>
        </div>
    </div>
    <!--    Edit Customer Details form ends here-->
    <?php
        }
    ?>
    
    <body>
        <div id="headernav">
            <?php
            if ($email != "") {
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
                                            <img src="<?php echo base_url() . $picture; ?>" alt="User Image"/>
                                            <span class="badge badge-notify allcount"></span>
                                            <ul>
                                                <li><a>
                                                        <div class="notifiction-panel">
                                                            <table>
                                                                <tr>
                                                                    <td>
                                                                        <button class="btn btn-default btn-lg btn-link" data-toggle="modal" data-target="#myModalmessage" style="font-size:30px;">
                                                                            <span class="glyphicon glyphicon-comment"></span>
                                                                        </button>
                                                                        <span class="badge badge-notify msgcount"></span>
                                                                    </td>
                                                                    <td>
                                                                        <button class="btn btn-default btn-lg btn-link" data-toggle="modal" data-target="#myModalnotify" style="font-size:30px;">
                                                                            <span class="glyphicon glyphicon-bell"></span>
                                                                        </button>
                                                                        <span class="badge badge-notify notifycount"></span>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </a></li>

                                                <?php
                                                if ($person == "provider") {
                                                    ?>
                                                    <li><a href="#" class="profile" type="button">Profile</a></li>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <li><a href="#" button type="button" data-toggle="modal" data-target="#myModal2">Edit info</a></li>

                                                    <?php
                                                }
                                                ?>
                                                <li><a href="#" class="highlight logout">Logout</a></li>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>

                            </div>


                            <div class="navbar-header header-user-dropdown navbar-toggle left" style="width: 90px; padding: 0; margin-left: 1px;">
                                <div class="header-limiter">
                                    <div class="header-user-menu user">
                                        <img src="<?php echo base_url() . $picture; ?>" alt="User Image"/>
                                        <span class="badge badge-notify allcount"></span>
                                        <ul>
                                            <li><a>
                                                    <div class="notifiction-panel">
                                                        <table>
                                                            <tr>
                                                                <td>
                                                                    <button class="btn btn-default btn-lg btn-link" data-toggle="modal" data-target="#myModalmessage" style="font-size:30px;">
                                                                        <span class="glyphicon glyphicon-comment"></span>
                                                                    </button>
                                                                    <span class="badge badge-notify msgcount"></span>
                                                                </td>
                                                                <td>
                                                                    <button class="btn btn-default btn-lg btn-link" data-toggle="modal" data-target="#myModalnotify" style="font-size:30px;">
                                                                        <span class="glyphicon glyphicon-bell"></span>
                                                                    </button>
                                                                    <span class="badge badge-notify notifycount"></span>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </a></li>

                                            <?php
                                            if ($person == "provider") {
                                                ?>
                                                <li><a href="#">Profile</a></li>
                                                <?php
                                            } else {
                                                ?>
                                                <li><a href="#" button type="button" data-toggle="modal" data-target="#myModal2">Edit info</a></li>

                                                <?php
                                            }
                                            ?>
                                            <li><a href="#" class="highlight logout">Logout</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </nav>
                </div>
                <?php
            } else {
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
                                        <label>E-Mail</label>
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

                            <div class="w" id="w">
                                <div class="page" id="page">
                                    <div class="animated-modal-2" id="content-shopregister">
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


                                    <div class="animated-modal-1" id="content-customerregister">
                                        <div class="content"><br>
                                            <a href="#" class="slidelink right feature-content-link blue-btn" id="showshopregister">Register Your Shop &rarr;</a><br><br><br>
                                            <div class="modal-content">
                                                <div class="modal-header">Register Customer
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- Customer registration form starts here-->
                                                    <form  name="customerRegister" id="customerRegister" role="form" method="post"  accept-charset="utf-8">


                                                        <div class="form-group">
                                                            <label>Email:<span style="color:red">*</span></label>
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                                                <input class="form-control" type="email" name="customeremail" id="customeremail" placeholder="Email" required>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Password:<span style="color:red">*</span></label>
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                                                <input class="form-control" type="password" name="customerpass" id="customerpass" placeholder="Password"  required>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Confirm Password:<span style="color:red">*</span></label>
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                                                <input class="form-control" type="password" name="customerconfpass" required id="customerconfpass" placeholder="Password"><span style="color:red;"></span>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Select a picture</label>
                                                            <div id="cusfilein">
                                                                <div class="input-group">
                                                                    <span class="input-group-addon"><i class="glyphicon glyphicon-picture"></i></span>
                                                                    <input class="form-control" type="file" name="customerpic" id="customerpic"/>
                                                                </div>
                                                                <div class="picdiv"><img id="cuspic" src="" alt="No picture selected"/></div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Name:</label>
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                                                <input type="text" class="form-control" id="customername" name="customername" placeholder="Name">
                                                            </div>
                                                        </div>



                                                        <div class="form-group">
                                                            <label>Address:</label>
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                                                                <input class="form-control" type="text" name="customeraddress" id="customeraddress" placeholder="Address">
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Contact:</label>
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                                                                <input class="form-control" type="text" name="customertp" id="customertp" minlength="10" maxlength="10" placeholder="TPNumber1">
                                                            </div>
                                                        </div>

                                                        <div class="form-inline">
                                                            <input class="btn btn-primary" id="submitregister" onclick="registercustomer();" type="submit" value="Register"/>
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
