<!DOCTYPE html>
<html>
<head>
<style>
table {
  width: 100%;
  border-collapse: collapse;
}

table, td, th {
  border: 1px solid black;
  padding: 5px;
}

th {text-align: left;}
</style>
</head>
<body>

<?php
$server = "spring-2021.cs.utexas.edu";
$user = "cs329e_bulko_rmoore";
$pswd = "torch4chapel3silk";
$dbname = "cs329e_bulko_rmoore";

$q = intval($_GET['q']);

$con = mysqli_connect($server,$user,$pswd,$dbname);
if (!$con) {
  die('connect error: ' . mysqli_error($con));
}

mysqli_select_db($con,"courses");
$sql="SELECT * FROM courses WHERE id = '".$q."'";
$result = mysqli_query($con,$sql);

echo "<table>
<tr>
<th>Course</th>
<th>Description</th>
</tr>";
while($row = mysqli_fetch_array($result)) {
  echo "<tr>";
  echo "<td>" . $row['name'] . "</td>";
  echo "<td>" . $row['description'] . "</td>";
  echo "</tr>";
}
echo "</table>";
mysqli_close($con);
?>
</body>
</html>
