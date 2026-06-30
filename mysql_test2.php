<?php
require_once("C:\\xampp\\htdocs\\Supermarket-mgmt-PHP\\include\\constants.php");

$GLOBALS['mysql_connection_global'] = null;

if (!function_exists('mysql_connect')) {
    function mysql_connect($server, $user, $password) {
        if ($server === 'localhost') {
            $server = '127.0.0.1';
        }
        $conn = new mysqli($server, $user, $password, "", 3307);
        if ($conn->connect_error) {
            return false;
        }
        $GLOBALS['mysql_connection_global'] = $conn;
        return $conn;
    }

    function mysql_select_db($db_name, $link = null) {
        $conn = $link ?: $GLOBALS['mysql_connection_global'];
        return $conn->select_db($db_name);
    }

    function mysql_query($query, $link = null) {
        $conn = $link ?: $GLOBALS['mysql_connection_global'];
        return $conn->query($query);
    }

    function mysql_fetch_array($result, $result_type = MYSQLI_BOTH) {
        if (!$result || !is_object($result)) return false;
        return $result->fetch_array($result_type);
    }

    function mysql_fetch_assoc($result) {
        if (!$result || !is_object($result)) return false;
        return $result->fetch_assoc();
    }

    function mysql_error($link = null) {
        $conn = $link ?: $GLOBALS['mysql_connection_global'];
        return $conn ? $conn->error : "";
    }

    function mysql_num_rows($result) {
        if (!$result || !is_object($result)) return false;
        return $result->num_rows;
    }

    function mysql_real_escape_string($unescaped_string, $link = null) {
        $conn = $link ?: $GLOBALS['mysql_connection_global'];
        return $conn->real_escape_string($unescaped_string);
    }
    
    function mysql_insert_id($link = null) {
        $conn = $link ?: $GLOBALS['mysql_connection_global'];
        return $conn->insert_id;
    }
    
    function mysql_close($link = null) {
         $conn = $link ?: $GLOBALS['mysql_connection_global'];
         return $conn->close();
    }
}

//start connection
$connect = mysql_connect(DB_SERVER, DB_USER, DB_PASSWORD);
if(!$connect){
	die("Database connection Error ".mysql_error());
}
echo "Connected\n";
//select database
$db = mysql_select_db(DB_NAME);
if(!$db){
	die("Database selection Error ".mysql_error());
}
echo "DB Selected\n";

$res = mysql_query("SHOW TABLES");
if($res) {
    echo "Found " . mysql_num_rows($res) . " tables\n";
} else {
    echo "Error: " . mysql_error() . "\n";
}
?>
