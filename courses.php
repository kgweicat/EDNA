<link href = "homepage.css" rel = "stylesheet">
<header>
	<a id = "logo-link" href = "https://spring-2021.cs.utexas.edu/cs329e-bulko/rmoore/phase4/home.html"><img src = "EDNA.png" alt = ""></a>
	<div id = "navbar">
		<a href = "courses.html">Courses</a>
		<a href = "research.html">Research </a>
		<a href = "work.html">Work</a>
		<a href = "contacts.html">Contact Us</a>
	</div>
</header>

<h3>Thanks for your response! Here is some suggestions on what you should take...</h3>

<?php

$checked_lab = $_POST['lab'];					//array of all lab courses user has taken
$lab_count = count($checked_lab);				//number of lab courses user has taken
$checked_upper_div = $_POST['upper_div'];		//array of all non-lab upper-division courses user has taken
$upper_div_count = count($checked_upper_div);	//number of non-lab upper-division courses user has taken
$checked_flag = $_POST['flag'];					//array of all flags user still need
$flags_needed = count($checked_flag);			//number of flags user still needed
$deg_plan=$_POST["deg_plan"];					//degree plan (BS/BSA/Neuroscience Scholar) chosen by user
$grade=$_POST["year"];							//year user is in
$upper_div_needed = 0; 							//number of non-lab upper-division courses user still has to take
$lab_needed;									//number of lab courses user still has to take

function check_prereq(){
	if(!in_array('prereq_NS1', $_POST['prereq'])){?>
		<p>You seem to be very early on your journey as a neuroscience major.
		At this point, we could not give you too much advice on what class to take in the far future.
		Start with Neural Systems I and II, and come back to us in one or two semester for more course suggestions!</p>
		<?php
		return false;
	}
	if (!in_array('prereq_NS2', $_POST['prereq'])){
		?>
		<p>Here are some upper-division course you can take without NEU 335 Neural Systems II credit: </p>
		<ul>
			<li>NEU 340 Neural Systems III: Quantitative tools</li>
		</ul>
		<?php
	}
	if (!in_array('prereq_phy', $_POST['prereq'])){
		?>
		<p>Here are some upper-division course you can take without having the physics requirement: </p>
		<ul>
			<li>NEU 340 Neural Systems III: Quantitative tools</li>
		</ul>
		<?php
	}
	return true;
}

function calc_credits_needed(){
	global $deg_plan, $upper_div_needed, $upper_div_count, $lab_needed, $lab_count;
	if ($deg_plan == "BS"){
		$upper_div_needed = 15 - $upper_div_count*3;
		$lab_needed = 6 - $lab_count*3;
	} elseif ($deg_plan=="Scholar") {
		$upper_div_needed = 9 - $upper_div_count*3;
		$lab_needed = 15 - $lab_count*3;
	} elseif ($deg_plan=="BSA"){
		$upper_div_needed=12 - ($upper_div_count + $lab_count)*3;
		$lab_needed=0;
	}
	if ($upper_div_needed < 0){
		$upper_div_needed=0;
	}
	if ($lab_needed < 0){
		$lab_needed=0;
	}
}

function display_credits_needed(){
	global $deg_plan, $upper_div_needed, $upper_div_count, $lab_needed, $lab_count, $flags_needed;
	if (check_prereq()==true){
		calc_credits_needed();
		if ($upper_div_needed <= 0 && $lab_needed <= 0 && $flags_needed == 0 && count($_POST['prereq']) == 3){
			?>
			<p class="critical">You seem to meet the graduation requirement regarding neuroscience courses, Congratulations!
			However, you should definitely <a href="https://utdirect.utexas.edu/apps/degree/audits/">run a degree audit</a>
			to see if you have meet all the other requirements, such as core classes, flags, minor/certificate etc.
			Don't forget to take a look at our <a href="work.html">work page</a> if you would like to figure out
			what you would like to do after you graduate!</p>
			<?php
		} else {
			if ($deg_plan=="BSA"){
				?>
				<p class="critical"><b>To meet your graduation requirement, you will need <?php echo $upper_div_needed;?> more credit hours for labs/upper division courses
				and obtain <?php echo $flags_needed?> flags from neuroscience classes.</p></b>
				<?php
			} else {
				?>
				<p class="critical"><b>To meet your graduation requirement, you will need <?php echo $upper_div_needed;?> more credit hours for upper division courses,
				 <?php echo $lab_needed;?> more credit hours for lab courses, and obtain <?php echo $flags_needed?> flag(s) from neuroscience classes.</b></p>
				<?php
			}
		}
	}
}

function display_flag_courses(){
	global $checked_flag;
	if (in_array('writing', $checked_flag)){
		?>
		<p>To obtain your <b>upper division writing flag</b> from neuroscience courses, you can take any of the following classes:</p>
		<ul>
			<li>NEU 365L Neurobiology Laboratory</li>
			<li>NEU 366L NeuroImaging Laboratory</li>
			<li>NEU 366S Neuromolecular Genetic/Disease Lab</li>
			<li>NEU 365N Nerve Regeneration Invertebrate/Vertebrate</li>
		</ul>
		<?php
	}
	if (in_array('inquiry', $checked_flag)){
		?>
		<p>To obtain your <b>independent inquiry flag</b> from neuroscience courses, you can take any of the following classes:</p>
		<ul>
			<li>NEU 365L Neurobiology Laboratory</li>
			<li>NEU 366L NeuroImaging Laboratory</li>
			<li>NEU 366S Neuromolecular Genetic/Disease Lab</li>
		</ul>
		<?php
	}
	if (in_array('quant', $checked_flag)){
		?>
		<p>To obtain your <b>quantitative reasoning flag</b> from neuroscience courses, you can take any of the following classes:</p>
		<ul>
			<li>NEU 366D Synaptic Physiology and Plasticity</li>
		</ul>
		<?php
	}
	
}

function graduate_time(){
	global $upper_div_needed, $lab_needed, $flags_needed, $grade;
	$senior_late=($grade=="senior" && $upper_div_needed + $lab_needed + $flags_needed >= 5);
	$junior_late=($grade=="junior" && ($upper_div_needed + $lab_needed + $flags_needed >= 9 || count($_POST['prereq']) <= 2));
	if ($senior_late || $junior_late){
		?>
		<p>You might be a little tight on the schedule if you would like to graduate on time.
		It might be preferable for you to graduate one or two semesters later instead of trying to tackle too many upper level courses at once.</p>
		<?php
	}
	$sophomore_early=($grade=="sophomore" && $upper_div_needed + $lab_needed + $flags_needed <= 5);
	$junior_early=($grade=="junior" && $upper_div_needed + $lab_needed + $flags_needed <= 2);
	$freshman_early=($grade=="freshman" && count($_POST['prereq']) == 3 + $flags_needed <= 8);
	if ($sophomore_early || $junior_early || $freshman_early){
		?>
		<p>You are pretty on-track regarding your neuroscience courses!
		It seems like you might be able to finish your neuroscience coursework early if you would like to.
		Maybe consider <a href="https://catalog.utexas.edu/undergraduate/the-university/minor-and-certificate-programs/">Obtaining
		a minor or certificate</a> in a field that you are interested in?</p>
		<p class="attached">Note: If you are currently on the BSA degree plan, a minor/certificate will be <b>REQUIRED</b> for you degree.</p>
		<?php
	}
}

display_credits_needed();
display_flag_courses();
graduate_time();

readfile('courses_table.html');
?>



<p>Useful Links:</p>
<div id="bottom_nav">
	<a href="https://utdirect.utexas.edu/apps/student/coursedocs/nlogon/">Look up past CVs and Syllabi</a><br>
	<a href="https://utdirect.utexas.edu/apps/student/coursedocs/nlogon/">Interactive Degree Audit</a><br>
	<a href="http://utdirect.utexas.edu/ctl/ecis/results/index.WBX">Look up eCIS for particular professors/classes</a><br>
	<a href="https://registrar.utexas.edu/schedules">UT Course Schedules</a><br>
	<a href="https://www.ratemyprofessors.com/">Rate my Professors</a><br>
</div>


<footer>
        <span id = "copyright">© EDNA 2021</span>
        <span class = "center-text center-justify-text">
        <span>Page last updated: <script>document.write(document.lastModified);</script></span>
        </span>
</footer>
