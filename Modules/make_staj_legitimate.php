<?php
include '..\\Variables\\config.php';

function get_data($path_to_file) {
    $json = file_get_contents($path_to_file);
    return json_decode($json, true);
}

$stajs = get_data($main_path . '\Json_returns\2024\employees\employee_staj_array.json');

function addOsnovnoiStaj($stajs) {
    
    foreach($stajs as $id => &$human) {
        if(isset($human['staj_array']) && !is_null($human['staj_array'])) {
            foreach ($human['staj_array'] as $id_staj => &$staj) {
                $checker = false;
                if(isset($staj['staj_types']) && !is_null($staj['staj_types'])) {
                    foreach($staj['staj_types'] as $id => &$item) {
                        if (!in_array($item['STAJ_TYPE'], [1, 2, 3, 4, 5, 7])) {
                            unset($staj['staj_types'][$id]);
                            continue;
                        }
                        if ($item['STAJ_TYPE'] == 2) {
                            $checker = true;
                        }
                    }
                }
                if ($checker == false) {
                    $staj['staj_types']['pes']['STAJ_TYPE'] = 2;
                    $staj['staj_types']['pes']['COEFFICIENT'] = 1;
                }
            }
        }
    }

    return $stajs;
}

$new_stajs = addOsnovnoiStaj($stajs);
file_put_contents($main_path . '\Json_returns\2024\employees\employee_staj_array.json', json_encode($new_stajs));