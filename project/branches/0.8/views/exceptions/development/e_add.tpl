{*SMARTY*}
{* Exceptions View For Development Environment Status *}
{extends file='common_layout.tpl'}
{block name='main'}
<h1>Uncaught Exception</h1>
<h2>{$exception->getMessage()}</h2>
<small>{$exception->getCode()}</small>
<h3>Debug Data</h3>
{add_debug::return_var_dump($exception->data)}
{/block}
