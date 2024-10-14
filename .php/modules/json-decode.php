<?php
class JSON {
  public static function Decode(string $JSONFileName, bool $ReturnArray = true) {
    if (!str_ends_with($JSONFileName, '.json')) {$JSONFileName .= '.json';}
    return json_decode(file_get_contents($JSONFileName), $ReturnArray);
  }
  public static function String(string $String, bool $ReturnArray = true) {
    return json_decode($String, $ReturnArray);
  }
}
?>