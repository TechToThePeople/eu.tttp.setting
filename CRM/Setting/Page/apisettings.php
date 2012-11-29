<?php

require_once 'CRM/Core/Page.php';
require_once('api/class.api.php');

class CRM_Setting_Page_apisettings extends CRM_Core_Page {
  function run() {
    $api= new civicrm_api3();
    //we allow filters and domain ids to be passed in
    $domain_ids = explode(',',CRM_Utils_Request::retrieve('domain','String'));
    $filters = explode(',',CRM_Utils_Request::retrieve('filters', 'String'));
    $extraParams = array();
    foreach ($filters as $filter){
      if(!empty($filter)){
        $vals = explode(":", $filter);
        $extraParams['filters'][$vals[0]] = $vals[1];
      }
    }
    //using the php form rather than class so I can do the array intersect - X probably has
    // a better way
    $domains = civicrm_api('domain', 'get', array('version' => 3));
    if(is_array($domain_ids)){
      $domains = array_intersect_key($domains['values'], array_flip($domain_ids));
      $extraParams['domain_id'] = $domain_ids;
    }

    $api->Setting->getfields (array('sequential'=> 0) + $extraParams );
    $fields =  $api->values;

    $api->Setting->get (array('sequential'=> 0) + $extraParams );
    $settings = $api->values;
    $this->assign_by_ref('fields', $fields);
    $this->assign_by_ref('settings', $settings);
    $this->assign_by_ref('domains',$domains);
    parent::run();
  }
}

