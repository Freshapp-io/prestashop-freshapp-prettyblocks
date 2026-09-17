{*
 * FreshApp PrettyBlocks
 * @author FreshApp.io
 * @copyright 2026 FreshApp.io
 * @license Proprietary - see LICENSE file
 *}
{if $block.states}
<section class="fa-home-reassurance {$block.classes}{if $block.settings.default.force_full_width} _force-full{/if}" {$block.styles} aria-labelledby="fa-reassurance-{$block.id_prettyblocks|intval}">
  <div class="{if $block.settings.default.container}container{/if}">
    <h2 id="fa-reassurance-{$block.id_prettyblocks|intval}" class="visually-hidden">{$block.settings.title|default:''|escape:'html':'UTF-8'}</h2>
    <ul class="fa-home-reassurance__list">
      {foreach from=$block.states item=fa_item}
        {if $fa_item.label}
          <li class="fa-home-reassurance__item">
            <span class="fa-home-reassurance__icon" aria-hidden="true">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" focusable="false">
                {if $fa_item.icon == 'refresh'}<path d="M21 12a9 9 0 0 0-15.5-6.2L3 8"/><path d="M3 3v5h5"/><path d="M3 12a9 9 0 0 0 15.5 6.2L21 16"/><path d="M21 21v-5h-5"/>
                {elseif $fa_item.icon == 'book'}<path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20"/>
                {elseif $fa_item.icon == 'download'}<path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><path d="m7 10 5 5 5-5"/><path d="M12 15V3"/>
                {elseif $fa_item.icon == 'shield'}<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                {elseif $fa_item.icon == 'gift'}<rect x="3" y="8" width="18" height="4" rx="1"/><path d="M12 8v13"/><path d="M19 12v7a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-7"/>
                {else}<path d="M20 6 9 17l-5-5"/>{/if}
              </svg>
            </span>
            <span class="fa-home-reassurance__label">{$fa_item.label|escape:'html':'UTF-8'}</span>
            {if $fa_item.text}<span class="fa-home-reassurance__text">{$fa_item.text|escape:'html':'UTF-8'}</span>{/if}
          </li>
        {/if}
      {/foreach}
    </ul>
  </div>
</section>
{/if}
