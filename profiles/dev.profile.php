<?php

return 'dev';

function civicrm_settingapi_dev(&$settingsMetadata, $domainID, $profile){
  if($profile == 'dev'){
      $settingsMetadata['debug_enabled']['default'] = '1';
      $settingsMetadata['debug_enabled']['profile'] = 'dev';
      $settingsMetadata['backtrace']['default'] = 1;
      $settingsMetadata['backtrace']['profile'] = 'dev';
      return 'settingapi' . $profile;
  }
}