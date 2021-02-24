<?php

require 'dbConnection.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    $sql = "SELECT * FROM tasks WHERE id='$id'";

    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("Can'\t get task");
    }

    $json = array();
    while($row = mysqli_fetch_array($result))
    {
        $json[] = array(
            'id' => $row['id'],
            'name' => $row['name'],
            'description' => $row['description']
        );
    }

    $jsonObj = json_encode($json[0]);
    echo $jsonObj;
}