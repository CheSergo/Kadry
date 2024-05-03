<?php

$sql_addedu2 = "SELECT
ADD_EDU.[O_HMEN01_ID]
,ADD_EDU.[REGION_COD]
,ADD_EDU.[O_HMEN11_ID]
,ADD_EDU.[M_EDU_06_ID]
,ADD_EDU.[ORG]
,ADD_EDU.[SPECIAL]
,ADD_EDU.[DATEBEGIN]
,ADD_EDU.[DATEFINISH]

FROM [Kadry2024v2].[dbo].[O_HMEN01] H1

inner JOIN [Kadry2024v2].[dbo].[O_HMEN11] ADD_EDU
ON H1.[O_HMEN01_ID] = ADD_EDU.[O_HMEN01_ID] and H1.[REGION_COD] = ADD_EDU.[REGION_COD]

Order by H1.[REGION_COD],H1.[O_HMEN01_ID],ADD_EDU.[O_HMEN11_ID]
"

?>