    
</div>                <!--BEGIN FOOTER-->
 
<div id="footer">
    
                    <div class="copyright">
                        <a href="http://www.afri-dash.com">2015 © Afri-Dash</a></div>
 
    
         
<div class="chat_box">
	<div class="chat_head"> <i class="icon-conversation icon-large"></i>Afrimessenger</div>
    <div class="chat_body">
    <div id="mmc-chat" class="color-default">
        <!-- BEGIN CHAT BOX -->
        <div class="chat-box">
            <!-- BEGIN CHAT BOXS -->
            <ul class="boxs">
                <!-- BEGIN CHAT BOX -->
                <li class="box active" data-id="2">
                    <div class="had-container">
                         </li>
                <!-- END CHAT BOX -->
            </ul>
            <!-- END CHAT BOXS -->
            <div class="icons-set">
                <div class="stickers">
                    <div class="had-container">
                        <div class="row">
                            <div class="s12">
                                <ul class="tabs" style="width: 100%;height: 60px;">
                                    <li class="tab col s3">
                                        <a href="#tab1" class="active">
                                            <img src="assets/img/icons/smile/1.png" alt="" />
                                        </a>
                                    </li>
                                    <li class="tab col s3"><a href="#tab2">Test 2</a></li>
                                </ul>
                            </div>
                            <div id="tab1" class="s12 tab-content">
                                <ul>
                                    <li><img src="assets/img/icons/smile/1.png" /></li>
                                    <li><img src="assets/img/icons/smile/10.png" /></li>
                                    <li><img src="assets/img/icons/smile/11.png" /></li>
                                    <li><img src="assets/img/icons/smile/12.png" /></li>
                                    <li><img src="assets/img/icons/smile/13.png" /></li>
                                    <li><img src="assets/img/icons/smile/14.png" /></li>
                                    <li><img src="assets/img/icons/smile/2.png" /></li>
                                    <li><img src="assets/img/icons/smile/3.png" /></li>
                                    <li><img src="assets/img/icons/smile/4.png" /></li>
                                    <li><img src="assets/img/icons/smile/5.png" /></li>
                                    <li><img src="assets/img/icons/smile/6.png" /></li>
                                    <li><img src="assets/img/icons/smile/7.png" /></li>
                                    <li><img src="assets/img/icons/smile/8.png" /></li>
                                    <li><img src="assets/img/icons/smile/9.png" /></li>
                                </ul>
                            </div>
                            <div id="tab2" class="s12 tab-content">Test 2</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END CHAT BOX -->
        <!-- BEGIN SIDEBAR -->
        <div id="sidebar" class="right scroll">
            <div class="had-container">
                <!-- BEGIN SIDEBAR HEADER-->
                <div class="sidebar-header">
                    <div class="sidebar-collapse"><i class="small material-icons">reorder</i></div>
                    <!-- BEGIN SEARCHBAR-->
                    <div class="row searchbar">
                        <div class="input-field col s12 search ">
                            <input value="" id="search" type="text" class="validate" data-placeholder="Search">
                            <label class="active" for="search">Search user</label>
                        </div>
                        <!-- BEGIN SEARCHBAR COLLAPSED ICON-->
                        <div class="searchbar-closed">
                            <div class="searchbar-closed tooltipped" data-position="left" data-tooltip="Search"><i class="small material-icons">search</i></div>
                        </div>
                        <!-- END SEARCHBAR COLLAPSED ICON-->
                    </div>
                    <!-- END SEARCHBAR-->
                </div>
                <!-- END SIDEBAR HEADER-->
                <!-- BEGIN USERS -->
                <div class="users">

                    <ul class="user-list" wave-effect="true" wave-color="waves-teal">
                        <!-- BEGIN USER-->
                                         <?php
global $connection;
$query= "SELECT u.user_id, c.c_id, u.email,  u.last_name, u.logged_in, u.first_name FROM convo c, users u WHERE CASE WHEN c.user1 = {$_SESSION['user_id']} THEN c.user2 = u.user_id WHEN c.user2 = {$_SESSION['user_id']} THEN c.user1 = u.user_id END 
 AND ( c.user1 = {$_SESSION['user_id']} OR c.user2 = {$_SESSION['user_id']} ) ORDER BY c.c_id DESC";
 
 $get_list1 = mysqli_query($connection, $query);
 confirm_query($get_list1);
$first = 0;
 while($new_list1 = mysqli_fetch_assoc($get_list1)){
     
if($new_list1['logged_in'] == '1'){
    $status = 'online';
}else{
    $status = 'off';
}
$c_id=$new_list1['c_id'];
$user_id=$new_list1['user_id'];
$email=$new_list1['email'];
     
$query="SELECT R.cr_id, R.time, R.reply 
                            FROM convoReply R WHERE R.convoID={$c_id} 
                            ORDER BY R.cr_id DESC LIMIT 1";
$cReply = mysqli_query($connection, $query);
  confirm_query($cReply);                           
$crow=mysqli_fetch_assoc($cReply);
$cr_id=$crow['cr_id'];
$reply=$crow['reply'];
$time=$crow['time'];

//HTML Output. 
?>
                     
                        <li class="user-tooltip" data-id="<?php echo "{$new_list1['user_id']}"; ?>" data-status="online" data-username="<?php echo "{$new_list1['first_name']} {$new_list1['last_name']}"; ?>" data-position="left" data-tooltip="<?php echo "{$new_list1['first_name']} {$new_list1['last_name']}"; ?>" onclick="getID(<?php echo $c_id; ?>)">
                        
                        <div class="user-image">
                                <?php set_profile_picture(50,50,$new_list1['email']);?>
                            </div>
                            
                            <span class="user-name"><?php echo "{$new_list1['first_name']} {$new_list1['last_name']}"; ?></span>
                            <!-- END USERNAME-->
                             </li>
                            
                                <?php }
                                ?>
                        
                    </ul>
                    <!--also you may add wave effect other way-->
                    <!--<ul class="user-list" wave-effect="false">
                        <li class="waves-effect waves-teal">
                            <img src="assets/img/avatar.png" class="avatar" alt="Rufat Askerov" />
                            <span class="user-name">Rufat Askerov</span>
                        </li>
                    </ul>-->
                </div>
                <!-- END USERS -->

            </div>
        </div>
        <!-- END SIDEBAR -->
    </div>
    </div>
</div>

          </div>
                            </div>
                        </div>
                </div>
                <!--END FOOTER-->
<script type="text/javascript" src="script/jquery.watermarkinput.js"></script>
       <script type="text/javascript" src="script/jquery.form.js"></script> 
    <script src="script/jquery-migrate-1.2.1.min.js"></script>
    <script src="script/jquery-ui.js"></script>
    <script src="script/bootstrap.min.js"></script>
    <script src="script/bootstrap-hover-dropdown.js"></script>
    <script src="script/html5shiv.js"></script>
    <script src="script/respond.min.js"></script>
    <script src="script/jquery.metisMenu.js"></script>
    <script src="script/jquery.slimscroll.js"></script>
    <script src="script/jquery.cookie.js"></script>
    <script src="script/icheck.min.js"></script>
    <script src="script/custom.min.js"></script>
    <script src="script/jquery.news-ticker.js"></script>
    <script src="script/jquery.menu.js"></script>
    <script src="script/pace.min.js"></script>
    <script src="script/holder.js"></script>
    <script src="script/responsive-tabs.js"></script>
    <script src="script/jquery.flot.js"></script>
    <script src="script/jquery.flot.categories.js"></script>
    <script src="script/jquery.flot.pie.js"></script>
    <script src="script/jquery.flot.tooltip.js"></script>
    <script src="script/jquery.flot.resize.js"></script>
    <script src="script/jquery.flot.fillbetween.js"></script>
    <script src="script/jquery.flot.stack.js"></script>
    <script src="script/jquery.flot.spline.js"></script>
    <script src="script/zabuto_calendar.min.js"></script>
    <script src="script/index.js"></script>
   
    <script src="assets/js/mmc-common.js"></script>
    <script src="assets/js/mmc-chat.js"></script>
    <!-- demo js 
    <script src="assets/js/demo.js"></script>
    <!--CORE JAVASCRIPT-->
    <script src="script/main.js"></script>



<script>
$(document).ready(function(){

	$('.chat_head').click(function(){
		$('.chat_body').slideToggle('slow');
	});
	$('.msg_head').click(function(){
		$('.msg_wrap').slideToggle('slow');
	});
	
	$('.close').click(function(){
		$('.msg_box').hide();
	});
	
	$('.user').click(function(){

		$('.msg_wrap').show();
		$('.msg_box').show();
	});
	
	$('textarea').keypress(
    function(e){
        if (e.keyCode == 13) {
            var msg = $(this).val();
			$(this).val('');
			if(msg!='')
			$('<div class="msg_b">'+msg+'</div>').insertBefore('.msg_push');
			$('.msg_body').scrollTop($('.msg_body')[0].scrollHeight);
        }
    });
	
});


</script>


    <script>        (function (i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function () {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
            a = s.createElement(o),
            m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');
        ga('create', 'UA-145464-12', 'auto');
        ga('send', 'pageview');


</script>
<script>
    //This is for the auto loading more posts
function yHandler(){
	// Watch video for line by line explanation of the code
	// http://www.youtube.com/watch?v=eziREnZPml4
    var ID=$(".post_box:last").attr("id");
    if(ID != "" && ID != 0 ){
    var wrap = document.getElementById('wrap');
	var contentHeight = wrap.offsetHeight;
	var yOffset = window.pageYOffset; 
	var y = yOffset + window.innerHeight;
    var dataString = 'ID='+ ID;
	if(y >= contentHeight){
        $.ajax({
        type: 'POST',
        url: 'submit.php',
        data:   dataString,
        success: function(data){
                 if(data != null) $("#contentOneTwo").text(data)
         }
     });
		// Ajax call to get more dynamic data goes here
		wrap.innerHTML += document.getElementById("contentOneTwo").textContent;
	}
        window.onscroll = yHandler;
    }

}

</script>
<script type="text/javascript" >
$(document).ready(function()
{
$("#notificationLink").click(function()
{
$("#tasksContainer").hide();
$("#messagesContainer").hide();
 $("#friendsContainer").hide();
$("#notificationContainer").fadeToggle(300);
$("#notification_count").fadeOut("slow");
return false;
});

//Document Click
$(document).click(function()
{
$("#notificationContainer").hide();
});
$("#notificationContainer").click(function()
{
//return false;
});
});
</script>

<script type="text/javascript" >
$(document).ready(function()
{
$("#friendsLink").click(function()
{
$("#tasksContainer").hide();
$("#notificationContainer").hide();
$("#messagesContainer").hide();
$("#friendsContainer").fadeToggle(300);
$("#friends_count").fadeOut("slow");
return false;
});

//Document Click
$(document).click(function()
{
$("#friendsContainer").hide();
});
//Popup Click
$("#friendsContainer").click(function()
{
$("#friendsContainer").hide();
//return false;
});

});
</script>

<script type="text/javascript" >
$(document).ready(function()
{
$("#tasksLink").click(function()
{
$("#notificationContainer").hide();
$("#messagesContainer").hide();
 $("#friendsContainer").hide();
$("#tasksContainer").fadeToggle(300);
$("#tasks_count").fadeOut("slow");
return false;
});

//Document Click
$(document).click(function()
{
$("#tasksContainer").hide();
});
//Popup Click
$("#tasksContainer").click(function()
{
//return false;
});

});
</script>

<script type="text/javascript" >
$(document).ready(function()
{
$("#messagesLink").click(function()
{
$("#tasksContainer").hide();
$("#notificationContainer").hide();
 $("#friendsContainer").hide();
$("#messagesContainer").fadeToggle(300);
$("#messages_count").fadeOut("slow");
return false;
});

//Document Click
$(document).click(function()
{
$("#messagesContainer").hide();
});
//Popup Click
$("#messagesContainer").click(function()
{
//return false;
});

});
</script>
<script type="text/javascript">
$(document).ready(function(){

$(".search").keyup(function() 
{
var searchbox = $(this).val();
var dataString = 'searchword='+ searchbox;

if(searchbox=='')
{
}
else
{

$.ajax({
type: "POST",
url: "search.php",
data: dataString,
cache: false,
success: function(html)
{
$("#display").html(html).show();
}

});
}  
});
$(document).click(function()
{
$("#display").hide();
});
    
return false; 
});

jQuery(function($){
   $("#searchbox").Watermark("Search");
   });
</script>
<script>
    // Add content to form
    $('.chat-textarea input').on("keypress", function(e){

        var $obj = $(this);
        var $me = $obj.parent().parent().find('ul.chat-box-body');
        
        var $my_avt = 'https://s3.amazonaws.com/uifaces/faces/twitter/kolage/128.jpg';
        var $your_avt = 'https://s3.amazonaws.com/uifaces/faces/twitter/alagoon/48.jpg';
        
        if (e.which == 13) {
            var $content = $obj.val();
            if ($content !== "") {
                var d = new Date();
                var h = d.getHours();
                var m = d.getMinutes();
                if (m < 10) m = "0" + m;
                $obj.val(""); // CLEAR TEXT ON TEXTAREA

                var $element = ""; 
                $element += "<li>";
                $element += "<p>";
                $element += "<?php set_profile_picture(25,25, $_SESSION['email']); ?>";
                $element += "<span class='user'>"+"<?php echo " ".$_SESSION['name'];?>"+"</span>";
                $element += "<span class='time'>" + h + ":" + m + "</span>";
                $element += "</p>";
                $element = $element + "<p>" + $content +  "</p>";
                $element += "</li>";
                
                $me.append($element);
                var height = 0;
                $me.find('li').each(function(i, value){
                    height += parseInt($(this).height());
                });

                height += '';
                //alert(height);
                $me.scrollTop(height);  // add more 400px for #chat-box position      

                // RANDOM RESPOND CHAT

                var $res = "";
                $res += "<li class='odd'>";
                $res += "<p>";
                $res += "<img class='avt' src='"+$your_avt+"'>";
                $res += "<span class='user'>adsa</span>";
                $res += "<span class='time'>" + h + ":" + m + "</span>";
                $res += "</p>";
                $res = $res + "<p>" + "Yep! It's so funny :)" + "</p>";
                $res += "</li>";
                setTimeout(function(){
                    $me.append($res);
                    $me.scrollTop(height+100); // add more 500px for #chat-box position             
                }, 1000);
            }
        }
    });
//Ask user for persmission to show notifications    
document.addEventListener('DOMContentLoaded', function () 
{

if (Notification.permission !== "granted")
{
Notification.requestPermission();
}

});
//function that shows notification
function notifyBrowser(title,desc,url,ppicture) 
{

if (Notification.permission !== "granted")
{
Notification.requestPermission();
}
else
{
var notification = new Notification(title, {
icon:ppicture,
body: desc,
sound: 'http://lugreat.com/afri-dash/public/Dashboard/audio/Online.mp3'
});

/* Remove the notification from Notification Center when clicked.*/
notification.onclick = function () {
window.open(url); 
};

/* Callback function when the notification is closed. */
notification.onclose = function () {
console.log('Notification closed');
};

}
}
</script>


<script>
function getID(postID){
    //alert("I was clicked  " + postID);
    var datastring = "{'convoID': postID}";
    
   // $.post('../../includes/header.php', datastring)
    
    $.ajax({
        type: "POST",
        url: "../../includes/footer.php",
       // datatype: 'json',
        data: datastring,
       // data: {convoID: "datastring"},
        cache: false,
        success: function(data){
                alert("data "+ datastring);
        }
    });
}
function minimizedBoxCount() {
    _count = $('#mmc-chat .box.minimized .dropdown li').size();

    $('#mmc-chat .box.minimized .count span').html($('#mmc-chat .box.minimized .dropdown li').size());

    if (_count == 0) {
        $('#mmc-chat .box.minimized').remove();
    }
}


function box_minimizedAddUser() {
    _boxHidden = $('#mmc-chat .box:not(".minimized"):not(".hidden")').eq(0);
    _boxHidden.addClass('hidden');
    dataId = _boxHidden.data('id');

    hasItem = false;
    $('#mmc-chat .box.minimized .dropdown li').each(function () {
        if ($(this).data('id') == dataId) {
            hasItem = true;
        }
    });

    if (!hasItem) {
        dataUserName = _boxHidden.find('.box-username a').text();
        $('#mmc-chat .box.minimized .dropdown').append(box_minimized_dropdownLi.format(dataId, dataUserName));
    }
}

var box_minimized_dropdownLi = '<li data-id="{0}"><div class="username">{1}</div> <div class="remove">X</div></li>'
function box_minimized() {
    _boxDefaultWidth = parseInt($('#mmc-chat .box:not(".minimized")').css('width').replace('px', ''), 0);
    _boxCommonWidth = parseInt($('.chat-box').css('width').replace('px', ''), 10) + 50 + parseInt($('#sidebar').css('width').replace('px', ''), 10);
    _windowWidth = $(window).width();
    _hasMinimized = false;

    $('#mmc-chat .boxs .box').each(function (index) {
        if ($(this).hasClass('minimized')) {
            _hasMinimized = true;
        }
    });

    if ((_windowWidth) > (_boxCommonWidth + 50)) {

        if (!_hasMinimized) {
            return;
        }

        dataId = $('#mmc-chat .boxs .minimized .dropdown li').last().data('id');
        $('#mmc-chat .boxs .minimized .dropdown li').last().remove();
        $('#mmc-chat .boxs .box').each(function (index) {
            if ($(this).data('id') == dataId) {
                $(this).removeClass('hidden');
                return false;
            }
        });
    } else {

        if (!_hasMinimized) {
            $('#mmc-chat .boxs').prepend('<li class="box minimized"><div class="count"><span>0</span></div><ul class="dropdown"></ul></li>');
        }
        box_minimizedAddUser();
    }

    minimizedBoxCount();
}

    
  
                                
  var newBox = '<li class="box" data-id="{0}"> <div class="had-container"> <div class="box-header "> <div class="info"> <span class="box-username"><a href="#">{1}</a></span> </div><div class="tools"> <span class="collapse tooltipped" data-position="top" data-tooltip="Collapse chat"> </span> <span class="maximize maximize-tooltipped" data-position="top" data-tooltip="Open other window"> </span> <span class="close close_tooltip" data-position="top" data-tooltip="Close"> </span> </div></div><div class="box-body"> <div class="status {2}"></div><div class="options"> <div class="group group1"> <a href="#" class="video-cam" title="If you want video call click"></a> <a href="#" class="person-add" title="Add person this chat"></a> </div><div class=" group group2"> </div><div class="clear"></div></div><div class="message-scrooler"> <div class="messages">'
  
  <?php 

   
  //  if ($_POST) {
            //$chid = $_POST['convoID'];
      //  } 
 
  //$chid = !empty($_POST['convoID']); 
     $chid = 3;
  
?>
   newBox = newBox + "<?php echo $GLOBALS['chid']; ?>";
  <?php
                             $query="SELECT R.cr_id, R.time, R.reply,R.userID 
                            FROM convoReply R WHERE R.convoID= '".$GLOBALS['chid']."' 
                            ORDER BY R.cr_id ASC ";
                            $cReply = mysqli_query($connection, $query);
                            confirm_query($cReply);                           
                            while($message = $crow=mysqli_fetch_assoc($cReply) ){
                                if($message['userID']==$_SESSION['user_id']){
                                    ?>
  newBox = newBox + '<div class="message out no-avatar"><div class="sender"><a href="javascript:void(0);" >';
  newBox  = newBox + "<?php set_profile_picture(30,30,$_SESSION['email']); ?>";  
  newBox  = newBox + '</a></div><div class="body"><div class="content"><span>';
  newBox  = newBox + "<?php echo $message['reply'] ?>";
 newBox  = newBox + '</span></div><div class="seen"><span>';
  newBox  = newBox + "<?php $date = new MyDateTime($message['time'], new DateTimeZone('PST')); echo time_stamp($date->getTimestamp()); ?>";
   newBox  = newBox + '</span> </div></div><div class="clear"></div></div>';
  
    <?php }
         else
            { ?>
                                 
  
    newBox = newBox + '<div class="message in no-avatar"><div class="sender"><a href="javascript:void(0);"></a></div><div class="body"><div class="content"><span>';
  newBox  = newBox + "<?php echo $message['reply'] ?>";
 newBox  = newBox + '</span></div><div class="seen"><span>';
  newBox  = newBox + "<?php $date = new MyDateTime($message['time'], new DateTimeZone('PST')); echo time_stamp($date->getTimestamp()); ?>";
   newBox  = newBox + '</span> </div></div><div class="clear"></div></div>';
    
    
    
    
    
  <?php
                   } ?>
                                
                            <?php
                            }
                            ?>     
                                   
                               
  
  newBox  = newBox + '</div></div></div><div class="box-footer"> <div class="item icons" data-source="icons-set"> <div class="smile-ico"></div><div class="smiles-set"></div></div><div class="item send-message"> <div class="textarea" contenteditable="true" data-placeholder="Write message"> </div></div><div class="item file"> <input type="file" id="selectedFile" class="selected-file"/> </div></div></div></li>';
                  
    
                                              
                                
                                
            

        
    

    
                                
$(window).resize(function () {
    box_minimized();
    sidebar_closed();
});
$(function () {

    waveEffect = $('.user-list').attr('wave-effect');
    waveColor = $('.user-list').attr('wave-color');
    if (waveEffect == 'true') {
        $('#sidebar .user-list li').each(function (index) {
            $(this).addClass('waves-effect ' + waveColor);
        });
    }    

    initializeTooltip();
    messageScrollMoveEnd();
    generatePlaceholder();   

    box_minimized();
});

$(document).on('click', '#mmc-chat .mmcMin', function () {
$("#mmcbox").slideDown();
});


$(document).on('click', '#mmc-chat .box', function () {

    if ($(this).hasClass('new-message')) {
        $(this).removeClass('new-message');
    }
    selectActiveChatBox(this);
});

$(document).on('click', '#mmc-chat .box-header .info', function () {
    removeBoxCollapseClass($(this).parents('.box'));
    //selectActiveChatBox($(this).parents('.box'));
    messageScrollMoveEnd();
});

$(document).on('click', '#mmc-chat .box .collapse', function () {
    parent = $(this).parents('.box');

    if (parent.hasClass('collapsed')) {
        parent.removeClass('collapsed');
        messageScrollMoveEnd();
    } else {
        parent.addClass('collapsed');
    }

});

$(document).on('click', '#mmc-chat .box .close', function () {
    parent = $(this).parents('.box');
    if (parent.hasClass('active')) {
        parent.remove();
        setTimeout(function () { $('#mmc-chat .boxs .box:last-child').addClass('active'); }, 1);
    }
    parent.remove();
    parent.find('.close_tooltip').tooltip('remove');

    box_minimized();
});

$(document).on('click', '#mmc-chat #sidebar .user-list li', function () {

    dataId = $(this).attr('data-id');
    /*
     $.post('', {data: dataId}, function(data){
        console.log(data);
    });
    */
    dataStatus = $(this).data('status');
    dataUserName = $(this).attr('data-username');
    _return = false;

    $('#mmc-chat .chat-box .boxs .box').each(function (index) {
        if ($(this).attr('data-id') == dataId) {
            removeBoxCollapseClass(this);
            selectActiveChatBox(this);
            _return = true;
        }
    });
  

    if (_return) {
        return;
    }
    $('#mmc-chat .box').removeClass('active');
    $('#mmc-chat .chat-box .boxs').append(newBox.format(dataId, dataUserName, dataStatus));
    generatePlaceholder();
    messageScrollMoveEnd();
    box_minimized();
    initializeTooltip();
});

$(document).on('focus', '#mmc-chat .textarea', function () {
    if ($(this).html() == '<span class="placeholder">{0}</span>'.format($(this).data('placeholder'))) {
        $(this).html('');
    }
});

$(document).on('blur', ' #mmc-chat .textarea', function () {
    if ($(this).html() == '') {
        $(this).html('<span class="placeholder">{0}</span>'.format($(this).data('placeholder')));
    }
});

$(document).on('click', '#mmc-chat .sidebar-collapse', function () {
    if ($('#mmc-chat').hasClass('sidebar-closed')) {
        $('#mmc-chat').removeClass('sidebar-closed');
        // $('.search').addClass('input-field');
        $('#mmc-chat .search input').attr('placeholder', '');
        $('#mmc-chat .search').css('display', 'block');

        //$('#mmc-chat .user-list li').each(function (index) {

        //    $(this).removeClass('tooltipped');
        //    $(this).removeAttr('data-position');
        //    $(this).removeAttr('data-tooltip'); 
        //    $(this).removeAttr('data-tooltip-id');
        //});

        deinitializeTooltipSiderbarUserList();



    } else {
        $('#mmc-chat').addClass('sidebar-closed');

        // $('.search').removeClass('input-field');
        $('#mmc-chat .search input').attr('placeholder', $('.search input').data('placeholder'));
        $('#mmc-chat .search').css('display', 'none');
        $('#mmc-chat .search').removeAttr('style');
        $('#mmc-chat .searchbar-closed').removeAttr('style');
        //$('#mmc-chat .user-list li').each(function (index) {

        //    $(this).addClass('tooltipped');
        //    $(this).attr('data-position', 'left');
        //    $(this).attr('data-tooltip', $(this).data('username'));

        //});

        initializeTooltipSiderbarUserList();
    }
});

$(document).on('click', '#mmc-chat .searchbar-closed', function () {
    $('#mmc-chat .sidebar-collapse').click();
    setTimeout(function () { $('#mmc-chat .searchbar input').focus(); }, 50);
    return false;
});

$(document).on('click', '#mmc-chat .box .maximize', function () {
    window.open('inbox.html', 'window name', "width=300,height=400,scrollbars=yes");
    $(this).parents('.box').remove();
    $('maximize-tooltipped').tooltip('remove');
    return false;
});



$(document).on('click', '#mmc-chat .boxs .minimized .count', function (e) {
    e.stopPropagation();
    hideStickerBox();
    _parent = $(this).parents('.minimized');

    if (_parent.hasClass('show')) {
        hideMinimizedBox();
    } else {

        _parent.addClass('show');
        _bottom = parseInt(_parent.css('height').replace('px', ''),0) + 10;
        _parent.find('.dropdown').css({
            'display': 'block',
            'bottom': _bottom
        });
    }
});

$(document).on('click', '#mmc-chat .boxs .minimized .dropdown .username', function (e) {
    e.stopPropagation();
    selectedDataId = $(this).parent().data('id');

    $(this).parent().remove();

    box_minimizedAddUser();

    $('#mmc-chat .boxs .box').each(function (index) {
        if ($(this).data('id') == selectedDataId) {
            $(this).removeClass('hidden').removeClass('collapsed');
            selectActiveChatBox($(this));
        }
    });
});

$(document).on('click', '#mmc-chat .boxs .minimized .dropdown .remove', function (e) {
    e.stopPropagation();
    _parent = $(this).parents('.dropdown li');
    dataId = _parent.data('id');

    $('#mmc-chat .box').each(function () {
        if ($(this).data('id') == dataId) {
            $(this).remove();
        }
    });
    _parent.remove();

    minimizedBoxCount();
});


</script>

</body>
</html>
<div class="modal fade" id="ChangeCover" role ="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
             <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Upload a Cover Photo</h4>
      </div>
      <div class="modal-body">
      <div class="container-fluid">
        <form action="?f_name=<?php echo $_GET['f_name']?>&l_name=<?php echo $_GET['l_name']?>&changecoverphoto=true" method="POST" enctype="multipart/form-data">
            <input type="file" name="file" class="btn btn-default">
            <br/>
            <input type="submit" name="submit" value="Upload" class="btn btn-primary">
        </form>
      </div>
      </div>
      <div class="modal-footer">
        <a class="btn btn-default" data-dismiss="modal">Close</a>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="SendMessage" role ="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
             <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Send Message</h4>
      </div>
      <div class="modal-body">
      <div class="container-fluid">
        <form action="" method="POST" enctype="multipart/form-data">
           <div class="form-group">
                <textarea class="form-control" rows="2" id="comment" name="msg" placeholder="Enter Message"></textarea>
            </div>
            <input type="hidden" value="<?php echo $_GET['id']; ?>" name="userID">
        <input type="submit" class="btn btn-primary" name="submit" value="Send">
        <a class="btn btn-default" data-dismiss="modal">Close</a>
        </form>
      </div>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="ChangeProfile" role ="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
             <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-ti