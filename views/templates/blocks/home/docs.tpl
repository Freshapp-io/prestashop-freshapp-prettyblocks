{*
 * FreshApp PrettyBlocks
 * @author FreshApp.io
 * @copyright 2026 FreshApp.io
 * @license Proprietary - see LICENSE file
 *}
{if $block.extra.pages}
<section class="fa-home-section fa-home-docs {$block.classes}{if $block.settings.default.force_full_width} _force-full{/if}" {$block.styles}>
  <div class="{if $block.settings.default.container}container{/if}">
    <h2 class="fa-home-section__title">{$block.settings.title|escape:'html':'UTF-8'}</h2>
    {if $block.settings.intro}<p class="fa-home-section__intro">{$block.settings.intro|escape:'html':'UTF-8'}</p>{/if}
    <ul class="fa-home-docs__list">
      {foreach from=$block.extra.pages item=fa_page}
        <li><a class="fa-home-docs__link" href="{$fa_page.url|escape:'html':'UTF-8'}">{$fa_page.title|escape:'html':'UTF-8'}</a></li>
      {/foreach}
    </ul>
    {if $block.settings.link_label && $block.extra.category_url}
      <p class="fa-home-section__more"><a href="{$block.extra.category_url|escape:'html':'UTF-8'}">{$block.settings.link_label|escape:'html':'UTF-8'}</a></p>
    {/if}
  </div>
</section>
{/if}
