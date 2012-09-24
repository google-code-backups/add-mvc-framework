{*SMARTY*}
{extends file='common_layout.tpl'}
{block name=main}
{if !$mode}
<h1>Enter Information</h1>
<input type='text' name='first_name' value="{$first_name}" placeholder='First Name' /> <br />
<input type='text' name='last_name' value="{$last_name}" placeholder='Last Name' /> <br />
<input type='text' name='age' value="{$age}" placeholder='Age' /> <br />
<input type='text' name='birthday' value="{$birthday}" placeholder='Birthday' /> <br />
<input type='text' name='address' value="{$address}" placeholder='Address' /> <br />
<input type='text' name='city' value="{$city}" placeholder='City' /> <br />
<input type='text' name='state' value="{$state}" placeholder='State' /> <br /> <br />

<button type='submit' name='mode' value='view_my_age'> View My Age </button>

<button type='submit' name='mode' value='view_my_address'> View My address </button>
{else}
   {if $mode == 'view_my_age'}
      <h1>View my age</h1>
      <p>My Name is {$full_name} and my age is {$age}. I was born on {$birthday}</p>
      <button type='submit' name='mode' value='view_my_address'> View My Address </button>
   {else}
      <h1>View my address</h1>
      <p>My Name is {$full_name} and I live in {$address} {$city} {$state}</p>
      <button type='submit' name='mode' value='view_my_age'> View My age </button>
   {/if}
{/if}
{/block}