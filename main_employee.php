<?php

// functions
include 'Variables\\config.php';
include 'Functions\\init_data_fetch.php';
include 'Functions\\fetching.php';

// ====================================================================================
// Подключение к БД
include 'db_connection.php';

if( $conn ) {
  echo "Connection established.<br />";
} else {
  echo "Connection could not be established.<br />";
  die( print_r( sqlsrv_errors(), true));
}

function create_stmt($conn, $sql) {
  $stmt = sqlsrv_query( $conn, $sql);

  if( $stmt === false ) {
    die( print_r( sqlsrv_errors(), true));
  }

  return $stmt;
}

// ====================================================================================

// Инициализация начальных данных
include 'Modules\\init_data.php';

// ====================================================================================

// Создание начального Массива с айдишниками людей
include 'Modules\\get_organazed_array.php';

// Завпрос на Чины
include 'Modules\\get_chins.php';

// Завпрос на Стажи
include 'Modules\\get_staj.php';
include 'Modules\\make_staj_legitimate.php';

// Запрос на Родственников
include 'Modules\\get_rodstv.php';

// Запрос ОКЛАДОВ на занимаемых должностях на ГОССЛУЖБЕ
include 'Modules\\get_oklads.php';

// Запрос на Образование
include 'Modules\\get_education.php';

// Запрос на Послевузовское образование
include 'Modules\\get_after_education.php';

// Запрос на Дополнительное образование
include 'Modules\\get_addedu.php';

// Запрос на Аттестации
include 'Modules\\get_attestation.php';

// Запрос на Командировки
include 'Modules\\get_businesstips.php';

// Запрос на Награды
include 'Modules\\get_rewards.php';

// Запрос на Награды
include 'Modules\\get_vacations.php';

# ============================================================================================ #
// Это входит в формирование контрактов.
// Используется в файле make_contracts.php, где окончательно билдятся массивы контрактов

// Запрос на Контракты
include 'Modules\\get_contracts.php';

// Запрос на Должности
include 'Modules\\get_doljnosti.php';

// Запрос на Больничные листы
include 'Modules\\get_sick.php';

###################################
// ТУТ ОКОНЧАТЕЛЬНО СОБИРАЕМ JSON CONTRACTS
include 'Modules\\make_contracts.php';
###################################

# =========================================== Запуск Парсера ================================================ #

include 'Modules\\parser.php';

# =========================================== ############## ================================================ #
# ========================================= Запуск XML Парсера ================================================ #

include 'xml\\parser_xml.php';

# ========================================= ###### XML ####### ================================================ #
