{*SMARTY*}
{extends file='common_layout.tpl'}
{if add::content_type() == 'text/plain'}
    {block name="response"}{/block}
{/if}
