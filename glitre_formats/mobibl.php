<?php 

function format($records, $num_of_records, $first_record, $last_record) {

	// require('File/MARCXML.php');
	// $records = new File_MARCXML($marcxml, File_MARC::SOURCE_STRING);

  // Create a unique ID
  $searchid = md5($_GET['library'] . $_GET['q']);
	
	$out = '';
	$count = 0;
  if ($first_record == 1) {
    $out .= '<div data-role="page" data-title="Søkeresultat" id="' . $searchid . '" class="search-result" data-theme="b">';
    $out .= '	<div data-role="header">';
    $out .= '		<h1>Søkeresultat</h1>';
    $out .= '	</div>';
    $out .= '	<div data-role="content" data-theme="b">';
    
    // $out .= '	<h2>Søk</h2>';
    $out .= '	<form method="get" action="/glitre/api/index.php" id="bib-search">';
		$out .= '	<ul data-role="listview">';
    $out .= '	  <li data-role="fieldcontain">';
	  $out .= '	    <label for="name">Søk etter emne/tittel/forfatter:</label>';
	  $out .= '	    <input type="search" name="q" id="search" value="' . strip_tags(urldecode($_GET['q'])) . '"  />';
		$out .= '		</li>';
		$out .= '	</ul>';
		$out .= '	<input type="hidden" name="library" value="' . $_GET['library'] . '" />';
    $out .= '	<input type="hidden" name="sort_by" value="year" />';
    $out .= '	<input type="hidden" name="sort_order" value="descending" />';
    $out .= '	<input type="hidden" name="format" value="mobibl" />';
		$out .= '	</form>';
		$out .= '	</div>';
    
    $out .= '	    <div class="content-primary">';
    $out .= '<ul id="searchresults" data-role="listview">';
    $out .= '<li data-role="list-divider" id="searchcounter">Viser treff 1 til <span id="searchcountto">' . $last_record . '</span> av ';
    $out .= '<span id="searchcounttotal">' . $num_of_records . '</span> for "' . strip_tags(urldecode($_GET['q'])) . '"</li>';
  }
	foreach ($records as $rec) {
		$out .= get_basic_info($rec);
		$count++;
	}
  $out .= '</ul>';
  $out .= '<ul id="searchtmp" style=""></ul>';
  if ($num_of_records > $last_record) {
    $out .= '<p><a href="#" data-role="button" data-icon="plus" id="show-more-results">Vis flere treff</a></p>';
  }
  $out .= '	</div>';
  $out .= '    <div data-role="footer">';
  $out .= '		<div data-role="navbar" data-grid="a">';
  $out .= '		    <ul>';
  $out .= '			    <li><a href="/choose.php">Velg bibliotek</a></li>';
  $out .= '			    <li><a href="#about">Om moBibl</a></li>';
  $out .= '		    </ul>';
  $out .= '	    </div>';
  $out .= '    </div>';
  $out .= '</div>';
	
	$ret = array(
		'data' => $out, 
		'content_type' => 'text/html'
	);	
	return $ret;

}

function get_basic_info($record) {

	global $config;

	// Get the ID and create a link to the record in the OPAC
	$bibid = '';
	if ($record->getField("999") && $record->getField("999")->getSubfield("c")) {
		// Koha
		$bibid = marctrim($record->getField("999")->getSubfield("c"));
	} else {
		// Others
		$bibid = substr(marctrim($record->getField("001")), 3);
	}
	
	$id = md5($_GET['library'] . $bibid);

    // $out = '<li><a class="searchresult" href="#' . $id . '">';
    $out = '<li class="searchresult"><a href="/glitre/api/index.php?library=' . $_GET['library'] . '&id=' . $bibid . '&format=mobiblfull">';
    
    // Title
    $out .= '<h3>';
    if ($record->getField("245") && $record->getField("245")->getSubfield("a")) {
    	// Remove . at the end of a title
    	$title = preg_replace("/\.$/", "", marctrim($record->getField("245")->getSubfield("a")));
		  $out .= $title;
    } else {
    	$out .= '[Uten tittel]';	
    }
    if ($record->getField("245") && $record->getField("245")->getSubfield("b")) {
    	$out .= ' : ' . marctrim($record->getField("245")->getSubfield("b"));
    }
    $out .= '</h3>';
    $out .= '<p>';
    if ($record->getField("245") && $record->getField("245")->getSubfield("c")) {
    	// $out .= ' / ' . marctrim($record->getField("245")->getSubfield("c"));
    	$out .= marctrim($record->getField("245")->getSubfield("c"));
    }
    // Publication data
    if ($record->getField("260")) {
    	// Year
    	if ($record->getField("260")->getSubfield("c")) {
    		$out .= ' (' . marctrim($record->getField("260")->getSubfield("c")) . ')';
    	}
    }
    $out .= '</p>';
    
    $out .= '</a></li>';
   	
    return $out;
	
}

?>
