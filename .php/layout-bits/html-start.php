<?php
global $CurrentPageTitle;
Modules::Load('site-title');
Modules::Load('server-info');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?=SiteTitle::Full($CurrentPageTitle);?></title>
  <link rel="stylesheet" href="<?ServerInfo::RootAddress();?>/css/main.css">
</head>
<body>