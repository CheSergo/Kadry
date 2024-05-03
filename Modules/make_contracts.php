<?php
include 'Variables\\config.php';

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

function createContractsArray($contracts, $doljnosti, $sick_usually, $sickpregnant) {

    foreach($contracts as $id => &$worker) {
        foreach($worker['contracts_array'] as $key => &$contract) {
            if($contract['CONTRACT_BEGIN'] == $contract['CONTRACT_END']) {
                unset($worker['contracts_array'][$key]);
            }
        }
    }

    foreach($contracts as $id => &$worker) {

        $length = count($worker['contracts_array']);
        $dates = array();
        foreach ($worker['contracts_array'] as $key => &$contract) {
            $dates[$key] = $contract["CONTRACT_BEGIN"];
        }
        array_multisort($dates, SORT_DESC, $worker['contracts_array']);

        // if($worker['O_HMEN01_ID'] == 407 && $worker['REGION_COD'] == 210) {
            

        foreach($worker['contracts_array'] as $key => &$contract) {

            // print "\n"."1==========";
            // print '<pre>';
            // print_r($contract);
            // print '<pre>';
            // die;

            $keys = array_keys($worker['contracts_array']);
            // if($key == $keys[0]) {
            //     if ($contract['FIRED_ID'] == 11 && $contract['CONTRACT_END'] == null && !is_null($contract['WFL_DATEFINISH'])) {
            //         $contract['CONTRACT_END'] = $contract['WFL_DATEFINISH'];
            //     }
            // }
            if ($length > 1) {
                $next = next($worker['contracts_array']);
                if ($next) {
                    if($contract['CONTRACT_BEGIN'] <= $next['CONTRACT_END'] || is_null($next['CONTRACT_END'])) {
                        $index = array_search($key, $keys);
                        $next_key = $keys[$index + 1];
                        $worker['contracts_array'][$next_key]['CONTRACT_END'] = date('Y-m-d H:i:s', strtotime($contract['CONTRACT_BEGIN'] . ' - 1 day'));
                    }
                }
            }

            // if(count($doljnosti[$id]['doljnosti_array']) > 2) {
            //     print '<pre>';
            //     print_r($sickpregnant[$id]['sickpregnant_array']);
            //     print '<pre>';
            //     die;
            // }
            
            $contract['doljnosti_array'] = array();
            if (array_key_exists($id, $doljnosti)) {
                
                if (count($doljnosti[$id]['doljnosti_array'])) {
                    $dates_dolj = array();
                    foreach ($doljnosti[$id]['doljnosti_array'] as $key_q => &$dolj) {
                        $dates_dolj[$key_q] = $dolj["STAJ_BEGIN"];
                    }
                    array_multisort($dates_dolj, SORT_DESC, $doljnosti[$id]['doljnosti_array']);

                    // rsort($doljnosti[$id]['doljnosti_array']);
                    foreach($doljnosti[$id]['doljnosti_array'] as $doljnost_id => $doljnost) {
                        if(strtotime($contract['CONTRACT_BEGIN']) <= strtotime($doljnost['STAJ_BEGIN'])) {
                            array_push($contract['doljnosti_array'], $doljnost);
                            unset($doljnosti[$id]['doljnosti_array'][$doljnost_id]);
                        }
                    }
                    // Если в контракт не попала ни одна должность
                    if (!count($contract['doljnosti_array'])) {
                        $first = reset($doljnosti[$id]['doljnosti_array']);
                        $first_key = array_key_first($doljnosti[$id]['doljnosti_array']);
                        if ($first) {
                            if ($first['STAJ_END'] == null) {
                                $first['STAJ_BEGIN'] = $contract['CONTRACT_BEGIN'];
                                array_push($contract['doljnosti_array'], $first);
                                unset($doljnosti[$id]['doljnosti_array'][$first_key]);
                            }
                            // print '<pre>';
                            // print_r($contract);
                            // print '<pre>';
                            // die;
                        }
                    }
                }
            }


            

            // if($key == end($keys)) {
            if($key == $keys[0]) {
                $dates_dolj = array();
                foreach ($contract['doljnosti_array'] as $key => &$dolj) {
                    $dates_dolj[$key] = $dolj["STAJ_BEGIN"];
                }
                // array_multisort($dates_dolj, SORT_DESC, $contract['doljnosti_array']);
                array_multisort($dates_dolj, SORT_ASC, $contract['doljnosti_array']);

                if ($contract['FIRED_ID'] == 11) {
                    if (end($contract['doljnosti_array'])) {
                        $contract['CONTRACT_END'] = end($contract['doljnosti_array'])['STAJ_END'];
                    }
                }

                // if ($worker['O_HMEN01_ID'] == 318 && $worker['REGION_COD'] == 312) {
                // print '<pre>';
                // print_r($contract);
                // print '<pre>';
                // die;
                // }
            }

            if (count($contract['doljnosti_array'])) {
                $dates_dolj = array();
                foreach ($contract['doljnosti_array'] as $key => &$dolj) {
                    $dates_dolj[$key] = $dolj["STAJ_BEGIN"];
                }
                array_multisort($dates_dolj, SORT_ASC, $contract['doljnosti_array']);

                if($contract['CONTRACT_BEGIN'] != $contract['doljnosti_array'][0]['STAJ_BEGIN']) {
                    $contract['CONTRACT_BEGIN'] = $contract['doljnosti_array'][0]['STAJ_BEGIN'];
                }
            }



            // if(count($sickpregnant[$id]['sickpregnant_array']) > 2) {
            //     print '<pre>';
            //     print_r($sickpregnant[$id]['sickpregnant_array']);
            //     print '<pre>';
            //     die;
            // }

            $contract['sick_array'] = array();
            if (array_key_exists($id, $sick_usually)) {
                if (count($sick_usually[$id]['sick_array'])) {
                    $sick_u_dates = array();
                    foreach ($sick_usually[$id]['sick_array'] as $key => &$sick_u) {
                        $sick_u_dates[$key] = $sick_u["SICK_BEGIN"];
                    }
                    array_multisort($sick_u_dates, SORT_DESC, $sick_usually[$id]['sick_array']);
                    foreach($sick_usually[$id]['sick_array'] as $sick_usually_id => $sick_arr) {
                        if(strtotime($contract['CONTRACT_BEGIN']) <= strtotime($sick_arr['SICK_BEGIN'])) {
                            array_push($contract['sick_array'], $sick_arr);
                            unset($sick_usually[$id]['sick_array'][$sick_usually_id]);
                        }
                    }
                }
            }

            $contract['sickpregnant_array'] = array();
            if (array_key_exists($id, $sickpregnant)) {
                if (count($sickpregnant[$id]['sickpregnant_array'])) {
                    $sick_dates = array();
                    foreach ($sickpregnant[$id]['sickpregnant_array'] as $key => &$sick) {
                        $sick_dates[$key] = $sick["DATEBEGIN"];
                    }
                    array_multisort($sick_dates, SORT_DESC, $sickpregnant[$id]['sickpregnant_array']);
                    foreach($sickpregnant[$id]['sickpregnant_array'] as $sickpregnant_id => $sick) {
                        // if($sickpregnant[$id]['O_HMEN01_ID'] == "15117" && $sickpregnant[$id]['REGION_COD'] == "403") {
                        //     print '<pre>';
                        //     if(is_numeric($sickpregnant[$id]['sickpregnant_array']['403_609']['DOC_NUM'])) {
                        //         print 'valid';
                        //     } else {
                        //         print 'invalid';
                        //     }
                        //     // print_r($sickpregnant[$id]['sickpregnant_array']['403_609']['DOC_NUM']);
                        //     print '<pre>';
                        //     die;
                        // }
                        if(is_numeric($sick['DOC_NUM'])) {
                            if(strtotime($contract['CONTRACT_BEGIN']) <= strtotime($sick['DATEBEGIN'])) {
                                array_push($contract['sickpregnant_array'], $sick);
                                unset($sickpregnant[$id]['sickpregnant_array'][$sickpregnant_id]);
                            }
                        }
                    }
                }
            }

        }
        // }
        
        array_multisort($dates, SORT_ASC, $worker['contracts_array']);
    }
    return $contracts;
}

$contracts =        get_data($main_path . '\Json_returns\2024\employees\employee_init_contracts_array.json');
$doljnosti =        get_data($main_path . '\Json_returns\2024\employees\employee_doljnosti_array.json');
$sick =             get_data($main_path . '\Json_returns\2024\employees\employee_sick_array.json');
$sickpregnant =     get_data($main_path . '\Json_returns\2024\employees\employee_sickpregnant_array.json');

$new_contracts = createContractsArray($contracts, $doljnosti, $sick, $sickpregnant);

file_put_contents($main_path . '\Json_returns\2024\employees\employee_contracts_array.json', json_encode($new_contracts));

unset($contracts);
unset($doljnosti);
unset($sick);
unset($sickpregnant);
unset($new_contracts);
echo "\n"."=============================================";
echo "\n"."======"."Сборка контрактов завершена"."======";
echo "\n"."=============================================";
sleep(1);