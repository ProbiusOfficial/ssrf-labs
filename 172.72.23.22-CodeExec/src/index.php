<?php 
$dir = './';
$files = scandir($dir);
foreach ($files as $file) {
    if ($file == '.' || $file == '..') {
        continue;
    }
    echo "<p>$file</p>";
}   
?>