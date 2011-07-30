<!DOCTYPE html> 
<html> 
  <head> 
  <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1" /> 
  <meta name="apple-mobile-web-app-capable" content="yes" />
  <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
  <meta charset="UTF-8">
  <title>moBibl</title>
  <link rel="stylesheet" href="http://code.jquery.com/mobile/1.0b1/jquery.mobile-1.0b1.min.css" />
  <script type="text/javascript" src="http://code.jquery.com/jquery-1.6.1.min.js"></script>
  <script type="text/javascript" src="http://code.jquery.com/mobile/1.0b1/jquery.mobile-1.0b1.min.js"></script>
  <script type="text/javascript" src="mobibl.js"></script>
</head> 
<body> 

<div data-role="page" data-title="moBibl" id="index" data-theme="b">

	<div data-role="header">
		<h1>moBibl <sup>beta</sup></h1>
	</div>
	
	<div data-role="content">
        <ul data-role="listview" data-inset="true">
            <li><a href="choose.php">Velg bibliotek</a></li>
            <li><a href="#about">Om moBibl</a></li>
        </ul>
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

<div data-role="page" data-title="Om moBibl" id="about" data-theme="b">

	<div data-role="header">
	  <a href="#" data-rel="back">Tilbake</a>
		<h1>Om moBibl</h1>
	</div>

	<div data-role="content" data-theme="b">	
		<p>Blah.</p>
		<h2>Credits</h2>
		<!-- <p>icons by Joseph Wain / <a href="http://glyphish.com/">glyphish.com</a></p> -->
		<p><a href="#foo">Tilbake til forsiden</a></p>	
	</div>

    <div data-role="footer">
		<div data-role="navbar" data-grid="a">
		    <ul>
			    <li><a href="/choose.php">Velg bibliotek</a></li>
			    <li><a href="#about">Om moBibl</a></li>
		    </ul>
	    </div>
    </div>
</div>

</body>
</html>
