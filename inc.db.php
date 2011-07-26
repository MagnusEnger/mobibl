<?php

/* Generic database functions */

/*
Connect to the database
Parameters: none
Returns: valid database-connection
*/

function db_open($db_host, $db_name, $db_user, $db_pass) {

    // Connect to database-server, suppress error-messages with @

    $dbcnx = @mysql_connect($db_host, $db_user, $db_pass);
    // Check to see if a valid database-handle was returned
    if (!$dbcnx) {
        // Print an error-message
        echo("<p style=\"color: red; font-size: 150%;\">:-(<br />Unable to connect to the database server at this time.<br />
				Kan ikke opprette kontakt til database-serveren, vennligst pr�v igjen senere.<br />
				<!--" . mysql_error() . "--><p></body></html>");
        exit();
    }

    // Select the database, suppress error-messages with @
    if (! @mysql_select_db($db_name, $dbcnx) ) {
        // Print an error-message
        echo("<hr><p class=\"error\">Unable to select the database at this time.<br>(" . mysql_error() . ")<p></body></html>");
        exit();
    }

    // Return the connection-identifier, if we got this far
    return $dbcnx;
}

/*
Execute a query on a database, with error-checking
Parameters: $sql        - SQL to be executed
            $connection - active databse-connection
Returns: Result-set
*/

function db_execute_query($sql, $connection) {

	// TODO: How to include info based on is_admin()?

    // Execute the query
    $result = mysql_query($sql, $connection) or die("<p class=\"error\">Unable to execute the query at this time.<br>(" . mysql_error() . ")</p><p><pre>$sql</pre></p></body></html>");
    return $result;

}

?>