<?php

$sql_rewards = " SELECT 
H1.[O_HMEN01_ID]
,H1.[REGION_COD]
,REWARDS.[O_HMEN16_ID]
,REWARDS.[M_AWD_03_ID] as REWARD_ID
,REWARD_NAME.[NAME] as REWARD_NAME
,REWARDS.[DATE] as REWARD_DATE
,REWARDS.[O_ORD_01_ID] as DOC_ID
,DOC_NAME.[NAME] as DOC_NAME
,DOC_NAME.[NUM] as DOC_NUM
,DOC_NAME.[DATE] as DOC_DATE
,REWARD_TYPE.[M_AWD_02_ID] as REWARD_TYPE_ID
,REWARD_TYPE.[NAME] as REWARD_TYPE_NAME

FROM [Kadry2024v2].[dbo].[O_HMEN01] H1

inner JOIN [Kadry2024v2].[dbo].[O_HMEN16] REWARDS
ON H1.[O_HMEN01_ID] = REWARDS.[O_HMEN01_ID] AND H1.[REGION_COD] = REWARDS.[REGION_COD]

LEFT JOIN [Kadry2024v2].[dbo].[M_AWD_03] REWARD_NAME
ON REWARDS.[M_AWD_03_ID] = REWARD_NAME.[M_AWD_03_ID]

LEFT JOIN [Kadry2024v2].[dbo].[M_AWD_02] REWARD_TYPE
ON REWARD_NAME.[M_AWD_02_ID] = REWARD_TYPE.[M_AWD_02_ID]

LEFT JOIN [Kadry2024v2].[dbo].[O_ORD_01] DOC_NAME
ON REWARDS.[REGION_COD] = DOC_NAME.[REGION_COD] and REWARDS.[O_ORD_01_ID] = DOC_NAME.[O_ORD_01_ID]

Order by H1.[REGION_COD], H1.[O_HMEN01_ID], REWARDS.[O_HMEN16_ID]
";

?>