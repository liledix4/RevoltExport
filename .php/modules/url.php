<?php
class URL {
  public static function ClearQueryString() {
    return rtrim(strtok($_SERVER["REQUEST_URI"], '?'), '/');
  }
}
?>