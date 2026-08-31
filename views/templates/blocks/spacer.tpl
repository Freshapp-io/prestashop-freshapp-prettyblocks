{assign var="spacer_id"    value=$block.settings.custom_id|default:''}
{assign var="spacer_class" value=$block.settings.custom_class|default:''}
<div
  {if $spacer_id}id="{$spacer_id|escape:'html'}"{/if}
  class="fa-spacer {$block.classes}{if $block.settings.default.container} container{/if}{if $block.settings.default.force_full_width} _force-full{/if}{if $spacer_class} {$spacer_class|escape:'html'}{/if}"
  style="height:{$block.settings.height|default:'40px'|escape:'html'};background-color:{$block.settings.background_color|default:'transparent'|escape:'html'};"
  {$block.styles}
  aria-hidden="true"
></div>
