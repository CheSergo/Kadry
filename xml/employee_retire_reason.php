<?php

$retire_array = array();

if (isset($contract['doljnosti_array'])) {
    foreach ($contract['doljnosti_array'] as $doljnost) {
        if (isset($doljnost['RETIRE_CODE'])) {
            array_push($retire_array, $doljnost['RETIRE_CODE']);
        }
    }
}

if(count($retire_array)) {
    switch (end($retire_array)) {
        case 116:
            $child_node_RetireReason = $dom->createElement('RetireReason', "33.1.3.00");
            $child_node_laborContract->appendChild($child_node_RetireReason);
            break;
        case 191:
            $child_node_RetireReason = $dom->createElement('RetireReason', "31.2");
            $child_node_laborContract->appendChild($child_node_RetireReason);
            break;
        case 167:
            $child_node_RetireReason = $dom->createElement('RetireReason', "33.1.1");
            $child_node_laborContract->appendChild($child_node_RetireReason);
            break;
        case 175:
            $child_node_RetireReason = $dom->createElement('RetireReason', "33.1.10");
            $child_node_laborContract->appendChild($child_node_RetireReason);
            break;
        case 253:
            $child_node_RetireReason = $dom->createElement('RetireReason', "33.1.11");
            $child_node_laborContract->appendChild($child_node_RetireReason);
            break;
        case 176:
            $child_node_RetireReason = $dom->createElement('RetireReason', "33.1.14");
            $child_node_laborContract->appendChild($child_node_RetireReason);
            break;
        case 168:
            $child_node_RetireReason = $dom->createElement('RetireReason', "33.1.2");
            $child_node_laborContract->appendChild($child_node_RetireReason);
            break;
        case 117:
            $child_node_RetireReason = $dom->createElement('RetireReason', "33.1.3");
            $child_node_laborContract->appendChild($child_node_RetireReason);
            break;
        case 178:
            $child_node_RetireReason = $dom->createElement('RetireReason', "33.1.3.0");
            $child_node_laborContract->appendChild($child_node_RetireReason);
            break;
        case 169:
            $child_node_RetireReason = $dom->createElement('RetireReason', "33.1.3");
            $child_node_laborContract->appendChild($child_node_RetireReason);
            break;
        case 170:
            $child_node_RetireReason = $dom->createElement('RetireReason', "33.1.4");
            $child_node_laborContract->appendChild($child_node_RetireReason);
            break;
        case 171:
            $child_node_RetireReason = $dom->createElement('RetireReason', "33.1.5");
            $child_node_laborContract->appendChild($child_node_RetireReason);
            break;
        case 172:
            $child_node_RetireReason = $dom->createElement('RetireReason', "33.1.6");
            $child_node_laborContract->appendChild($child_node_RetireReason);
            break;
        case 304:
            $child_node_RetireReason = $dom->createElement('RetireReason', "33.1.7");
            $child_node_laborContract->appendChild($child_node_RetireReason);
            break;
        case 173:
            $child_node_RetireReason = $dom->createElement('RetireReason', "33.1.8");
            $child_node_laborContract->appendChild($child_node_RetireReason);
            break;
        case 174:
            $child_node_RetireReason = $dom->createElement('RetireReason', "33.1.9");
            $child_node_laborContract->appendChild($child_node_RetireReason);
            break;
        case 226:
            $child_node_RetireReason = $dom->createElement('RetireReason', "33.1.3.2");
            $child_node_laborContract->appendChild($child_node_RetireReason);
            break;
        case 290:
            $child_node_RetireReason = $dom->createElement('RetireReason', "37.1.6");
            $child_node_laborContract->appendChild($child_node_RetireReason);
            break;
        case 294:
            $child_node_RetireReason = $dom->createElement('RetireReason', "37.1.7");
            $child_node_laborContract->appendChild($child_node_RetireReason);
            break;
        case 286:
            $child_node_RetireReason = $dom->createElement('RetireReason', "37.1.1.1");
            $child_node_laborContract->appendChild($child_node_RetireReason);
            break;
        case 283:
            $child_node_RetireReason = $dom->createElement('RetireReason', "37.1.2");
            $child_node_laborContract->appendChild($child_node_RetireReason);
            break;
        case 298:
            $child_node_RetireReason = $dom->createElement('RetireReason', "37.1.3");
            $child_node_laborContract->appendChild($child_node_RetireReason);
            break;
        case 303:
            $child_node_RetireReason = $dom->createElement('RetireReason', "37.1.3.1");
            $child_node_laborContract->appendChild($child_node_RetireReason);
            break;
        case 263:
            $child_node_RetireReason = $dom->createElement('RetireReason', "37.1.8.2");
            $child_node_laborContract->appendChild($child_node_RetireReason);
            break;
        case 279:
            $child_node_RetireReason = $dom->createElement('RetireReason', "37.1.8.3");
            $child_node_laborContract->appendChild($child_node_RetireReason);
            break;
        case 295:
            $child_node_RetireReason = $dom->createElement('RetireReason', "39.1.1");
            $child_node_laborContract->appendChild($child_node_RetireReason);
            break;
        case 302:
            $child_node_RetireReason = $dom->createElement('RetireReason', "39.2.1");
            $child_node_laborContract->appendChild($child_node_RetireReason);
            break;
        case 282:
            $child_node_RetireReason = $dom->createElement('RetireReason', "39.2.4");
            $child_node_laborContract->appendChild($child_node_RetireReason);
            break;
        case 266:
            $child_node_RetireReason = $dom->createElement('RetireReason', "39.3");
            $child_node_laborContract->appendChild($child_node_RetireReason);
            break;
        case 215:
            $child_node_RetireReason = $dom->createElement('RetireReason', "39.5");
            $child_node_laborContract->appendChild($child_node_RetireReason);
            break;
        case 285:
            $child_node_RetireReason = $dom->createElement('RetireReason', "59.2.1");
            $child_node_laborContract->appendChild($child_node_RetireReason);
            break;
        case 120:
            $child_node_RetireReason = $dom->createElement('RetireReason', "29.1");
            $child_node_laborContract->appendChild($child_node_RetireReason);
            break;
        case 148:
            $child_node_RetireReason = $dom->createElement('RetireReason', "71");
            $child_node_laborContract->appendChild($child_node_RetireReason);
            break;
        case 128:
            $child_node_RetireReason = $dom->createElement('RetireReason', "77.1");
            $child_node_laborContract->appendChild($child_node_RetireReason);
            break;
        case 147:
            $child_node_RetireReason = $dom->createElement('RetireReason', "77.11");
            $child_node_laborContract->appendChild($child_node_RetireReason);
            break;
        case 159:
            $child_node_RetireReason = $dom->createElement('RetireReason', "77.2");
            $child_node_laborContract->appendChild($child_node_RetireReason);
            break;
        case 165:
            $child_node_RetireReason = $dom->createElement('RetireReason', "77.3");
            $child_node_laborContract->appendChild($child_node_RetireReason);
            break;
        case 121:
            $child_node_RetireReason = $dom->createElement('RetireReason', "77.5");
            $child_node_laborContract->appendChild($child_node_RetireReason);
            break;
        case 142:
            $child_node_RetireReason = $dom->createElement('RetireReason', "77.6");
            $child_node_laborContract->appendChild($child_node_RetireReason);
            break;
        case 127:
            $child_node_RetireReason = $dom->createElement('RetireReason', "77.7");
            $child_node_laborContract->appendChild($child_node_RetireReason);
            break;
        case 143:
            $child_node_RetireReason = $dom->createElement('RetireReason', "77.8");
            $child_node_laborContract->appendChild($child_node_RetireReason);
            break;
        case 144:
            $child_node_RetireReason = $dom->createElement('RetireReason', "77.9");
            $child_node_laborContract->appendChild($child_node_RetireReason);
            break;
        case 280:
            $child_node_RetireReason = $dom->createElement('RetireReason', "77.1.4");
            $child_node_laborContract->appendChild($child_node_RetireReason);
            break;
        case 137:
            $child_node_RetireReason = $dom->createElement('RetireReason', "78");
            $child_node_laborContract->appendChild($child_node_RetireReason);
            break;
        case 156:
            $child_node_RetireReason = $dom->createElement('RetireReason', "80.0.2");
            $child_node_laborContract->appendChild($child_node_RetireReason);
            break;
        case 157:
            $child_node_RetireReason = $dom->createElement('RetireReason', "80.0.1");
            $child_node_laborContract->appendChild($child_node_RetireReason);
            break;
        case 164:
            $child_node_RetireReason = $dom->createElement('RetireReason', "80.0.4");
            $child_node_laborContract->appendChild($child_node_RetireReason);
            break;
        case 130:
            $child_node_RetireReason = $dom->createElement('RetireReason', "80.0.3");
            $child_node_laborContract->appendChild($child_node_RetireReason);
            break;
        case 131:
            $child_node_RetireReason = $dom->createElement('RetireReason', "80.0.6");
            $child_node_laborContract->appendChild($child_node_RetireReason);
            break;
        case 198:
            $child_node_RetireReason = $dom->createElement('RetireReason', "80.0.5");
            $child_node_laborContract->appendChild($child_node_RetireReason);
            break;
        case 124:
            $child_node_RetireReason = $dom->createElement('RetireReason', "81.1");
            $child_node_laborContract->appendChild($child_node_RetireReason);
            break;
        case 297:
            $child_node_RetireReason = $dom->createElement('RetireReason', "81.10");
            $child_node_laborContract->appendChild($child_node_RetireReason);
            break;
        case 138:
            $child_node_RetireReason = $dom->createElement('RetireReason', "81.2");
            $child_node_laborContract->appendChild($child_node_RetireReason);
            break;
        case 125:
            $child_node_RetireReason = $dom->createElement('RetireReason', "81.3");
            $child_node_laborContract->appendChild($child_node_RetireReason);
            break;
        case 139:
            $child_node_RetireReason = $dom->createElement('RetireReason', "81.5");
            $child_node_laborContract->appendChild($child_node_RetireReason);
            break;
        case 133:
            $child_node_RetireReason = $dom->createElement('RetireReason', "81.6.а");
            $child_node_laborContract->appendChild($child_node_RetireReason);
            break;
        case 140:
            $child_node_RetireReason = $dom->createElement('RetireReason', "81.6.в");
            $child_node_laborContract->appendChild($child_node_RetireReason);
            break;
        case 136:
            $child_node_RetireReason = $dom->createElement('RetireReason', "81.6.г");
            $child_node_laborContract->appendChild($child_node_RetireReason);
            break;
        case 141:
            $child_node_RetireReason = $dom->createElement('RetireReason', "81.6.д");
            $child_node_laborContract->appendChild($child_node_RetireReason);
            break;
        case 126:
            $child_node_RetireReason = $dom->createElement('RetireReason', "81.6");
            $child_node_laborContract->appendChild($child_node_RetireReason);
            break;
        case 134:
            $child_node_RetireReason = $dom->createElement('RetireReason', "81.7");
            $child_node_laborContract->appendChild($child_node_RetireReason);
            break;
        case 135:
            $child_node_RetireReason = $dom->createElement('RetireReason', "81.8");
            $child_node_laborContract->appendChild($child_node_RetireReason);
            break;
        case 75:
            $child_node_RetireReason = $dom->createElement('RetireReason', "83.1");
            $child_node_laborContract->appendChild($child_node_RetireReason);
            break;
        case 158:
            $child_node_RetireReason = $dom->createElement('RetireReason', "83.2");
            $child_node_laborContract->appendChild($child_node_RetireReason);
            break;
        case 145:
            $child_node_RetireReason = $dom->createElement('RetireReason', "83.3");
            $child_node_laborContract->appendChild($child_node_RetireReason);
            break;
        case 123:
            $child_node_RetireReason = $dom->createElement('RetireReason', "83.4");
            $child_node_laborContract->appendChild($child_node_RetireReason);
            break;
        case 146:
            $child_node_RetireReason = $dom->createElement('RetireReason', "83.5");
            $child_node_laborContract->appendChild($child_node_RetireReason);
            break;
        case 219:
            $child_node_RetireReason = $dom->createElement('RetireReason', "83.6");
            $child_node_laborContract->appendChild($child_node_RetireReason);
            break;
    
        default:
            $child_node_RetireReason = $dom->createElement('RetireReason', "-");
            $child_node_laborContract->appendChild($child_node_RetireReason);
            $str = $array['NAME']." ".$array['LSTNAME']." ".$array['FAMILY']." ".date('Y-m-d', strtotime($array['BIRTHDATE'])).' id должности - '.$array['REGION_COD'].'_'.$contract['SRT_ID']." "."M_ORD_02_ID - ".end($retire_array);
            file_put_contents("Retire_Reason_log.txt", $str."\n", FILE_APPEND);
            break;
    }
}
    