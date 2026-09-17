{*
 * FreshApp PrettyBlocks
 * @author FreshApp.io
 * @copyright 2026 FreshApp.io
 * @license Proprietary - see LICENSE file
 *}
{assign var="sep_id"    value=$block.settings.custom_id|default:''}
{assign var="sep_class" value=$block.settings.custom_class|default:''}
{assign var="sep_align" value=$block.settings.align|default:'center'}
<div
  {if $sep_id}id="{$sep_id|escape:'html':'UTF-8'}"{/if}
  class="fa-separator-wrap {$block.classes}{if $block.settings.default.container} container{/if}{if $block.settings.default.force_full_width} _force-full{/if}{if $sep_class} {$sep_class|escape:'html':'UTF-8'}{/if}"
  style="text-align:{$sep_align|escape:'html':'UTF-8'};"
  {$block.styles}
>
  <hr class="fa-separator" style="
    display: inline-block;
    width: {$block.settings.width|default:'100%'|escape:'html':'UTF-8'};
    border: none;
    border-top: {$block.settings.height|default:'1px'|escape:'html':'UTF-8'} {$block.settings.style|default:'solid'|escape:'html':'UTF-8'} {$block.settings.color|default:'#cccccc'|escape:'html':'UTF-8'};
    margin: 0;
  " />
</div>
