<?php

$sql_first_date = "SELECT H1.[O_HMEN01_ID]
                      ,H1.[REGION_COD]
                      ,H1.[FSTNAME]
                      ,H1.[FAMILY]
                      ,H1.[LSTNAME]
                      ,H1.[BIRTHDATE]
                      ,H1.[BIRTHPLACE]
                      ,H1.[SEX]
                      ,H1.[INN]
                      ,H1.[INSURANCE]
                      ,H1.[PSSERIAL]
                      ,H1.[PSPLACE]
                      ,H1.[PASSPORT_NUM]
                      ,H1.[PASSPORT_SERIA]
                      ,H1.[PASSPORT_DATERECV]
                      ,H1.[PASSPORT_KODPODRAZD]
                      ,H1.[REGADDR]
                      ,H1.[REALADDR]
                      ,H1.[HOMETEL]
                      ,H1.[WORKTEL]
                      ,H1.[DATE_INS]
                      ,H1.[DATE_UPD]

                      ,H13.[PER_NUMBER] AS VOENIK_NUMBER
                      ,H13.[WUS]
                      ,H13.[DATE_UPD] AS WUS_DATEUPD
                      ,ZAPAS.[NAME] AS CAT_ZAPAS
                      ,ZVANIE.[NAME] AS ZVANIE
                      ,GODNOST.[NAME] AS GODNOST
                      ,KOMMISARIAT.[NAME] AS KOMMISARIAT

                      ,BRAK.[NAME] AS BRAK

        FROM [Kadry2024v2].[dbo].[O_HMEN01] H1

        LEFT JOIN [Kadry2024v2].[dbo].[O_HMEN13] H13
        ON H1.[O_HMEN01_ID] = H13.[O_HMEN01_ID] and H1.[REGION_COD] = H13.[REGION_COD]

        LEFT JOIN [Kadry2024v2].[dbo].[M_MLT_ZAPAS] ZAPAS
        ON H13.[M_MLT_ZAPASID] = ZAPAS.[M_MLT_ZAPASID]

        LEFT JOIN [Kadry2024v2].[dbo].[M_MLT_01] ZVANIE
        ON H13.[M_MLT_01_ID] = ZVANIE.[M_MLT_01_ID]

        LEFT JOIN [Kadry2024v2].[dbo].[M_MLT_GODNOST] GODNOST
        ON H13.[M_MLT_GODNOSTID] = GODNOST.[M_MLT_GODNOSTID]

        LEFT JOIN [Kadry2024v2].[dbo].[M_MLT_02] KOMMISARIAT
        ON H13.[M_MLT_02_ID] = KOMMISARIAT.[M_MLT_02_ID]
        
        LEFT JOIN [Kadry2024v2].[dbo].[M_PRT_02] BRAK
        ON H1.[M_PRT_02_ID] = BRAK.[M_PRT_02_ID]";

?>