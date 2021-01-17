<?php

$_REQUEST;
$_ENV;

$modules = array('Application', 'Information', 'Template');

foreach($modules as $path) require_once sprintf('%s/application/core/%s.php', ROOTSERVER, $path);

require_once ROOTSERVER . 'application/main.php';
