<?php

declare(strict_types=1);

/**
 * CIN Framework Logging System
 *
 * Provides comprehensive logging functionality for the CIN Framework
 * with structured log entries, timestamps, and occurrence tracking.
 *
 * @package CIN Framework
 * @author Ayoub Alarjani (MAWI MAN)
 * @license Proprietary - All rights reserved to CIN Framework
 */

if (!ensure_logs_directory()) {
    die('Failed to create logs directory');
}

/**
 * Logs messages to the CIN Framework logging system.
 *
 * Creates structured log entries with timestamps, file locations, and occurrence tracking.
 * Automatically groups duplicate messages and maintains occurrence counts.
 * Organizes logs by type in separate directories.
 *
 * @param string $message The log message to record
 * @param string $type    The log type (error, system, info, etc.)
 * @param array  $context Additional context data (currently unused)
 *
 * @return void
 */
function cin_logs(string $message, string $type = 'error', array $context = []): void
{
    $typeDir = ROOT_PATH . '/.cin/logs/' . $type;
    if (!is_dir($typeDir)) {
        if (!mkdir($typeDir, 0755, true)) {
            error_log("Failed to create log directory: {$typeDir}");
            return;
        }
    }
    
    $logFile = $typeDir . '/' . date('Y-m-d') . '.log';
    $timestamp = date('Y-m-d H:i:s');

    $trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 1)[0];
    $errorInfo = [
        'timestamp' => $timestamp,
        'type' => $type,
        'message' => $message,
        'file' => $trace['file'],
        'line' => $trace['line'],
        'count' => 1
    ];

    $logs = [];
    if (file_exists($logFile)) {
        $logs = json_decode(file_get_contents($logFile), true) ?: [];

        foreach ($logs as &$log) {
            if ($log['message'] === $message &&
                $log['file'] === $trace['file'] &&
                $log['line'] === $trace['line']) {
                $log['count']++;
                $log['last_occurrence'] = $timestamp;
                file_put_contents($logFile, json_encode($logs, JSON_PRETTY_PRINT));
                return;
            }
        }
    }

    $logs[] = $errorInfo;
    file_put_contents($logFile, json_encode($logs, JSON_PRETTY_PRINT));
}
