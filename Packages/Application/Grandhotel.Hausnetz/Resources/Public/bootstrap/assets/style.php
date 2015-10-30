<?php
$directory = "stylesheets";

require "scssphp/scss.inc.php";
scss_server::serveFrom($directory);