{*
 * FreshApp PrettyBlocks
 * @author FreshApp.io
 * @copyright 2026 FreshApp.io
 * @license Proprietary - see LICENSE file
 *}
{assign var="spacer_id"    value=$block.settings.custom_id|default:''}
{assign var="spacer_class" value=$block.settings.custom_class|default:''}
<div
  {if $spacer_id}id="{$spacer_id|escape:'html':'UTF-8'}"{/if}
  class="fa-spacer {$block.classes|escape:'html':'UTF-8'}{if $block.settings.default.container} container{/if}{if $block.settings.default.force_full_width} _force-full{/if}{if $spacer_class} {$spacer_class|escape:'html':'UTF-8'}{/if}"
  style="height:{$block.settings.height|default:'40px'|escape:'html':'UTF-8'};background-color:{$block.settings.background_color|default:'transparent'|escape:'html':'UTF-8'};"
  {$block.styles|escape:'html':'UTF-8'}
  aria-hidden="true"
></div>
