# PHP PDO Query Class
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

# Change PDO fetch style
By default, PDO::FETCH_OBJ is used, though it can be changed to any of the other [fetch styles](http://php.net/manual/en/pdostatement.fetch.php).

```PHP
$q = new Query("SELECT * FROM users");
$q->setFetchStyle(PDO::FETCH_ASSOC);
```

If you want to permanently change the PDO fetch style for all queries, you can do so by changing the $fetch_style variable in the Query class (found in the constructor).

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
# Using the DB class
The DB class can be used by itself without the use of the Query class.

```PHP
require_once 'path/to/class/DB.php';

//Create the database object
$db = new DB();

//You can also create the object and not connect to the database
//This is useful for changing database information
$db = new DB(false);
```

## Update Database Information
You can either set the database information permantly inside the class by editing the DB.php file, or do as followed.

```PHP
//Set database name
$db->setDBName("database_name");
//Set database host
$db->setDBHost("localhost");
//Set database username
$db->setDBUser("root");
//Set database password
$db->setDBPass("pass");
```

## Make a Query
Making a query with the DB class without the Query class is done using normal PDO methods.
```PHP
//Make a query and set it to the $q variable
$q = $db->getDB()->query("SELECT * FROM users);
//Get the number of rows returned
$count = $q->rowCount();
//Get the results from the query
$rows = $q->fetch(PDO::FETCH_OBJ);

//Do something with data returned
```
