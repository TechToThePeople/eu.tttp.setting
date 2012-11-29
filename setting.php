<?php

require_once 'setting.civix.php';

/**
 * Implementation of hook_civicrm_config
 */
function setting_civicrm_config(&$config) {
  _setting_civix_civicrm_config($config);
}

/**
 * Implementation of hook_civicrm_xmlMenu
 *
 * @param $files array(string)
 */
function setting_civicrm_xmlMenu(&$files) {
  _setting_civix_civicrm_xmlMenu($files);
}

/**
 * Implementation of hook_civicrm_install
 */
function setting_civicrm_install() {
  return _setting_civix_civicrm_install();
}

/**
 * Implementation of hook_civicrm_uninstall
 */
function setting_civicrm_uninstall() {
  return _setting_civix_civicrm_uninstall();
}

/**
 * Implementation of hook_civicrm_enable
 */
function setting_civicrm_enable() {
  return _setting_civix_civicrm_enable();
}

/**
 * Implementation of hook_civicrm_disable
 */
function setting_civicrm_disable() {
  return _setting_civix_civicrm_disable();
}

/**
 * Implementation of hook_civicrm_upgrade
 *
 * @param $op string, the type of operation being performed; 'check' or 'enqueue'
 * @param $queue CRM_Queue_Queue, (for 'enqueue') the modifiable list of pending up upgrade tasks
 *
 * @return mixed  based on op. for 'check', returns array(boolean) (TRUE if upgrades are pending)
 *                for 'enqueue', returns void
 */
function setting_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _setting_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implementation of hook_civicrm_managed
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 */
function setting_civicrm_managed(&$entities) {
  return _setting_civix_civicrm_managed($entities);
}

function setting_civicrm_alterSettingsMetaData(&$settingsMetadata, $domainID){
  $profile = CRM_Utils_Request::retrieve('filters', 'String',
      $this, FALSE, Null, 'GET');

  // probably not the best pattern but for demo purposes...
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