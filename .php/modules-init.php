<?php
class Modules {
  static function Load($name) {
    require_once(__DIR__."/modules/{$name}.php");
  }
  static function Layout($name) {
    require_once(__DIR__."/layout-bits/{$name}.php");
  }
  static function Config() {
    require_once(__DIR__."/config.php");
  }
}
?>