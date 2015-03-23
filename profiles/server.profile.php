<?php

return 'server';

function civicrm_settingapi_server(&$settingsMetadata, $domainID, $profile){
  if($profile == 'server'){
      $mailing = array(
        'outBound_option' => 0,
        'sendmail_path' => '/usr/sbin/sendmail',
        'sendmail_args' => '-i',
        'smtpServer' => 'localhost',
        'smtpPort' => 25,
        'smtpAuth' => 0,
      );
      $settingsMetadata['mailing_backend']['default'] =$mailing;
      $settingsMetadata['mailing_backend']['profile'] = 'server';
      return 'settingapi' . $profile;
  }
}