<?php
include('connect.php');


$nurseName = $_GET['nurseName'];

try {
    $sqlSelect = "SELECT nurse.name, ward.name, department, shift FROM nurse, ward, nurse_ward WHERE 
    nurse.name=? AND id_nurse=fid_nurse AND fid_ward=id_ward";

    $stmt = $dbh->prepare($sqlSelect);

    $stmt->bindValue(1,$nurseName);
    $stmt->execute();
    $res = $stmt->fetchAll();

    echo "<table border='1'";
    echo "<thead><tr><th>nurse.name</th><th>ward.name</th><th>department</th><th>shift</th></tr></thead>";
    echo "<tbody>";

    foreach($res as $row)
    {
        echo "<tr><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td></tr>";
    }
    
    echo "</tbody>";
    echo "</table>";
}
catch(PDOException $ex) {
    echo $ex->GetMessage();
}
$dbh = null;