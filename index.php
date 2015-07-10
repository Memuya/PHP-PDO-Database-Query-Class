<?php
require_once 'classes/Query.php';

/************************
* Returing a single row *
*************************/

//Query and bind values
$q = new Query("SELECT * FROM users WHERE id = :id", [':id' => 1]);

//1. Store results in a variable and access the information you need
$r = $q->single();
$r->username;

//2. Access the information directly
$q->single()->username;


/********************
* Returing all rows *
*********************/

$q = new Query("SELECT * FROM users");
$r = $q->getAll();

//Check to see if any rows were returned
if($q->getCount() != 0)
	//Loop through array to access each object
	foreach($r as $row)
		echo $row->username."<br>".$row->email."<br><br>";


/******************
* Execute a query *
*******************/

$username = "TestName";
$id = 1;

//Query and bind values
$q = new Query("
	UPDATE users SET username = :username WHERE id = :id", [
		':username' => $username,
		':id' => $id
	]
);

//Execute the query and return a how many rows have been affected (default) or a message
echo $q->commit();
