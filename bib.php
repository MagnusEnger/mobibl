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
    <h2>Søk</h2>
    <form method="get" action="/glitre/api/index.php" id="bib-search">
		<ul data-role="listview">
      <li data-role="fieldcontain">
	      <label for="name">Emne/tittel/forfatter:</label>
	      <input type="search" name="q" id="search" value=""  />
			</li>
		</ul>
		<input type="hidden" name="library" value="<?php echo($_GET['bib']) ?>" />
    <input type="hidden" name="sort_by" value="year" />
    <input type="hidden" name="sort_order" value="descending" />
    <input type="hidden" name="format" value="mobibl" />
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
