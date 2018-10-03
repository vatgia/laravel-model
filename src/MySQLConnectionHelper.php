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

            return $connections[$connection];
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
}