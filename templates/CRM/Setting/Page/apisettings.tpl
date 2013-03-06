{include file="CRM/common/crmeditable.tpl"}

<div id="help">
<p>You are looking at Profile {$profile} for domain {$domain}</p>
<p>Choose a profile .... (these are mostly for demo purposes). You can store your own profile in templates_c/../profiles to use your own settings
{foreach from=$availableProfiles item=avprofile}
<a href="{crmURL p='civicrm/admin/setting' h=0 q="profile=$avprofile&domain=$domainstring&filters=profile:$avprofile" }">{$avprofile}</a>
{/foreach}
</p>
</div>
<table class="report">
<th>Setting</th>
<th>Default</th>
{foreach from=$domains key=domainid item=domain}
  <th><p>{$domain.name}</p>
    <p class="description">email: {$domain.domain_email}
    <p class="description">phone: {$domain.domain_phone.phone}<p>
    <p class="description">address: {$domain.domain_address.street_address}<br>
    {$domain->domain_address.city}<br>
    {$domain->domain_address.postal_code}</p>
    <p class="description">from email: {$domain.from_name} {$domain.from_email}<p>
  </th>
{/foreach}


{foreach from=$fields key=name item=field}
  {if $field->name}
    {assign var="fieldname" value=$field->name}
  {else}
    {assign var="fieldname" value='undefined'}
  {/if}
  <tr class="setting" data-name="{$name}" data-type="{$setting->type}">
    <td title="{$field->title}"><p>{if $field->title}{$field->title}{else}{$field->name}{/if}</p>
    <p class="description">{if $field->description}{$field->description}{/if}</p></td>
    <td class="crmf-default crmf-value crm-entity-setting crmf-{$fieldname}" data-id="all" data-profile="{$profile}">
      {if is_array($field->default) || is_object($field->default)}
        {if $field->html_type eq 'checkboxes' && $field->options}
          {foreach from=$field->default key=optionid item = option}
            {$field->options.$option}</br>
          {/foreach}
        {else}
          {$field->default|@print_r:true}
        {/if}
      {else}
        {$field->default}
      {/if}
      <br>
      {if $domains|@count gt 1}<a class="button revert"><span>{ts}Revert All Domains{/ts}</span></a>
      {/if}</td>
    {foreach from=$domains key=domainid item=domain}
      <span class="crm-entity" id="setting-{$domainid}"></span>
      <td title="{$field->description}" class="crmf-value crm-entity-setting crm-entity" id="setting-{$domainid}" data-id="{$domainid}">
        <p>
        {if is_array($settings->$domainid->$fieldname) ||
            is_object($settings->$domainid->$fieldname) }
          {if $field->html_type eq 'checkboxes' && $field->options}{strip}
          <span class="crmf-{$fieldname}" data-type='checkboxes' data-options='{$field->options|@json_encode}' data-values={$settings->$domainid->$fieldname} data-action="create">
              {foreach from=$settings->$domainid->$fieldname key=optionid item = option}
                <span class='crmf-option' data-option={$option}>{$field->options.$option}</span></br>
              {/foreach}
             </span>{/strip}
          {else}
           {$settings->$domainid->$fieldname|@print_r:true}
          {/if}
        {elseif $field->type == 'String' ||  $field->type == 'Integer'}
          <span class="crmf-{$fieldname} crm-editable" {if $field->html_type eq 'TextArea'}data-type='textarea' {/if}data-action="create">{$settings->$domainid->$fieldname}</span>
        {elseif $field->type == 'Boolean'}
          {assign var='custOptions' value="`$smarty.ldelim`\"0\":\"No\",\"1\":\"Yes\"`$smarty.rdelim`"}
          <span class="crmf-{$fieldname} crm-editable" data-options='{$custOptions}' data-type='select' data-action="create">{if $settings->$domainid->$fieldname eq 1}Yes{else}No{/if}</span>
        {else}
          {$settings->$domainid->$fieldname}
        {/if}</p>
        {if $settings->$domainid->$fieldname != $field->default}
        <span>
          <a class="button revert">{ts}Revert{/ts}</a></span>{/if}
    </td>
    {/foreach}
</tr>
{/foreach}
</table>

<script>
{literal}
cj (function($){
  $(".revert").click(function(){
    var $tr=$(this).closest(".setting");
    var name=$tr.data("name");
    var $td=$(this).closest(".crmf-value");
    var domain=$td.data("id");
    var profile=$td.data("profile");
    $().crmAPI("setting","revert",{"name":name , "domain_id":domain, "profile":profile},{
      success:function(data) {
        $td.html("reset to default");
        $td.find('.revert').remove();
      }
    });
console.log(name);
    return false;
  });
});
{/literal}
</script>
