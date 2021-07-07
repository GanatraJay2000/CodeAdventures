<?php

function addBranch($data)
{
    global $conn;
    $query = $conn->prepare("INSERT INTO `branchs`(name, detailed_address, town, city, region_id) VALUES(?, ?, ?, ?, ?) ON DUPLICATE KEY UPDATE name=VALUES(name), detailed_address=VALUES(detailed_address), town=VALUES(town), city=VALUES(city), region_id=VALUES(region_id)");
    if (!$query) return [false, "Please contact Admin!: " . $conn->error];
    $query->bind_param("ssssi", $data['name'], $data['detailed_address'], $data['town'], $data['city'], $data['region_id']);
    $query->execute();
    if (!empty($query->error)) return [false, $query->error];
    else return [true, "Branch Added Successfully!"];
}


function updateBranch($qry, $data)
{
    global $conn;
    $subQuery = "";
    $types = [];
    foreach ($data as $field => $value) {
        $subQuery .= $field . "=?, ";
        $type = getBindString($value);
        $types[] = $type;
    }
    $data = array_values($data);
    array_push($data, $qry[1]);
    array_push($types, getBindString($qry[1]));
    $types = implode("", $types);
    $subQuery = substr($subQuery, 0, -2);
    $query = $conn->prepare("UPDATE `branchs` SET {$subQuery} WHERE {$qry[0]}=?");
    if (!$query) return [false, "Please contact Admin!: " . $conn->error];
    $query->bind_param($types, ...$data);
    $query->execute();
    if (!empty($query->error)) return [false, $query->error];
    else return [true, "Branch Updated Successfully!"];
}


function deleteBranch($id)
{
    global $conn;
    $query = $conn->prepare("DELETE FROM `branchs` WHERE id=?");
    if (!$query) return [false, "Please contact Admin!: " . $conn->error];
    $query->bind_param("i", $id);
    $query->execute();
    if (!empty($query->error)) return [false, $query->error];
    else return [true, "Branch Deleted Successfully!"];
}


function getBranch($field, $value)
{
    global $conn;
    $query = $conn->prepare("SELECT * from `branchs` WHERE {$field}=?");
    if (!$query) return [false, "Please contact Admin!: " . $conn->error];
    $query->bind_param("i", $value);
    $query->execute();
    $query = $query->get_result();
    if ($query->num_rows == 0) return [false, "No Such Branch"];
    $batch = $query->fetch_assoc();
    if (!empty($query->error)) return [false, $query->error];
    else return [true, $batch];
}


function getBranchs($conf = [])
{
    global $conn;
    $branchs = [];
    $query = "SELECT * from `branchs`";
    foreach ($conf as $key => $c) {
        if (!$key) $query .= " WHERE " . $c[0] . ($c[1] == "like" ? " LIKE '%" : $c[1] . "'") . $c[2] . ($c[1] == "like" ? "%'" : "'");
        else $query .= " AND " . $c[0] . ($c[1] == "like" ? " LIKE '%" : $c[1] . "'") . $c[2] . ($c[1] == "like" ? "%'" : "'");
    }
    $query = $conn->query($query);
    if (!$query) return [false, "Please contact Admin!: " . $conn->error];
    if ($query->num_rows == 0) return [false, "No Such Branch"];
    while ($row = $query->fetch_assoc()) {
        $branchs[] = $row;
    }
    return [true, $branchs];
}