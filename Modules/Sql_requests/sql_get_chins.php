<?php

$sql_chins = "SELECT
CHINID.[O_HMEN01_ID]
,CHINID.[REGION_COD]
,CHINID.[O_CLASS_ID]
,CHINID.[M_CLASS_ID] AS CODE_ID
,CHINID.[DATE_TEST] AS CHIN_DATE_START
,CHINID.[DATEFINISH] AS CHIN_DATE_END
-- ,CHINID.O_ORD_01_ID
,PRIKAZ.[DATE] AS CHIN_ORDERDATE
,PRIKAZ.[NUM] AS CHIN_PRIKAZ
,PRIKAZ.[NAME] AS CHIN_NAME

FROM [Kadry2024v2].[dbo].[O_CLASS] CHINID

LEFT JOIN [Kadry2024v2].[dbo].[M_CLASS] CHINNAME
ON CHINID.[M_CLASS_ID] = CHINNAME.[M_CLASS_ID]

LEFT JOIN [Kadry2024v2].[dbo].[O_ORD_01] PRIKAZ
ON CHINID.[O_ORD_01_ID] = PRIKAZ.[O_ORD_01_ID] and CHINID.[REGION_COD] = PRIKAZ.[REGION_COD]";

// $sql_chins = "SELECT
//               CHINID.[O_HMEN01_ID]
//               ,CHINID.[REGION_COD]
//               ,CHINID.[O_CLASS_ID]
//               ,CHINID.[DATE_TEST] AS CHIN_DATE_START
//               ,CHINID.[DATEFINISH] AS CHIN_DATE_END
//               ,CHINID.[OSN_TEST] AS CHIN_PRIKAZ
//               ,CHINNAME.[NAME] AS CHIN_NAME

//               FROM [Kadry2024v2].[dbo].[O_CLASS] CHINID

//               LEFT JOIN [Kadry2024v2].[dbo].[M_CLASS] CHINNAME
//               ON CHINID.[M_CLASS_ID] = CHINNAME.[M_CLASS_ID]";

?>