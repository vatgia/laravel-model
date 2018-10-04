<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 10/3/18
 * Time: 12:00
 */

namespace VatGia\Model;


class MySQLConnectionHelper
{

    const LOG_PATH_CONNECT_FAIL_PATTERN = 'logs/connection_fail_%s.log';

    const MAX_CONNECT_FAIL = 100;

    /**
     * Set the connection associated with the model.
     *
     * @param $connections
     * @return array
     */
    public static function random($connections)
    {

        if (static::isAvailableConnection($connections)) {
            return $connections;
        }

        if ($connections && is_array($connections)) {
            $connections = static::getAvailableConnections($connections);

            $connection = static::getRandomConnection($connections);

            if (!$connection) {
                throw new \InvalidArgumentException('No database is available!');
            }

            return $connection ? $connections[$connection] : [];
        }
    }

    /**
     * Check connection is available in config
     *
     * @param $connection
     * @return bool
     */
    protected static function isAvailableConnection($connection)
    {

        $host = $connection['host'] ?? $connection['read']['host'] ?? null;
        if (!$host) {
            return false;
        }

        $connect_fail_count = (int)@filesize(sprintf(storage_path(static::LOG_PATH_CONNECT_FAIL_PATTERN), $host));

        $max_connection_retry = (int)static::MAX_CONNECT_FAIL;

        if ($connect_fail_count/2 > $max_connection_retry) {
            return false;
        }

        return is_array($connection)
            && isset($connection['driver'])
            && (
                (isset($connection['host']) && $connection['host'])
                || (
                    isset($connection['read']['host'])
                    && $connection['read']['host']
                    && isset($connection['write']['host'])
                    && $connection['write']['host']
                )
            );
    }

    /**
     * Filter connections enable in config
     *
     * @param $connections
     * @return array
     */
    protected static function getAvailableConnections($connections)
    {
        $result = [];
        foreach ($connections as $key => $connection) {
            if (!static::isAvailableConnection($connection)) {
                continue;
            }
            $result[$key] = $connection;
        }

        return array_filter($result);
    }


    /**
     * Get random connection
     *
     * @param $connections
     * @return string
     */
    protected static function getRandomConnection($connections)
    {
        if (empty($connections)) {
            return '';
        }
        $keys = [];
        foreach ($connections as $key => $connection) {
            $connection['weight'] = isset($connection['weight']) ? (int)$connection['weight'] : 1;
            $keys = array_merge($keys, array_fill(0, $connection['weight'], $key));
        }

        shuffle($keys);

        return (string)reset($keys);
    }

    public static function handlePDOException(\Exception $e)
    {
        if ($e instanceof \PDOException) {
            //Log khi connect mysql fail
            $connection = app('last_connection');
            $log_path_pattern = storage_path(static::LOG_PATH_CONNECT_FAIL_PATTERN);
            $host = $connection['host'] ?? $connection['read']['host'] ?? '';
            static::appendToLogFile(sprintf($log_path_pattern, $host), ' ');
            $content = date('H:i:s d/m/Y') . ': Connection fail from ' . $_SERVER['REMOTE_ADDR'] . PHP_EOL;
            static::appendToLogFile(sprintf($log_path_pattern, $host . '_detail'), $content);
        }
    }

    public static function handleQueryException(\Exception $e)
    {
        if ($e instanceof \Illuminate\Database\QueryException) {
            return;
        }
    }

    protected static function appendToLogFile($log_path, $content)
    {
        $handle = fopen($log_path, 'a+');
        if ($handle) {
            fwrite($handle, $content);
            fclose($handle);
        }
    }
}