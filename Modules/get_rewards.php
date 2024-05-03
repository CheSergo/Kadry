<?php
include 'Variables\\config.php';
// Награды

// подключаем sql запрос
include 'Sql_requests\\sql_get_rewards.php';
include 'Sql_requests\\sql_get_rewards2.php';

$stmt = create_stmt($conn, $sql_rewards);

$rewards_array = array();
$items = array('O_HMEN01_ID', 'REGION_COD');
$sub_array_name = 'rewards_array';
$sub_items = array('hmen_reward_id', 'REWARD_ID', 'REWARD_NAME', 'REWARD_DATE', 'DOC_ID', 'DOC_NAME', 'DOC_NUM', 'DOC_DATE', 'REWARD_TYPE_ID', 'REWARD_TYPE_NAME');

while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_NUMERIC)) {
  fetching($row, 0, $rewards_array, $items, $sub_items, $sub_array_name);
}

file_put_contents($main_path . '\Json_returns\2024\employees\employee_rewards_array.json', json_encode($rewards_array));

$stmt = create_stmt($conn, $sql_rewards2);

$rewards2_array = array();
$items = array('O_HMEN01_ID', 'REGION_COD');
$sub_array_name = 'rewards2_array';
$sub_items = array('hmen_reward_id', 'REWARD_ID', 'REWARD_DATE', 'DOC_ID', 'DOC_NAME', 'DOC_NUM', 'DOC_DATE');

while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_NUMERIC)) {
  fetching($row, 0, $rewards2_array, $items, $sub_items, $sub_array_name);
}

file_put_contents($main_path . '\Json_returns\2024\employees\employee_rewards2_array.json', json_encode($rewards2_array));