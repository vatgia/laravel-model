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
    

}