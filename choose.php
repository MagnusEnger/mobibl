<?php

include('inc.db.php');
include('config.php');

$dbconfig = get_db_config();
$db = db_open($dbconfig['host'], $dbconfig['name'], $dbconfig['user'], $dbconfig['pass']);
$libs = db_execute_query("SELECT id, name FROM libraries ORDER BY name;", $db);

?>
<div data-role="page" data-title="Velg bibliotek" id="choose" data-theme="b">

	<div data-role="header">
		<h1>Velg bibliotek</h1>
	</div>

	<div data-role="content" data-theme="b">
        <ul data-role="listview" data-filter="true" data-inset="true">
            <?php
                while($lib = mysql_fetch_assoc($libs)) {
                    echo('<li><a href="bib.php?bib=' . $lib['id'] . '">' . $lib['name'] . '</a></li>');
                }
            ?>
        </ul>
    </div>

    <div data-role="footer">
		<div data-role="navbar" data-grid="a">
		    <ul>
			    <li><a href="#choose" id="chat">Velg bibliotek</a></li>
			    <li><a href="#about" id="email">Om moBibl</a></li>
		    </ul>
	    </div>
    </div>
    
</div>
