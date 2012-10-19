<script>
{literal}
cj (function($){
  $(".revert").click(function(){
    var $tr=$(this).closest(".entity");
    var name=$tr.data("id");
    $().crmAPI("setting","revert",{"name":name},{
      success:function(data) {
        $tr.find('.crmf-value').html("reset to default"); 
        $tr.find('.revert').remove(); 
      }
    });
console.log(name);
    return false;
  });
});
{/literal}
</script>

{crmAPI var="Settings" entity="Setting" action="get" sequential="0" }
<div id="help">
Definitely not the right API call to get the list
.Eileen, help!
</div>
<table class="report">
<th>Setting</th>
<th>Your Site</th>
<th>Default</th>
<tr data-entity="setting" data-id="name" class="entity">
    <td>SettingName</td>
 
    <td class="crmf-value">My setting</td>
    <td class="crmf-default">default</td>
    <td>
<a class="button revert">{ts}Revert{/ts}</span></a>
</td>
</tr>
{foreach from=$settings key='settingName' item='settingValue'}
<tr data-entity="setting" data-id="{$settingName}" class="entity">
<tr id="setting-{$settingName}" class="entity">
    <td>AA{ts}{$settingName}{/ts}</td>
 
    <td>BB{$fields.$settingName.html_type}</td>
    <td>CC{if is_array($settingValue)}{$settingValue|print_r}
    {else}{$settingValue}
    {/if}</a></td>
    <td>EE{$defaults.$settingName}</td>
    <td>
<span class="revert_button">{ts}Revert{/ts}</span>
{if (isset($defaults.$settingName)) && $defaults.$settingName != $settingValue}<a href='/civicrm/ajax/rest?json=1&sequential=1&entity=Setting&action=revert&name={$settingName}'>Revert</a>{/if}</td>
</tr>
{/foreach}
</table>
