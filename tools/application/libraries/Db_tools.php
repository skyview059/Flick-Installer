<?php

/**
 * @author Khairul Azam
 * @Date 14th July, 2023
 */

class Db_tools {
    
    private static $ci = false;
    
    function __construct()
    {
        self::$ci =& get_instance();
    }
    
    
    public static function generateAlterQuery($src_Structure, $dist_Structure, $tableName) {
        $src_Lines  = explode("\n", $src_Structure);
        $dist_Lines = explode("\n", $dist_Structure);

        $alterQuery = '';

        // Find differences between source and target structure
        $src_Columns    = self::extractColumns($src_Lines);
        $dist_Columns   = self::extractColumns($dist_Lines);

        /* Find added columns */ 
        foreach ($src_Columns as $columnName => $columnDefinition) {
            if (!array_key_exists($columnName, $dist_Columns)) {
                $alterQuery .= ' ADD COLUMN '. trim($columnDefinition) . ",\r\n";
            }
        }

        /* Find modified columns */
        foreach ($src_Columns as $columnName => $columnDefinition) {
            if (array_key_exists($columnName, $dist_Columns) && trim($columnDefinition) !== trim($dist_Columns[$columnName])) {
                $alterQuery .= " CHANGE COLUMN `{$columnName}` ". trim($columnDefinition) . ",\r\n";
            }
        }

        /* Find dropped columns */ 
        foreach ($dist_Columns as $columnName => $columnDefinition) {
            if (!array_key_exists($columnName, $src_Columns)) {
                $alterQuery .= " DROP COLUMN `{$columnName}`," . "\r\n";;
            }
        }

        /* Handle table engine differences (e.g., InnoDB vs MyISAM) */ 
        $src_Engine     = self::extractTableEngine($src_Lines);
        $dist_Engine    = self::extractTableEngine($dist_Lines);

        if ($src_Engine != $dist_Engine) {
            $alterQuery .= "ENGINE={$src_Engine}" . "\r\n";
        }
        
        return !empty($alterQuery) ? "ALTER TABLE `{$tableName}`" . "\r\n" . trim($alterQuery, ',' . "\r\n"  ) : '';
    }
        
    public static function getTableStructure($table){                        
        $query = self::$ci->db->query("SHOW CREATE TABLE `{$table}`")->row_array();
        return self::ignoreTableExtraAttr( $query['Create Table'] );
    }
    
    public static function createTableQuery($table){        
        $query = self::$ci->db->query("SHOW CREATE TABLE `{$table}`")->row_array();                   
        return self::viewMySQLQuery( $query['Create Table'] );
    }
    
    private static function ignoreTableExtraAttr( $stracture ){
//        $attrs = ['CHARACTER SET utf8mb4 '];
//        return str_replace($attrs, [''], $stracture );    
        return $stracture;
    }
    
    private static function  extractTableEngine($lines) {
        foreach ($lines as $line) {
            if (strpos($line, 'ENGINE=') !== false) {
                preg_match("/ENGINE=([^\s]+)/", $line, $matches);
                return $matches[1];
            }
        }
        return '';
    }
    
    public static function viewMySQLQuery( $query ){
        
        $modify = str_replace(
            ['_tmp_', ' DEFAULT CHARSET=utf8mb3'], 
            ['', ''], 
            $query
        );
        
        if(empty($modify)){
            return '';
        }
        return "<pre class='sql-query'>{$modify};</pre>";
        
//        return "<pre class='sql-query'>{$query};</pre>";
    }
    
    private static function extractColumns($lines) {
        $columns = [];
        $currentColumnName = '';

        foreach ($lines as $line) {
            if (preg_match("/^\s*`([^`]+)`/", $line, $matches)) {
                $currentColumnName = $matches[1];
            }

            if (!empty($currentColumnName) && strpos($line, $currentColumnName) !== false) {
                $columns[$currentColumnName] = trim($line, ',');
            }
        }

        return $columns;
    }
    
}
