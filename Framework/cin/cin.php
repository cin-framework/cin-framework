<?php

declare(strict_types=1);

/**
 * CIN Framework Core Bootstrap File
 *
 * This file serves as the main entry point and bootstrap for the CIN Framework.
 * It defines essential constants, validates system integrity, and initializes
 * the core framework components required for operation.
 *
 * @package CIN Framework
 * @author Ayoub Alarjani (MAWI MAN)
 * @version 2.0.0
 * @license Proprietary - All rights reserved to CIN Framework
 */

define('ROOT_PATH', dirname(__DIR__));
define('CIN_PATH', __DIR__);

if (!defined('ROOT_PATH') || !defined('CIN_PATH')) {
    die('Access Denied - Direct access not permitted');
} else {
    require_once CIN_PATH . '/Config/config.php';
    require_once CIN_PATH . '/Core/logs.php';
    require_once CIN_PATH . '/Core/kernal.php';
}
