<!DOCTYPE html>

<html lang="en">

<head>
        <title>Project Phase 3</title>
        <meta charset="UTF-8">
        <meta name="description" content="Final Project phase 4">
        <meta name="group 44" content="Project Phase 4">
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
<div class =  "researchContent  normal-text center-text">
  <h1>Neuroscience Courses Fall 2021</h1>

  <form action="">
  <select name="neuro_courses" onchange="show_courses(this.value)">
  <option value="">Select a course:</option>
  <option value ="1">NEURAL SYSTEMS I</option>
  <option value ="2">NEURAL SYSTEMS II</option>
  <option value ="3">COMP SIM OF NEURAL PROCESSES</option>
  <option value ="4">STRUCTURAL NEUROSCIENCE</option>
  <option value ="5">NEURAL SYSTEMS III: QUAN TOOLS</option>
  <option value ="6">PRINCIPLES OF DRUG ACTION</option>
  <option value ="7">NERVE REGENRTN INVRTBRT/VRTBRT</option>
  <option value ="8">NEUROBIOLOGY OF DISEASE</option>
  <option value ="9">ION CHNNL/MOL PHYS NEURONL SIG</option>
  <option value ="10">NEUROBIOLOGY LABORATORY</option>
  <option value ="11">NEUROIMAGING LABORATORY</option>
  </select>
  </form>
  <br>
  <div id= "course_select">Course info will be listed here...</div>


  <script language = "javascript" type = "text/javascript">

    function show_courses(str) {
      var ajaxRequest;
      if (str == "") {
        document.getElementById("course_select").innerHTML = "";
      return;
      }
      ajaxRequest = new XMLHttpRequest();
      ajaxRequest.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("course_select").innerHTML = this.responseText;
        }
      };
      ajaxRequest.open("GET", "neuro_courses.php?q=" + str, true);
      ajaxRequest.send();
      }
        </script>

</div>
</div>
</body>
</html>
