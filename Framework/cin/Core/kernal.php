<?php

declare(strict_types=1);

/**
 * CIN Framework Kernel
 *
 * Core system initialization and bootstrap file that loads the DOMinator
 * and initializes the complete CIN framework system.
 *
 * @package CIN Framework
 * @author Ayoub Alarjani (MAWI MAN)
 * @license Proprietary - All rights reserved to CIN Framework
 */

require_once CIN_PATH . '/DOMinator/dominator.php';

if (!initialize_cin_system()) {
    cin_logs("Failed to initialize CIN Framework system", "system");
    exit;
} else {
    cin_logs("CIN Framework initialized successfully", "success");
}
