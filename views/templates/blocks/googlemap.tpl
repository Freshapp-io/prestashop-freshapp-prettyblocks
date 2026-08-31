{assign var="gm_id"      value=$block.settings.custom_id|default:''}
{assign var="gm_class"   value=$block.settings.custom_class|default:''}
{assign var="gm_address" value=$block.settings.address|default:'Paris, France'}
{assign var="gm_zoom"    value=$block.settings.zoom|default:'14'}
{assign var="gm_height"  value=$block.settings.height|default:'400px'}
<div
  {if $gm_id}id="{$gm_id|escape:'html'}"{/if}
  class="fa-googlemap-wrap {$block.classes}{if $block.settings.default.container} container{/if}{if $block.settings.default.force_full_width} _force-full{/if}{if $gm_class} {$gm_class|escape:'html'}{/if}"
  {$block.styles}
>
  <iframe
    class="fa-googlemap"
    width="100%"
    height="{$gm_height|escape:'html'}"
    style="border:0; display:block;"
    loading="lazy"
    referrerpolicy="no-referrer-when-downgrade"
    src="https://maps.google.com/maps?q={$gm_address|urlencode}&z={$gm_zoom|intval}&output=embed&hl={$language.iso_code|default:'fr'}"
    allowfullscreen
  ></iframe>
</div>
