{*SMARTY*}
{extends file='common_layout.tpl'}
{block name="main"}{if add::content_type() == 'text/plain'}{$smarty.block.child|strip_tags}{else}{$smarty.block.child}{/if}{/block}