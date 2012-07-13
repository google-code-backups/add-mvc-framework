{*SMARTY*}
{extends file='common_layout.tpl'}
{block name=main}

   <h1>Tests</h1>
   Getting Real Query String: {http_build_query(add::gpc_get())}<br />
   {if $log.warnings}
      <h5>Warnings</h5>
      <ul>
      {foreach $log.warnings as $warning}
         <li>{$warning}</li>
      {/foreach}
      </ul>
   {/if}
   {if $log.dirs}
      <h2>Directories Created</h2>
      <ul>
      {foreach $log.dirs as $dir}
         <li>{$dir}</li>
      {/foreach}
      </ul>
   {/if}

{/block}