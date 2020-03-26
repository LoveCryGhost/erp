<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class CoreModel extends Model
{
    /*
     * $values = [
        ['user', 1],
        ['user', 2],
        ['moderator', 1],
        ['admin', 1],
    ];
        $dummies = Dummy::whereInMultiple(['morphable_type', 'morphable_id'], $values)->get();
    */
    public static function whereInMultiple(array $columns, $values)
    {
        $values = array_map(function (array $value) {
            return "('".implode("', '", $value)."')";
        }, $values);

        return static::query()->whereRaw(
            '('.implode(', ' ,$columns).') in ('.implode(', ', $values ).')'
        );
    }


}
