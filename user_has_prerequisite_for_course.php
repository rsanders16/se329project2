<?php 
header("Content-type: text/javascript");
include ('util.php');

// extract url params
$course = $courses[$_GET['course']];
$user = $users[$_GET['netid']];
$semester_course_will_be_taken = $_GET['semester'];

// make sure user param exists
if( in_array($user, $users) == false)
{
	echo "ERROR User Does not Exist";
}

// make sure course param exists
elseif( in_array( $course, $courses ) == false )
{
	echo "ERROR Course Does not Exist";
}

else
{
	$user_has_all_prerequisites = true;
	
	$prerequisites = $course['prerequisites'];
	foreach($prerequisites as $prerequisite)
	{
		$user_has_prerequisite = false;
		$semesters = $user['semesters'];
		
		for($i = 1 ; $i < $semester_course_will_be_taken[1] +1 ; $i++)
		{
			
			
			if( in_array($prerequisite, $semesters[s.$i])  == true)
			{
				$user_has_prerequisite = true;
			}
		}
		if($user_has_prerequisite == false)
		{
			$user_has_all_prerequisites = false;
		}
	}
	
	if($user_has_all_prerequisites || $semester_course_will_be_taken == "s0")
	{
		echo "ui-state-default";
	}
	else
	{
		echo "ui-state-highlight";
	}
}