<?php
/**
 * @brief this is an abstract class to hold all database related columns and tables in constants
 * todo: spread this into more sub folders for each table
 * @author alter
 *
 */
abstract class AbstractTypes {
    
    const TYPES = [];
    
    static function getTypes(): array {
        return static::TYPES;
    }
}