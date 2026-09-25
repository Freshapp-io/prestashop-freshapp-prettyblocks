{*
 * FreshApp PrettyBlocks
 * @author FreshApp.io
 * @copyright 2026 FreshApp.io
 * @license GPL-3.0-or-later
 *}
{if $block.extra.categories}
<section class="fa-home-section fa-home-categories {$block.classes|escape:'html':'UTF-8'}{if $block.settings.default.force_full_width} _force-full{/if}" {$block.styles|escape:'html':'UTF-8'}>
  <div class="{if $block.settings.default.container}container{/if}">
    <h2 class="fa-home-section__title">{$block.settings.title|escape:'html':'UTF-8'}</h2>
    {if $block.settings.intro}<p class="fa-home-section__intro">{$block.settings.intro|escape:'html':'UTF-8'}</p>{/if}
    <ul class="fa-home-categories__grid">
      {foreach from=$block.extra.categories item=fa_cat}
        <li class="fa-home-categories__item">
          <a class="fa-home-card fa-home-categories__card" href="{$fa_cat.url|escape:'html':'UTF-8'}">
            <h3 class="fa-home-card__title">{$fa_cat.name|escape:'html':'UTF-8'}</h3>
            {if $fa_cat.excerpt}<p class="fa-home-card__text">{$fa_cat.excerpt|escape:'html':'UTF-8'}</p>{/if}
            {if $fa_cat.count}
              <span class="fa-home-card__meta">
                {if $fa_cat.count > 1}{$block.settings.count_plural|default:'%d'|replace:'%d':$fa_cat.count|escape:'html':'UTF-8'}{else}{$block.settings.count_singular|escape:'html':'UTF-8'}{/if}
              </span>
            {/if}
          </a>
        </li>
      {/foreach}
    </ul>
  </div>
</section>
{/if}
