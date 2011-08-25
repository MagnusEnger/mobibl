<?php

include('../inc.db.php');
include('../config.php');

$dbconfig = get_db_config();
$db = db_open($dbconfig['host'], $dbconfig['name'], $dbconfig['user'], $dbconfig['pass']);
$libs = db_execute_query("SELECT * FROM libraries ORDER BY name;", $db);

echo("<?php\n");

while($lib = mysql_fetch_assoc($libs)) {
  echo("\$l['" . $lib['id'] . "'] = array(
  'name'  => '" . $lib['name'] . "', 
  'records_max' => " . $lib['records_max'] . ", 
  'records_per_page' => " . $lib['records_per_page'] . ", 
  'system' => '" . $lib['system'] . "',
  'z3950'  => '" . $lib['z3950'] . "'
  );\n");
}

echo("\n?>\n");

?>
