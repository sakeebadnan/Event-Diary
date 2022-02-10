<?php

declare(strict_types=1);
require_once ("connection.php");

class data extends DB{
    
    function getUser($email) {
       
        $query = <<<'SQL'
            SELECT *
            FROM tb_users 
            WHERE Email = ?;
        SQL;

        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$email]);
        $results = $stmt->fetch();
        if($results==false)$results["return"]=false;
        else $results["return"]=true;
        $this->disconnect();

        return $results;
    }

    function addUser($value) {
        
        $newDb = new DB;
        if(!isset($value['Address']))$value['Address']=null;
        if(!isset($value['City']))$value['City']=null;
        if(!isset($value['State']))$value['State']=null;
        if(!isset($value['Country']))$value['Country']=null;
        if(!isset($value['PostalCode']))$value['PostalCode']=null;
        if(!isset($value['Phone']))$value['Phone']=null;
        $newID=0;
       echo 'rony';
       $query = <<<'SQL'
            INSERT INTO tb_users (FirstName,LastName,Password,Address,City,State,Country,PostalCode,Phone,Email) VALUES (?,?,?,?,?,?,?,?,?,?);
    SQL;

        $stmt = $newDb->pdo->prepare($query);
        $stmt->execute([$value['FirstName'],$value['LastName'],password_hash($value['Password'], PASSWORD_DEFAULT),$value['Address'],$value['City'],$value['State'],$value['Country'],$value['PostalCode'],$value['Phone'],$value['Email']]);

        $newID = $newDb->pdo->lastInsertId();

        $newDb->disconnect();

        return $newID;
    }

    function updateUser($value) {
        try{
            $newDb = new DB;
            if(!isset($value['Address']))$value['Address']=null;
            if(!isset($value['City']))$value['City']=null;
            if(!isset($value['State']))$value['State']=null;
            if(!isset($value['Country']))$value['Country']=null;
            if(!isset($value['PostalCode']))$value['PostalCode']=null;
            if(!isset($value['Phone']))$value['Phone']=null;
            $query = <<<'SQL'
                update tb_users 
                set FirstName=?,
                    LastName=?,
                    Address=?,
                    City=?,
                    State=?,
                    Country=?,
                    PostalCode=?,
                    Phone=?
                    WHERE Id=?;
            SQL;

            $stmt = $newDb->pdo->prepare($query);
            $stmt->execute([$value['FirstName'],$value['LastName'],$value['Address'],$value['City'],$value['State'],$value['Country'],$value['PostalCode'],$value['Phone'],$value['Id']]);

            $newDb->disconnect();

            return true;
        } catch (Exception $e) {
            echo $e;
            return false;
        }    
    }

    function passUpdate($pass,$id) {
        try{
            $newDb = new DB;
            $query = <<<'SQL'
                update tb_users 
                set Password=?
                    WHERE Id=?;
            SQL;

            $stmt = $newDb->pdo->prepare($query);
            $stmt->execute([password_hash($pass, PASSWORD_DEFAULT),$id]);

            $newDb->disconnect();

            return true;
        } catch (Exception $e) {
            echo $e;
            return false;
        }      
    }

    function InsertEventsDb($value) 
    {
        
        try{
            $newDb = new DB;
            $newDb->pdo->beginTransaction();
            $query = <<<'SQL'
                SELECT Id
                FROM tb_cities
                WHERE CityName=?;            
            SQL;
            $cityId=0;
            $stmt = $newDb->pdo->prepare($query);
            $stmt->execute([$value['city']]);
            while($row = $stmt->fetch())
                $cityId = $row['Id'];
            $stmt = null;            
            if($cityId==0){
                
                $query = <<<'SQL'
                        INSERT INTO tb_cities (CityName) VALUES (?);    
                SQL;
                $stmt = $newDb->pdo->prepare($query);
                $stmt->execute([$value['city']]);
                $cityId = $newDb->pdo->lastInsertId();
                $stmt = null;

            }
            $eventId=0;
            $query = <<<'SQL'
                SELECT Id
                FROM tb_events
                WHERE EventGlobalId=?;            
            SQL;
            $stmt = $newDb->pdo->prepare($query);
            $stmt->execute([$value['eventId']]);
            while($row = $stmt->fetch())
                $eventId = $row['Id'];
            $stmt = null;
            if($eventId==0){
                $query = <<<'SQL'
                            INSERT INTO tb_events (EventGlobalId,EventName,Category,EventDate,EventTime,Address,CityId,EventUrl,ImageUrl,Country) VALUES (?,?,?,?,?,?,?,?,?,?);    
                    SQL;
                $stmt = $newDb->pdo->prepare($query);
                $stmt->execute([
                $value['eventId'],
                $value['eventName'],
                $value['category'],        
                $value['eventDate'],
                $value['eventTime'],
                $value['address'],
                $cityId,
                $value['eventUrl'],
                $value['imageUrl'],
                $value['country']]);
                $eventId = $newDb->pdo->lastInsertId();
                $stmt = null;
            }           
            $query = <<<'SQL'
                        INSERT INTO tb_user_event (UserId,EventId) VALUES (?,?);    
            SQL;
            $stmt = $newDb->pdo->prepare($query);
            $stmt->execute([
            $value['Id'],
            $eventId]);
            $stmt = null;
            $newDb->pdo->commit();
            $valueReturn = 'success';
            
        }catch (Exception $e) {
            $newDb->pdo->rollBack();
            echo $e;
            $valueReturn='Not';
        }
        $newDb->disconnect();
        return $valueReturn;
    }
    function CityList($value) 
    {      
        $newDb = new DB;
        $query = <<<'SQL'
            call All_City(?);            
        SQL;
        $Id=0;
        $stmt = $newDb->pdo->prepare($query);
        $stmt->execute([$value]);
        while($row = $stmt->fetch())
            {$city[$Id] = $row['CityName'];
                $Id=$Id+1;
        }
        $stmt = null;            
        $newDb->disconnect();
        return $city;
    }

    function seeEvents($Category,$City,$Id){
        $newDb = new DB;
        if($Category=='all'){
            $query = <<<'SQL'
                SELECT * FROM all_events WHERE UserId=? and CityName=? and Category!=?and Category!=? and Category!=?;
            SQL;
            $stmt = $newDb->pdo->prepare($query);
            $stmt->execute([$Id,$City,'sports','food','music']);
        }else{
            $query = <<<'SQL'
                SELECT * FROM all_events WHERE UserId=? and CityName=? and Category=?;            
            SQL;
            $stmt = $newDb->pdo->prepare($query);
            $stmt->execute([$Id,$City,$Category]);
        }
        $returnEvents = $stmt->fetchAll(PDO::FETCH_OBJ);
        $stmt = null;            
        $newDb->disconnect();
        return $returnEvents; 
    }
    function delEvent($eventId,$Id){
        try{
            $newDb = new DB; 
            $query = <<<'SQL'
                DELETE FROM tb_user_event WHERE UserId=? and EventId= ?;
            SQL;
            $stmt = $newDb->pdo->prepare($query);
            $stmt->execute([$Id,$eventId]);

            $return = true;
            $newDb->disconnect();

            return $return;
        }catch(Exception $e)
        {
            echo $e;
            return false;
        }
    }

}