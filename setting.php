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


function setting_civicrm_navigationMenu(&$params){
  // can't rely on array if multidomain so query table
  $maxKey = ( CRM_Core_DAO::singleValueQuery("SELECT max(id) FROM civicrm_navigation"));
  //find administer id
  foreach ($params as $key => $attributes){
    if($attributes['attributes']['label'] == 'Administer'){
      $adminID = $key;
      continue;
    }
  }
  $params[$adminID]['child'][$maxKey+1]['attributes'] = array (
    'label'      => 'Configure Settings',
    'name'       => 'Configure Settings',
    'url'        => 'civicrm/admin/setting',
    'permission' => 'administer CiviCRM',
    'operator'   => null,
    'separator'  => null,
    'parentID'   => $adminID,
    'navID'      => $maxKey+1,
    'active'     => 1
  );
  $domainCount = civicrm_api('domain', 'getcount', array('version' => 3));
  $multiDomain = $domainCount > 1 ? 1 : 0;
  $params[$adminID]['child'][$maxKey+2]['attributes'] = array (
    'label'      => 'Configure MultiDomain Settings',
    'name'       => 'Configure MultiDomain Settings',
    'url'        => 'civicrm/admin/setting?domain=all',
    'permission' => 'administer CiviCRM',
    'operator'   => null,
    'separator'  => null,
    'parentID'   => $adminID,
    'navID'      => $maxKey+2,
    'active'     => $multiDomain,
  );

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

function setting_civicrm_alterSettingsMetaData(&$settingsMetadata, $domainID, $profile){
  $settingsProfiles = _setting_civicrm_getavailableprofiles();
  foreach ($settingsProfiles as $settingsProfile){
    $function = 'civicrm_settingapi_' . $settingsProfile;
    $configured = $function($settingsMetadata, $domainID, $profile);
  }

  if(!empty($configured)){
    return $configured;
  }
}
/**
 * Get profiles provided
 *
 * @return array profiles
 */
function _setting_civicrm_getavailableprofiles(){
  $filePaths = array(CIVICRM_TEMPLATE_COMPILEDIR . '../profiles', __DIR__ . '/profiles');
  static $profiles = array();
  if(!empty($profiles)){
    return $profiles;
  }
  foreach ($filePaths as $folder){
    if(is_dir($folder)){
      $files = CRM_Utils_File::findFiles($folder, '*.profile.php');
      foreach ($files as $file){
        $profiles[] = require_once $file;
      }
    }
  }
  return $profiles;
}