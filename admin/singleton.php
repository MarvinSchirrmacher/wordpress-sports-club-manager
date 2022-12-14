<?php
abstract class Singleton {
    private static $instances = array();
    final private function __construct() {
        $class = get_called_class();
        if (array_key_exists($class, self::$instances))
            throw new Exception('An instance of '. $class .' already exists !');

        $this->initialize();
    }
    final private function __clone() { }
    abstract protected function initialize();

    public static function getInstance() {
        $class = get_called_class();
        if (array_key_exists($class, self::$instances) === false){
            self::$instances[$class] = new $class();
        } 
        return self::$instances[$class];
    }
}
?>