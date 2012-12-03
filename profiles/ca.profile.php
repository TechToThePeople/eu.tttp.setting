<?php

return 'ca';

function civicrm_settingapi_ca(&$settingsMetadata, $domainID, $profile){
  if($profile == 'ca'){
      $settingsMetadata['defaultCurrency']['default'] = 'CAD';
      $settingsMetadata['defaultCurrency']['profile'] = 'ca';
      $settingsMetadata['countryLimit']['default'] = array(1039);
      $settingsMetadata['countryLimit']['profile'] = 'ca';
      $settingsMetadata['provinceLimit']['default'] = Array (1039 );
      $settingsMetadata['provinceLimit']['profile'] = 'ca';
      return 'settingapi' . $profile;
  }
}