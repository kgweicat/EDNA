<html lang="en">

<head>
        <title>Project Phase 6</title>
        <meta charset="UTF-8">
        <meta name="description" content="Final Project phase 6">
        <meta name="group 44" content="Project Phase 6">
	<link href = "homepage.css" rel = "stylesheet">
</head>

<body>
<div id= "container">
<header>
        <a id = "logo-link" href = "https://spring-2021.cs.utexas.edu/cs329e-bulko/rmoore/phase6/home.php"><img src = "EDNA.png" alt = ""></a>
                <div id = "navbar">
                <a href = "https://spring-2021.cs.utexas.edu/cs329e-bulko/rmoore/phase6/courses.html">Courses</a>
                <a href = "https://spring-2021.cs.utexas.edu/cs329e-bulko/rmoore/phase6/research.html">Research </a>
                <a href = "https://spring-2021.cs.utexas.edu/cs329e-bulko/rmoore/phase6/work.html">Work</a>
                <a href = "https://spring-2021.cs.utexas.edu/cs329e-bulko/rmoore/phase6/contacts.html">Contact Us</a>
        </div>
        </header>
<?php 
	$next = "";
	if (!isset ($_COOKIE["loggedIn"])){
                $exp = 0;
        }
        if (isset ($_COOKIE["loggedIn"])){
                $val = explode('|', $_COOKIE["loggedIn"]);
                $exp = $val[0];
        }
	if (isset ($_COOKIE["loggedIn"]) && $exp > time()) {
                $val = explode('|', $_COOKIE["loggedIn"]);
                $exp = $val[0];
                $next = $val[1];
		content($exp);

	}
	elseif (isset($_POST["register"])){
                $next = $_POST["register"];
                if (!isset ($_POST["new_user"]) || !isset($_POST["new_pass"])){
                        $new_user = "";
                        $new_pass = "";
                }
                else{
                        $new_user = $_POST["new_user"];
                        $new_pass = $_POST["new_pass"];
                }
                register($next,$new_user,$new_pass);
        }
        elseif (isset($_POST["login"])) {
                $next = $_POST["login"];
                if (!isset ($_POST["username"]) || !isset( $_POST["password"])){
                        $username = "";
                        $password = "";
                }
                else{
                        $username = $_POST["username"];
                        $password = $_POST["password"];
                }
                tried($next,$username,$password);

        }
        else {
		home();
	}

	##############

	function home(){
		print<<<HOME
<div class ="sideNav">
                <b>Students: See Fall 2021 Courses!</b>
                <form id = "log" action = "home.php" method = "post">
                        <button name = "login" onclick="document.getElementById('log').submit();">Click Here!</button> <br>
		</form><br>
</div>

<div id = "internships" class =  "researchContent  normal-text center-text">
  <br><br><h1>What is EDNA?</h1>
  <p>    EDNA is your one stop shop for all things Neuroscience at UT! We wanted to make a site that will serve as a guide for incoming and current Neuroscience students. Here You'll find: general help, career options in neuroscience, course recomendations, and find faculty members and what research they are conducting along with research assistantships our team recommends.
  </p>
<br><br>
  <h3>A video to get you excited about your neuroscience studies here at UT!</h3>
  <br>
  <iframe width="560" height="315" src="https://www.youtube.com/embed/lq1Xr5mMAa0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
  <br>
  <p>
  A disclaimer:
  Before beginning any new research activities, all students should consult the <a href ="https://research.utexas.edu/undergraduate-research-restart/">Undergraduate Research Restart guidelines</a> from the Office of the Vice President for Research — and their faculty mentor — to ensure that they're following the latest guidance about in-person versus remote research.
  </p>
  <p>Below we have added the best tips we found for college in general and especially during these times!
  </p>
	<br><br>
  <h4>Five Proven Study Hacks for College Students:</h4>

  <h4>1. Change Your Surroundings</h4>
  <p>
  Our Team has found that a change in surroundings can be the difference between finishing an assignment and totally giving up. It's always a good idea to grab a coffee and head out of the house and to the library or stay in the coffee shop and study. With the current state of things, that isn't a good idea so we recommend:
  </p>
  <ul>
          <li>A quiet picnic table in a sparsely populated park</li>
          <li>Your own balcony, patio, or backyard</li>
          <li>A different room in your own house, such as the family room or den</li>
          <li>On a bench in a deserted garden</li>
          <li>Inside your car</li>
</ul>
<p>
Sometimes wifi can be an issue in these places so we also recommend getting a hotspot (personal wifi router) if you're able to make sure you're connected wherever you go.
</p>
<br>
<h4>2. Make a Daily Routine</h4>
<p>
It may seem overwhelming at first, but a strict schedule can be a great way to keep up with assignments while still living it up in college. We aren't saying to fill every second of the day with school work, but rather to make sure you leave time for other activities and time with friends!
</p>
<br>
<h4>3. Keeping Clean</h4>
The worst thing is waking up to a ton of chores. It significantly decresease your metal health and productivity. For these reasons, We strongly suggest keeping up on chores for your own good! The last thing you need while trying to study and have fun is to worry about dirty dishes and washing your sheets. Now we aren't experts at keeping clean (Not even close!) but we have found some experts for you to check out and follow:
</p>
<ul>
	<li>
		<a href = "https://www.hgtv.com/lifestyle/clean-and-organize/your-top-10-organizing-tips">HGTV Tips</a>
	</li>
		<li>
			<a href = "https://www.pinterest.com/pin/158963061833006694/">Pinterest Student Hacks</a>
		</li>
		<li>
			<a href = "https://konmari.com/">And of course Marie Kondo tips</a>
		</li>
		
</ul>
<br><br>
<h4>4.Review material before each class</h4>
<p>
Take good notes and be sure to review them before each online class with your professors. This will help you to be more prepared during the session, but there’s another perk, as well. Hearing the information repeated back to you will help you better retain it. If sessions are live, record them so you can watch again during your designated study times. Take notes during each lecture and then take a half hour afterward to either re-type them in a more cohesive way, or to jot them down in a notebook so they’re neater and easier to follow.
</p>
<br><br>
<h4>5. Stay Organized</h4>
<p>
Keep a detailed calendar with all your commitments, including classwork, social events and extracurricular activities. This way, you can block out time each day to study.
<br>
<br>
<a href = "https://www.campusexplorer.com/college-advice-tips/7D1CF79C/Get-Organized-How-to-Develop-Better-Study-Habits/">Organizing class materials</a>is also one of the most important study tips for college students. Use sticky notes to remember important textbook pages, keep your returned assignments, and make flashcards for key terms. You’ll thank yourself come exam time!
</p>
</div>
HOME;
	}
	##################################
	
	function tried($next, $username, $password){
                $script = $_SERVER['PHP_SELF'];
                $count = 0;
                if ($username !== "" && $password !== ""){
                if ($fh = fopen("passwd.txt","r")){
                        $s_user = str_replace(' ','',$username);
                        $s_pass = str_replace(' ','',$password);
                        while (($line = fgets($fh)) !== false){
                                $word_arr = explode(":",$line);
                                $word_arr[0] = str_replace(' ','',$word_arr[0]);
                                $word_arr[1] = str_replace(' ','',$word_arr[1]);
                                $word_arr[1] = rtrim($word_arr[1]);
                                if ($word_arr[0] == $s_user && $word_arr[1] == $s_pass){
                                        $count += 1;
                                        $exp = time() + 120;
                                        setCookie('loggedIn', "$exp|$next", $exp);
                                        header("Refresh:0;");
                                        }
                        }

                        if ($count < 1){
                                print "<script> alert('Incorrect Username or Password') </script>";
                        }
                        fclose($fh);

                }
                }


                print <<<LOGIN
                <div id = "main">
                <h3> Login </h3>
                <form id = "logged" action = "home.php" method = "post">
                        <input type = "hidden" name = "login" value = '$next'/>
                        Username <br>
                        <input id="U" name="username" type="text" size="30"><br>
                        Password <br>
                        <input id="P" name="password" type="text" size="30"><br>
                        <input type = "submit" value = "Submit" />
                </form>

                <form id = "reggie" action = "home.php" method = "post">
                        <input type = "hidden" name = "register" value = '$next' />
                        <a href= "#" onclick = "document.getElementById('reggie').submit();">Register Here </a>
                </form>
LOGIN;

	}

	######################
	function register($next,$new_user,$new_pass){

                print<<<REG
                <div class="content">
                        <h2> Register </h2>
                        <form id = "logged" action = "home.php" method = "post">
                                <input type = "hidden" name = "register" value = '$next'/>
                                Enter a New Username <br>
                                <input id="U" name="new_user" type="text" size="30"><br>
                                Enter a New Password <br>
                                <input id="P" name="new_pass" type="text" size="30"><br>
                                <input type = "submit" value = "Submit" />
                        </form>
                </div>

REG;

                if ($new_pass !== "" && $new_user !== ""){
                        $count = 0;
                        if ($fh = fopen("passwd.txt","r")){
                        $s_user = str_replace(' ','',$new_user);
                        $s_pass = str_replace(' ','',$new_pass);
                        while (($line = fgets($fh)) !== false){
                                $word_arr = explode(":",$line);
                                $word_arr[0] = str_replace(' ','',$word_arr[0]);
                                if ($word_arr[0] == $s_user){
                                        $count += 1;
                                        }
                        }
                        fclose($fh);
                        if ($count < 1){
                                $exp = time() + 2;
                                        setCookie('loggedIn', "$exp|$next", $exp);
                                        header("Refresh:0;");
                        if ($fh = fopen("passwd.txt","a")){
                                $content= "$s_user:$s_pass". "\n";
                                fwrite($fh,$content);
                                fclose($fh);
                        }
                        }
                        else{
                                print "<script> alert('Username has already been taken') </script>";
                        }

                        }
                }

	}

	##############

	function content($exp){
		setCookie('loggedIn',"nah", time() - 3600);
		header('Location: logged_in.php');
                exit;
		unset($_COOKIE['loggedIn']);
	}
?>

<footer>
        <span id = "copyright">© EDNA 2021</span>
        <span class = "center-text center-justify-text">
        <span>Page last updated: <script>document.write(document.lastModified);</script></span>
        </span>
</footer>
</div>
</div>
</body>
</html>
