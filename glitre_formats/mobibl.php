<?php 

function format($records, $num_of_records, $first_record, $last_record) {

	// require('File/MARCXML.php');
	// $records = new File_MARCXML($marcxml, File_MARC::SOURCE_STRING);
	
	$out = '';
	$count = 0;
  if ($first_record == 1) {
    $out .= '<div data-role="page" data-title="Søkeresultat" id="search-result" data-theme="b">';
    $out .= '	<div data-role="header">';
    $out .= '		<h1>Søkeresultat</h1>';
    $out .= '	</div>';
    $out .= '	<div data-role="content" data-theme="b">';
    $out .= '	    <div class="content-primary">';
    $out .= '<p id="searchcounter">Viser treff 1 til <span id="searchcountto">' . $last_record . '</span> av ';
    $out .= '<span id="searchcountotal">' . $num_of_records . '</span></p>';
    $out .= '<ul id="searchresults" data-role="listview">';
  }
	foreach ($records as $rec) {
		$out .= get_basic_info($rec);
		$count++;
	}
  $out .= '</ul>';
  $out .= '	  		</div>';
  $out .= '	</div>';
  $out .= '    <div data-role="footer">';
  $out .= '		<div data-role="navbar" data-grid="a">';
  $out .= '		    <ul>';
  $out .= '			    <li><a href="choose.php" id="chat">Velg bibliotek</a></li>';
  $out .= '			    <li><a href="#about" id="email">Om moBibl</a></li>';
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
    $out = '<li><a class="searchresult" href="/glitre/api/index.php?library=' . $_GET['library'] . '&id=' . $bibid . '">';
    
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
