<?php

class Attendance
{
    protected $table = [
        "name" => "transactions",
        "title" => "Attendance",
        "all_fields" => ["emp_id", "date", "vehicle_id", "region_id", "branch_id", "site_id", "service_type", "start_time", "end_time", "opening_km", "closing_km", "total_km", "km_allowances"],
        "req_fields" => ["emp_id", "vehicle_id", "date", "opening_km"],
    ];

    // DB Functions
    function add($data)
    {
        //get DB connection
        global $conn;

        //Format the data provided
        $fields = array_keys($data);
        $fCount = count($fields);
        $values = array_values($data);

        //Variables
        $string = "";
        $types = [];

        //Getting Bind Parameters String
        foreach ($values as $val) {
            $type = getBindString($val);
            $types[] = $type;
        }
        $types = implode($types);


        //Check if data exists
        if (!$fCount)
            return [false, "Please Fill the form!!"];

        //Remove extra fields
        $fields = array_intersect($fields, $this->table['all_fields']);

        //Check for required fields
        if (count(array_diff($this->table['req_fields'], $fields)))
            return [false, "Please Fill all required fields!"];

        //Dynamic Query!!!!
        $query = "INSERT INTO `{$this->table['name']}`(" . implode(", ", $fields) . ") VALUES(";
        $string = "";
        for ($i = 0; $i < $fCount; $i++) $string .= "?, ";
        $string = substr($string, 0, -2);
        $query .= $string . ") ON DUPLICATE KEY UPDATE ";
        $string = "";
        foreach ($fields as $f) $string .= $f . "=VALUES({$f}), ";
        $string = substr($string, 0, -2);
        $query .= $string;

        //Calling-Executing the prepared statement
        $query = $conn->prepare($query);
        if (!$query) return [false, "Please contact Admin!: " . $conn->error];
        $query->bind_param($types, ...$values);
        $query->execute();
        if (!empty($query->error))
            return [false, $query->error];
        else
            return [true, "{$this->table['title']} Added Successfully!"];
    }

    function update($qry, $data)
    {
        //Connection to DB
        global $conn;

        //Variables
        $subQuery = "";
        $types = [];

        //Data Manipulation and dynamic query generation
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

        //Calling-Executing the prepared statement
        $query = $conn->prepare("UPDATE `{$this->table['name']}` SET {$subQuery} WHERE {$qry[0]}=?");
        if (!$query) return [false, "Please contact Admin!: " . $conn->error];
        $query->bind_param($types, ...$data);
        $query->execute();
        if (!empty($query->error)) return [false, $query->error];
        else return [true, "{$this->table['title']} Updated Successfully!"];
    }

    function delete($id)
    {
        //Connection to DB
        global $conn;

        //Calling-Executing the prepared statement
        $query = $conn->prepare("DELETE FROM `{$this->table['name']}` WHERE id=?");
        if (!$query) return [false, "Please contact Admin!: " . $conn->error];
        $query->bind_param("i", $id);
        $query->execute();
        if (!empty($query->error)) return [false, $query->error];
        else return [true, "{$this->table['title']} Deleted Successfully!"];
    }

    function find($field, $value)
    {
        //Connection to DB
        global $conn;
        $type = getBindString($value);

        //Calling-Executing the prepared statement
        $query = $conn->prepare("SELECT * from `{$this->table['name']}` WHERE {$field}=?");
        if (!$query) return [false, "Please contact Admin!: " . $conn->error];
        $query->bind_param($type, $value);
        $query->execute();

        //The data
        $query = $query->get_result();
        if ($query->num_rows == 0) return [false, "No Such {$this->table['title']}"];
        $batch = $query->fetch_assoc();
        if (!empty($query->error)) return [false, $query->error];
        else return [true, $batch];
    }

    function get($conf = [[], []])
    {
        global $conn;
        $data = [];
        $query = "SELECT * from `{$this->table['name']}`";
        foreach ($conf[0] as $key => $c) {
            if (!$key) $query .= " WHERE " . $c[0] . ($c[1] == "like" ? " LIKE '%" : $c[1] . "'") . $c[2] . ($c[1] == "like" ? "%'" : "'");
            else $query .= " AND " . $c[0] . ($c[1] == "like" ? " LIKE '%" : $c[1] . "'") . $c[2] . ($c[1] == "like" ? "%'" : "'");
        }
        if (isset($conf[1])) {
            if (gettype($conf[1]) !== null) {
                if (count($conf[1]) > 0) {
                    foreach ($conf[1] as $x) {
                        $query .= " " . $x . " ";
                    }
                }
            }
        }

        $query = $conn->query($query);
        if (!$query) return [false, "Please contact Admin!: " . $conn->error];
        if ($query->num_rows == 0) return [false, "No Such {$this->table['title']}"];
        while ($row = $query->fetch_assoc()) {
            $data[] = $row;
        }
        return [true, $data];
    }
}
