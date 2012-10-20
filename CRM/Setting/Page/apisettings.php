<?php

require_once 'CRM/Core/Page.php';
require_once('api/class.api.php');

class CRM_Setting_Page_apisettings extends CRM_Core_Page {
  function run() {
    $api= new civicrm_api3();
    $api->Setting->getfields (array('sequential'=>0));
    $f= $api->values;
    $api->Setting->get (array('sequential'=>1));
    foreach ($api->values[0] as $name => &$value) {
      $f->$name->value = $value;
    }
    $properties = array ("type","title","value","default","description");
    //properties need to be defined for each item, otherwise smarty ain't so happy
    foreach ($f as $k => &$v) {
      foreach ($properties as $property) {
        if (!property_exists ($v,$property)) 
          $v->$property = "";
      }
    }
    $this->assign_by_ref('settings',$f); 
    parent::run();
;
  }
}
