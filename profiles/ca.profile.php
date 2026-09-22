<?php

return 'ca';

function civicrm_settingapi_ca(&$settingsMetadata, $domainID, $profile){
  if($profile == 'ca'){
      $settingsMetadata['defaultCurrency']['default'] = 'CAD';
      $settingsMetadata['defaultCurrency']['profile'] = 'ca';
      $settingsMetadata['countryLimit']['default'] = [1039];
      $settingsMetadata['countryLimit']['profile'] = 'ca';
      $settingsMetadata['provinceLimit']['default'] = [1039 ];
      $settingsMetadata['provinceLimit']['profile'] = 'ca';
      return 'settingapi' . $profile;
  }
}
