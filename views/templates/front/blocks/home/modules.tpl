{*
 * FreshApp PrettyBlocks
 * @author FreshApp.io
 * @copyright 2026 FreshApp.io
 * @license Proprietary - see LICENSE file
 *}
{if $block.extra.modules}
<section class="fa-home-section fa-home-modules {$block.classes|escape:'html':'UTF-8'}{if $block.settings.default.force_full_width} _force-full{/if}" {$block.styles|escape:'html':'UTF-8'}>
  <div class="{if $block.settings.default.container}container{/if}">
    <h2 class="fa-home-section__title">{$block.settings.title|escape:'html':'UTF-8'}</h2>
    {if $block.settings.intro}<p class="fa-home-section__intro">{$block.settings.intro|escape:'html':'UTF-8'}</p>{/if}
    <ul class="fa-home-modules__grid">
      {foreach from=$block.extra.modules item=fa_mod}
        <li class="fa-home-modules__item">
          <article class="fa-home-card fa-home-module">
            {if $fa_mod.image}
              <a class="fa-home-module__media" href="{$fa_mod.url|escape:'html':'UTF-8'}" tabindex="-1" aria-hidden="true">
                <img src="{$fa_mod.image|escape:'html':'UTF-8'}" alt="" width="250" height="250"{if !$block.settings.eager} loading="lazy"{/if} decoding="async">
              </a>
            {/if}
            <h3 class="fa-home-card__title">
              <a href="{$fa_mod.url|escape:'html':'UTF-8'}">{$fa_mod.name|escape:'html':'UTF-8'}</a>
            </h3>
            {if $fa_mod.excerpt}<p class="fa-home-card__text">{$fa_mod.excerpt|escape:'html':'UTF-8'}</p>{/if}
            <div class="fa-home-module__foot">
              {if $fa_mod.compat}<span class="fa-home-module__compat">{$fa_mod.compat|escape:'html':'UTF-8'}</span>{/if}
              {if $fa_mod.is_free}
                <span class="fa-home-module__price fa-home-module__price--free">{$block.settings.free_label|escape:'html':'UTF-8'}</span>
              {else}
                <span class="fa-home-module__prices">
                  <span class="fa-home-module__price">{$fa_mod.price|escape:'html':'UTF-8'} <span class="fa-home-module__tax">{$fa_mod.price_label|escape:'html':'UTF-8'}</span></span>
                  <span class="fa-home-module__price-secondary">{$fa_mod.price_secondary|escape:'html':'UTF-8'} {$fa_mod.price_secondary_label|escape:'html':'UTF-8'}</span>
                </span>
              {/if}
            </div>
          </article>
        </li>
      {/foreach}
    </ul>
    {if $block.settings.link_label && $block.extra.category_url}
      <p class="fa-home-section__more"><a href="{$block.extra.category_url|escape:'html':'UTF-8'}">{$block.settings.link_label|escape:'html':'UTF-8'}</a></p>
    {/if}
  </div>
</section>
{/if}
