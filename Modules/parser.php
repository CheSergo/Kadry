<?php
include dirname(__DIR__) . '\Variables\\config.php';

function get_data($path_to_file) {
  $json = file_get_contents($path_to_file);
  return json_decode($json, true);
}

function createTotalArr(&$array, $array_to_parse, ?string $inside_arr_name = null) {
  if(!is_null($inside_arr_name)) {
    foreach($array_to_parse as $key => $arr) {
      if(isset($array[$key])) {
        $array[$key][$inside_arr_name] = $arr[$inside_arr_name];
      }
    }
  } else {
    foreach($array_to_parse as $key => $arr) {
      if(isset($array[$key])) {
        foreach($arr as $item_key => $item) {
          $array[$key][$item_key] = $item;
        }
      }
    }
  }
  return $array;
}

$organized =        get_data($main_path . '\Json_returns\2024\employees\employee_organized_array.json');
$first_data =       get_data($main_path . '\Json_returns\2024\employees\employee_firstData_array.json');
$chins =            get_data($main_path . '\Json_returns\2024\employees\employee_chins_array.json');
$staj =             get_data($main_path . '\Json_returns\2024\employees\employee_staj_array.json');
$rodstv =           get_data($main_path . '\Json_returns\2024\employees\employee_rodstvenniki_array.json');
$contracts =        get_data($main_path . '\Json_returns\2024\employees\employee_contracts_array.json');
$education =        get_data($main_path . '\Json_returns\2024\employees\employee_education_array.json');
$attestation =      get_data($main_path . '\Json_returns\2024\employees\employee_attestation_array.json');
$after_education =  get_data($main_path . '\Json_returns\2024\employees\employee_after_education_array.json');
$businesstips =     get_data($main_path . '\Json_returns\2024\employees\employee_businesstips_array.json');
$addedu =           get_data($main_path . '\Json_returns\2024\employees\employee_addedu_array.json');
$addedu2 =          get_data($main_path . '\Json_returns\2024\employees\employee_addedu2_array.json');
$vacations =        get_data($main_path . '\Json_returns\2024\employees\employee_vacations_array.json');
$vacations2 =       get_data($main_path . '\Json_returns\2024\employees\employee_vacations2_array.json');
$rewards =          get_data($main_path . '\Json_returns\2024\employees\employee_rewards_array.json');
$rewards2 =         get_data($main_path . '\Json_returns\2024\employees\employee_rewards2_array.json');
$oklads =           get_data($main_path . '\Json_returns\2024\employees\employee_oklads_array.json');

createTotalArr($organized, $first_data);
createTotalArr($organized, $chins,            'chins_array');
createTotalArr($organized, $staj,             'staj_array');
createTotalArr($organized, $rodstv,           'rodstv_array');
createTotalArr($organized, $contracts,        'contracts_array');
createTotalArr($organized, $education,        'education_array');
createTotalArr($organized, $attestation,      'attestation_array');
createTotalArr($organized, $after_education,  'after_education_array');
createTotalArr($organized, $businesstips,     'businesstips_array');
createTotalArr($organized, $addedu,           'addedu_array');
createTotalArr($organized, $addedu2,          'addedu2_array');
createTotalArr($organized, $vacations,        'vacations_array');
createTotalArr($organized, $vacations2,       'vacations2_array');
createTotalArr($organized, $rewards,          'rewards_array');
createTotalArr($organized, $rewards2,         'rewards2_array');
createTotalArr($organized, $oklads,           'oklads_array');

unset($first_data);
unset($chins);
unset($staj);
unset($rodstv);
unset($contracts);
unset($education);
unset($attestation);
unset($after_education);
unset($businesstips);
unset($after_education);
unset($addedu);
unset($addedu2);
unset($vacations);
unset($vacations2);
unset($rewards);
unset($rewards2);
unset($oklads);

// file_put_contents($main_path . '\Json_returns\2024\employees\employee_alldata_array.json', json_encode($organized));

// $json = file_get_contents($main_path . '\Json_returns\2024\employees\employee_alldata_array.json');
// $test = json_decode($json, true);

$grouped = array();

// foreach($test as $key => $item) {
foreach($organized as $key => $item) {
  $grouped[$item['ORGANIZATION_ID']][$key] = $item;
}

file_put_contents($main_path . '\Json_returns\2024\employees\employee_grouped_array.json', json_encode($grouped));

unset($grouped);
echo "\n"."=============================================";
echo "\n"."================ Parser done ================";
echo "\n"."=============================================";
sleep(1);
?>