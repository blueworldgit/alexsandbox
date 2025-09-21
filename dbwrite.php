<?php


include("./db/db.php");

//mysqli_query($conn,"SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");

$sql="INSERT INTO `english` (`id`, `circuit`, `standard`, `ordinal`, `reduced`, `fullstandard`, `fullordinal`, `fullreduced`, `reversestandard`, `reverseordinal`, `reversereduced`) 
VALUES (NULL, 'אא אא אאאאאאאא', '2', '5', '7', '8', '4', '2', '8', '9', '4')";

if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
