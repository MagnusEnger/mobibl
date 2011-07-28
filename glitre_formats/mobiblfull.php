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
	
	foreach ($records as $rec) {
		$out .= get_basic_info($rec);
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

    $out = '<div id="' . $id . '" class="section">';
    $out .= '<div class="toolbar">';
    
    $title = '';
    if ($record->getField("245") && $record->getField("245")->getSubfield("a")) {
    	// Remove . at the end of a title
    	$title = preg_replace("/\.$/", "", marctrim($record->getField("245")->getSubfield("a")));
    } else {
    	$title = '[Uten tittel]';	
    }
    
	$out .= '<h1>' . $title . '</h1>';
	$out .= '<a class="button back" href="#">Tilbake</a>';
	$out .= '</div>';
	$out .= '<div>';
    
    $out .= '<ul>';
    $out .= '<li>Tittel: ' . $title . "</li>\n";
    if ($record->getField("245") && $record->getField("245")->getSubfield("b")) {
    	$out .= '<li>Undertittel: ' . marctrim($record->getField("245")->getSubfield("b")) . "</li>\n";
    }
    if ($record->getField("245") && $record->getField("245")->getSubfield("c")) {
    	$out .= '<li>Forfatter: ' . marctrim($record->getField("245")->getSubfield("c")) . "</li>\n";
    }
    if ($record->getField("245") && $record->getField("245")->getSubfield("h")) {
    	$out .= '<li>Format: ' . marctrim($record->getField("245")->getSubfield("h")) . "</li>\n";
    }
    // Publication data
    if ($record->getField("260")) {
    	// Year
    	if ($record->getField("260")->getSubfield("c")) {
    		$out .= '<li>Publisert: ' . marctrim($record->getField("260")->getSubfield("c")) . "</li>\n";
    	}
    	if ($record->getField("260")->getSubfield("b")) {
    		$out .= '<li>Utgiver: ' . marctrim($record->getField("260")->getSubfield("b")) . "</li>\n";
    	}
    	if ($record->getField("260")->getSubfield("a")) {
    		$out .= '<li>Sted: ' . marctrim($record->getField("260")->getSubfield("a")) . "</li>\n";
    	}
    }
    $out .= '</ul>';
    
    // Items
    if ($record->getField("850") && $record->getField("850")->getSubfield("a")) {
		$out .= '<h2>Eksemplarer:</h2><ul>';
		foreach ($record->getFields("850") as $item) {
			$out .= '<li>'. marctrim($item->getSubfield("a")) . ', ' . marctrim($item->getSubfield("c")) . '</li>' . "\n";
		}
		$out .= '</ul>';
	}
	// BIBSYS
        if ($record->getField("852") && $record->getField("852")->getSubfield("a")) {
		$out .= '<h2>Eksemplarer:</h2><ul>';
		foreach ($record->getFields("852") as $item) {
			$out .= '<li>'. marctrim($item->getSubfield("a")) . ' ' . marctrim($item->getSubfield("a")) . ' ' . marctrim($item->getSubfield("c")) . '</li>' . "\n";
		}
		$out .= '</ul>';
	}
    
    // Notes
    $notes = $record->getFields('5..', true);
    if ($notes) {
    	$out .= '<h2>Noter</h2>' . "\n";
    	$out .= '<ul>' . "\n";
		foreach ($notes as $field) {
			if ($field->getSubfield("a")) {
    			$out .= '<li>' . marctrim($field->getSubfield("a")) . "</li>\n";
			}
		}
		$out .= '</ul>' . "\n";
    }
    
    $out .= '<p><a style="margin:0 10px;color:rgba(0,0,0,.9)" href="#" class="whiteButton goback">Tilbake</a></p>';
    
    // $out .= '<h2>Debug</h2><div class="content"><pre>' . $record->__toString() . '</pre></div>';
    
    $out .= '</div></div>';
   	
    return $out;
	
}

?>
