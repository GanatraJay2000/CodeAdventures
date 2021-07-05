<?php

function addRegion($data){
    global $conn;        
    $query = $conn->prepare("INSERT INTO `regions`(name, zone_id, main_branch_id) VALUES(?, ?, ?) ON DUPLICATE KEY UPDATE name=VALUES(name), zone_id=VALUES(zone_id), main_branch_id=VALUES(main_branch_id)");
    if(!$query) return [false, "Please contact Admin!: ".$conn->error];
    $query->bind_param("sii", $data['name'],$data['zone_id'], $data['main_branch_id']);
    $query->execute();        
    if(!empty($query->error)) return [false, $query->error];
    else return [true, "Region Added Successfully!"];    
}


function updateRegion($qry, $data){
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
    $query = $conn->prepare("UPDATE `regions` SET {$subQuery} WHERE {$qry[0]}=?");
    if(!$query) return [false, "Please contact Admin!: ".$conn->error];
    $query->bind_param($types, ...$data);
    $query->execute();        
    if(!empty($query->error)) return [false, $query->error];
    else return [true, "Region Updated Successfully!"];  
}


function deleteRegion($id){
    global $conn;
    $query = $conn->prepare("DELETE FROM `regions` WHERE id=?");
    if(!$query) return [false, "Please contact Admin!: ".$conn->error];
    $query->bind_param("i", $id);
    $query->execute();
    if(!empty($query->error)) return [false, $query->error];
    else return [true, "Region Deleted Successfully!"];      
}


function getRegion($id){
    global $conn;
    $query = $conn->prepare("SELECT * from `regions` WHERE id=?");
    if(!$query) return [false, "Please contact Admin!: ".$conn->error];
    $query->bind_param("i", $id);
    $query->execute();
    $query = $query->get_result();
    if($query->num_rows == 0) return [false, "No Such Region"];
    $batch = $query->fetch_assoc();    
    if(!empty($query->error)) return [false, $query->error];
    else return [true, $batch];
}


function getRegions($conf=[]){
    global $conn;
    $regions = [];
    $query = "SELECT * from `regions`";
    foreach ($conf as $key=>$c){
        if(!$key) $query.=" WHERE ".$c[0].($c[1]=="like"?" LIKE '%":$c[1]."'").$c[2].($c[1]=="like"?"%'":"'");
        else $query.=" AND ".$c[0].($c[1]=="like"?" LIKE '%":$c[1]."'").$c[2].($c[1]=="like"?"%'":"'");
    }       
    $query = $conn->query($query);
    if(!$query) return [false, "Please contact Admin!: ".$conn->error];
    if($query->num_rows == 0) return [false, "No Such Region"];
    while($row = $query->fetch_assoc()){
        $regions[] = $row;
    }   
    return [true, $regions];   
}