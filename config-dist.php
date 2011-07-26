<?php

set_include_path(get_include_path() . PATH_SEPARATOR . '/home/lib/pear/PEAR');

// TODO: This should be replaced by calls to a database! 

function get_config($lib=false) {

  $c = array();

  $c['debug'] = false;
  $c['debug_feeds'] = false;

  $c['max_records'] = 11;
  $c['per_page'] = 4;

  // Library independent settings
  $c['smarty_path'] = '/usr/share/php/smarty/libs/Smarty.class.php';

  if ($lib) {
    $c['lib'] = get_lib($lib);
    // Save the short form of the chosen library
    $c['lib']['lib'] = $lib;
  }

  return $c;

}

function get_db_config() {

  $db = array(
    'host' => '', 
    'user' => '', 
    'name' => '',
    'pass' => ''
  );
  return $db;
	
}

function get_lib($lib=false){

  //Libraries
  $l = array();
  $l['barum'] = array(
    'name'  => 'Bærum folkebibliotek',
    'name_short' => 'Bærum',
    'records_max' => 100, 
    'records_per_page' => 10, 
    'system' => 'bibliofil',  
    'z3950'  => 'z3950.barum.folkebibl.no:210/data', 
    'theme' => 'apple', // apple, jqt
    /*
    'nav' => array(
      'nytt' => array(
	    'type' => 'feed', 
	    'title' => 'Nytt fra biblioteket', 
	    'url' => 'http://www.deichmanske-bibliotek.oslo.kommune.no/rss.php'
      ),
    ),
    */
  );
  $l['deich'] = array(
    'name'  => 'Deichmanske bibliotek',
    'name_short' => 'Deichmanske',
    'records_max' => 11, 
    'records_per_page' => 4, 
    'system' => 'bibliofil',  
    'z3950'  => 'z3950.deich.folkebibl.no:210/data', 
    'theme' => 'apple', // apple, jqt
    'nav' => array(
      'nytt' => array(
	'type' => 'feed', 
	'title' => 'Nytt fra biblioteket', 
	'url' => 'http://www.deichmanske-bibliotek.oslo.kommune.no/rss.php'
      ),
    ),
  );
  $l['hig'] = array(
    'name'  => 'Høgskolen i Gjøvik',
    'name_short' => 'HiG',  
    'records_max' => 11, 
    'records_per_page' => 4, 
    'system' => 'bibsys',
    'z3950'  => 'z3950.bibsys.no:2100/HIG',
    'theme' => 'apple', // apple, jqt
    'frontpage' => '<ul>
	<li>Åpningstider</li>
	<li>Man. - tor.: 08.30-18.00</li>
	<li>Fre.: 08:30-15.30</li>
	<li>Tlf: <a href="tel:+4761135131">+47 61 13 51 31</a></li>
	<li>E-post: <a href="mailto:bibliotek@hig.no">bibliotek@hig.no</a></li>
	</ul>',  
    'nav' => array(
      'nytt' => array(
	'type' => 'feed', 
	'title' => 'Nytt fra biblioteket', 
	'url' => 'http://blog.hig.no/endnote/feed/'
      ), 
      /*
      'lenker' => array(
	'type' => 'feed', 
	'title' => 'Lenker', 
	'url' => 'http://blog.hig.no/lenker/feed/'
      )
      */
    )
  );
  $l['pode'] = array(
    'name'    => 'Pode testkatalog', 
    'name_short' => 'Pode',
    'records_max' => 11, 
    'records_per_page' => 4, 
    'system'   => 'koha', 
    'sru'      => 'http://torfeus.deich.folkebibl.no:9999/biblios', 
    'item_url' => 'http://dev.bibpode.no/cgi-bin/koha/opac-detail.pl?biblionumber=',
    'theme' => 'jqt', // apple, jqt
  );
  $l['sksk'] = array(
    'name'  => 'Sjøkrigsskolen',
    'name_short' => 'Sjøkrigsskolen',
    'records_max' => 11, 
    'records_per_page' => 4, 
    'system' => 'koha',  
    'sru'      => 'http://sksk.bibkat.no:9999/biblios', 
    'item_url' => 'http://sksk.bibkat.no.no/cgi-bin/koha/opac-detail.pl?biblionumber=',
    'theme' => 'apple', // apple, jqt
    'nav' => array(
      'nytt' => array(
	'type' => 'feed', 
	'title' => 'Nytt fra biblioteket', 
	'url' => 'http://sksk.wordpress.com/feed/'
      ),
    ),
  );

  if ($lib) {
    return $l[$lib];
  } 
  return $l;

}

?>
