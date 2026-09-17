{*
 * FreshApp PrettyBlocks
 * @author FreshApp.io
 * @copyright 2026 FreshApp.io
 * @license Proprietary - see LICENSE file
 *}
{assign var="btn_id"    value=$block.settings.custom_id|default:''}
{assign var="btn_class" value=$block.settings.custom_class|default:''}
{assign var="btn_size"  value=$block.settings.size|default:'md'}
{assign var="btn_align" value=$block.settings.align|default:'left'}
{assign var="btn_text_stretch_align" value=$block.settings.text_align_stretch|default:'center'}
{assign var="btn_label" value=$block.settings.label|default:'Cliquez ici'}
{assign var="btn_url"   value=$block.settings.url|default:'#'}
{assign var="btn_uid"   value=$block.id_prettyblocks|default:'btn'}
<style>
  .freshapp-button-block-{$btn_uid} {
    {if $btn_align == 'stretch'}
    display: block;
    {else}
    display: flex;
    {if $btn_align == 'center'}
    justify-content: center;
    {elseif $btn_align == 'right'}
    justify-content: flex-end;
    {else}
    justify-content: flex-start;
    {/if}
    {/if}
  }
  .freshapp-btn-{$btn_uid} {
    background-color: {$block.settings.bg_color|default:'#61C424'|escape:'html':'UTF-8'};
    color: {$block.settings.text_color|default:'#ffffff'|escape:'html':'UTF-8'};
    border: {$block.settings.border_width|default:'0px'|escape:'html':'UTF-8'} solid {$block.settings.border_color|default:'#61C424'|escape:'html':'UTF-8'};
    border-radius: {$block.settings.border_radius|default:'4px'|escape:'html':'UTF-8'};
    text-decoration: none;
    transition: background-color .2s, color .2s, border-color .2s;
    cursor: pointer;
    {if $btn_align == 'stretch'}
    display: block;
    width: 100%;
    text-align: {$btn_text_stretch_align|escape:'html':'UTF-8'};
    {/if}
  }
  .freshapp-btn-{$btn_uid}:hover,
  .freshapp-btn-{$btn_uid}:focus {
    background-color: {$block.settings.bg_color_hover|default:'#4da01d'|escape:'html':'UTF-8'};
    color: {$block.settings.text_color_hover|default:'#ffffff'|escape:'html':'UTF-8'};
    border-color: {$block.settings.border_color_hover|default:'#4da01d'|escape:'html':'UTF-8'};
    text-decoration: none;
  }
  .freshapp-btn-size-sm { font-size: 0.8rem; padding: 6px 14px; }
  .freshapp-btn-size-md { font-size: 1rem;   padding: 10px 20px; }
  .freshapp-btn-size-lg { font-size: 1.2rem; padding: 12px 24px; }
  .freshapp-btn-size-xl { font-size: 1.5rem; padding: 14px 28px; }
</style>
<div
  class="freshapp-button-block freshapp-button-block-{$btn_uid} {$block.classes}{if $block.settings.default.container} container{/if}{if $block.settings.default.force_full_width} _force-full{/if}"
  {$block.styles}
>
  <a
    {if $btn_id}id="{$btn_id|escape:'html':'UTF-8'}"{/if}
    class="freshapp-btn freshapp-btn-{$btn_uid} freshapp-btn-size-{$btn_size|escape:'html':'UTF-8'}{if $btn_class} {$btn_class|escape:'html':'UTF-8'}{/if}"
    href="{$btn_url|escape:'html':'UTF-8'}"
    target="{$block.settings.target|default:'_self'|escape:'html':'UTF-8'}"
    {if $block.settings.nofollow}rel="nofollow"{/if}
  >
    {$btn_label|escape:'html':'UTF-8'}
  </a>
</div>
