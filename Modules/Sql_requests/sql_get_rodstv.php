<?php

$sql_get_rodstv = "SELECT
              RODSTV.[O_HMEN01_ID]
              ,RODSTV.[REGION_COD]
              ,RODSTV.[O_HMEN04_ID]
              ,RODSTV.[FIO] AS RODSTV_FIO
              ,RODSTV.[DATE_INS] AS RODSTV_DATE_INS
              ,RODSTV.[BIRTHDATE] AS RODSTV_BIRTHDATE
              ,RODSTVNAMES.[NAME] AS TIP_RODSTVA

              FROM [Kadry2024v2].[dbo].[O_HMEN04] RODSTV

              LEFT JOIN [Kadry2024v2].[dbo].[M_PRT_01] RODSTVNAMES
              ON RODSTV.[M_PRT_01_ID] = RODSTVNAMES.[M_PRT_01_ID]";

?>