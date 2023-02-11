<?php
    if ( isset($_GET['action']) && !empty(isset($_GET['action'])) ) {
      $action = $_GET['action'];
      
      switch( $action ) {
        case "connect":{
            return connect();
        }break;
    
        default: {
          return 'No data';
        }
      }
    }
    
    function connect(){    
        $host = 'localhost';
        $user = 'root';
        $password = '';

        $conection =  new mysqli($host, $user, $password);
        if ($conection->connect_errno) {
            echo "Fallo al conectar a MySQL: (" . $conection->connect_errno . ") " . $conection->connect_error;
            return false;
        }
        return true;
    }
?>