<?php

namespace App\Repositories\Member;


use App\Repositories\Repository;
use Illuminate\Support\Facades\DB;

class MemberCoreRepository extends Repository {

    /**
     * Mass (bulk) insert or update on duplicate for Laravel 4/5
     *
     * insertOrUpdate([
     *   ['id'=>1,'value'=>10],
     *   ['id'=>2,'value'=>60]
     * ]);
     *
     *
     * @param array $rows
     */
    function massUpdate($model, array $rows){

        if(count($rows)==0){
            return true;
        }

        $table = $model->getTable();

        $first = reset($rows);

        $columns = implode( ',',
            array_map( function( $value ) { return "$value"; } , array_keys($first) )
        );

        $values = implode( ',', array_map( function( $row ) {
                return '('.implode( ',',
                        array_map( function( $value ) {
                                if($value===null){
                                    return "NULL";
                                }else{
                                    return '"'.str_replace('"', '""', $value).'"';
                                }
                            } , $row )
                    ).')';
            } , $rows )
        );

        $updates = implode( ',',
            array_map( function( $value ) { return "$value = VALUES($value)"; } , array_keys($first) )
        );

        $sql = "INSERT INTO {$table}({$columns}) VALUES {$values} ON DUPLICATE KEY UPDATE {$updates}";

        return DB::statement( $sql );
    }
}
