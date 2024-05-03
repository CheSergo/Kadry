<?php

$sql_rewards2 = "SELECT 
H1.[O_HMEN01_ID]
,H1.[REGION_COD]
,H6.[O_HMEN06_ID]
,H6.[M_AWD_05_ID] as REWARD_ID
,H6.[ONDATE] as REWARD_DATE
,H6.[O_ORD_01_ID] as DOC_ID
,DOCS.[NAME] as DOC_NAME
,DOCS.[NUM] as DOC_NUM
,DOCS.[DATE] as DOC_DATE

FROM [Kadry2024v2].[dbo].[O_HMEN01] H1

inner join [Kadry2024v2].[dbo].[O_HMEN06] H6
on H1.[O_HMEN01_ID] = H6.[O_HMEN01_ID] and H1.[REGION_COD] = H6.[REGION_COD]

left join [Kadry2024v2].[dbo].[O_ORD_01] DOCS
ON H6.[REGION_COD] = DOCS.[REGION_COD] and H6.[O_ORD_01_ID] = DOCS.[O_ORD_01_ID]

Order by H1.[REGION_COD], H1.[O_HMEN01_ID]";

?>