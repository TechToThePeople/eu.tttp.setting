<div id="help">
Should we display all the settings, including the ones that don't have a default?
<br>Should we make editable the ones that are of type string?
</div>
<table class="report">
<th>Setting</th>
<th>Your Site</th>
<th>Default</th>
{foreach from=$settings key=name item=setting}
<tr class="entity" data-id="{$name}" data-type="{$setting->type}">
    <td title="{$setting->title}">{$name}</td>
    <td title="{$setting->description}" class="crmf-value">
      {if is_object($setting->value)}
        {$setting->value|@print_r}
      {else}
        {if is_array($setting->value)}{$setting->value|@print_r}
          {else}{$setting->value}
        {/if}
      {/if}
</td>
    <td class="crmf-default">{$setting->default}</td>
    <td><a class="button revert">{ts}Revert{/ts}</span></a></td>
</tr>
{/foreach}
</table>

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
