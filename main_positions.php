<?php
include 'Variables\\config.php';

// ====================================================================================
// Подключение к БД
include 'db_connection.php';

if( $conn ) {
    echo "Connection established.<br />";
} else {
    echo "Connection could not be established.<br />";
    die( print_r( sqlsrv_errors(), true));
}

$sql = "SELECT SRT.[O_SRT_ID]
              ,SRT.[REGION_COD]
              ,SRT.[M_VIDSRTNODE_ID]
              ,SRT.[O_REESTR_ID]
              ,SRT.[NODE_PAR]
              ,SRT.[NAME]
              ,SRT.[STAVKA]
              ,SRT.[DATEBEGIN]
              ,SRT.[DATEFINISH]
              ,OKLAD.[O_OKLAD_ID] AS OKLAD_ID
              ,OKLAD.[OKLAD_VALUE] AS RAZMER_OKLADA
              ,OKLAD.[DATEBEGIN] AS BEGIN_OKLAD
              ,OKLAD.[DATEFINISH] AS FINISH_OKLAD
              ,MINIST.[NAME] AS ORGANZATION
              ,MINIST.[O_SRT_ID] AS ORGANIZATION_ID
              ,MINIST.[REGION_COD] AS ORGANIZATION_REGION_COD
              ,REESTR_WORK.[DATEBEGIN] AS WORK_DATEBEGIN

        FROM [Kadry2024v2].[dbo].[O_SRT] SRT

        LEFT JOIN [Kadry2024v2].[dbo].[O_OKLAD] OKLAD
        ON SRT.[O_REESTR_ID] = OKLAD.[O_REESTR_ID]

        LEFT JOIN [Kadry2024v2].[dbo].[O_SRT] MINIST
        ON SRT.[REGION_COD] = MINIST.[REGION_COD]
          AND MINIST.[M_VIDSRTNODE_ID] = 1

        LEFT JOIN [Kadry2024v2].[dbo].[O_REESTR] REESTR_WORK
        ON SRT.[O_REESTR_ID] = REESTR_WORK.[O_REESTR_ID]

        WHERE SRT.[M_VIDSRTNODE_ID] = 3
        order by SRT.[REGION_COD],SRT.[O_SRT_ID]";

$stmt = sqlsrv_query( $conn, $sql);

if( $stmt === false ) {
    die( print_r( sqlsrv_errors(), true));
}

$deist_GGS = array_map('str_getcsv', file($main_path .'\csv_parser\\deistv_GGS.csv'));
$deisv_gosdolg = array_map('str_getcsv', file($main_path .'\csv_parser\\deistv_GosDolhnosti.csv'));
$deisv_nonGosdolg = array_map('str_getcsv', file($main_path .'\csv_parser\\deistv_nonGosDolhnosti.csv'));
$deisv_techSupp = array_map('str_getcsv', file($main_path .'\csv_parser\\deistv_techSupp.csv'));
$closed_GGS = array_map('str_getcsv', file($main_path .'\csv_parser\\closed_GGS.csv'));
$closed_nonGGS = array_map('str_getcsv', file($main_path .'\csv_parser\\closed_nonGGS.csv'));
$closed_gosdolg = array_map('str_getcsv', file($main_path .'\csv_parser\\closed_GosDolhnosti.csv'));

array_shift($deist_GGS);
array_shift($deisv_gosdolg);
array_shift($deisv_nonGosdolg);
array_shift($deisv_techSupp);
array_shift($closed_GGS);
array_shift($closed_nonGGS);
array_shift($closed_gosdolg);

$arr_for_shift = [&$deist_GGS, &$deisv_gosdolg, &$deisv_nonGosdolg, &$deisv_techSupp, &$closed_GGS, &$closed_nonGGS, &$closed_gosdolg];

$ids_arr = []; # Справочник кодов
function csv_mapping ($csv, &$ids_arr) {
  foreach($csv as $line) {
    $arr = explode(';', $line[0]);
    print_r($arr);
    die;
    $ids_arr[$arr[1]] = $arr[0];
  }
}

foreach($arr_for_shift as $arr) {
  csv_mapping($arr, $ids_arr);
}

print_r($ids_arr);
die;

$all_data = array(); //Итоговый многомерный ассоциативный массив

function fetch($row, $index, &$array) {
  $row = $row;

  if (isset($row[$index]) && !is_null($row[$index])) {
    $key = $row[$index + 15].'_'.$row[$index + 14];
    $position_key = $row[$index + 1].'_'.$row[$index];

    if ( !array_key_exists($key, $array) || !array_key_exists($position_key, $array[$key])) {
      $array[$key][$position_key] = array(
        'O_SRT_ID' => $row[$index],
        'REGION_COD' => $row[$index + 1],
        'M_VIDSRTNODE_ID' => $row[$index + 2],
        'O_REESTR_ID' => $row[$index + 3],
        'NODE_PAR' => $row[$index + 4],
        'PARENT_ID' => $row[$index + 1].'_'.$row[$index + 4],
        'NAME' => $row[$index + 5],
        'STAVKA' => $row[$index + 6],
        'POSITION_DATEBEGIN' => $row[$index + 7],
        'POSITION_DATEFINISH' => $row[$index + 8],
        'ORGANZATION_NAME' => $row[$index + 13],
        'ORGANIZATION_ID' => $row[$index + 14],
        'ORGANIZATION_REGION_COD' => $row[$index + 15],
        'WORK_DATEBEGIN' => $row[$index + 16],
      );
    } 
    if ($row[$index + 3] == 177) {
      $array[$key][$position_key]['O_REESTR_ID'] = '163';
    } elseif ($row[$index + 3] == 170) {
      $array[$key][$position_key]['O_REESTR_ID'] = '156';
    } else {
      $array[$key][$position_key]['O_REESTR_ID'] = $row[$index + 3];
    }
    if (isset($row[$index + 9]) && !is_null($row[$index + 9])) {
      $array[$key][$position_key]['oklads'][$row[$index + 9]] = array( 
        'RAZMER_OKLADA' => $row[$index + 10],
        'BEGIN_OKLAD' => $row[$index + 11],
        'FINISH_OKLAD' => $row[$index + 12],
        );
      }
    // fetch_child($row, $index + 6, $array[$key]['departments']);
  } 
}

while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_NUMERIC)) {
  fetch($row, 0, $all_data);
}

// file_put_contents('C:\\guverento\\phpKadry\\employee\\2023\\xml_returns\\positions\\positions_array.json', json_encode($all_data));

file_put_contents($main_path . '\Json_returns\2024\positions\positions_array.json', json_encode($all_data));

// function group_by_parent($array) {
//   $array_by_organization = [];
//   foreach($array as $key => $position_arr) {
//     print '<pre>';
//     print_r($position_arr);
//     print '<pre>';
//     die;
//     if( $position_arr['ORGANIZATION_REGION_COD'] == 203 && $position_arr['ORGANIZATION_ID'] == 296 ) {
//       print '<pre>';
//       print_r($position_arr);
//       print '<pre>';
//       die;
//     }
//     // $array_by_organization[$position_arr['ORGANIZATION_REGION_COD'].'_'.$position_arr['ORGANIZATION_ID']][$position_arr['PARENT_ID']][$key] = $position_arr;
//     $array_by_organization[$position_arr['ORGANIZATION_REGION_COD'].'_'.$position_arr['ORGANIZATION_ID']][$key] = $position_arr;
//   }
//   return $array_by_organization;
// }


// $grouped_array = group_by_parent($all_data);

// file_put_contents('C:\\guverento\\phpKadry\\employee\\2023\\xml_returns\\positions\\positions_by_parrents_array.json', json_encode($grouped_array));

function makeFile($array, $dom, $root, &$ids_arr) {

  foreach ($array as $data) {
    // print '<pre>';
    // print_r($data);
    // print '<pre>';
    // die;

    $dom = $dom;
    $root = $root;
      $position_node = $dom->createElement('Position');
      
      $child_node_code = $dom->createElement('Code', $data['REGION_COD'].'_'.$data['O_SRT_ID']);
      $position_node->appendChild($child_node_code);
      // $child_node_begin = $dom->createElement('Begin', $data['POSITION_DATEBEGIN']->format('Y-m-d'));
      $child_node_begin = $dom->createElement('Begin', date('Y-m-d', strtotime($data['POSITION_DATEBEGIN'])));
      $position_node->appendChild($child_node_begin);
      if (!is_null($data['POSITION_DATEFINISH'])) {
          // $child_node_end = $dom->createElement('End', $data['POSITION_DATEFINISH']->format('Y-m-d'));
          $child_node_end = $dom->createElement('End', date('Y-m-d', strtotime($data['POSITION_DATEFINISH'])));
          $position_node->appendChild($child_node_end);
      }
      $child_node_ParentCode = $dom->createElement('ParentCode', $data['PARENT_ID']);
      $position_node->appendChild($child_node_ParentCode);

      $child_node_Post = $dom->createElement('Post');
      $position_node->appendChild($child_node_Post);
        $child_node_post = $dom->createElement('post');
        $child_node_Post->appendChild($child_node_post);
          if (!is_null($data['WORK_DATEBEGIN'])) {
          // $child_node_Begin = $dom->createElement('Begin', $data['WORK_DATEBEGIN']->format('Y-m-d'));
          $child_node_Begin = $dom->createElement('Begin', date('Y-m-d', strtotime($data['WORK_DATEBEGIN'])));
          $child_node_post->appendChild($child_node_Begin);
          } else {
            $child_node_Begin = $dom->createElement('Begin', '1900-01-01');
            $child_node_post->appendChild($child_node_Begin);
          }
          if(isset($ids_arr[$data['O_REESTR_ID']])) {
            $child_node_Catalog = $dom->createElement('Catalog', $ids_arr[$data['O_REESTR_ID']] == 3 ? '2' : $ids_arr[$data['O_REESTR_ID']]);
            $child_node_post->appendChild($child_node_Catalog);
          } else {
            $child_node_Catalog = $dom->createElement('Catalog', '2');
            $child_node_post->appendChild($child_node_Catalog);
          }
          $child_node_Code = $dom->createElement('Code', $data['O_REESTR_ID']);
          $child_node_post->appendChild($child_node_Code);

      $child_node_Rate = $dom->createElement('Rate');
      $position_node->appendChild($child_node_Rate);
        $child_node_rate = $dom->createElement('rate');
        $child_node_Rate->appendChild($child_node_rate);
          // $child_node_Begin = $dom->createElement('Begin', $data['POSITION_DATEBEGIN']->format('Y-m-d'));
          $child_node_Begin = $dom->createElement('Begin', date('Y-m-d', strtotime($data['POSITION_DATEBEGIN'])));
          $child_node_rate->appendChild($child_node_Begin);
          $child_node_Value = $dom->createElement('Value', $data['STAVKA']);
          $child_node_rate->appendChild($child_node_Value);

      $child_node_Shortname = $dom->createElement('ShortName');
      $position_node->appendChild($child_node_Shortname);
        $child_node_short = $dom->createElement('shortname');
        $child_node_Shortname->appendChild($child_node_short);
          // $child_node_begin = $dom->createElement('Begin', $data['POSITION_DATEBEGIN']->format('Y-m-d'));
          $child_node_begin = $dom->createElement('Begin', date('Y-m-d', strtotime($data['POSITION_DATEBEGIN'])));
          $child_node_short->appendChild($child_node_begin);
          $child_node_Value = $dom->createElement('Value', trim($data['NAME']));
          $child_node_short->appendChild($child_node_Value);

      $child_node_Surcharge = $dom->createElement('Surcharge');
      $position_node->appendChild($child_node_Surcharge);
        if ( isset($data['oklads']) && count($data['oklads']) ) {
          foreach($data['oklads'] as $key => $oklad_arr) {
            $child_node_surcharge = $dom->createElement('surcharge');
            $child_node_Surcharge->appendChild($child_node_surcharge);

            if (!is_null($oklad_arr['BEGIN_OKLAD'])) {
              // $child_node_Begin = $dom->createElement('Begin', $oklad_arr['BEGIN_OKLAD']->format('Y-m-d'));
              $child_node_Begin = $dom->createElement('Begin', date('Y-m-d', strtotime($oklad_arr['BEGIN_OKLAD'])));
              $child_node_surcharge->appendChild($child_node_Begin);
            }
            if (!is_null($oklad_arr['FINISH_OKLAD'])) {
              // $child_node_Begin = $dom->createElement('End', $oklad_arr['FINISH_OKLAD']->format('Y-m-d'));
              $child_node_Begin = $dom->createElement('End', date('Y-m-d', strtotime($oklad_arr['FINISH_OKLAD'])));
              $child_node_surcharge->appendChild($child_node_Begin);
            }
            $child_node_Code = $dom->createElement('Code');
            $child_node_surcharge->appendChild($child_node_Code);
            $child_node_Value = $dom->createElement('Value', $oklad_arr['RAZMER_OKLADA']);
            $child_node_surcharge->appendChild($child_node_Value);
          }
        }
      // makeFile($data['departments'], $dom, $child_node_departments);
      $root->appendChild($position_node);

  }
}

foreach($all_data as $key => $positions_array) {
  // print $key;
  // print '<pre>';
  // print_r($positions_array);
  // print '<pre>';
  // die;

  $dom = new DOMDocument();
		$dom->encoding = 'utf-8';
		$dom->xmlVersion = '1.0';
		$dom->formatOutput = true;

	// $xml_file_name = 'C:\\guverento\\phpKadry\\employee\\2023\\xml_returns\\positions\\'.$key.'_'.trim( preg_replace('/\s+/', ' ', array_values($positions_array)[0]['ORGANZATION_NAME']) ).'_positions.xml';

  // $xml_file_name = $main_path . '\xml_returns\2024\positions\\'.$key.'_'.trim( preg_replace('/\s+/', ' ', array_values($positions_array)[0]['ORGANZATION_NAME']) ).'_positions.xml';
  $xml_file_name = $main_path . '\xml_returns\2024\positions\\'.$key.'_positions.xml';

    $root = $dom->createElement('Positions');

      // foreach($positions_array as $position) {
        makeFile($positions_array, $dom, $root, $ids_arr);
      // }

    $dom->appendChild($root);

	$dom->save($xml_file_name);
	echo "$xml_file_name has been successfully created"."\n";
}

?>