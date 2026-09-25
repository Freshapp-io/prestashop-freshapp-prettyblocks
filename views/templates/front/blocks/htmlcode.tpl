{*
 * FreshApp PrettyBlocks
 * @author FreshApp.io
 * @copyright 2026 FreshApp.io
 * @license GPL-3.0-or-later
 *}
{assign var="html_id"    value=$block.settings.custom_id|default:''}
{assign var="html_class" value=$block.settings.custom_class|default:''}
<div
  {if $html_id}id="{$html_id|escape:'html':'UTF-8'}"{/if}
  class="fa-htmlcode {$block.classes|escape:'html':'UTF-8'}{if $block.settings.default.container} container{/if}{if $block.settings.default.force_full_width} _force-full{/if}{if $html_class} {$html_class|escape:'html':'UTF-8'}{/if}"
  style="width:{$block.settings.width|default:'100%'|escape:'html':'UTF-8'};height:{$block.settings.height|default:'auto'|escape:'html':'UTF-8'};"
  {$block.styles|escape:'html':'UTF-8'}
>
  {fa_pb_html html=$block.settings.html_content|default:''}
</div>
