<?php
// functions
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

$sql = "SELECT SRT1.[O_SRT_ID]
              ,SRT1.[REGION_COD]
              ,SRT1.[NODE_PAR]
              ,SRT1.[NAME]
              ,SRT1.[DATEBEGIN]
              ,SRT1.[DATEFINISH]
              ,SRT2.[O_SRT_ID]
              ,SRT2.[REGION_COD]
              ,SRT2.[NODE_PAR]
              ,SRT2.[NAME]
              ,SRT2.[DATEBEGIN]
              ,SRT2.[DATEFINISH]
              ,SRT3.[O_SRT_ID]
              ,SRT3.[REGION_COD]
              ,SRT3.[NODE_PAR]
              ,SRT3.[NAME]
              ,SRT3.[DATEBEGIN]
              ,SRT3.[DATEFINISH]
              ,SRT4.[O_SRT_ID]
              ,SRT4.[REGION_COD]
              ,SRT4.[NODE_PAR]
              ,SRT4.[NAME]
              ,SRT4.[DATEBEGIN]
              ,SRT4.[DATEFINISH]
              ,SRT5.[O_SRT_ID]
              ,SRT5.[REGION_COD]
              ,SRT5.[NODE_PAR]
              ,SRT5.[NAME]
              ,SRT5.[DATEBEGIN]
              ,SRT5.[DATEFINISH]
              ,SRT6.[O_SRT_ID]
              ,SRT6.[REGION_COD]
              ,SRT6.[NODE_PAR]
              ,SRT6.[NAME]
              ,SRT6.[DATEBEGIN]
              ,SRT6.[DATEFINISH]
              FROM [Kadry2024].[dbo].[O_SRT] SRT1
              INNER JOIN [Kadry2024].[dbo].[O_SRT] SRT2
              ON SRT1.[O_SRT_ID] = SRT2.[NODE_PAR]
              AND SRT1.[REGION_COD] = SRT2.[REGION_COD]
              LEFT JOIN [Kadry2024].[dbo].[O_SRT] SRT3
              ON SRT2.[O_SRT_ID] = SRT3.[NODE_PAR]
              AND SRT2.[REGION_COD] = SRT3.[REGION_COD]
              LEFT JOIN [Kadry2024].[dbo].[O_SRT] SRT4
              ON SRT3.[O_SRT_ID] = SRT4.[NODE_PAR]
              AND SRT3.[REGION_COD] = SRT4.[REGION_COD]
              LEFT JOIN [Kadry2024].[dbo].[O_SRT] SRT5
              ON SRT4.[O_SRT_ID] = SRT5.[NODE_PAR]
              AND SRT4.[REGION_COD] = SRT5.[REGION_COD]
              LEFT JOIN [Kadry2024].[dbo].[O_SRT] SRT6
              ON SRT5.[O_SRT_ID] = SRT6.[NODE_PAR]
              AND SRT5.[REGION_COD] = SRT6.[REGION_COD]
              WHERE SRT1.[NODE_PAR] IS NULL
              ORDER BY SRT1.NODE_PAR";

$stmt = sqlsrv_query( $conn, $sql);

if( $stmt === false ) {
    die( print_r( sqlsrv_errors(), true));
}

$all_data = array(); //Итоговый многомерный ассоциативный массив

function fetch_child($row, $index, &$array) {
  $row = $row;
  
  if (isset($row[$index]) && !is_null($row[$index])) {
    $key = $row[$index + 1].'_'.$row[$index];
    if ( !array_key_exists($key, $array) ) {
      $array[$key] = array(
        'srt_id' => $row[$index],
        'region_cod' => $row[$index + 1],
        'node_par' => $row[$index + 2],
        'name' => $row[$index + 3],
        'datebegin' => $row[$index + 4],
        'datefinish' => $row[$index + 5],
        'departments' => array(),
      );
    } 
    fetch_child($row, $index + 6, $array[$key]['departments']);
  } 
}

while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_NUMERIC)) {
  fetch_child($row, 0, $all_data);
}

// file_put_contents('C:\xampp\htdocs\phpKadry\departments\departments-array.json', json_encode($all_data));

function makeFile($array, $dom, $root) {
  foreach ($array as $data) {
    // print '<pre>';
    // print_r($data);
    // print '<pre>';
    // die;

    $dom = $dom;
    $root = $root;
    if (count($data['departments'])) {

      $department_node = $dom->createElement('Department');
      $child_node_code = $dom->createElement('Code', $data['region_cod'].'_'.$data['srt_id']);
      $department_node->appendChild($child_node_code);
      // $child_node_begin = $dom->createElement('Begin', $data['datebegin']->format('Y-m-d'));
      $child_node_begin = $dom->createElement('Begin', date('Y-m-d', strtotime($data['datebegin'])));
      $department_node->appendChild($child_node_begin);

      if (!is_null($data['datefinish'])) {
          // $child_node_end = $dom->createElement('End', $data['datefinish']->format('Y-m-d'));
          $child_node_end = $dom->createElement('End', date('Y-m-d', strtotime($data['datefinish'])));
          $department_node->appendChild($child_node_end);
      }

      $child_node_Shortname = $dom->createElement('ShortName');
      $department_node->appendChild($child_node_Shortname);

      $child_node_short = $dom->createElement('shortname');
        $child_node_Shortname->appendChild($child_node_short);
          // $child_node_begin = $dom->createElement('Begin', $data['datebegin']->format('Y-m-d'));
          $child_node_begin = $dom->createElement('Begin', date('Y-m-d', strtotime($data['datebegin'])));
          $child_node_short->appendChild($child_node_begin);
          $child_node_Value = $dom->createElement('Value', trim($data['name']));
          $child_node_short->appendChild($child_node_Value);

      $child_node_departments = $dom->createElement('Departments');
      $department_node->appendChild($child_node_departments);

      makeFile($data['departments'], $dom, $child_node_departments);
      $root->appendChild($department_node);

    }
  }
}
foreach($all_data as $key => $ministerstvo) {
  $dom = new DOMDocument();
		$dom->encoding = 'utf-8';
		$dom->xmlVersion = '1.0';
		$dom->formatOutput = true;

	// $xml_file_name = 'C:\\guverento\\phpKadry\\employee\\2023\\xml_returns\\departments\\'.$key.'_departments.xml';

  $xml_file_name = $main_path . '\xml_returns\2024\departments\\'.$key.'_departments.xml';

    $root = $dom->createElement('Departments');

      // foreach($ministerstvo as $data) {
        makeFile($ministerstvo['departments'], $dom, $root);
      // }

    $dom->appendChild($root);

	$dom->save($xml_file_name);
	echo "$xml_file_name has been successfully created"."\n";
}
// ?>