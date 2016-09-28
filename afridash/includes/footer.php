 <!-- BEGIN chat -->
    <div id="mmc-chat" class="color-default">
        <!-- BEGIN CHAT BOX -->
        <div class="chat-box">
            <!-- BEGIN CHAT BOXS -->
            <ul class="boxs">
                <!-- BEGIN CHAT BOX -->
                <li class="box " data-id="2">
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
                                $query = "SELECT U.user_id, U.email, U.first_name, U.last_name, F.status FROM users U, padi F WHERE CASE WHEN F.padi_1 = {$_SESSION['user_id']} THEN F.padi_2 = U.user_id WHEN F.padi_2 = {$_SESSION['user_id']} THEN F.padi_1 = U.user_id END AND F.status = '1' ";
                                $get_list = mysqli_query($connection, $query);
                                confirm_query($get_list);
                                while($list = mysqli_fetch_assoc($get_list)){ ?>
                                  <li class="user-tooltip" data-id="<?php echo "{$list['user_id']}"; ?>" data-status="online" data-username="<?php echo "{$list['first_name']} {$list['last_name']}"; ?>" data-position="left" data-tooltip="<?php echo "{$list['first_name']} {$list['last_name']}"; ?>">
                        <div class="user-image">
                                <?php set_profile_picture(50,50,$list['email']);?>
                            </div>

                            <span class="user-name"><?php echo "{$list['first_name']} {$list['last_name']}"; ?></span>
                            <!-- END USERNAME-->
                        </li>

                                <?php }
                                ?>

                    </ul>
                </div>
                <!-- END USERS -->

            </div>
        </div>
        <!-- END SIDEBAR -->
    </div>
    <!-- END chat -->


</div>
          <!--BEGIN FOOTER-->

<div id="footer">
                   <div class="copyright">
                        <a href="http://www.afri-dash.com">2015 © Afri-Dash</a></div>


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
    <!-- demo js -->
    <script src="assets/js/demo.js"></script>
    <!--CORE JAVASCRIPT-->
    <script src="script/main.js"></script>
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
-->
<script>
    //This is for the auto loading more posts
function yHandler(){
	// Watch video for line by line explanation of the code
	// http://www.youtube.com/watch?v=eziREnZPml4
    var ID=$(".post_box:last").attr("id");
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
}
window.onscroll = yHandler;
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
        <h4 class="modal-title">Upload a Profile Picture</h4>
      </div>
      <div class="modal-body">
      <div class="container-fluid">
        <form action="?f_name=<?php echo $_GET['f_name']?>&l_name=<?php echo $_GET['l_name']?>&changeprofilepic=true" method="POST" enctype="multipart/form-data">
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

<div class="modal fade" id="course_description" role ="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog">
    <div class="modal-content">
     <form action="" method="post">
      <div class="modal-header">
             <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Update Course Description</h4>
      </div>
      <div class="modal-body">
      <div class="container-fluid">
        <div class="form-group">
            <label for="inputMessage" class="control-label">Comment</label><textarea rows="5" class="form-control" name="description"></textarea>
            <small class="help-block">You may use these HTML tags and attributes: &#x3C;a href=&#x22;&#x22;
            title=&#x22;&#x22;&#x3E;, &#x3C;abbr title=&#x22;&#x22;&#x3E;, &#x3C;acronym title=&#x22;&#x22;&#x3E;,
            &#x3C;b&#x3E;, &#x3C;blockquote cite=&#x22;&#x22;&#x3E;, &#x3C;cite&#x3E;, &#x3C;code&#x3E;,
            &#x3C;del datetime=&#x22;&#x22;&#x3E;, &#x3C;em&#x3E;, &#x3C;i&#x3E;, &#x3C;q cite=&#x22;&#x22;&#x3E;,
         &#x3C;strike&#x3E;, &#x3C;strong&#x3E;. </small>
    </div>
      </div>
      </div>
      <div class="modal-footer">
        <input type="submit" name="submit" value="Save" class="btn btn-default">
        <a class="btn btn-default" data-dismiss="modal">Close</a>
      </div>
    </form>
    </div>
  </div>
</div>
<?php ob_end_flush()?>
