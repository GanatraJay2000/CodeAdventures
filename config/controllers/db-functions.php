<?php
function select($conf)
{
    global $conn;
    $data = [];
    if (gettype($conf) == "array") {

        $query = "SELECT " . implode(", ", $conf['select']) . " FROM " . $conf['from'];
        if (isset($conf['join'])) {
            $string = "";
            foreach ($conf['join'] as $j) {
                $string .= " INNER JOIN " . $j['table'] . " ON " . $j['on'];
            }
            $query .= $string;
        }
        if (isset($conf['conditions'])) {
            $string = "";
            foreach ($conf['conditions'] as $key => $c) {
                $pre = " AND ";
                if (!$key) $pre = " WHERE ";
                $string .= $pre . $c;
            }
            $query .= $string;
        }
    } else if (gettype($conf) == "string") {
        $query = "SELECT * from {$conf}";
    }
    $query = $conn->query($query);
    if (!$query) return [false, $conn->error];
    if ($query->num_rows <= 0) return [false, "No Such Data Found"];
    while ($row = $query->fetch_assoc()) {
        $data[] = $row;
    }
    return [true, $data];
}

// $conf = [
//     "select" => ["regions.id", "regions.name as region", "zones.name as zone"],
//     "from" => "regions",
//     "join" => [
//         [
//             "table" => "zones",
//             "on" => "zones.id = regions.zone_id",
//         ]
//     ],
//     "conditions" => [
//         "zones.id = 1",
//         "zones.id < 2"
//     ]
// ];
// print_r(select($conf)[1]);