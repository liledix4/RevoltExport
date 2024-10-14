<?php
Modules::Config();
class SiteTitle {
  public static function Full(string $SecondaryTitle = '') {
    if ($SecondaryTitle != '') {
      $SecondaryTitle .= ConfigPublic::$WebsiteTitleSeparator;
    }
    return $SecondaryTitle.ConfigPublic::$WebsiteTitle;
  }
}
?>