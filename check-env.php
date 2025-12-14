<?php
echo "MYSQLHOST: " . (getenv('MYSQLHOST') ?: 'NOT SET') . "<br>";
echo "MYSQLPORT: " . (getenv('MYSQLPORT') ?: 'NOT SET') . "<br>";
echo "MYSQLUSER: " . (getenv('MYSQLUSER') ?: 'NOT SET') . "<br>";
echo "MYSQLDATABASE: " . (getenv('MYSQLDATABASE') ?: 'NOT SET') . "<br>";
echo "MYSQLPASSWORD: " . (getenv('MYSQLPASSWORD') ? 'SET (hidden)' : 'NOT SET') . "<br>";
?>