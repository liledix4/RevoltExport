<?php
Modules::Load('server-info');
class FileSystem {
  public static function ListContents(string $Path = '', $Sort = SCANDIR_SORT_ASCENDING, $Context = null) {
    $Temp = array();
    foreach(scandir(ServerInfo::RootDirectory().$Path, $Sort, $Context) as $value) {
      if ($value != '.' && $value != '..') {
        array_push($Temp, $value);
      }
    }
    return $Temp;
  }
  public static function CheckExistence(string $Path = '') {
    return file_exists($Path);
  }
  public static function GetSubFolders(string $Path = '') {
    $Temp = array();
    foreach(static::ListContents($Path) as $Item) {
      if (strpos($Item, '.') === false) {
        array_push($Temp, $Item);
      }
    }
    return $Temp;
  }
  public static function FilterFileExtension(string $Path = '', string $FileExtension = null) {
    $Temp = array();
    foreach(static::ListContents($Path) as $Item) {
      if (str_ends_with($Item, $FileExtension)) {
        array_push($Temp, $Item);
      }
    }
    return $Temp;
  }
}
?>