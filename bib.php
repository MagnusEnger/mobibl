<?php

include('inc.db.php');
include('config.php');

$dbconfig = get_db_config();
$db = db_open($dbconfig['host'], $dbconfig['name'], $dbconfig['user'], $dbconfig['pass']);
$libres = db_execute_query("SELECT * FROM libraries WHERE id = '" . $_GET['bib'] . "';", $db);
$lib = mysql_fetch_assoc($libres);

?>

<div data-role="page" data-title="<?php echo($lib['name_short']); ?>" id="<?php echo($lib['id']); ?>" data-theme="b">

	<div data-role="header">
		<h1><?php echo($lib['name_short']); ?></h1>
	</div>

	<div data-role="content" data-theme="b">	
	
	    <div class="content-primary">
        <form action="search.php" method="get">
		<ul data-role="listview">
            <li data-role="fieldcontain">
	         	<h2>Søk</h2>
	         	<input type="search" name="q" id="search" value=""  />
	         	<input type="hidden" name="lib" value="<?php echo($_GET['bib']) ?>" />
	          <input type="hidden" name="sorter" value="aar" />
	          <input type="hidden" name="orden" value="synk" />
			</li>
		</ul>
		</form>
		</div>
		
		<div class="content-secondary">
		
		    <h2>Nyheter</h2>

            <div data-role="collapsible" data-collapsed="true">
	            <h3>Nye åpningstider</h3>
	            <p>Blah, blah...</p>
	        </div>

            <div data-role="collapsible" data-collapsed="true">
	            <h3>Gamle åpningstider</h3>
	            <p>Blah, blah...</p>
	        </div>
	        
            <div data-role="collapsible" data-collapsed="true">
	            <h3>Rullebrett til utlån</h3>
	            <p>Blah, blah...</p>
	        </div>

		</div>
	
	</div>

    <div data-role="footer">
		<div data-role="navbar" data-grid="a">
		    <ul>
			    <li><a href="choose.php" id="chat">Velg bibliotek</a></li>
			    <li><a href="#about" id="email">Om moBibl</a></li>
		    </ul>
	    </div>
    </div>
</div>
