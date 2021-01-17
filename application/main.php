<?php

use Core\Application;
use Core\Information;

Application::configure();
Information::configure();

$request = null;
$context = Information::hasContext(Application::$uri, $request);

return Application::send(Information::getPath($context, $request));
