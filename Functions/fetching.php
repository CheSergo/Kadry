<?php

function fetching($row, $index, &$array, $items, ?array $sub_items = null, ?string $sub_array_name = null, 
?array $third_level = null, ?string $third_level_name = null, ?string $index_to_inspect = null) {
  if($index_to_inspect) {
    if($row[$index_to_inspect] == '11') {
      $key = $row[$index + 1]."_".$row[$index];

      if(isset($array[$key]) && count($array[$key])) {
        $k = array_keys(end($array[$key]));
        $array[$key][$sub_array_name][end($k)]['RETIRE_CODE'] = $row[$index_to_inspect + 1];
      } 

      print "\r\n"."skipped ".$key;

      // print '<pre>';
      // print_r($array);
      // print '<pre>';
      // die;
    } else {
      $key = $row[$index + 1]."_".$row[$index];
      foreach($items as $item) {
        $array[$key][$item] = $row[$index];
        $index += 1;
      }
      $sub_items_id = $row[1]."_".$row[2];
    
      if (!is_null($sub_items) and !is_null($sub_array_name)) {
        foreach($sub_items as $sub_item) {
          $array[$key][$sub_array_name][$sub_items_id][$sub_item] = $row[$index];
          $index += 1;
        }
        ksort($array[$key][$sub_array_name], SORT_NATURAL);
        if (!is_null($third_level) and !is_null($third_level_name)) {
          $third_level_key = $row[$index];
          foreach ($third_level as $sub_sub_item) {
            $array[$key][$sub_array_name][$sub_items_id][$third_level_name][$third_level_key][$sub_sub_item] = $row[$index];
            $index += 1;
          }
        }
      }
      print "\r\n"."created ".$key;
    }
  } else {
    $key = $row[$index + 1]."_".$row[$index];
    // print '<pre>';
    // print_r($row);
    // print '<pre>';
    // die;
    foreach($items as $item) {
      $array[$key][$item] = $row[$index];
      $index += 1;
    }
    $sub_items_id = $row[1]."_".$row[2];
  
    if (!is_null($sub_items) and !is_null($sub_array_name)) {
      foreach($sub_items as $sub_item) {
        $array[$key][$sub_array_name][$sub_items_id][$sub_item] = $row[$index];
        $index += 1;
      }
      ksort($array[$key][$sub_array_name], SORT_NATURAL);
      if (!is_null($third_level) and !is_null($third_level_name)) {
        $third_level_key = $row[$index];
        foreach ($third_level as $sub_sub_item) {
          $array[$key][$sub_array_name][$sub_items_id][$third_level_name][$third_level_key][$sub_sub_item] = $row[$index];
          $index += 1;
        }
      }
    }
    print "\r\n"."created ".$key;
  }

}