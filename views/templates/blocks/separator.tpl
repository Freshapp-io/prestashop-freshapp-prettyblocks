{assign var="sep_id"    value=$block.settings.custom_id|default:''}
{assign var="sep_class" value=$block.settings.custom_class|default:''}
{assign var="sep_align" value=$block.settings.align|default:'center'}
<div
  {if $sep_id}id="{$sep_id|escape:'html'}"{/if}
  class="fa-separator-wrap {$block.classes}{if $block.settings.default.container} container{/if}{if $block.settings.default.force_full_width} _force-full{/if}{if $sep_class} {$sep_class|escape:'html'}{/if}"
  style="text-align:{$sep_align|escape:'html'};"
  {$block.styles}
>
  <hr class="fa-separator" style="
    display: inline-block;
    width: {$block.settings.width|default:'100%'|escape:'html'};
    border: none;
    border-top: {$block.settings.height|default:'1px'|escape:'html'} {$block.settings.style|default:'solid'|escape:'html'} {$block.settings.color|default:'#cccccc'|escape:'html'};
    margin: 0;
  " />
</div>
