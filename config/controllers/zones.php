<?php

function addZone($data){
    global $conn;        
    $query = $conn->prepare("INSERT INTO `zones`(name, detailed_address, town, city, main_branch_id) VALUES(?, ?, ?, ?, ?) ON DUPLICATE KEY UPDATE name=VALUES(name)");
    if(!$query) return [false, "Please contact Admin!: ".$conn->error];
    $query->bind_param("ssssi", $data['name'],$data['detailed_address'], $data['town'], $data['city'], $data['main_branch_id']);
    $query->execute();        
    if(!empty($query->error)) return [false, $query->error];
    else return [true, "Zone Added Successfully!"];    
}


function updateZone($qry, $data){
    global $conn;
    $subQuery = "";
    $types = [];
    
    foreach($data as $field=>$value){
        $subQuery.=$field."=?, ";
        $type = getBindString($value);
        $types[] = $type;
    }
    $data = array_values($data);
    array_push($data, $qry[1]);
    array_push($types, getBindString($qry[1]));
    $types = implode("", $types);     
    $subQuery = substr($subQuery, 0, -2);        
    $query = $conn->prepare("UPDATE `zones` SET {$subQuery} WHERE {$qry[0]}=?");
    if(!$query) return [false, "Please contact Admin!: ".$conn->error];
    $query->bind_param($types, ...$data);
    $query->execute();        
    if(!empty($query->error)) return [false, $query->error];
    else return [true, "Zone Updated Successfully!"];  
}


function deleteZone($id){
    global $conn;
    $query = $conn->prepare("DELETE FROM `zones` WHERE id=?");
    if(!$query) return [false, "Please contact Admin!: ".$conn->error];
    $query->bind_param("i", $id);
    $query->execute();
    if(!empty($query->error)) return [false, $query->error];
    else return [true, "Zone Deleted Successfully!"];      
}


function getZone($id){
    global $conn;
    $query = $conn->prepare("SELECT * from `zones` WHERE id=?");
    if(!$query) return [false, "Please contact Admin!: ".$conn->error];
    $query->bind_param("i", $id);
    $query->execute();
    $query = $query->get_result();
    if($query->num_rows == 0) return [false, "No Such Zone"];
    $batch = $query->fetch_assoc();    
    if(!empty($query->error)) return [false, $query->error];
    else return [true, $batch];
}


function getZones($conf=[]){
    global $conn;
    $zones = [];
    $query = "SELECT * from `zones`";
    foreach ($conf as $key=>$c){
        if(!$key) $query.=" WHERE ".$c[0].($c[1]=="like"?" LIKE '%":$c[1]."'").$c[2].($c[1]=="like"?"%'":"'");
        else $query.=" AND ".$c[0].($c[1]=="like"?" LIKE '%":$c[1]."'").$c[2].($c[1]=="like"?"%'":"'");
    }       
    $query = $conn->query($query);
    if(!$query) return [false, "Please contact Admin!: ".$conn->error];
    if($query->num_rows == 0) return [false, "No Such Zone"];
    while($row = $query->fetch_assoc()){
        $zones[] = $row;
    }   
    return [true, $zones];   
}