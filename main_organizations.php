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

$sql = "SELECT [O_SRT_ID]
              ,[REGION_COD]
              -- ,[M_VIDSRTNODE_ID]
              ,[NAME]
              -- ,[ORD]
              ,[DATEBEGIN]
              ,[DATEFINISH]
              -- ,[DATE_INS]
        FROM [Kadry2024v2].[dbo].[O_SRT]
        WHERE [M_VIDSRTNODE_ID] = 1
        ORDER BY [REGION_COD]";

$stmt = sqlsrv_query( $conn, $sql);

if( $stmt === false ) {
    die( print_r( sqlsrv_errors(), true));
}

$working_organizations = array(); //Итоговый многомерный ассоциативный массив
$closed_organizations = array(); //Итоговый многомерный ассоциативный массив

function fetch_child($row, $index, &$working_orgs, &$closed_orgs) {
  $row = $row;
  
  if (isset($row[$index]) && !is_null($row[$index])) {
    $key = $row[$index + 1]."_".$row[$index];
    is_null($row[$index + 4]) ? $array = &$working_orgs : $array = &$closed_orgs;

    if ( !array_key_exists($key, $array) ) {
      $array[$key] = array(
        'CODE' => $row[$index + 1]."_".$row[$index],
        'O_SRT_ID' => $row[$index],
        'REGION_COD' => $row[$index + 1],
        'NAME' => $row[$index + 2],
        'DATEBEGIN' => $row[$index + 3],
        'DATEFINISH' => $row[$index + 4],
        'closed' => array(),
      );
    } 
    // fetch_child($row, $index + 16, $array[$key]['child_positions']);
  } 
}

while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_NUMERIC)) {
  fetch_child($row, 0, $working_organizations, $closed_organizations);
}

function compile_arrays($arr1, $arr2) {
  foreach($arr1 as $key => $sub_arr1) {
    foreach($arr2 as $arr2_key => $sub_arr2) {
      if( $sub_arr1['REGION_COD'] == $sub_arr2['REGION_COD']) {
        $sub_arr1['closed'][$arr2_key] = $sub_arr2;
      }
    }
    $data[$key] = $sub_arr1;
  }
  return $data;
}

// print(count($working_organizations));
// print('</br>');
// print(count($closed_organizations));
// $data = compile_arrays($working_organizations, $closed_organizations);

// print '<pre>';
// print_r($data);
// print '<pre>';
// die;

// print_r($closed_organizations);

// file_put_contents('C:\guverento\phpKadry\employee\2023\Json_returns\organizations\closed_positions_array.json', json_encode($closed_organizations));
// file_put_contents('C:\guverento\phpKadry\employee\2024\Json_returns\organizations\open_positions_array.json', json_encode($working_organizations));

file_put_contents($main_path . '\Json_returns\2024\organizations\open_positions_array.json', json_encode($working_organizations));

function make_xml($array, $dom, $root) {
  foreach ($array as $key => $data) {
    $dom = $dom;
    $root = $root;

      $Organization_node = $dom->createElement('Organization');
        $child_node_code = $dom->createElement('Code', $data['CODE']);
        $Organization_node->appendChild($child_node_code);
        // $child_node_Begin = $dom->createElement('Begin', $data['DATEBEGIN']->format('Y-m-d'));
        $child_node_Begin = $dom->createElement('Begin', date('Y-m-d', strtotime($data['DATEBEGIN'])));
        $Organization_node->appendChild($child_node_Begin);
        if(isset($data['DATEFINISH']) && !is_null($data['DATEFINISH'])) {
          // $child_node_Begin = $dom->createElement('End', $data['DATEFINISH']->format('Y-m-d'));
          $child_node_Begin = $dom->createElement('End', date('Y-m-d', strtotime($data['DATEFINISH'])));
          $Organization_node->appendChild($child_node_Begin);
        }
        if(isset($data['SHORT_NAME'])) {
          $child_node_ShortName = $dom->createElement('ShortName');
          $Organization_node->appendChild($child_node_ShortName);
            $child_node_shortname = $dom->createElement('shortname');
            $child_node_ShortName->appendChild($child_node_shortname);
              // $child_node_Begin = $dom->createElement('Begin', $data['DATEBEGIN']->format('Y-m-d'));
              $child_node_Begin = $dom->createElement('Begin', date('Y-m-d', strtotime($data['DATEBEGIN'])));
              $child_node_shortname->appendChild($child_node_Begin);
              $child_node_Value = $dom->createElement('Value', $data['SHORT_NAME']);
              $child_node_shortname->appendChild($child_node_Value);
            if(count($data['closed'])) {
              foreach($data['closed'] as $sub_arr) {
                $child_node_shortname = $dom->createElement('shortname');
                $child_node_ShortName->appendChild($child_node_shortname);
                  // $child_node_Begin = $dom->createElement('Begin', $sub_arr['DATEBEGIN']->format('Y-m-d'));
                  $child_node_Begin = $dom->createElement('Begin', date('Y-m-d', strtotime($sub_arr['DATEBEGIN'])));
                  $child_node_shortname->appendChild($child_node_Begin);
                  $child_node_Value = $dom->createElement('Value', $sub_arr['SHORT_NAME']);
                  $child_node_shortname->appendChild($child_node_Value);
              }
            }
        }

        $child_node_FullName = $dom->createElement('FullName');
        $Organization_node->appendChild($child_node_FullName);
          $child_node_fullname = $dom->createElement('fullname');
          $child_node_FullName->appendChild($child_node_fullname);
            // $child_node_Begin = $dom->createElement('Begin', $data['DATEBEGIN']->format('Y-m-d'));
            $child_node_Begin = $dom->createElement('Begin', date('Y-m-d', strtotime($data['DATEBEGIN'])));
            $child_node_fullname->appendChild($child_node_Begin);
            $child_node_Value = $dom->createElement('Value', $data['NAME']);
            $child_node_fullname->appendChild($child_node_Value);
        if(count($data['closed'])) {
          foreach($data['closed'] as $sub_arr) {
            $child_node_fullname = $dom->createElement('fullname');
            $child_node_FullName->appendChild($child_node_fullname);
              // $child_node_Begin = $dom->createElement('Begin', $sub_arr['DATEBEGIN']->format('Y-m-d'));
              $child_node_Begin = $dom->createElement('Begin', date('Y-m-d', strtotime($sub_arr['DATEBEGIN'])));
              $child_node_fullname->appendChild($child_node_Begin);
              $child_node_Value = $dom->createElement('Value', $sub_arr['NAME']);
              $child_node_fullname->appendChild($child_node_Value);
          }
        }
        $child_node_Inn = $dom->createElement('Inn');
        $Organization_node->appendChild($child_node_Inn);
        $child_node_Kpp = $dom->createElement('Kpp');
        $Organization_node->appendChild($child_node_Kpp);
        $child_node_Okpo = $dom->createElement('Okpo');
        $Organization_node->appendChild($child_node_Okpo);
        $child_node_Okopf = $dom->createElement('Okopf');
        $Organization_node->appendChild($child_node_Okopf);
        $child_node_Okved = $dom->createElement('Okved');
        $Organization_node->appendChild($child_node_Okved);
        $child_node_Ogrn = $dom->createElement('Ogrn');
        $Organization_node->appendChild($child_node_Ogrn);
        
        if(isset($data['ADDRESS'])) {
          $child_node_ActualAddress = $dom->createElement('ActualAddress');
          $Organization_node->appendChild($child_node_ActualAddress);
            $child_node_actualaddress = $dom->createElement('actualaddress');
            $child_node_ActualAddress->appendChild($child_node_actualaddress);
              $child_node_actualaddress = $dom->createElement('actualaddress');
              $child_node_ActualAddress->appendChild($child_node_actualaddress);
                $child_node_Begin = $dom->createElement('Begin');
                $child_node_actualaddress->appendChild($child_node_Begin);
                $child_node_Value = $dom->createElement('Value', $data['ADDRESS']);
                $child_node_actualaddress->appendChild($child_node_actualaddress);
          $child_node_LegalAddress = $dom->createElement('LegalAddress');
          $Organization_node->appendChild($child_node_LegalAddress);
          $child_node_PostAddress = $dom->createElement('PostAddress');
          $Organization_node->appendChild($child_node_PostAddress);
        }

      $root->appendChild($Organization_node);

      // if(count($data['closed'])) {
      //   make_xml($data['closed'], $dom, $Organization_node);
      // }
  }
}

$dom = new DOMDocument();
		$dom->encoding = 'utf-8';
		$dom->xmlVersion = '1.0';
		$dom->formatOutput = true;

	// $xml_file_name = 'C:\\guverento\\phpKadry\\employee\\2023\\xml_returns\\organizations\\closed_organizations.xml';
	// $xml_file_name = 'C:\\guverento\\phpKadry\\employee\\2023\\xml_returns\\organizations\\open_organizations.xml';

  $xml_file_name = $main_path . '\xml_returns\2024\organizations\open_organizations.xml';

    $root = $dom->createElement('Organizations');

    print('start func');
    make_xml($working_organizations, $dom, $root);
    // make_xml($closed_organizations, $dom, $root);

    $dom->appendChild($root);

	$dom->save($xml_file_name);
	echo "$xml_file_name has been successfully created";

  ?>