<?php
if (FLOW_PATH_ROOT !== '/home/flo/Dokumente/www/hostings/hausnetz/' || !file_exists('/home/flo/Dokumente/www/hostings/hausnetz/Data/Temporary/Development/Configuration/DevelopmentConfigurations.php')) {
	unlink(__FILE__);
	return array();
}
return require '/home/flo/Dokumente/www/hostings/hausnetz/Data/Temporary/Development/Configuration/DevelopmentConfigurations.php';