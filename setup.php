<?php
function pg_connection_string_from_database_url() {
 extract(parse_url($_ENV["DATABASE_URL"]));
 return "user=$user password=$pass host=$host dbname=" . substr($path, 1);
}
  $db = pg_connect(pg_connection_string_from_database_url() );
  if(!$db){
      echo "Eroor : Unable to open database\n";
   }else {
      echo "Opened database successfully\n";
   }

$sql ="CREATE TABLE MyAccounts (username CHAR(10) PRIMARY KEY   NOT NULL, password   CHAR(50)  )";


$ret = pg_query($db, $sql);
if(!$ret){
  echo pg_last_error($db);
} else {
  echo "table created successfully\n";
}
pg_close($db);
?>
