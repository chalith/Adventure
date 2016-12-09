<html>
    <head>
        <link rel="stylesheet" href="<?php echo base_url();?>css/home/message.css">
        <script src="<?php echo base_url();?>js/home/message.js"></script>
        <script>
            $(window).load(function(){
                loadSenders();
            });
            $(document).ready(function(){
                $("#receivers").on('click',function(e){
                    var id=e.target.id;
                    if(id.length>10){
                        $('#sendername').html("<img src="+$('#'+id+' img').attr('src')+" style=\"width:50px; max-height:40px; border-radius: 5px; float:left;\"><h4>"+$('#'+id+' h5').html()+"</h4>");
                        document.getElementById("sender").value=id;
                        loadMessages();
                        $('#messages').animate({scrollTop:$('#messages')[0].scrollHeight});
                    }
                });
                setInterval("loadSenders();", 3000);
                setInterval("loadMessages();", 3000);
            });
            function loadSenders() {
                jQuery.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>" + "index.php/message_controller/get_Senders",
                    dataType: 'json',
                    success: function (res) {
                        var senders="";
                        for(var i=0;i<res.length;i++){
                            senders+="<div class=\"media conversation\" id="+res[i].id+">"+
                                "<a  class=\"pull-left\" href=\"#\">"+
                                    "<img id="+res[i].id+" class=\"media-object\" data-src=\"holder.js/64x64\" alt=\"user\" src="+"<?php echo base_url(); ?>"+res[i].picture+">"+
                                "</a>"+
                                "<div id="+res[i].id+" class=\"media-body\">"+
                                    "<h5 id="+res[i].id+" class=\"media-heading\">"+res[i].name+"</h5>"+
                                    "<small id="+res[i].id+">"+res[i].lastmessage.substring(0,15)+"....</small>"+
                                "</div>"+
                            "</div>";
                        }
                        document.getElementById("receivers").innerHTML=senders;
                    }
                });
            }
            function loadMessages() {
                var id=document.getElementById("sender").value;
                jQuery.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>" + "index.php/message_controller/get_Messages/"+id,
                    dataType: 'json',
                    success: function (res) {
                        var messages="";
                        for(var i=0;i<res.length;i++){
                            if(res[i].type=="sent"){
                                messages+="<div class=\"sentmessage\"><p>"+res[i].message+"<p></br><a>"+res[i].time+"</a></div>";
                            }
                            else if(res[i].type=="received"){
                                messages+="<div class=\"receivemessage\"><p>"+res[i].message+"<p></br><a>"+res[i].time+"</a></div>";
                            }
                            
                        }
                        document.getElementById("messages").innerHTML=messages;
                    }
                });
            }
            function send(){
                var message = document.forms["messageForm"]["message"].value;
                var targetid = document.getElementById("sender").value;
                if(targetid==""){
                    alert("Select a receiver");
                    return;
                }
                var obj = {message:message,targetid:targetid};
                sendMessage(obj);
            }
            function sendMessage(obj){
                jQuery.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>" + "index.php/message_controller/send_Message",
                    dataType: 'json',
                    data: obj,
                    success: function (res) {
                        if(res.alert=="done"){
                            loadMessages();
                            $('#messages').animate({scrollTop:$('#messages')[0].scrollHeight});
                            document.forms["messageForm"]["message"].value="";
                        }
                    }
                });
            }
        </script>
    </head>
<body>
    <div class="container">
    <div class="row">
        <div class="col-sm-2 col-md-2">
            <div class="panel panel-default">
                <div class="panel-body receivers">
                    <div class="row">
                        
                    </div>
                    <div class="row" id="receivers">
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4 col-md-4">
            <div class="panel panel-default">
                <input id="sender" type="hidden"/>
                <div class="panelhead" id="sendername"></div>
                <div class="panel-body msgs" id="messages">
                    
                </div>
                <div class="panel-body formbody">                
                    <form name="messageForm" accept-charset="UTF-8" action="" method="POST">
                        <textarea id="field" onkeyup="countChar(this)" class="form-control counted" name="message" placeholder="Type in your message" rows="5" style="margin-bottom:10px;"></textarea>
                        <h6 class="pull-right" id="counter">&nbspcharacters remaining</h6><h6 class="pull-right" id="charNum">320</h6>
                        <button class="btn btn-info" type="button" onclick="send();">Send</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>
</html>