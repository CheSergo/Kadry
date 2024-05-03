<?php

$sql_oklads = "SELECT
      H1.[O_HMEN01_ID]
      ,H1.[REGION_COD]
      ,OKLAD.[O_OKLAD_ID] AS OKLAD_ID
      ,WFl.[O_SRT_ID]
      ,OKLAD.[OKLAD_VALUE] AS RAZMER_OKLADA
      ,OKLAD.[DATEBEGIN] AS BEGIN_OKLAD
      ,OKLAD.[DATEFINISH] AS FINISH_OKLAD

        FROM [Kadry2024v2].[dbo].[O_HMEN01] H1

        LEFT JOIN [Kadry2024v2].[dbo].[O_WFL_01] WFl
        ON H1.[O_HMEN01_ID] = WFl.[O_HMEN01_ID] AND H1.[REGION_COD] = WFl.[REGION_COD]
        
        LEFT JOIN [Kadry2024v2].[dbo].[O_SRT] SRT
        ON WFl.[O_SRT_ID] = SRT.[O_SRT_ID] AND WfL.[REGION_COD] = SRT.[REGION_COD]
        
        LEFT JOIN [Kadry2024v2].[dbo].[O_OKLAD] OKLAD
        ON SRT.[O_REESTR_ID] = OKLAD.[O_REESTR_ID]
        
        WHERE WFl.[O_SRT_ID] IS NOT NULL AND WFl.[O_ORD_01_ID] IS NOT NULL

  ";

  ?>