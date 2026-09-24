{*
 * FreshApp PrettyBlocks
 * @author FreshApp.io
 * @copyright 2026 FreshApp.io
 * @license Proprietary - see LICENSE file
 *}
{assign var="vid_id"       value=$block.settings.custom_id|default:''}
{assign var="vid_class"    value=$block.settings.custom_class|default:''}
{assign var="vid_source"   value=$block.settings.source|default:'youtube'}
{assign var="vid_url"      value=$block.settings.url|default:''}
{assign var="vid_height"   value=$block.settings.height|default:'480px'}
{assign var="vid_autoplay" value=$block.settings.autoplay|default:false}
{assign var="vid_muted"    value=$block.settings.muted|default:false}
{assign var="vid_loop"     value=$block.settings.loop|default:false}

{* URL d'intégration : calculée par FreshVideo::beforeRendering (hook beforeRenderingFreshappVideo) *}
{assign var="vid_embed" value=$block.extra.embed_url|default:''}

<div
  {if $vid_id}id="{$vid_id|escape:'html':'UTF-8'}"{/if}
  class="fa-video-wrap {$block.classes|escape:'html':'UTF-8'}{if $block.settings.default.container} container{/if}{if $block.settings.default.force_full_width} _force-full{/if}{if $vid_class} {$vid_class|escape:'html':'UTF-8'}{/if}"
  {$block.styles|escape:'html':'UTF-8'}
>
  {if $vid_source == 'self'}
    {assign var="self_url" value=$block.settings.self_hosted_file.url|default:''}
    {if $self_url}
    <video
      width="100%"
      height="{$vid_height|escape:'html':'UTF-8'}"
      style="display:block;"
      {if $vid_autoplay}autoplay{/if}
      {if $vid_muted}muted{/if}
      {if $vid_loop}loop{/if}
      controls
    >
      <source src="{$self_url|escape:'html':'UTF-8'}">
    </video>
    {/if}
  {else}
    <div class="fa-video-responsive" style="position:relative; width:100%; height:{$vid_height|escape:'html':'UTF-8'};">
      <iframe
        src="{$vid_embed|escape:'html':'UTF-8'}"
        style="position:absolute; top:0; left:0; width:100%; height:100%; border:0;"
        allowfullscreen
        allow="autoplay; encrypted-media"
        loading="lazy"
      ></iframe>
    </div>
  {/if}
</div>
