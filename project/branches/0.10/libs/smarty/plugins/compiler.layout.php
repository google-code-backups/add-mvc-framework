<?php

function smarty_compiler_layout($params, Smarty $smarty) {
   $template_object_key = array_shift(array_keys($smarty->template_objects));
   $extends = new Smarty_Internal_Compile_Extends();
   return $extends->compile($params);
}