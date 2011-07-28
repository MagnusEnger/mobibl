<?php 

/* 

Copyright 2010 ABM-utvikling

This file is part of Glitre.

Glitre is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

Glitre is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with Glitre.  If not, see <http://www.gnu.org/licenses/>.

*/

function format($records, $num_of_records, $first_record, $last_record) {

	// require('File/MARCXML.php');
	// $records = new File_MARCXML($marcxml, File_MARC::SOURCE_STRING);
	
	$out = '';
	$count = 0;
        if ($first_record == 1) {
          $out = '<p id="searchcounter">Viser treff 1 til <span id="searchcountto">' . $last_record . '</span> av <span id="searchcountotal">' . $num_of_records . '</span></p>';
          $out .= '<ul id="searchresults">';
        }
	foreach ($records as $rec) {
		$out .= get_basic_info($rec);
		$count++;
	}
        if ($first_record == 1) {
	  $out .= '</ul>';
	  // $out .= '<a style="margin:0 10px;color:rgba(0,0,0,.9);" href="#" class="whiteButton" id="searchmorebt">Vis fler</a>';
        }
	
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

    $out = '<li class="arrow flip"><a class="searchresult" href="#' . $id . '">';
    
    // Title
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
    if ($record->getField("245") && $record->getField("245")->getSubfield("c")) {
    	$out .= ' / ' . marctrim($record->getField("245")->getSubfield("c"));
    }
    // Publication data
    if ($record->getField("260")) {
    	// Year
    	if ($record->getField("260")->getSubfield("c")) {
    		$out .= ' (' . marctrim($record->getField("260")->getSubfield("c")) . ')';
    	}
    }
    
    $out .= '</a></li>';
   	
    return $out;
	
}

?>
