<?php

return 'nz';

function civicrm_settingapi_nz(&$settingsMetadata, $domainID, $profile){
  if($profile == 'nz'){
      $settingsMetadata['defaultCurrency']['default'] = 'NZD';
      //the profile is just being set here for filtering
      $settingsMetadata['defaultCurrency']['profile'] = 'nz';
      $settingsMetadata['countryLimit']['default'] = array(1154);
      $settingsMetadata['countryLimit']['profile'] = 'nz';
      $settingsMetadata['provinceLimit']['default'] = Array (1154 );
      $settingsMetadata['provinceLimit']['profile'] = 'nz';
    return 'settingapi' . $profile;
  }
}