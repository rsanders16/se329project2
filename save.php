<?php
header("Content-type: text/javascript");
include ('util.php');

// extract url params
$c = $courses[$_GET['course']];
$user = $users[$_GET['netid']];
$semester_course_will_be_taken = $_GET['semester'];

// make sure user param exists
if( in_array($user, $users) == false)
{
	echo "ERROR User Does not Exist";
}

// make sure course param exists
elseif( in_array( $c, $courses ) == false )
{
	echo "ERROR Course Does not Exist";
}

else if(is_array($users[$_GET['netid']]['semesters'][$semester_course_will_be_taken]))
{

	// remove course from current postion
	foreach ($users[$_GET['netid']]['semesters'] as $s => $v) 
	{
		for($i = 0 ; $i < count($users[$_GET['netid']]['semesters'][$s]) ; $i++)
		{
			if($users[$_GET['netid']]['semesters'][$s][$i] === $_GET['course'])
			{
				unset($users[$_GET['netid']]['semesters'][$s][$i]);
			}
		}
	}
		
	// move course to new position
	$arr = array($_GET['course'] => "");
	//array_merge ($users[$_GET['netid']]['semesters'][$semester_course_will_be_taken], $arr);
	array_push($users[$_GET['netid']]['semesters'][$semester_course_will_be_taken], $_GET['course']);
		
	//save user data
	$myFile = "users.json";
	$fh = fopen($myFile, 'w') or die("can't open file");
	$stringData = json_encode($users);
	fwrite($fh, $stringData);
	fclose($fh);
	
	
}

