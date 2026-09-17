{*
 * FreshApp PrettyBlocks
 * @author FreshApp.io
 * @copyright 2026 FreshApp.io
 * @license Proprietary - see LICENSE file
 *}
{if $block.settings.content || $block.settings.title}
<section class="fa-home-section fa-home-text {$block.classes}{if $block.settings.default.force_full_width} _force-full{/if}" {$block.styles}>
  <div class="{if $block.settings.default.container}container{/if}">
    {if $block.settings.title}<h2 class="fa-home-section__title">{$block.settings.title|escape:'html':'UTF-8'}</h2>{/if}
    <div class="fa-home-text__body rich-text">{$block.settings.content nofilter}</div>
  </div>
</section>
{/if}
