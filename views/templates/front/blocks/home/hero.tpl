{*
 * FreshApp PrettyBlocks
 * @author FreshApp.io
 * @copyright 2026 FreshApp.io
 * @license Proprietary - see LICENSE file
 *}
{assign var="fa_tag" value=$block.settings.heading|default:'h1'}
{if $fa_tag != 'h2'}{assign var="fa_tag" value='h1'}{/if}
<section class="fa-home-hero {$block.classes|escape:'html':'UTF-8'}{if $block.settings.default.force_full_width} _force-full{/if}" {$block.styles|escape:'html':'UTF-8'}>
  <div class="fa-home-hero__inner{if $block.settings.default.container} container{/if}">
    {if $block.settings.kicker}
      <p class="fa-home-hero__kicker">{$block.settings.kicker|escape:'html':'UTF-8'}</p>
    {/if}
    <{$fa_tag|escape:'html':'UTF-8'} class="fa-home-hero__title">{$block.settings.title|escape:'html':'UTF-8'}</{$fa_tag|escape:'html':'UTF-8'}>
    {if $block.settings.subtitle}
      <p class="fa-home-hero__subtitle">{$block.settings.subtitle|escape:'html':'UTF-8'}</p>
    {/if}
    {if $block.extra.highlights}
      <ul class="fa-home-hero__highlights">
        {foreach from=$block.extra.highlights item=fa_point}
          <li>{$fa_point|escape:'html':'UTF-8'}</li>
        {/foreach}
      </ul>
    {/if}
    <div class="fa-home-hero__actions">
      {if $block.settings.cta_label && $block.settings.cta_url}
        <a class="fa-home-btn fa-home-btn--primary" href="{$block.settings.cta_url|escape:'html':'UTF-8'}">{$block.settings.cta_label|escape:'html':'UTF-8'}</a>
      {/if}
      {if $block.settings.cta2_label && $block.settings.cta2_url}
        <a class="fa-home-btn" href="{$block.settings.cta2_url|escape:'html':'UTF-8'}">{$block.settings.cta2_label|escape:'html':'UTF-8'}</a>
      {/if}
    </div>
  </div>
</section>
