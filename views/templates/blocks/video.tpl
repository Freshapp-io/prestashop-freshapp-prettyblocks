{assign var="vid_id"       value=$block.settings.custom_id|default:''}
{assign var="vid_class"    value=$block.settings.custom_class|default:''}
{assign var="vid_source"   value=$block.settings.source|default:'youtube'}
{assign var="vid_url"      value=$block.settings.url|default:''}
{assign var="vid_height"   value=$block.settings.height|default:'480px'}
{assign var="vid_autoplay" value=$block.settings.autoplay|default:false}
{assign var="vid_muted"    value=$block.settings.muted|default:false}
{assign var="vid_loop"     value=$block.settings.loop|default:false}

{* Build embed URL per source *}
{if $vid_source == 'youtube'}
  {assign var="yt_params" value=''}
  {if $vid_autoplay}  {assign var="yt_params" value="{$yt_params}&autoplay=1"} {/if}
  {if $vid_muted}     {assign var="yt_params" value="{$yt_params}&mute=1"} {/if}
  {if $vid_loop}      {assign var="yt_params" value="{$yt_params}&loop=1"} {/if}
  {assign var="vid_embed" value="https://www.youtube.com/embed/{$vid_url|regex_replace:'/.*(?:youtu\.be\/|v\/|u\/\w\/|embed\/|shorts\/|watch\?v=)([^#\&\?]*).*/':'$1'}{if $yt_params}?{$yt_params|ltrim:'&'}{/if}"}
{elseif $vid_source == 'vimeo'}
  {assign var="vm_params" value=''}
  {if $vid_autoplay}  {assign var="vm_params" value="{$vm_params}&autoplay=1"} {/if}
  {if $vid_muted}     {assign var="vm_params" value="{$vm_params}&muted=1"} {/if}
  {if $vid_loop}      {assign var="vm_params" value="{$vm_params}&loop=1"} {/if}
  {assign var="vid_embed" value="https://player.vimeo.com/video/{$vid_url|regex_replace:'/.*vimeo\.com\/(?:video\/)?(\d+).*/':'$1'}{if $vm_params}?{$vm_params|ltrim:'&'}{/if}"}
{elseif $vid_source == 'dailymotion'}
  {assign var="dm_params" value=''}
  {if $vid_autoplay}  {assign var="dm_params" value="{$dm_params}&autoplay=1"} {/if}
  {if $vid_muted}     {assign var="dm_params" value="{$dm_params}&mute=1"} {/if}
  {if $vid_loop}      {assign var="dm_params" value="{$dm_params}&loop=1"} {/if}
  {assign var="vid_embed" value="https://www.dailymotion.com/embed/video/{$vid_url|regex_replace:'/.*dailymotion\.com\/(?:video\/)?([a-zA-Z0-9]+).*/':'$1'}{if $dm_params}?{$dm_params|ltrim:'&'}{/if}"}
{elseif $vid_source == 'peertube'}
  {assign var="vid_embed" value="{$vid_url|replace:'/watch/':'/embed/'}"}
{/if}

<div
  {if $vid_id}id="{$vid_id|escape:'html'}"{/if}
  class="fa-video-wrap {$block.classes}{if $block.settings.default.container} container{/if}{if $block.settings.default.force_full_width} _force-full{/if}{if $vid_class} {$vid_class|escape:'html'}{/if}"
  {$block.styles}
>
  {if $vid_source == 'self'}
    {assign var="self_url" value=$block.settings.self_hosted_file.url|default:''}
    {if $self_url}
    <video
      width="100%"
      height="{$vid_height|escape:'html'}"
      style="display:block;"
      {if $vid_autoplay}autoplay{/if}
      {if $vid_muted}muted{/if}
      {if $vid_loop}loop{/if}
      controls
    >
      <source src="{$self_url|escape:'html'}">
    </video>
    {/if}
  {else}
    <div class="fa-video-responsive" style="position:relative; width:100%; height:{$vid_height|escape:'html'};">
      <iframe
        src="{$vid_embed|escape:'html'}"
        style="position:absolute; top:0; left:0; width:100%; height:100%; border:0;"
        allowfullscreen
        allow="autoplay; encrypted-media"
        loading="lazy"
      ></iframe>
    </div>
  {/if}
</div>
