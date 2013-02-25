<?php
define("SITE_NAME", "DegreeAudit++");
define("PAGE_TITLE", "DegreeAudit++");

class Course{
	private $courseCode;
	private $prerequisites  = array();
	
	public function Course($courseCode, $prerequisites){
		$this->courseCode = $courseCode;
		$this->prerequisites   = $prerequisites ;
	}
	
	public function getCourseCode(){
		return $this->courseCode;
	}
	
	public function addPrerequisite($courseCode){
		array_push($this->prerequisites, $courseCode);
	}
	
	public function getPrerequisites(){
		return $prerequisites;
	}
}


$econ_elective_courses = array(
	new Course("ECON 101", "101"),
	new Course("ECON 102","102")
);

$spplm_elective_courses = array(
	new Course("SPPLM 101", "101"),
	new Course("SPPLM 102","102")
);

$us_diversity_elective_courses = array(
	new Course("US DIV 101", "101"),
	new Course("US DIV 102","102")
);

//place holder 1

$math_elective_courses = array(
	new Course("MATH 101", "101"),
	new Course("MATH 102","102")
);

//place holder 2

$social_science_elective_courses = array(
	new Course("SS 101", "101"),
	new Course("SS 102","102")
);

//place holder 3

//place holder 4

$international_perspective_elective_courses = array(
	new Course("IP 101", "101"),
	new Course("IP 102","102")
);

$technical_elective_courses = array(
	new Course("TECH 101", "101"),
	new Course("TECH 102","102")
);

$se_elective_courses = array(
	new Course("SE 101", "101"),
	new Course("SE 102","102")
);

$arts_and_humanities_elective_courses = array(
	new Course("AH 101", "101"),
	new Course("AH 102","102")
);

$open_elective_courses = array(
	new Course("OPEN 101", "101"),
	new Course("OPEN 102","102")
);

?>
<!doctype html>
 
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>jQuery UI Sortable - Connect lists</title>
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css" />
  <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
  <script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>
  <style>
  body{font-family:arial}
  #sortable1, #sortable2, #sortable3, #sortable4 { list-style-type: none; margin: 0; padding: 0 0 2.5em; float: left; margin-right: 10px; }
  #sortable1 li, #sortable2 li, #sortable3 li, #sortable4 li { margin: 0 5px 5px 5px; padding: 5px; font-size: 1.2em; width: 93%; }
ul{
width:20em;
border-style:solid;
border-width:5px;
}
  </style>
  <script>
  $(function() {
    $( "#sortable1, #sortable2, #sortable3, #sortable4" ).sortable({
	  
      stop: function(event, ui) {
			var text =$(this).attr('id');
			$("#select-result").text(ui.item.text() + " saved.");
		},
	  connectWith: ".connectedSortable"
	}).disableSelection()
  });
  </script>
</head>
<body>

<p id="feedback">
<span>Server Response</span> <span id="select-result">none</span>.
</p>

<h1><center>Degree Audit++</center></h1>
<hr>
<ul id="sortable1" class="connectedSortable">
     Required Classes
	<li class="ui-state-default" id="MATH165">Math 165 </li>
	<li class="ui-state-default" id="SE101">SE 101</li>
	<li class="ui-state-default" id="SE185">SE 185</li>
	<li class="ui-state-default" id="COMS227">COM S 227</li>
	<li class="ui-state-default">LIB 160</li>
	<li class="ui-state-default">ENGL 150</li>
	<li class="ui-state-default">MATH 166</li>
	<li class="ui-state-default">PHYS 221</li>
	<li class="ui-state-default">SE 166</li>
	<li class="ui-state-default">COM S 228</li>
	<li class="ui-state-default">
		
		ECON ELECTIVE
		<select>
		<?php foreach ($econ_elective_courses as $course): ?>
		<option><?php echo $course->getCourseCode(); ?></option>
		<?php endforeach; ?>
		</select>

		</li>

<li class="ui-state-default">MATH 267</li>
			<li class="ui-state-default">
				SPPLM ELECTIVE
				<select name="spplm_elective">
					<?php foreach ($spplm_elective_courses as $course): ?>
					<option><?php echo $course->getCourseCode(); ?></option>
					<?php endforeach; ?>
				</select>
			</li>
			<li class="ui-state-default">CHEM 167</li>
			<li class="ui-state-default">CPR E 281</li>
			<li class="ui-state-default">ENGL 250</li>
			<li class="ui-state-default">
				US DIVERSITY
				<select name="us_diversity_elective">
					<?php foreach ($us_diversity_elective_courses as $course): ?>
					<option><?php echo $course->getCourseCode(); ?></option>
					<?php endforeach; ?>
				</select>
			</li>
			<li class="ui-state-default">SE 319</li>
			<li class="ui-state-default">
				ADVANCED PROGRAMMING
				<select name="advanced_programing">
					<option>CPR E 288</option>
					<option>COM S 229</option>
				</select>
			</li>
			<li class="ui-state-default">
				MATH ELECTIVE
				<select name="math_elective">
					<?php foreach ($math_elective_courses as $course): ?>
					<option><?php echo $course->getCourseCode(); ?></option>
					<?php endforeach; ?>
				</select>
			</li>
			<li class="ui-state-default">
				COMPUTER ARCITECTURE
				<select name="computer_arcitecture">
					<option>CPR E 381</option>
					<option>COM S 321</option>
				</select>
			</li>
			<li class="ui-state-default">
				SOCIAL SCIENCE ELECTIVE
				<select name="social_science_elective">
					<?php foreach ($social_science_elective_courses as $course): ?>
					<option><?php echo $course->getCourseCode(); ?></option>
					<?php endforeach; ?>
				</select>
			</li>
			<li class="ui-state-default">SE 339</li>
			<li class="ui-state-default">COM S 309</li>
			<li class="ui-state-default">
				DISCRETE MATHEMATCIS
				<select name="discreate_mathematics">
					<option>CPR E 310</option>
					<option>COM S 330</option>
				</select>
			</li>
			<li class="ui-state-default">COM S 363</li>
			<li class="ui-state-default">SP CM 212</li>
			<li class="ui-state-default">SE 329</li>
			<li class="ui-state-default">COM S 311</li>
			<li class="ui-state-default">
				OPERATING SYSTEMS
				<select name="operating_systems">
					<option>CPR E 308</option>
					<option>COM S 352</option>
				</select>
			</li>
			<li class="ui-state-default">ENGL 314</li>
			<li class="ui-state-default">
				INTERNATIONAL PERSPECTIVE
				<select name="international_perspective_elective">
					<?php foreach ($international_perspective_elective_courses as $course): ?>
					<option><?php echo $course->getCourseCode(); ?></option>
					<?php endforeach; ?>
				</select>
			</li>
			<li class="ui-state-default">
				TECHNICAL ELECTIVE
				<select name="technical_elective">
					<?php foreach ($technical_elective_courses as $course): ?>
					<option><?php echo $course->getCourseCode(); ?></option>
					<?php endforeach; ?>
				</select>
			</li>
			<li class="ui-state-default">
				SE ELECTIVE
				<select name="se_elective">
					<?php foreach ($se_elective_courses as $course): ?>
					<option><?php echo $course->getCourseCode(); ?></option>
					<?php endforeach; ?>
				</select>
			</li>
			<li class="ui-state-default">STAT 330</li>
			<li class="ui-state-default">SE 491</li>
			<li class="ui-state-default">SE 494</li>
			<li class="ui-state-default">
				ARTS AND HUMANITIES ELECTIVE
				<select name="arts_and_hunmainties_elective">
					<?php foreach ($arts_and_humanities_elective_courses as $course): ?>
					<option><?php echo $course->getCourseCode(); ?></option>
					<?php endforeach; ?>
				</select>
			</li>	
			<li class="ui-state-default">
				SE ELECTIVE
				<select name="se_elective">
					<?php foreach ($se_elective_courses as $course): ?>
					<option><?php echo $course->getCourseCode(); ?></option>
					<?php endforeach; ?>
				</select>
			</li>	
			<li class="ui-state-default">
				SPPLM ELECTIVE
				<select name="spplm_elective">
					<?php foreach ($spplm_elective_courses as $course): ?>
					<option><?php echo $course->getCourseCode(); ?></option>
					<?php endforeach; ?>
				</select>
			</li>		
			<li class="ui-state-default">
				SPPLM ELECTIVE
				<select name="spplm_elective">
					<?php foreach ($spplm_elective_courses as $course): ?>
					<option><?php echo $course->getCourseCode(); ?></option>
					<?php endforeach; ?>
				</select>
			</li>	
			<li class="ui-state-default">SE 492</li>
			<li class="ui-state-default">
				OPEN ELECTIVE
				<select name="open_elective">
					<?php foreach ($open_elective_courses as $course): ?>
					<option><?php echo $course->getCourseCode(); ?></option>
					<?php endforeach; ?>
				</select>
			</li>		

</ul>
 
 <ul id="sortable2" class="connectedSortable">
   Already Taken
</ul>
 
 <ul id="sortable3" class="connectedSortable">
  Semester 1
</ul>

 <ul id="sortable4" class="connectedSortable">
  Semester 2
</ul>
 



 
 
</body>
</html>