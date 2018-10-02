<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 9/29/18
 * Time: 23:12
 */

namespace VatGia\Model;


use \Illuminate\Database\Eloquent\Model as LaravelModel;
use Illuminate\Support\Facades\Config;

class Model extends LaravelModel
{

    use CustomizableFieldsWithPrefixTrait;

    /**
     * Create a new Eloquent model instance.
     *
     * @param  array $attributes
     * @return void
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setConnection();
    }

    /**
     * Set the connection associated with the model.
     *
     * @param  string $name
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function setConnection($name = null)
    {
        $database_config = Config::get('database');

        $name = $name ?? $database_config['default'] ?? 'master';

        //Trường hợp chỉ định cụ thể connection
        $connection = Config::get('database.connections.' . $name);
        if ($this->isAvailableConnection($connection)) {

            return parent::setConnection($name);
        }

        //Trường hợp chỉ định 1 nhóm connections
        $connections = Config::get('database.connections.' . $name);
        if ($connections && is_array(reset($connections))) {
            $connections = $this->getAvailableConnections($connections);
            $name = $name . '.' . $this->getRandomConnection($connections);

            return parent::setConnection($name);
        }

        return parent::setConnection($name);
    }

    /**
     * Check connection is available in config
     *
     * @param $connection
     * @return bool
     */
    protected function isAvailableConnection($connection)
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
    protected function getAvailableConnections($connections)
    {
        $result = [];
        foreach ($connections as $key => $connection) {
            if (!$this->isAvailableConnection($connection)) {
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
    protected function getRandomConnection($connections)
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