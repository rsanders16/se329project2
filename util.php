<?php

error_reporting(E_ALL ^ E_NOTICE);


// load users 
$users_file = "users.json";
$fh = fopen($users_file, 'r');
$raw_user_data = fread($fh, filesize($users_file));
fclose($fh);
$users = json_decode($raw_user_data, true);


// load courses
$courses_file = "se_course_list.json";
$fh = fopen($courses_file, 'r');
$raw_courses_data = fread($fh, filesize($courses_file));
fclose($fh);
$courses = json_decode($raw_courses_data, true);
