<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 10/1/18
 * Time: 13:09
 */

namespace VatGia\Model;

/**
 * Trait CustomizableFieldsWithPrefixTrait
 * @package VatGia\Model
 *
 */
trait CustomizableFieldsWithPrefixTrait
{

    /**
     * @param null $fields
     * @param null $prefix
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function fields($fields = null, $prefix = null)
    {

        $fields = $fields ?? '*';

        $prefix = $prefix ?? $this->prefix ?? '';

        $fields = is_array($fields) ? $fields : explode(',', $fields);

        $fields = array_map(function ($value) use ($prefix) {
            return $value != '*' ? $prefix . trim($value) : $value;
        }, $fields);

        return $this->select($fields);
    }

}