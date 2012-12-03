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
  <tr class="entity" data-id="{$name}" data-type="{$setting->type}">
    <td title="{$field->title}"><p>{if $field->title}{$field->title}{else}{$field->name}{/if}</p>
    <p class="description">{if $field->description}{$field->description}{/if}</p></td>
    <td class="crmf-default">
      {if is_array($field->default) || is_object($field->default)}
        {$field->default|@print_r:true}
      {else}
        {$field->default}
      {/if}</td>
    {foreach from=$domains key=domainid item=domain}
      <td title="{$field->description}" class="crmf-value crm-entity-setting" data-id="{$domainid}" data-profile="{$profile}"><p>
        {if is_array($settings->$domainid->$fieldname) ||
            is_object($settings->$domainid->$fieldname) }
          {$settings->$domainid->$fieldname|@print_r:true}
        {elseif $field->type == 'String' ||  $field->type == 'String'}
        <span class="crmf-{$fieldname} crm-editable" data-action="create">{$settings->$domainid->$fieldname}</span>
         {else}
          {$settings->$domainid->$fieldname}
        {/if}</p>
        {if $settings->$domainid->$fieldname != $field->default}<span>
          <a class="button revert">{ts}Revert{/ts}</span></a>{/if}
    </td>
    {/foreach}
</tr>
{/foreach}
</table>

<script>
{literal}
cj (function($){
  $(".revert").click(function(){
    var $tr=$(this).closest(".entity");
    var name=$tr.data("id");
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
