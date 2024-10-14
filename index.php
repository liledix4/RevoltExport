<?php
require_once(__DIR__.'/.php/modules-init.php');
Modules::Layout('wrap');
Modules::Load('server-info');
Modules::Load('file-system');
Modules::Load('url');
$JSONRootFolder = ServerInfo::RootDirectory().'.json';
$Request = urldecode(URL::ClearQueryString());

if
  (
    FileSystem::CheckExistence($JSONRootFolder.$Request.'.json')
    ||
    str_ends_with($Request, '.json')
    &&
    FileSystem::CheckExistence($JSONRootFolder.$Request)
  )
  {Wrap::Chat($JSONRootFolder.$Request);}
elseif (FileSystem::CheckExistence($JSONRootFolder.$Request))
  {Wrap::FolderList($JSONRootFolder.$Request);}
// else
//   {header('Location: '.ServerInfo::RootAddress(), true, 301);}

?>