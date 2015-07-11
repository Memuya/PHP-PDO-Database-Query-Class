# PHP-PDO-Database-Classes
Easy way to connect and query your database via PDO.

# Get Started

## 1. Edit the DB.php file to add your database values

## 2. Include the Query class

```PHP
require_once 'path/to/class/Query.php;
```
## 3. Make a query

```PHP
//No binds made to query
$q = new Query("SELECT * FROM users");

//Binds made to query
$q = new Query("SELECT * FROM users WHERE id = :id", [':id' => 1]);
```

## 4. Choose a method for your needs

#### 4.1. Return a single row

```PHP
$r = $q->single();
echo $r->username;
```

#### 4.2. Return all rows

```PHP
$r = $q->getAll();

//Loop through returned array and output information
foreach($r as $row)
  echo $row->username."<br>";
```

#### 4.3. Execute a query (UPDATE, INSERT, DELETE, etc)

The commit method will return the number of rows affected by the query by default. A message can be displayed instead.

```PHP
$username = "TestName";
$id = 1;

$q = new Query("
	UPDATE users SET username = :username WHERE id = :id", [
		':username' => $username,
		':id' => $id
	]
);

$r->commit(); //X number of rows affected
$r->commit("Query Done!"); //Query Done!
```

## 5. Number of rows returned

You can use the getCount() method to validate how many rows were returned

```PHP
//Only loop through results if at least ONE row has been returned
$q = new Query("SELECT * FROM users");
$r = $q->getAll(); //This will set the getCount() method

if($q->getCount() != 0)
  //Loop through results
else
  //No results returned
```
The getAll(), single(), and commit() methods all set the getCount() method.

# Basic Example

```PHP
<?php
require_once 'path/to/class/Query.php';

$q = new Query("SELECT * FROM users");
$r = $q->getAll();

if($q->getCount() != 0) {
  foreach($r as $row) {
    echo $row->id.". ".$row->username."<br>";
  }
} else {
  echo "No results were returned!";
}
```
