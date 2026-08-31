{assign var="html_id"    value=$block.settings.custom_id|default:''}
{assign var="html_class" value=$block.settings.custom_class|default:''}
<div
  {if $html_id}id="{$html_id|escape:'html'}"{/if}
  class="fa-htmlcode {$block.classes}{if $block.settings.default.container} container{/if}{if $block.settings.default.force_full_width} _force-full{/if}{if $html_class} {$html_class|escape:'html'}{/if}"
  style="width:{$block.settings.width|default:'100%'|escape:'html'};height:{$block.settings.height|default:'auto'|escape:'html'};"
  {$block.styles}
>
  {$block.settings.html_content|default:''|nofilter}
</div>
