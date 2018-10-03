<?php 

function any_in_array($needle, $haystack)
{
  $needle = is_array($needle) ? $needle : array($needle);
  foreach ($needle as $item) {
    if (in_array($item, $haystack)) {
      return TRUE;
    }
  }
  return FALSE;
} 

function random_element($array) {
  shuffle($array);
  return array_pop($array)
}