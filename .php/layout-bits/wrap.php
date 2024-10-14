<?php
$CurrentPageTitle = '';
Modules::Config();
Modules::Load('json-decode');
Modules::Load('file-system');
Modules::Load('url');
class Wrap {
  private static $CurrentPath = '';

  public static function FolderList(string $JSONFileName) {
    $Request = urldecode(URL::ClearQueryString());

    if ( $Request != '/' ) {
      $CurrentFolderTitle = explode('/', $Request);
      $CurrentFolderTitle = $CurrentFolderTitle[sizeof($CurrentFolderTitle) - 1];
      $BackButton = "<a class='no-text' href='{$Request}/../'><div class='back-button'></div></a>";
      global $CurrentPageTitle;
      $CurrentPageTitle = $CurrentFolderTitle;
    }

    if ( $Request == '/' || $Request == '' ) {
      $Request = '';
      $BackButton = '';
      $CurrentFolderTitle = ConfigPublic::$WebsiteTitle;
    }

    if ( isset( $_GET['path'] ) ) {
      static::$CurrentPath = $_GET['path'];
    }

    function EchoListElement
    (string $Title, string $URL = '', string $Class = 'file', string $ImageFileName = null)
    {
      if ($ImageFileName == null) {$ImageFileName = $Class;}
      echo "
        <a href='{$URL}'>
          <div class='list-item {$Class}'>
            <img src='".ServerInfo::RootAddress()."/images/{$ImageFileName}.png' alt='{$ImageFileName}'>
            <span>{$Title}</span>
          </div>
        </a>
      ";
    }

    Modules::Layout('html-start');

    echo "
      <div class='browse'>
        <div class='current-location-title'>
          {$BackButton}
          <span>{$CurrentFolderTitle}</span>
        </div>
        <div class='list-body'>
    ";

    foreach (FileSystem::GetSubFolders('.json'.$Request) as $values) {
      EchoListElement($values, $Request.'/'.$values, 'folder');
    }
    unset($values);

    foreach (FileSystem::FilterFileExtension('.json'.$Request, 'json') as $values) {
      EchoListElement(explode('.', $values)[0], $Request.'/'.$values, 'file');
    }
    unset($values);

    echo '</div></div>';
    Modules::Layout('html-end');
  }
  public static function Chat(string $JSONFileName) {
    $temp = JSON::Decode($JSONFileName);
    $User = array();
    $Request = urldecode(URL::ClearQueryString());

    $CurrentFileTitle = explode('/', $Request);
    $CurrentFileTitle = $CurrentFileTitle[sizeof($CurrentFileTitle) - 1];
    $CurrentFileTitle = explode('.', $CurrentFileTitle)[0];

    global $CurrentPageTitle;
    $CurrentPageTitle = $CurrentFileTitle;

    Modules::Layout('html-start');

    echo "
      <div class='chat'>
        <div class='current-location-title'>
          <a class='no-text' href='{$Request}/../'><div class='back-button'></div></a>
          <span>{$CurrentFileTitle}</span>
        </div>
    ";

    for($i = sizeof($temp) - 1; $i >= 0; $i--) {
      for($ii = sizeof($temp[$i]['users']) - 1; $ii >= 0; $ii--) {
        $ThisUser = $temp[$i]['users'][$ii];
        $ThisUserID = $ThisUser['_id'];
        if (!isset($User[$ThisUserID])) {
          array_push($User, $ThisUserID);
          if ( isset($ThisUser['display_name']) )
            $User[$ThisUserID]['name'] = $ThisUser['display_name'];
          else
            $User[$ThisUserID]['name'] = $ThisUser['username'];
          if ( isset($ThisUser['avatar']) ) {
            $User[$ThisUserID]['avatar-id'] = $ThisUser['avatar']['_id'];
            $User[$ThisUserID]['avatar-filename'] = $ThisUser['avatar']['filename'];
          }
        }
      }
      for($ii = sizeof($temp[$i]['messages']) - 1; $ii >= 0; $ii--) {
        $Message = $temp[$i]['messages'][$ii];
        $UserData = $User[$Message['author']];
        $Attachments = '';
        if ( isset($UserData['avatar-id']) )
          $AvatarHTML = "src='https://autumn.revolt.chat/avatars/{$UserData['avatar-id']}/{$UserData['avatar-filename']}' ";
        if ( isset($Message['attachments']) ) {
          foreach ($Message['attachments'] as $Item) {
            $TempURL = "https://autumn.revolt.chat/attachments/{$Item['_id']}/{$Item['filename']}";
            $Attachments .= "
              <a href='{$TempURL}' target='_blank'>
                <img class='attachment-item' src='{$TempURL}' alt='' />
              </a>";
          }
        }
        echo "
          <div class='message'>
            <img class='avatar' {$AvatarHTML}alt='' />
            <div class='message-body'>
              <div class='author'>{$UserData['name']}</div>
              <div class='message-content'>{$Message['content']}</div>
              <div class='attachments'>{$Attachments}</div>
            </div>
          </div>
        ";
      }
    }

    unset($temp);

    echo '</div>';
    Modules::Layout('html-end');
  }
}
?>