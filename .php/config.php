<?php
Modules::Load('server-info');

class ConfigPublic {
  /*
  public static function ErrorPage() {
    return ServerInfo::RootAddress().'/error';
  }
  */
  public static $WebsiteTitle = 'Revolt Export';
  public static $WebsiteTitleSeparator = ' ︱ ';
}
/*
class ConfigSensitive {
  public static $DatabaseServer = '';
  public static $DatabaseUsername = '';
  public static $DatabasePassword = '';
  public static $DatabaseDev = '';
  public static $DevCookie = '';
  public static $DevTokenCookie = '';
  public static $DevTable = '';
}
*/
?>