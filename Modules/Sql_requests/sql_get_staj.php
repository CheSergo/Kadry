<?php

$sql_staj = "SELECT
WFl.[O_HMEN01_ID]
,WFl.[REGION_COD]
,WFl.[O_WFL_01_ID] as staj_ID
,WFl.[orgname] as STAJ_ORGANIZATION
,WFl.[dolgname] as STAJ_DOLJNOST
,WFl.[DATEBEGIN] as STAJ_BEGIN
,WFl.[DATEFINISH] as STAJ_END
,DOCS.[NAME] as doc_name
,DOCS.[NUM] as doc_num
,DOCS.[DATE] as doc_date
,TRUD_DOGOVOR.[NAME] as trud_name
,TRUD_DOGOVOR.[NUM] as trud_number
,TRUD_DOGOVOR.[DATE] as trud_date
,WFl.[M_ORD_01_ID] as OSNOVANIE_TYPE
,WFl.[M_ORD_02_ID] as OSNOVANIE_CODE
,WFLSTAG.[O_WFLSTAG_ID] as type_id
,WFLSTAG.[M_PRD_01_ID] as STAJ_TYPE
,WFLSTAG.[KOEF] as COEF


FROM [Kadry2024v2].[dbo].[O_HMEN01] H1

LEFT JOIN [Kadry2024v2].[dbo].[O_WFL_01] WFl
ON H1.[O_HMEN01_ID] = WFl.[O_HMEN01_ID] AND H1.[REGION_COD] = WFl.[REGION_COD]

LEFT JOIN [Kadry2024v2].[dbo].[O_ORD_01] DOCS
ON WFl.[O_ORD_01_ID] = DOCS.[O_ORD_01_ID] AND WFl.[REGION_COD] = DOCS.[REGION_COD]

left join [Kadry2024v2].[dbo].[O_ORD_01] TRUD_DOGOVOR
on WFl.[O_ORD_01_ID] = DOCS.[O_ORD_01_ID] and WFl.[REGION_COD] = DOCS.[REGION_COD] and DOCS.[M_ORD_03_ID] = 21

left join [Kadry2024v2].[dbo].[O_WFLSTAG] WFLSTAG
ON WFl.[REGION_COD] = WFLSTAG.[REGION_COD] AND WFl.[O_WFL_01_ID] = WFLSTAG.[O_WFL_01_ID]

WHERE WFl.[M_ORD_01_ID] != 11
and WFl.[M_ORD_01_ID] != 16
and WFl.[M_ORD_01_ID] != 24
and WFl.[M_ORD_01_ID] != 27
and WFl.[M_ORD_01_ID] != 38

order by H1.[REGION_COD], H1.[O_HMEN01_ID], staj_ID
";

?>