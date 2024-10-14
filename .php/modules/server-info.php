<?php
class ServerInfo {
  public static function RootAddress() {
    return "{$_SERVER['REQUEST_SCHEME']}://{$_SERVER['HTTP_HOST']}";
  }
  public static function RootDirectory() {
    return $_SERVER['DOCUMENT_ROOT'].'/';
  }
}
?>