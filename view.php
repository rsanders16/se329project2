<?php include ('util.php'); ?>
<?php 

$user = $users[$_GET['netid']];

// make sure user param exists
if( in_array($user, $users) == false)
{
	echo "ERROR User Does not Exist";
}

$semesters = $user['semesters'];

function taken_course($course)
{
	$courses_file = "se_course_list.json";
	$fh = fopen($courses_file, 'r');
	$raw_courses_data = fread($fh, filesize($courses_file));
	fclose($fh);
	$courses = json_decode($raw_courses_data, true);
	
	$users_file = "users.json";
	$fh = fopen($users_file, 'r');
	$raw_user_data = fread($fh, filesize($users_file));
	fclose($fh);
	$users = json_decode($raw_user_data, true);
	$user = $users[$_GET['netid']];
	
	$semesters = $user['semesters'];
	$has_taken_course = false;
	
	
	for($i = 0 ;  $i < count($semesters) ; $i++)
		{
			if( in_array($course, $semesters['s'.$i])  == true)
			{
				
				$has_taken_course = true;
			}
		}
		
	if($has_taken_course)
	{
		return true;
	}
	else
	{
		return false;
	}
	
	return $has_taken_course;
}

function has_taken_course($c, $s)
{
	

	
	$courses_file = "se_course_list.json";
	$fh = fopen($courses_file, 'r');
	$raw_courses_data = fread($fh, filesize($courses_file));
	fclose($fh);
	$courses = json_decode($raw_courses_data, true);
	
	$users_file = "users.json";
	$fh = fopen($users_file, 'r');
	$raw_user_data = fread($fh, filesize($users_file));
	fclose($fh);
	$users = json_decode($raw_user_data, true);
	$user = $users[$_GET['netid']];
	
	$user_has_all_prerequisites = true;
	$course = $courses[$c];
	$prerequisites = $course['prerequisites'];
	
	if($prerequisites == null)
	{
		return "ui-state-default";
	}
	foreach($prerequisites as $prerequisite)
	{
		$user_has_prerequisite = false;
		$semesters = $user['semesters'];

		for($i = 0 ; $i < $s && $i < count($semesters) ; $i++)
		{
			if( in_array($prerequisite, $semesters['s'.$i])  == true)
			{
				$user_has_prerequisite = true;
			}
		}
		if($user_has_prerequisite == false)
		{
			$user_has_all_prerequisites = false;
		}
	}
	
	if($user_has_all_prerequisites)
	{
		return "ui-state-default";
	}
	else
	{
		return "ui-state-highlight";
	}
	
}

?>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>jQuery UI Sortable - Connect lists with Tabs</title>
  <link rel="stylesheet" href="style.css" />
  <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
  <script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>
  <style>
  #sortable1 li, #s0 li, #s1 li, #s2 li { margin: 0 5px 5px 5px; padding: 5px; font-size: 1.2em; width: 120px; }
body{color: white;font-family:arial; background-image:url('http://www.kostenlosewallpaper.com/wallpapers/weltraum_all_universum_nebel_galaxie_planet_hd_wallpaper_1920x1080_1920x1200_53-hd-wallpaper-kostenlos--2560x1440.jpg');}
  
  .ui-state-highlight{
	background-color:red;
  }
  </style>
  <script>

  
  $(function() {
    $( "#sortable1, #s0, #s1, #s2" ).sortable().disableSelection();
 
    var $tabs = $( "#tabs" ).tabs();
 
    var $tab_items = $( "ul:first li", $tabs ).droppable({
      accept: ".connectedSortable li",
      hoverClass: "ui-state-hover",
      drop: function( event, ui ) {
        var $item = $( this );
        var $list = $( $item.find( "a" ).attr( "href" ) )
          .find( ".connectedSortable" );
		
		$.ajax({
				type: "GET",
				url: 'save.php?netid=rks&course=' + ui.draggable.attr("id") + '&semester=' + $list.attr('id')
			});
		

		var ajaxRequest;
		try{
			ajaxRequest = new XMLHttpRequest();
		} catch (e){
			try{
				ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
			} catch (e) {
				try{
					ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
				} catch (e){
					return false;
				}
			}
		}
		// Create a function that will receive data sent from the server
		ajaxRequest.onreadystatechange = function(){
			if(ajaxRequest.readyState == 4){
				//alert(ajaxRequest.responseText);
				ui.draggable.attr("class", ajaxRequest.responseText);
			}
		}
		//alert($list.attr("id"));
		ajaxRequest.open("GET", 'user_has_prerequisite_for_course.php?netid=rks&course=' + ui.draggable.attr("id") + '&semester=' + $list.attr("id"), true);
		ajaxRequest.send(null); 
		
		
        ui.draggable.hide( "slow", function() {
          $tabs.tabs( "option", "active", $tab_items.index( $item ) );
          $( this ).appendTo( $list ).show( "slow" );
        });
      }
    });
  });
  </script>
</head>
<body>
 <h1 style="font-size:7em"><center>Degree Audit++</center></h1>
<div id="tabs" style="opacity: 0.75;height:50%;">
  <ul>
    <li><a href="#tabs-1">All Courses</a></li>
    <li><a href="#tabs-2">Previously Taken</a></li>
    <li><a href="#tabs-3">Semester 1</a></li>
    <li><a href="#tabs-4">Semester 2</a></li>
  </ul>
  <div id="tabs-1">
    <ul id="sortable1" class="connectedSortable ui-helper-reset">
	 <?php foreach ($courses as $course => $course_name): ?>
			<?php// print_r( taken_course($course)); ?>
			<?php if (taken_course($course) == false): ?>
			<li class="ui-state-default" id="<?php echo $course ?>"><?php echo $course; ?></li>
			<?php endif ;?>
	<?php endforeach; ?>
    </ul>
  </div>
  <div id="tabs-2">
    <ul id="s0" class="connectedSortable ui-helper-reset">
	 <?php foreach ($semesters["s0"] as $course): ?>
	<li class="ui-state-default" id="<?php echo $course ?>"><?php echo $course; ?></li>
	<?php endforeach; ?>
    </ul>
  </div>
  <div id="tabs-3">
    <ul id="s1" class="connectedSortable ui-helper-reset">
	 <?php foreach ($semesters["s1"] as $course): ?>
	<li class="<?php echo has_taken_course($course, 2); ?>" id="<?php echo $course ?>"><?php echo $course; ?></li>
	<?php endforeach; ?>
    </ul>
  </div>
  <div id="tabs-4">
    <ul id="s2" class="connectedSortable ui-helper-reset">
	 <?php foreach ($semesters["s2"] as $course): ?>
	<li class="<?php echo has_taken_course($course, 3); ?>" id="<?php echo $course ?>"><?php echo $course; ?></li>
	<?php endforeach; ?>
    </ul>
  </div>
</div>
 
 
</body>
</html>



