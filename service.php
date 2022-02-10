<?php 
    session_start();
    require_once 'src/data.php';
    if(!empty($_REQUEST['insertevents'])){
        InsertEvents();
        
    }

    function InsertEvents() {
        $service = new data;
        //($userId,$eventId,$eventName,$category,$eventDate,$place
        $_REQUEST['Id']=$_SESSION['Id'];
        $returnValue=$service->InsertEventsDb($_REQUEST);
        echo $returnValue;
    }    
?>