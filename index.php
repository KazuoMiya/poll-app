<?php
require_once 'config.php';

require_once SOURCE_BASE . 'libs/helper.php';
require_once SOURCE_BASE . 'libs/auth.php';

require_once SOURCE_BASE . 'models/abstract.model.php';
require_once SOURCE_BASE . 'models/user.model.php';

require_once SOURCE_BASE . 'db/datasource.php';
require_once SOURCE_BASE . 'db/user.query.php';

require_once SOURCE_BASE . 'libs/message.php';

require_once SOURCE_BASE . 'libs/router.php';

use function lib\route;

session_start();

require_once SOURCE_BASE . 'partials/header.php';

$rpath = str_replace(BASE_CONTEXT_PATH, '', $_SERVER['REQUEST_URI']);
$method = strtolower($_SERVER['REQUEST_METHOD']);

route($rpath, $method);

require_once SOURCE_BASE . 'partials/footer.php';
