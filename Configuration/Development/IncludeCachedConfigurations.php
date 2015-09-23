<?php
if (FLOW_PATH_ROOT !== '/var/www/vhosts/hausnetz/' || !file_exists('/var/www/vhosts/hausnetz/Data/Temporary/Development/Configuration/DevelopmentConfigurations.php')) {
	unlink(__FILE__);
	return array();
}
return require '/var/www/vhosts/hausnetz/Data/Temporary/Development/Configuration/DevelopmentConfigurations.php';