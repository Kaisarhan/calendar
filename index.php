<?php
session_start();
include("database.php");
if(!isset($_SESSION['user']))
{
    $_SESSION['user'] = session_id();
}
$uid = $_SESSION['user'];  // set your user id settings
$datetime_string = date('c',time());    
    
if(isset($_POST['action']) or isset($_GET['view']))
{
    if(isset($_GET['view']))
    {
        header('Content-Type: application/json');
        $start = mysqli_real_escape_string($connection,$_GET["start"]);
        $end = mysqli_real_escape_string($connection,$_GET["end"]);
        
        $result = mysqli_query($connection,"SELECT `id`, `start` ,`end` ,`title` FROM  `eventt` where (date(start) >= '$start' AND date(start) <= '$end') and uid='".$uid."'");
        while($row = mysqli_fetch_assoc($result))
        {
            $events[] = $row; 
        }
        echo json_encode($events); 
        exit;
    }
    elseif($_POST['action'] == "add")
    {   
        mysqli_query($connection,"INSERT INTO `eventt` (
                    `title` ,
                    `start` ,
                    `end` ,
                    `uid` 
                    )
                    VALUES (
                    '".mysqli_real_escape_string($connection,$_POST["title"])."',
                    '".mysqli_real_escape_string($connection,date('Y-m-d H:i:s',strtotime($_POST["start"])))."',
                    '".mysqli_real_escape_string($connection,date('Y-m-d H:i:s',strtotime($_POST["end"])))."',
                    '".mysqli_real_escape_string($connection,$uid)."'
                    )");
        header('Content-Type: application/json');
        echo '{"id":"'.mysqli_insert_id($connection).'"}';
        exit;
    }
    elseif($_POST['action'] == "update")
    {
        mysqli_query($connection,"UPDATE `eventt` set 
            `start` = '".mysqli_real_escape_string($connection,date('Y-m-d H:i:s',strtotime($_POST["start"])))."', 
            `end` = '".mysqli_real_escape_string($connection,date('Y-m-d H:i:s',strtotime($_POST["end"])))."' 
            where uid = '".mysqli_real_escape_string($connection,$uid)."' and id = '".mysqli_real_escape_string($connection,$_POST["id"])."'");
        exit;
    }
    elseif($_POST['action'] == "delete") 
    {
        mysqli_query($connection,"DELETE from `eventt` where uid = '".mysqli_real_escape_string($connection,$uid)."' and id = '".mysqli_real_escape_string($connection,$_POST["id"])."'");
        if (mysqli_affected_rows($connection) > 0) {
            echo "1";
        }
        exit;
    }
}

?>

<!doctype html>
<html lang="ru"><head>
    <title>Event Calendar</title>
    <meta charset="UTF-8">
    <style type="text/css">
    
      img {border-width: 0}
      * {font-family:'Lucida Grande', sans-serif;}
    </style>
  </head>
  <body>   
    <style type="text/css">
        .block a:hover{
            color: silver;
        }
        .block a{
            color: #fff;
        }
        .block {
            position: fixed;
            background: #2184cd;
            padding: 20px;
            z-index: 1;
            top: 240px;
        }
    </style>
  
<div>
    <h2 class="header-title">Event Calendar</h2>
<!-- <br /><br />
<hr />   -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" crossorigin="anonymous"></script>
<link  href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" >

<link href="css/fullcalendar.css" rel="stylesheet" />
<link href="css/fullcalendar.print.css" rel="stylesheet" media="print" />
<script src="js/moment.min.js"></script>
<script src="js/fullcalendar.js"></script>


<!-- add calander in this div -->
<div class="container">
  <div class="row">
        <div id="calendar"></div>
    </div>
</div>


<!-- Modal -->
<div id="createEventModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Add Event</h4>
        </div>
            <div class="modal-body">
            <div class="control-group">
                <label class="control-label" for="inputPatient">Event:</label>
                <div class="field desc">
                    <textarea class="form-control" id="title" name="title" placeholder="Event" type="text" value=""></textarea>
                </div>
            </div>
                
            <input type="hidden" id="startTime"/>
            <input type="hidden" id="endTime"/>
                                
            <div class="control-group">
                <label class="control-label" for="when">When:</label>
                <div class="controls controls-row" id="when" style="margin-top:5px;"></div>
            </div>            
        </div>
        <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>            
            <button type="submit" class="btn btn-primary" id="submitButton">Save</button>
        </div>
        </div>
  </div>
</div>


<div id="calendarModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Event Details</h4>
            </div>
            <div id="modalBody" class="modal-body">
                <h4 id="modalTitle" class="modal-title"></h4>
                <div id="modalWhen" style="margin-top:5px;"></div>
            </div>
            <input type="hidden" id="eventID"/>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
                <button type="submit" class="btn btn-danger" id="deleteButton">Delete</button>
            </div>
        </div>
    </div>
</div>
<!--Modal-->


<!-- <div style='margin-left: auto;margin-right: auto;text-align: center;'>
</div> -->
<!-- <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-21769945-4', 'auto');
  ga('send', 'pageview');

</script> -->
<script src='locale/ru.js'></script>

</body>
</html>