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
