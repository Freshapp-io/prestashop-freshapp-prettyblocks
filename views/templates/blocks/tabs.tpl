{*
 * FreshApp Preta PrettyBlocks
 * @author FreshApp.io
 * @copyright 2026 FreshApp.io
 * @license Proprietary - see LICENSE file
 *}
{assign var="tabs_id"     value=$block.settings.custom_id|default:''}
{assign var="tabs_class"  value=$block.settings.custom_class|default:''}
{assign var="tabs_orient" value=$block.settings.orientation|default:'horizontal'}
{assign var="tabs_align"  value=$block.settings.align|default:'left'}
{assign var="tabs_uid"    value=$block.id_prettyblocks|default:'tabs'}

<div
  {if $tabs_id}id="{$tabs_id|escape:'html':'UTF-8'}"{/if}
  class="fa-tabs fa-tabs-{$tabs_orient|escape:'html':'UTF-8'} {$block.classes}{if $block.settings.default.container} container{/if}{if $block.settings.default.force_full_width} _force-full{/if}{if $tabs_class} {$tabs_class|escape:'html':'UTF-8'}{/if}"
  {$block.styles}
>
  {if $block.states}
    <ul class="fa-tabs-nav fa-tabs-align-{$tabs_align|escape:'html':'UTF-8'}" role="tablist">
      {foreach from=$block.states item=tab name=tabloop}
        <li class="fa-tab-item{if $smarty.foreach.tabloop.first} active{/if}" role="presentation">
          <button
            class="fa-tab-btn"
            data-target="#{$tabs_uid|escape:'html':'UTF-8'}-panel-{$smarty.foreach.tabloop.index}"
            role="tab"
            aria-selected="{if $smarty.foreach.tabloop.first}true{else}false{/if}"
            aria-controls="{$tabs_uid|escape:'html':'UTF-8'}-panel-{$smarty.foreach.tabloop.index}"
          >
            {$tab.tab_title|default:'Onglet'|escape:'html':'UTF-8'}
          </button>
        </li>
      {/foreach}
    </ul>
    <div class="fa-tabs-content">
      {foreach from=$block.states item=tab name=tabloop}
        <div
          class="fa-tab-panel{if $smarty.foreach.tabloop.first} active{/if}"
          id="{$tabs_uid|escape:'html':'UTF-8'}-panel-{$smarty.foreach.tabloop.index}"
          role="tabpanel"
          {if !$smarty.foreach.tabloop.first}hidden{/if}
        >
          {$tab.tab_content|default:'' nofilter}
        </div>
      {/foreach}
    </div>
  {/if}
</div>
