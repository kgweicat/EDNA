<head>
        <title>EDNA Database</title>
        <meta charset="UTF-8">
        <meta name="description" content="Final Project phase 6">
        <meta name="group 44" content="Project Phase 6">
        <link href = "homepage.css" rel = "stylesheet">
</head>

<body>
<div id= "container">
        <header>
        <a id = "logo-link" href = "https://spring-2021.cs.utexas.edu/cs329e-bulko/soha/phase6/home.php"><img src = "EDNA.png" alt = ""></a>
                <div id = "navbar">
                <a href = "https://spring-2021.cs.utexas.edu/cs329e-bulko/camsch74/phase6/courses.html">Courses</a>
                <a href = "https://spring-2021.cs.utexas.edu/cs329e-bulko/camsch74/phase6/research.html">Research </a>
                <a href = "https://spring-2021.cs.utexas.edu/cs329e-bulko/camsch74/phase6/work.html">Work</a>
                <a href = "https://spring-2021.cs.utexas.edu/cs329e-bulko/camsch74/phase6/contacts.html">Contact Us</a>
        </div>
        </header>
	
	<div>


<?php

if (isset($_POST["insertPage"])) {
	insertPage();

} else if (isset($_POST["dbInsert"])) {
        dbInsert();

} else if (isset($_POST["updatePage"])) {
        updatePage();

} else if (isset($_POST["dbUpdate"])) {
        dbUpdate();

} else if (isset($_POST["deletePage"])) {
	deletePage();

} else if (isset($_POST["dbDelete"])) {
	dbDelete();

} else if (isset($_POST["searchPage"])) {
	searchPage();

} else if (isset($_POST["dbSearch"])) {
	dbSearch();

} else if (isset($_POST["allRecords"])) {
	allRecords();

} else if (isset($_POST['researchAreas'])) {
	researchAreas();

} else if (isset($_POST['dbResearch'])) {
	dbResearch();
	
} else {
	getData();
}

###########################################################

function getData() {
	$script = $_SERVER['PHP_SELF'];

	$server    = "spring-2021.cs.utexas.edu";
        $user      = "cs329e_bulko_soha";
        $pwd       = "Part=stem8Staple";
        $dbName    = "cs329e_bulko_soha";

 	$path = "profInfo.json";
	$data = json_decode(file_get_contents($path));
 
	$mysqli    = new mysqli ($server, $user, $pwd, $dbName);
        
	// If it returns a non-zero error number, print a message and stop execution immediately
	if ($mysqli->connect_errno) {
                die('Connect Error: ' . $mysqli->connect_errno . ": " . $mysqli->connect_error);
	}

	if (($check = $mysqli->query("SELECT * FROM `neuro` LIMIT 1")->fetch_object())) {
		actions();

	} else {
		foreach ($data as $key=>$value) {
		
			$currName = $key;	
			$currData = ["n/a", "n/a", "n/a", "n/a", "n/a"];
		
			for ($i=0; $i < count($currData); $i++) {
				if ($value[$i] != " ") {
					$currData[$i] = $value[$i];
				}
			}
		
			$title = $currData[0];
			$honorsBlurb = $currData[1];
			$researchBlurb = $currData[2];
			$email = $currData[3];
			$office = $currData[4];

			$newRecord = "INSERT INTO neuro (name, title, honorsBlurb, researchBlurb, email, office) VALUES (\"" . $currName . "\", \"" . $title . "\", \"" . $honorsBlurb . "\", \"" . $researchBlurb . "\", \"" . $email . "\", \"" . $office . "\")";
               		if ($mysqli->query($newRecord) === TRUE) {
                	        echo "looks good!";
                	} else {
                	        echo $newRecord;
                	        echo "Uh oh...";
                	        echo "Error: <br>" . $mysqli->error . "<br>";
                	}
		}
		$mysqli->close();
		actions();
	}
}

#############################################################

function actions() {
	
	$script = $_SERVER['PHP_SELF'];
	print <<<ACTIONS
                <html>
                <head>
                <title> Actions </title>
		<style>
		h3 {
			padding-top: 15px;
			padding-bottom: 15px;
			margin-top:5px;
		}
                tr {
                        padding:15px;
                        padding: 12px 20px;
                        margin: 8px 0;
                        font-size:18px;
                        box-sizing:border-box;
                        border-radius: 4px;
                        border: none;
                }
                input[type=submit], input[type=reset] {
                        background-color: #FF8C00;
			color: white;
			font-family: 'Source Sans Pro', sans-serif;
			border: none;
			border-radius: 4px;
			cursor: pointer;
                        padding: 12px 20px;
                        font-size:14px;
                        padding-top:10px;
			margin-top:5px;
                }

                input[type=submit]:hover, input[type=reset]:hover {
			background-color: #FF4500;
                }

                input[type=text], input[type=password] {
                        height:40px;
		}       
                
                td {
                        color:#310066;
                }
                </style>
		</head>
                <body>
                <h3 align="center"> Select an action below: </h3>

                <form method="post" action=$script>

                <table align="center">
		<th> For Students: </th>
		<tr> 
		</tr>
                        <td> <input name="researchAreas" value="Browse Research Topics" type="submit" size="30" /> </td>
                        <td> <input name="searchPage" value="Search Professors" type="submit" size="30" /> </td>
                        <td> <input name="allRecords" value="All Records" type="submit" size="30" /> </td>
		</table>
		<br> <br> 
		<table align="center">
		<th> For Professors: </th>
		<tr>
                        <td> <input name="insertPage" value="Insert Record" type="submit" size="30" /> </td>	
			<td> <input name="updatePage" value="Update Record" type="submit" size="30" /> </td>
			<td> <input name="deletePage" value="Delete Record" type="submit" size="30" /> </td>
		</tr>
		</table>
		</form>

                </body>
                </html>
ACTIONS;
}

##############################################################

function insertPage() {
	$script = $_SERVER['PHP_SELF'];
        print <<<INSERT
                <html>
                <head>
                <title> Insert Record </title>
		<style>
                h3 {
                        padding-top: 15px;
                        padding-bottom: 15px;
                        margin-top:5px;
                }
                tr {
                        padding:15px;
                        padding: 12px 20px;
                        margin: 8px 0;
                        font-size:18px;
                        box-sizing:border-box;
                        border-radius: 4px;
                        border: none;
                }
                input[type=submit], input[type=reset] {
                        background-color: #FF8C00;
                        color: white;
                        font-family: 'Source Sans Pro', sans-serif;
                        border: none;
                        border-radius: 4px;
                        cursor: pointer;
                        padding: 12px 20px;
                        font-size:14px;
                        padding-top:10px;
                        margin-top:5px;
                }

                input[type=submit]:hover, input[type=reset]:hover {
                        background-color: #FF4500;
		}

                input[type=text], input[type=password] {
                        height:40px;
                }

                td {
                        color:#310066;
                }
                </style>

		</head>
                <body>
		<h3> Fill in the boxes below: </h3>

		<form method="post" action=$script>

                <table>
                <tr>
                        <td> Name: </td>
                        <td> <input name="name" type="text" size="30" required /> </td>
		</tr>
		<tr>
                        <td> Title: </td>
                        <td> <input name="title" type="text" size="30" required /> </td>
		</tr>
		<tr>
                        <td> Honors Blurb: </td>
                        <td> <input name="honorsBlurb" type="text" size="30" required /> </td>
		</tr>

                <tr>
			<td> Research Area: </td>
                        <td> <input name="researchArea" type="text" size="30" required /> </td>
		</tr>
 
                <tr>
                        <td> Research Blurb: </td>
                        <td> <input name="researchBlurb" type="text" size="30" required /> </td>
		</tr>
                <tr>
                        <td> Email: </td>
                        <td> <input name="email" type="text" size="30" required /> </td>
                </tr>

                <tr>
                        <td> Office: </td>
                        <td> <input name="office" type="text" size="30" required /> </td>
                </tr>
                </table>

                <p>
                <input name="dbInsert" type="submit" value="Enter" />
                <input name="reset" type="reset" value="Reset" />
                </p>
                </form>
INSERT;
}

#########################################################

function dbInsert() {
	// Optionally store the parameters in variables
	$name  = $_POST["name"];
	$title = $_POST["title"];
	$honorsBlurb = $_POST['honorsBlurb'];
	$researchArea = $_POST['researchArea'];
	$researchBlurb = $_POST['researchBlurb'];
	$office = $_POST['office'];
	$email = $_POST['email'];

	$server    = "spring-2021.cs.utexas.edu";
	$user      = "cs329e_bulko_soha";
	$pwd       = "Part=stem8Staple";
	$dbName    = "cs329e_bulko_soha";
	
 	$mysqli    = new mysqli ($server, $user, $pwd, $dbName);

	// If it returns a non-zero error number, print a message and stop execution immediately
	if ($mysqli->connect_errno) {
		die('Connect Error: ' . $mysqli->connect_errno . ": " . $mysqli->connect_error);
	}
	$newRecord = "INSERT INTO neuro (name, title, honorsBlurb, researchBlurb, researchArea, email, office) VALUES (\"" . $name . "\", \"" . $title . "\", \"" . $honorsBlurb . "\", \"" . $researchBlurb . "\", \"" . $researchArea . "\", \"" . $email . "\", \"" . $office . "\")";

        $home = actions();
        if ($mysqli->query($newRecord) === TRUE) {
        	$home;
                //echo "looks good
        } else {
                //echo $newRecord;
                echo "Error: <br>" . $mysqli->error . "<br>";
        }
	$mysqli->close();
}


##############################################################

function updatePage() {
        $script = $_SERVER['PHP_SELF'];
        print <<<UPDATE
                <html>
                <head>
                <title> Update Student Record </title>
                <style>
                h3 {
                        padding-top: 15px;
                        padding-bottom: 15px;
                        margin-top:5px;
                }
                tr {
                        padding:15px;
                        padding: 12px 20px;
                        margin: 8px 0;
                        font-size:18px;
                        box-sizing:border-box;
                        border-radius: 4px;
                        border: none;
		}
		input[type=submit], input[type=reset] {
                        background-color: #FF8C00;
                        color: white;
                        font-family: 'Source Sans Pro', sans-serif;
                        border: none;
                        border-radius: 4px;
                        cursor: pointer;
                        padding: 12px 20px;
                        font-size:14px;
                        padding-top:10px;
                        margin-top:5px;
                }

                input[type=submit]:hover, input[type=reset]:hover {
                        background-color: #FF4500;
                }

                input[type=text], input[type=password] {
                        height:40px;
                }

                td {
                        color:#310066;
                }
                </style>

                </head>
                <body>
                <h3> Fill in the boxes below: </h3>

                <form method="post" action=$script>

                <table>
		<tr>
                        <td> Name: </td>
                        <td> <input name="name" type="text" size="30" required /> </td>
                </tr>
                <tr>
                        <td> Title: </td>
                        <td> <input name="title" type="text" size="30"  /> </td>
                </tr>
                <tr>
                        <td> Honors Blurb: </td>
                        <td> <input name="honorsBlurb" type="text" size="30"  /> </td>
                </tr>

                <tr>
                        <td> Research Area: </td>
                        <td> <input name="researchArea" type="text" size="30" /> </td>
                </tr>

                <tr>
                        <td> Research Blurb: </td>
                        <td> <input name="researchBlurb" type="text" size="30" /> </td>
                </tr>
                <tr>
                        <td> Email: </td>
                        <td> <input name="email" type="text" size="30" /> </td>
                </tr>

                <tr>
                        <td> Office: </td>
                        <td> <input name="office" type="text" size="30"  /> </td>
                </tr>
		</table>

                <p>
                <input name="dbUpdate" type="submit" value="Enter" />
                <input name="reset" type="reset" value="Reset" />
                </p>
                </form>
UPDATE;
}

#########################################################

function dbUpdate() {
        $name  = $_POST["name"];
        $title = $_POST["title"];
        $honorsBlurb = $_POST['honorsBlurb'];
        $researchArea = $_POST['researchArea'];
        $researchBlurb = $_POST['researchBlurb'];
	$office = $_POST['office'];
	$email = $_POST['email'];

        if (empty($title) && empty($honorsBlurb) && empty($researchBlurb) && empty($researchArea) && empty($office) && empty($email)) {
                print <<<POPUP
                <script>
                alert("Please complete at least one field.");
                </script>
POPUP;
                updatePage();
        } else {

        $server = "spring-2021.cs.utexas.edu";
        $user = "cs329e_bulko_soha";
        $pwd = "Part=stem8Staple";
        $dbName = "cs329e_bulko_soha";

        $mysqli = new mysqli ($server, $user, $pwd, $dbName);

        if ($mysqli->connect_errno) {
                die('Connect Error: ' . $mysqli->connect_errno . ": " . $mysqli->connect_error);
        }

        $userInput = array($name, $title, $honorsBlurb, $researchArea, $researchBlurb, $office, $email);
        $cols = array("name", "title", "honorsBlurb", "researchArea", "researchBlurb", "office", "email");
        $set = "SET ";
        $i = 0;
        foreach ($userInput as $field) {
                if ($field !== "") {
                        $set = $set . "$cols[$i] = '$field', ";
                }
                $i++;
        }
        $setVars = rtrim($set, ", ");
        $updateRecord = "UPDATE neuro " . $setVars . " WHERE name='" . $name . "'";

        $home = actions();
        if ($mysqli->query($updateRecord) === TRUE) {
                $home;
        } else {
                echo "Error: " . $updateRecord . "<br>" . $mysqli->error;
        }

        $mysqli->close();
        }
}



##############################################################

function deletePage() {
        $script = $_SERVER['PHP_SELF'];
        print <<<DELETEPG
                <html>
                <head>
                <title> Delete Record </title>
		<style>
                h3 {
                        padding-top: 15px;
                        padding-bottom: 15px;
                        margin-top:5px;
                }
                tr {
                        padding:15px;
                        padding: 12px 20px;
                        margin: 8px 0;
                        font-size:18px;
                        box-sizing:border-box;
                        border-radius: 4px;
                        border: none;
                }
		input[type=submit], input[type=reset] {
                        background-color: #FF8C00;
                        color: white;
                        font-family: 'Source Sans Pro', sans-serif;
                        border: none;
                        border-radius: 4px;
                        cursor: pointer;
                        padding: 12px 20px;
                        font-size:14px;
                        padding-top:10px;
                        margin-top:5px;
                }

                input[type=submit]:hover, input[type=reset]:hover {
                        background-color: #FF4500;
                }

                input[type=text], input[type=password] {
                        height:40px;
                }

                td {
                        color:#310066;
                }
                </style>

		</head>
                <body>
                <h3> Fill in at least ONE of the boxes below: </h3>

                <form method="post" action=$script>

                <table>
                <tr>
                        <td> Name: </td>
			<td> <input name="name" type="text" size="30" /> </td>
		</tr>
		<tr>
			<td> Email: </td>
			<td> <input name="email" type="text" size="30" /> </td>
		</tr>
                </table>

                <p>
                <input name="dbDelete" type="submit" value="Enter" />
                <input name="reset" type="reset" value="Reset" />
                </p>
                </form>
DELETEPG;
}

#########################################################

function dbDelete() {
        // Optionally store the parameters in variables
        $name        = ($_POST["name"]);
	$email = ($_POST["email"]);
        if (empty($name) && empty($email)) {
                print <<<POPUP
                <script>
                alert("Please complete at least one field.");
                </script>
POPUP;
                deletePage();
        } else {

        $server = "spring-2021.cs.utexas.edu";
        $user = "cs329e_bulko_soha";
        $pwd = "Part=stem8Staple";
        $dbName = "cs329e_bulko_soha";

        $mysqli = new mysqli ($server, $user, $pwd, $dbName);

        // If it returns a non-zero error number, print a message and stop execution immediately
        if ($mysqli->connect_errno) {
                die('Connect Error: ' . $mysqli->connect_errno . ": " . $mysqli->connect_error);
        } 
	if (empty($email)) {
        	$deleteRecord = "DELETE FROM neuro WHERE name=\"$name\"";
	} else if (empty($name)) {
		$deleteRecord = "DELETE FROM neuro WHERE email=\"$email\"";
	}

        if ($mysqli->query($deleteRecord) === TRUE) {
                actions();
        } else {
                echo "Error: " . $deleteRecord . "<br>" . $mysqli->error;
        }

        $mysqli->close();
	
	}
}

##############################################################
function researchAreas() {
	$script = $_SERVER['PHP_SELF'];
        print <<<RESEARCH
                <html>
                <head>
                <title> Research Areas </title>
                <style>
                h3 {
                        padding-top: 15px;
                        padding-bottom: 15px;
                        margin-top:5px;
                }
                tr {
                        padding:15px;
                        padding: 12px 20px;
                        margin: 8px 0;
                        font-size:18px;
                        box-sizing:border-box;
                        border-radius: 4px;
                        border: none;
                }

                button {
                        background-color: #FF8C00;
                        color: white;
                        font-family: 'Source Sans Pro', sans-serif;
                        border: none;
                        border-radius: 4px;
                        cursor: pointer;
                        padding: 12px 20px;
                        font-size:14px;
                        padding-top:10px;
                        margin-top:5px;
                }
                .dropButton {
                        width: 250px;
                }

                button:hover {
                        background-color: #FF4500;
                }

                input[type=text], input[type=password] {
                        height:40px;
                }

                td {
                        color:#310066;
                }
                </style>

                </head>
                <body>
                <h3> If you don't yet know where to start—do not fret! <br> Choose a field that catches your eye, and <br>  we'll take care of the rest. </h3>

                <form method="post" action=$script>
RESEARCH;

        $server = "spring-2021.cs.utexas.edu";
        $user   = "cs329e_bulko_soha";
        $pwd    = "Part=stem8Staple";
        $dbName = "cs329e_bulko_soha";

        $mysqli = new mysqli ($server, $user, $pwd, $dbName);

        if ($mysqli->connect_errno) {
                die('Connect Error: ' . $mysqli->connect_errno . ": " . $mysqli->connect_error);
        }

        $dropDownMenu = "SELECT researchArea FROM neuro";
        $result = $mysqli->query($dropDownMenu);

        if (!$result) {
                echo "Error: " . $result . "<br>" . $mysqli->error;
        }
        echo "<div class='dropdown'>";
        echo "<button class='dropButton'> Research Areas </button>";
        echo "<div class='dropdownContent'>";

	$unique = [];
	$dropDownContent = [];

	while ($option = $result->fetch_assoc()) {
		$currItem = $option['researchArea'];
			
                if (!in_array($currItem, $unique)) {
			if ($currItem != NULL) {	
				array_push($unique, $currItem);
        	                array_push($dropDownContent, "<input type='submit' name=dbResearch value= '" . $currItem . "'>");
			}
		}
	}
	
	sort($dropDownContent, SORT_NATURAL | SORT_FLAG_CASE);
	
	$i = 0;
	while ($i < count($dropDownContent)) {
		echo $dropDownContent[$i];
		$i++;
	}
	print <<<RESEARCHBOTTOM
	<p>
        </p>
        <br><br><br>
	</div>
	</div> 
	</div>
	</form>
	</body>
	</html>
RESEARCHBOTTOM;
}
#########################################################

function dbResearch() {
	$researchArea = $_POST["dbResearch"];
	$server = "spring-2021.cs.utexas.edu";
        $user   = "cs329e_bulko_soha";
        $pwd    = "Part=stem8Staple";
        $dbName = "cs329e_bulko_soha";

        $mysqli = new mysqli ($server, $user, $pwd, $dbName);

        if ($mysqli->connect_errno) {
                die('Connect Error: ' . $mysqli->connect_errno . ": " . $mysqli->connect_error);
        }

        $search    = "WHERE researchArea=\"$researchArea\"";
        $viewRecord = "SELECT * FROM neuro " . $search;
        $result     = $mysqli->query($viewRecord);

        if (!$result) {
                echo "Error: " . $result . "<br>" . $mysqli->error;
        }
	
	print <<<RESEARCHRESULTS
                <head>
                <title> Existing Records </title>
                <style>
                h3 {
                        padding-top: 15px;
                        padding-bottom: 15px;
                        margin-top:5px;
                }
                tr {
                        padding:15px;
                        padding: 12px 20px;
                        margin: 8px 0;
                        font-size:18px;
                        box-sizing:border-box;
                        border-radius: 4px;
                        border: none;
                }

                input[type=submit], input[type=reset] {
                        background-color: #FF8C00;
                        color: white;
                        font-family: 'Source Sans Pro', sans-serif;
                        border: none;
                        border-radius: 4px;
                        cursor: pointer;
                        padding: 12px 20px;
                        font-size:14px;
                        padding-top:10px;
                        margin-top:5px;
                }

                input[type=submit]:hover, input[type=reset]:hover {
                        background-color: #FF4500;
                }

                input[type=text], input[type=password] {
                        height:40px;
                }

                td {
                        color:#310066;
                }
                </style>

                </head>
                <h3 align="center"> Results </h3>
                <table border="border" width="60%" align="center">
                <tr>
                        <th> Full Name </th>
                        <th> Title </th>
                        <th> Email </th>
                        <th> Office </th>
                        <th> Research Area </th>
                        <th> Research Blurb </th>
                        <th> Honors Blurb </th>
                </tr>
RESEARCHRESULTS;

        while ($row = mysqli_fetch_array($result)) {
                echo "<tr>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['title'] . "</td>";
                echo "<td><a href='mailto:" . $row['email'] . "'>" . $row['email'] . "</a></td>";
                echo "<td>" . $row['office'] . "</td>";
                echo "<td>" . $row['researchArea'] . "</td>";
                echo "<td>" . $row['researchBlurb'] . "</td>";
                echo "<td>" . $row['honorsBlurb'] . "</td>";
                echo "</tr>";
        }

        echo "</table>";
        $mysqli->close();


}

##############################################################


function searchPage() {
        $script = $_SERVER['PHP_SELF'];
        print <<<SEARCHTOP
                <html>
                <head>
                <title> Search Record </title>
		<style>
                h3 {
                        padding-top: 15px;
                        padding-bottom: 15px;
                        margin-top:5px;
                }
                tr {
                        padding:15px;
                        padding: 12px 20px;
                        margin: 8px 0;
                        font-size:18px;
                        box-sizing:border-box;
                        border-radius: 4px;
                        border: none;
                }

                input[type=submit], input[type=reset], button {
                        background-color: #FF8C00;
                        color: white;
                        font-family: 'Source Sans Pro', sans-serif;
			border: none;
                        border-radius: 4px;
                        cursor: pointer;
                        padding: 12px 20px;
                        font-size:14px;
                        padding-top:10px;
                        margin-top:5px;
		}
		.dropButton {
			width: 250px;
		}

                input[type=submit]:hover, input[type=reset]:hover, button:hover {
                        background-color: #FF4500;
                }

                input[type=text], input[type=password] {
                        height:40px;
                }

                td {
                        color:#310066;
                }
                </style>

		</head>
		<body>
		<h3> If you already have an idea of what you're looking for, way to go! <br> Use the search boxes below to find your target: </h3>

                <form method="post" action=$script>
		<table>
                <tr>
                        <td> Name: </td>
                        <td> <input name="name" type="text" size="30" /> </td>
                </tr>
		</table>
		
		<p>
                <input name="dbSearch" type="submit" value="Enter" />
                <input name="reset" type="reset" value="Reset" />
		</p>
		<p>

		</div> 
		</div> 
		</p>
		</div>
		</form>
		</body>
		</html>
SEARCHTOP;
}
#########################################################

function dbSearch() {
        $name = ($_POST["name"]);

        if (empty($name)) {
                print <<<POPUP
                <script>
                alert("Please complete at least one field.");
                </script>
POPUP;
                searchPage();
	} else {
	
	$server = "spring-2021.cs.utexas.edu";
        $user   = "cs329e_bulko_soha";
        $pwd    = "Part=stem8Staple";
        $dbName = "cs329e_bulko_soha";

        $mysqli = new mysqli ($server, $user, $pwd, $dbName);

        if ($mysqli->connect_errno) {
                die('Connect Error: ' . $mysqli->connect_errno . ": " . $mysqli->connect_error);
        }

        $search    = "WHERE name=\"$name\"";
        $where      = rtrim($search, ", ");
        $viewRecord = "SELECT * FROM neuro " . $where;
	$result     = $mysqli->query($viewRecord);
	
	if (!$result) {
		echo "Error: " . $result . "<br>" . $mysqli->error;
	}
	if (!mysqli_num_rows($result)) {
		print <<<POPUP
		<script>
                alert("No matches.");
                </script>
POPUP;
		searchPage();
                //actions();
	} else {
		print <<<VIEW
		<head> 
		<title> Existing Records </title> 
		<style>
                h3 {
                        padding-top: 15px;
                        padding-bottom: 15px;
                        margin-top:5px;
                }
                tr {
                        padding:15px;
                        padding: 12px 20px;
                        margin: 8px 0;
                        font-size:18px;
                        box-sizing:border-box;
                        border-radius: 4px;
                        border: none;
                }

                input[type=submit], input[type=reset] {
                        background-color: #FF8C00;
                        color: white;
                        font-family: 'Source Sans Pro', sans-serif;
                        border: none;
                        border-radius: 4px;
                        cursor: pointer;
                        padding: 12px 20px;
                        font-size:14px;
                        padding-top:10px;
                        margin-top:5px;
                }

                input[type=submit]:hover, input[type=reset]:hover {
                        background-color: #FF4500;
                }

                input[type=text], input[type=password] {
                        height:40px;
                }

                td {
                        color:#310066;
                }
                </style>

		</head>
		<h3 align="center"> Results </h3>
                <table border="border" width="60%" align="center">
                <tr>
                        <th> Full Name </th>
			<th> Title </th>
                        <th> Email </th>
			<th> Office </th>
			<th> Research Area </th>
			<th> Research Blurb </th>
                        <th> Honors Blurb </th>
                </tr>
VIEW;

	while ($row = mysqli_fetch_array($result)) {
		echo "<tr>";
		echo "<td>" . $row['name'] . "</td>";
		echo "<td>" . $row['title'] . "</td>";
		echo "<td><a href='mailto:" . $row['email'] . "'>" . $row['email'] . "</a></td>";
		echo "<td>" . $row['office'] . "</td>";
		echo "<td>" . $row['researchArea'] . "</td>";
                echo "<td>" . $row['researchBlurb'] . "</td>";
                echo "<td>" . $row['honorsBlurb'] . "</td>";
		echo "</tr>";
	}
	

	echo "</table>";
	}
	$mysqli->close();
	
	}
}
###########################################################################

function allRecords() {
	$server = "spring-2021.cs.utexas.edu";
        $user   = "cs329e_bulko_soha";
        $pwd    = "Part=stem8Staple";
        $dbName = "cs329e_bulko_soha";

        $mysqli = new mysqli ($server, $user, $pwd, $dbName);

        if ($mysqli->connect_errno) {
                die('C-onnect Error: ' . $mysqli->connect_errno . ": " . $mysqli->connect_error);
        }
	$allRecords = "SELECT * FROM neuro  ORDER BY name";
	$result     = $mysqli->query($allRecords);

        if (!$result) {
                echo "Error: " . $result . "<br>" . $mysqli->error;
        }
	
	print <<<VIEW
		<head>
		<title> All Records </title>
		<style>
                h3 {
                        padding-top: 15px;
                        padding-bottom: 15px;
                        margin-top:5px;
                }
                tr {
                        padding:15px;
                        padding: 12px 20px;
                        margin: 8px 0;
                        font-size:18px;
                        box-sizing:border-box;
                        border-radius: 4px;
                        border: none;
                }

                input[type=submit], input[type=reset] {
                        background-color: #FF8C00;
                        color: white;
                        font-family: 'Source Sans Pro', sans-serif;
                        border: none;
                        border-radius: 4px;
                        cursor: pointer;
                        padding: 12px 20px;
                        font-size:14px;
                        padding-top:10px;
                        margin-top:5px;
                }

                input[type=submit]:hover, input[type=reset]:hover {
                        background-color: #FF4500;
                }

                input[type=text], input[type=password] {
                        height:40px;
                }

                td {
                        color:#310066;
                }
                </style>
		</head>
		<h3 align="center"> All Records </h3>
                <table border="border" width="60%" align="center">
                <tr>
                        <th> Name </th>
                        <th> Title </th>
			<th> Research Area </th>
                        <th> Research Blurb </th>
			<th> Honors Blurb </th>
                        <th> Email </th>
                        <th> Office </th>
                </tr>
VIEW;

        while ($row = mysqli_fetch_array($result)) {
                echo "<tr>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['title'] . "</td>";
		echo "<td>" . $row['researchArea'] . "</td>";
		echo "<td>" . $row['researchBlurb'] . "</td>";
                echo "<td>" . $row['honorsBlurb'] . "</td>";
                echo "<td><a href='mailto:" . $row['email'] . "'>" . $row['email'] . "</a></td>";
                echo "<td>" . $row['office'] . "</td>";
                echo "</tr>";
        }


        echo "</table>";
        
        $mysqli->close();
}

?>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
</div>
<footer>
                <span id = "copyright">© EDNA 2021</span>
                <span class = "center-text center-justify-text">
                <span>Page last updated: <script>document.write(document.lastModified);</script></span>
                </span>
        </footer>
</body>
</html

