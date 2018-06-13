<?

    function url_encode($string){
        return urlencode(utf8_encode($string));
    }

    function url_decode($string){
        return utf8_decode(urldecode($string));
    }

function breakdate($date){
	 $fecha=strtotime($date);
	 $nuevafecha=date('Y-m-d', $fecha);
  	 $pieces_date=explode("-", $nuevafecha);
	 $fecha_datos=array();
	 $fecha_datos['year']=$pieces_date[0]; //year
	 $fecha_datos['month']=$pieces_date[1]; //month
	 $fecha_datos['day']=$pieces_date[2];  //day
return 	$fecha_datos;
}

/*function login($user,$pass){

	$sql="SELECT * FROM `".prefijo."users` WHERE username="$user"AND password=".$pass." AND active=1";

	return ($userid);
	}     */

 function formatear_fecha($date){
  $formato=strtotime($date);
  $fecha_format=date('D. F j, Y', $formato);

  return ($fecha_format);
 }

 function date_to_insert($date){
  $formato=strtotime($date);
  $fecha_format=date('Y-m-d', $formato);

  return ($fecha_format);
 }

 function calcula_numero_dia_semana($dia,$mes,$ano){
	$numerodiasemana = date('w', mktime(0,0,0,$mes,$dia,$ano));
	if ($numerodiasemana == 0)
		$numerodiasemana = 6;
	else
		$numerodiasemana--;
	return $numerodiasemana;
}

//funcion que devuelve el �ltimo d�a de un mes y a�o dados
function ultimoDia($mes,$ano){
    $ultimo_dia=28;
    while (checkdate($mes,$ultimo_dia + 1,$ano)){
       $ultimo_dia++;
    }
    return $ultimo_dia;
}

function dame_nombre_mes($mes){
	 switch ($mes){
	 	case 1:
			$nombre_mes="January";
			break;
	 	case 2:
			$nombre_mes="February";
			break;
	 	case 3:
			$nombre_mes="March";
			break;
	 	case 4:
			$nombre_mes="April";
			break;
	 	case 5:
			$nombre_mes="May";
			break;
	 	case 6:
			$nombre_mes="June";
			break;
	 	case 7:
			$nombre_mes="July";
			break;
	 	case 8:
			$nombre_mes="August";
			break;
	 	case 9:
			$nombre_mes="September";
			break;
	 	case 10:
			$nombre_mes="October";
			break;
	 	case 11:
			$nombre_mes="November";
			break;
	 	case 12:
			$nombre_mes="December";
			break;
	}
	return $nombre_mes;
}

function datediff($interval, $datefrom, $dateto, $using_timestamps = false)
{



	if (!$using_timestamps) {
		$datefrom = strtotime($datefrom, 0);
		$dateto = strtotime($dateto, 0);
	}
	$difference = $dateto - $datefrom; // Difference in seconds

	switch($interval) {
		case 'yyyy': // Number of full years
		$years_difference = floor($difference / 31536000);
		if (mktime(date("H", $datefrom),
                              date("i", $datefrom),
                              date("s", $datefrom),
                              date("n", $datefrom),
                              date("j", $datefrom),
                              date("Y", $datefrom)+$years_difference) > $dateto) {

		$years_difference--;
		}
		if (mktime(date("H", $dateto),
                              date("i", $dateto),
                              date("s", $dateto),
                              date("n", $dateto),
                              date("j", $dateto),
                              date("Y", $dateto)-($years_difference+1)) > $datefrom) {

		$years_difference++;
		}
		$datediff = $years_difference;
		break;

		case "q": // Number of full quarters
		$quarters_difference = floor($difference / 8035200);
		while (mktime(date("H", $datefrom),
                                   date("i", $datefrom),
                                   date("s", $datefrom),
                                   date("n", $datefrom)+($quarters_difference*3),
                                   date("j", $dateto),
                                   date("Y", $datefrom)) < $dateto) {

		$months_difference++;
		}
		$quarters_difference--;
		$datediff = $quarters_difference;
		break;

		case "ww": // Number of full weeks
		$datediff = floor($difference / (60*60*24));
		break;

  		case "d": // Number of full days - ing.joseluis@msn.com
		$datediff = floor($difference / 86400);
		break;

		case "h": // Number of full hours
		$datediff = floor($difference / 3600);
		break;

		case "n": // Number of full minutes
		$datediff = floor($difference / 60);
		break;

		default: // Number of full seconds (default)
		$datediff = $difference;
		break;
	}

	return $datediff;
}


function display($page){
	require_once(TEMP_DIR.HEAD);
	require_once(DIR_PAGE."page-".$page.PHP_EXT);
	require_once(TEMP_DIR.FOOTER);
	}
function display_1($page){
	require_once(TEMP_DIR.HEAD_SIMPLE);
	require_once(DIR_PAGE."page-".$page.PHP_EXT);
	require_once(TEMP_DIR.FOOTER_SIMPLE);
	}

function countryArray(){

	return array(
	'CA'=>'Canada',
	'US'=>'United States',
	'DO'=>'Dominican Republic',
    'NO'=>'Norway',
	'UK'=>'United Kingdom',
    'DE'=>'Germany',
    'FR'=>'France',
    'ES'=>'Spain',
	'AF'=>'Afghanistan',
	'AL'=>'Albania',
	'DZ'=>'Algeria',
	'AS'=>'American Samoa',
	'AD'=>'Andorra',
	'AO'=>'Angola',
	'AI'=>'Anguilla',
	'AQ'=>'Antarctica',
	'AG'=>'Antigua And Barbuda',
	'AR'=>'Argentina',
	'AM'=>'Armenia',
	'AW'=>'Aruba',
	'AU'=>'Australia',
	'AT'=>'Austria',
	'AZ'=>'Azerbaijan',
	'BS'=>'Bahamas',
	'BH'=>'Bahrain',
	'BD'=>'Bangladesh',
	'BB'=>'Barbados',
	'BY'=>'Belarus',
	'BE'=>'Belgium',
	'BZ'=>'Belize',
	'BJ'=>'Benin',
	'BM'=>'Bermuda',
	'BT'=>'Bhutan',
	'BO'=>'Bolivia',
	'BA'=>'Bosnia And Herzegovina',
	'BW'=>'Botswana',
	'BV'=>'Bouvet Island',
	'BR'=>'Brazil',
	'IO'=>'British Indian Ocean Territory',
	'BN'=>'Brunei',
	'BG'=>'Bulgaria',
	'BF'=>'Burkina Faso',
	'BI'=>'Burundi',
	'KH'=>'Cambodia',
	'CM'=>'Cameroon',
 	'CV'=>'Cape Verde',
	'KY'=>'Cayman Islands',
	'CF'=>'Central African Republic',
	'TD'=>'Chad',
	'CL'=>'Chile',
	'CN'=>'China',
	'CX'=>'Christmas Island',
	'CC'=>'Cocos (Keeling) Islands',
	'CO'=>'Columbia',
	'KM'=>'Comoros',
	'CG'=>'Congo',
	'CK'=>'Cook Islands',
	'CR'=>'Costa Rica',
	'CI'=>'Cote D\'Ivorie (Ivory Coast)',
	'HR'=>'Croatia (Hrvatska)',
	'CU'=>'Cuba',
	'CY'=>'Cyprus',
	'CZ'=>'Czech Republic',
	'CD'=>'Democratic Republic Of Congo (Zaire)',
	'DK'=>'Denmark',
	'DJ'=>'Djibouti',
	'DM'=>'Dominica',
 	'TP'=>'East Timor',
	'EC'=>'Ecuador',
	'EG'=>'Egypt',
	'SV'=>'El Salvador',
	'GQ'=>'Equatorial Guinea',
	'ER'=>'Eritrea',
	'EE'=>'Estonia',
	'ET'=>'Ethiopia',
	'FK'=>'Falkland Islands (Malvinas)',
	'FO'=>'Faroe Islands',
	'FJ'=>'Fiji',
	'FI'=>'Finland',
 	'FX'=>'France, Metropolitan',
	'GF'=>'French Guinea',
	'PF'=>'French Polynesia',
	'TF'=>'French Southern Territories',
	'GA'=>'Gabon',
	'GM'=>'Gambia',
	'GE'=>'Georgia',
 	'GH'=>'Ghana',
	'GI'=>'Gibraltar',
	'GR'=>'Greece',
	'GL'=>'Greenland',
	'GD'=>'Grenada',
	'GP'=>'Guadeloupe',
	'GU'=>'Guam',
	'GT'=>'Guatemala',
	'GN'=>'Guinea',
	'GW'=>'Guinea-Bissau',
	'GY'=>'Guyana',
	'HT'=>'Haiti',
	'HM'=>'Heard And McDonald Islands',
	'HN'=>'Honduras',
	'HK'=>'Hong Kong',
	'HU'=>'Hungary',
	'IS'=>'Iceland',
	'IN'=>'India',
	'ID'=>'Indonesia',
	'IR'=>'Iran',
	'IQ'=>'Iraq',
	'IE'=>'Ireland',
	'EI'=>'Ireland (Eire)',
	'IL'=>'Israel',
	'IT'=>'Italy',
	'JM'=>'Jamaica',
	'JP'=>'Japan',
	'JO'=>'Jordan',
	'KZ'=>'Kazakhstan',
	'KE'=>'Kenya',
	'KI'=>'Kiribati',
	'KW'=>'Kuwait',
	'KG'=>'Kyrgyzstan',
	'LA'=>'Laos',
	'LV'=>'Latvia',
	'LB'=>'Lebanon',
	'LS'=>'Lesotho',
	'LR'=>'Liberia',
	'LY'=>'Libya',
	'LI'=>'Liechtenstein',
	'LT'=>'Lithuania',
	'LU'=>'Luxembourg',
	'MO'=>'Macau',
	'MK'=>'Macedonia',
	'MG'=>'Madagascar',
	'MW'=>'Malawi',
	'MY'=>'Malaysia',
	'MV'=>'Maldives',
	'ML'=>'Mali',
	'MT'=>'Malta',
	'MH'=>'Marshall Islands',
	'MQ'=>'Martinique',
	'MR'=>'Mauritania',
	'MU'=>'Mauritius',
	'YT'=>'Mayotte',
	'MX'=>'Mexico',
	'FM'=>'Micronesia',
	'MD'=>'Moldova',
	'MC'=>'Monaco',
	'MN'=>'Mongolia',
	'MS'=>'Montserrat',
	'MA'=>'Morocco',
	'MZ'=>'Mozambique',
	'MM'=>'Myanmar (Burma)',
	'NA'=>'Namibia',
	'NR'=>'Nauru',
	'NP'=>'Nepal',
	'NL'=>'Netherlands',
	'AN'=>'Netherlands Antilles',
	'NC'=>'New Caledonia',
	'NZ'=>'New Zealand',
	'NI'=>'Nicaragua',
	'NE'=>'Niger',
	'NG'=>'Nigeria',
	'NU'=>'Niue',
	'NF'=>'Norfolk Island',
	'KP'=>'North Korea',
	'MP'=>'Northern Mariana Islands',
 	'OM'=>'Oman',
	'PK'=>'Pakistan',
	'PW'=>'Palau',
	'PA'=>'Panama',
	'PG'=>'Papua New Guinea',
	'PY'=>'Paraguay',
	'PE'=>'Peru',
	'PH'=>'Philippines',
	'PN'=>'Pitcairn',
	'PL'=>'Poland',
	'PT'=>'Portugal',
	'PR'=>'Puerto Rico',
	'QA'=>'Qatar',
	'RE'=>'Reunion',
	'RO'=>'Romania',
	'RU'=>'Russia',
	'RW'=>'Rwanda',
	'SH'=>'Saint Helena',
	'KN'=>'Saint Kitts And Nevis',
	'LC'=>'Saint Lucia',
	'PM'=>'Saint Pierre And Miquelon',
	'VC'=>'Saint Vincent And The Grenadines',
	'SM'=>'San Marino',
	'ST'=>'Sao Tome And Principe',
	'SA'=>'Saudi Arabia',
	'SN'=>'Senegal',
	'SC'=>'Seychelles',
	'SL'=>'Sierra Leone',
	'SG'=>'Singapore',
	'SK'=>'Slovak Republic',
	'SI'=>'Slovenia',
	'SB'=>'Solomon Islands',
	'SO'=>'Somalia',
	'ZA'=>'South Africa',
	'GS'=>'South Georgia And South Sandwich Islands',
	'KR'=>'South Korea',
    'LK'=>'Sri Lanka',
	'SD'=>'Sudan',
	'SR'=>'Suriname',
	'SJ'=>'Svalbard And Jan Mayen',
	'SZ'=>'Swaziland',
	'SE'=>'Sweden',
	'CH'=>'Switzerland',
	'SY'=>'Syria',
	'TW'=>'Taiwan',
	'TJ'=>'Tajikistan',
	'TZ'=>'Tanzania',
	'TH'=>'Thailand',
	'TG'=>'Togo',
	'TK'=>'Tokelau',
	'TO'=>'Tonga',
	'TT'=>'Trinidad And Tobago',
	'TN'=>'Tunisia',
	'TR'=>'Turkey',
	'TM'=>'Turkmenistan',
	'TC'=>'Turks And Caicos Islands',
	'TV'=>'Tuvalu',
	'UG'=>'Uganda',
	'UA'=>'Ukraine',
	'AE'=>'United Arab Emirates',
 	'UM'=>'United States Minor Outlying Islands',
	'UY'=>'Uruguay',
	'UZ'=>'Uzbekistan',
	'VU'=>'Vanuatu',
	'VA'=>'Vatican City (Holy See)',
	'VE'=>'Venezuela',
	'VN'=>'Vietnam',
	'VG'=>'Virgin Islands (British)',
	'VI'=>'Virgin Islands (US)',
	'WF'=>'Wallis And Futuna Islands',
	'EH'=>'Western Sahara',
	'WS'=>'Western Samoa',
	'YE'=>'Yemen',
	'YU'=>'Yugoslavia',
	'ZM'=>'Zambia',
	'ZW'=>'Zimbabwe'
	);
}

function cities($country){
    switch ($country){

    	case "US":
    		return array(
						'un'=>'Unknown',
    					'AB'=>'Alabama',
						'AL'=>'Alaska',
						'AS'=>'American Samoa',
						'AR'=>'Arizona',
						'AK'=>'Arkansas',
						'CA'=>'California',
						'CO'=>'Colorado',
						'CN'=>'Connecticut',
						'DE'=>'Delaware',
						'DC'=>'District of Columbia',
						'FL'=>'Florida',
						'GE'=>'Georgia',
						'GU'=>'Guam',
						'HA'=>'Hawaii',
						'ID'=>'Idaho',
						'IL'=>'Illinois',
						'IN'=>'Indiana',
						'IO'=>'Iowa',
						'KA'=>'Kansas',
						'KE'=>'Kentucky',
						'LO'=>'Louisiana',
						'MA'=>'Maine',
						'ML'=>'Maryland',
						'MS'=>'Massachusetts',
						'MI'=>'Michigan',
						'MN'=>'Minnesota',
						'MP'=>'Mississippi',
						'Mu'=>'Missouri',
						'MO'=>'Montana',
						'NE'=>'Nebraska',
						'NV'=>'Nevada',
						'NH'=>'New Hampshire',
						'NJ'=>'New Jersey',
						'NM'=>'New Mexico',
						'NY'=>'New York',
						'NC'=>'North Carolina',
						'ND'=>'North Dakota',
						'NI'=>'Northern Marianas Islands',
						'OH'=>'Ohio',
						'OK'=>'Oklahoma',
						'OR'=>'Oregon',
						'PE'=>'Pennsylvania',
						'PR'=>'Puerto Rico',
						'RI'=>'Rhode Island',
						'SC'=>'South Carolina',
						'SD'=>'South Dakota',
						'TE'=>'Tennessee',
						'TX'=>'Texas',
						'UT'=>'Utah',
						'VE'=>'Vermont',
						'VI'=>'Virginia',
						'VS'=>'Virgin Islands',
						'WA'=>'Washington',
						'WV'=>'West Virginia',
						'WI'=>'Wisconsin',
						'WY'=>'Wyoming'
				);
			break;
		case "CA":
    		return array(
					'un'=>'Unknown',
		    		'AL'=>'Alberta',
					'BC'=>'British Columbia',
					'MA'=>'Manitoba',
					'NB'=>'New Brunswick',
					'NL'=>'Newfoundland and Labrador',
					'NT'=>'Northwest Territories',
					'NS'=>'Nova Scotia',
					'NU'=>'Nunavut',
					'ON'=>'Ontario',
					'PI'=>'Prince Edward Island',
					'QU'=>'Quebec',
					'SA'=>'Saskatchewan',
					'YU'=>'Yukon Territory'
				);
			break;

		case "DO":
    		return array(
				'un'=>'Unknown',
    			'DN'=>'DN-Santo Domingo',
				'AZ'=>'Azua',
				'BA'=>'Bahoruco-Neiba',
				'BH'=>'Barahona',
				'DA'=>'Dajabon',
				'DU'=>'Duarte-San Francisco de Macoris',
				'ES'=>'El Seibo',
				'EP'=>'Elias Pi&ntilde;a-Comendador',
				'MO'=>'Espaillat-Moca',
				'HM'=>'Hato Mayor',
				'SA'=>'Hermanas Mirabal-Salcedo',
				'IJ'=>'Independencia-Jimani',
				'LA'=>'La Altagracia-Higuey',
				'LR'=>'La Romana',
				'LV'=>'La Vega',
				'NA'=>'Maria Trinidad Sanchez-Nagua',
				'BO'=>'Monse&ntilde;or Nouel-Bonao',
				'MC'=>'Monte Cristi',
				'MP'=>'Monte Plata',
				'PE'=>'Pedernales',
				'PB'=>'Peravia-Bani',
				'PP'=>'Puerto Plata',
				'SA'=>'Samana',
				'SC'=>'San Cristobal',
				'SO'=>'San Jose de Ocoa',
				'SJ'=>'San Juan',
				'SP'=>'San Pedro de Macoris',
				'CO'=>'Sanchez Ramirez-Cotui',
				'SG'=>'Santiago',
				'SS'=>'Santiago Rodriguez-Sabaneta',
				'SD'=>'Santo Domingo-Sto. Dgo Este',
				'VM'=>'Valverde-Mao'
				);
			break;
			case "AU":
    		return array(
				'un'=>'Unknown',
                'AAT'=>'Australian Antarctic Territory',
				'ACT'=>'Australian Capital Territory',
				'NT'=>'Northern Territory',
				'NSW'=>'New South Wales',
				'QLD'=>'Queensland',
				'SA'=>'South Australia',
				'TAS'=>'Tasmania',
				'VIC'=>'Victoria',
				'WA'=>'Western Australia'
				);
			break;
			case "BR":
    		return array(
				'un'=>'Unknown',
                'AC'=>'Acre',
				'AL'=>'Alagoas',
				'AM'=>'Amazonas',
				'AP'=>'Amapa',
				'BA'=>'Baia',
				'CE'=>'Ceara',
				'DF'=>'Distrito Federal',
				'ES'=>'Espirito Santo',
				'FN'=>'Fernando de Noronha',
				'GO'=>'Goias',
				'MA'=>'Maranhao',
				'MG'=>'Minas Gerais',
				'MS'=>'Mato Grosso do Sul',
				'MT'=>'Mato Grosso',
				'PA'=>'Para',
				'PB'=>'Paraiba',
				'PE'=>'Pernambuco',
				'PI'=>'Piaui',
				'PR'=>'Parana',
				'RJ'=>'Rio de Janeiro',
				'RN'=>'Rio Grande do Norte',
				'RO'=>'Rondonia',
				'RR'=>'Roraima',
				'RS'=>'Rio Grande do Sul',
				'SC'=>'Santa Catarina',
				'SE'=>'Sergipe',
				'SP'=>'Sao Paulo',
				'TO'=>'Tocatins'
				);
			break;
			case "NL":
    		return array(
				'un'=>'Unknown',
                'DR'=>'Drente',
				'FL'=>'Flevoland',
				'FR'=>'Friesland',
				'GL'=>'Gelderland',
				'GR'=>'Groningen',
				'LB'=>'Limburg',
				'NB'=>'Noord Brabant',
				'NH'=>'Noord Holland',
				'OV'=>'Overijssel',
				'UT'=>'Utrecht',
				'ZH'=>'Zuid Holland',
				'ZL'=>'Zeeland'
				);
			break;
			case "UK":
    		return array(
				'un'=>'Unknown',
                'AVON'=>'Avon',
				'BEDS'=>'Bedfordshire',
				'BERKS'=>'Berkshire',
				'BUCKS'=>'Buckinghamshire',
				'CAMBS'=>'Cambridgeshire',
				'CHESH'=>'Cheshire',
				'CLEVE'=>'Cleveland',
				'CORN'=>'Cornwall',
				'CUMB'=>'Cumbria',
				'DERBY'=>'Derbyshire',
				'DEVON'=>'Devon',
				'DORSET'=>'Dorset',
				'DURHAM'=>'Durham',
				'ESSEX'=>'Essex',
				'GLOUS'=>'Gloucestershire',
				'GLONDON'=>'Greater London',
				'GMANCH'=>'Greater Manchester',
				'HANTS'=>'Hampshire',
				'HERWOR'=>'Hereford & Worcestershire',
				'HERTS'=>'Hertfordshire',
				'HUMBER'=>'Humberside',
				'IOM'=>'Isle of Man',
				'IOW'=>'Isle of Wight',
				'KENT'=>'Kent',
				'LANCS'=>'Lancashire',
				'LEICS'=>'Leicestershire',
				'LINCS'=>'Lincolnshire',
				'MERSEY'=>'Merseyside',
				'NORF'=>'Norfolk',
				'NHANTS'=>'Northamptonshire',
				'NTHUMB'=>'Northumberland',
				'NOTTS'=>'Nottinghamshire',
				'OXON'=>'Oxfordshire',
				'SHROPS'=>'Shropshire',
				'SOM'=>'Somerset',
				'STAFFS'=>'Staffordshire',
				'SUFF'=>'Suffolk',
				'SURREY'=>'Surrey',
				'SUSS'=>'Sussex',
				'WARKS'=>'Warwickshire',
				'WMID'=>'West Midlands',
				'WILTS'=>'Wiltshire',
				'YORK'=>'Yorkshire'

				);
			break;
			case "EI": //Irland (Eire)
    		return array(
				'un'=>'Unknown',
    			'CO ANTRIM'=>'County Antrim',
				'CO ARMAGH'=>'County Armagh',
				'CO DOWN'=>'County Down',
				'CO FERMANAGH'=>'County Fermanagh',
				'CO DERRY'=>'County Londonderry',
				'CO TYRONE'=>'County Tyrone',
				'CO CAVAN'=>'County Cavan',
				'CO DONEGAL'=>'County Donegal',
				'CO MONAGHAN'=>'County Monaghan',
				'CO DUBLIN'=>'County Dublin',
				'CO CARLOW'=>'County Carlow',
				'CO KILDARE'=>'County Kildare',
				'CO KILKENNY'=>'County Kilkenny',
				'CO LAOIS'=>'County Laois',
				'CO LONGFORD'=>'County Longford',
				'CO LOUTH'=>'County Louth',
				'CO MEATH'=>'County Meath',
				'CO OFFALY'=>'County Offaly',
				'CO WESTMEATH'=>'County Westmeath',
				'CO WEXFORD'=>'County Wexford',
				'CO WICKLOW'=>'County Wicklow',
				'CO GALWAY'=>'County Galway',
				'CO MAYO'=>'County Mayo',
				'CO LEITRIM'=>'County Leitrim',
				'CO ROSCOMMON'=>'County Roscommon',
				'CO SLIGO'=>'County Sligo',
				'CO CLARE'=>'County Clare',
				'CO CORK'=>'County Cork',
				'CO KERRY'=>'County Kerry',
				'CO LIMERICK'=>'County Limerick',
				'CO TIPPERARY'=>'County Tipperary',
				'CO WATERFORD'=>'County Waterford'
				);
			break;
      /*
       default:
    		return array(
		    		'AL'=>'Alberta',
					'BC'=>'British Columbia',
					'MA'=>'Manitoba',
					'NB'=>'New Brunswick',
					'NL'=>'Newfoundland and Labrador',
					'NT'=>'Northwest Territories',
					'NS'=>'Nova Scotia',
					'NU'=>'Nunavut',
					'ON'=>'Ontario',
					'PI'=>'Prince Edward Island',
					'QU'=>'Quebec',
					'SA'=>'Saskatchewan',
					'YU'=>'Yukon Territory'
				);
			break; */

    }

}

function languageArray(){

	return array(
	'EN'=>'English',
	'SP'=>'Spanish',
	'FR'=>'French',
	'NO'=>'Norwegian',
	'DE'=>'German',
	'NL'=>'Nederlands',
	'IT'=>'Italian',
	'RU'=>'Russian',
	'CH'=>'Chinese',
	'JP'=>'Japanese',
	'MO'=>'Others'

	);
}

	function  validate_telephone_number($number){
	$formats  = array('###-###-####', '####-###-###', '(###) ###-####', '####-####-####', '##-###-####-####', '####-####', '###########','#-###-###-####', '##########', '+#-###-###-####', '-#-###-###-####', '(###)#######', '#(###)#######', '+#(###)#######');

	$format = trim(ereg_replace("[0-9]", "#", $number));

	return (in_array($format, $formats)) ? true : false;
	}

	function  validate_cedula($number){
	$formats  = array('###-#######-#', '###########');

	$format = trim(ereg_replace("[0-9]", "#", $number));

	return (in_array($format, $formats)) ? true : false;
	}


function valName($name){
	$name = preg_replace('�/[\s]+/is�, � �', $name);
    $name = trim($name);
	return preg_match('�/^[a-z\s]+$/i�', $name);
}



function normalize ($string) {
    $table = array(
        '�'=>'S', '�'=>'s', '�'=>'Dj', 'd'=>'dj', '�'=>'Z', '�'=>'z', 'C'=>'C', 'c'=>'c', 'C'=>'C', 'c'=>'c',
        '�'=>'A', '�'=>'A', '�'=>'A', '�'=>'A', '�'=>'A', '�'=>'A', '�'=>'A', '�'=>'C', '�'=>'E', '�'=>'E',
        '�'=>'E', '�'=>'E', '�'=>'I', '�'=>'I', '�'=>'I', '�'=>'I', '�'=>'N', '�'=>'O', '�'=>'O', '�'=>'O',
        '�'=>'O', '�'=>'O', '�'=>'O', '�'=>'U', '�'=>'U', '�'=>'U', '�'=>'U', '�'=>'Y', '�'=>'B', '�'=>'Ss',
        '�'=>'a', '�'=>'a', '�'=>'a', '�'=>'a', '�'=>'a', '�'=>'a', '�'=>'a', '�'=>'c', '�'=>'e', '�'=>'e',
        '�'=>'e', '�'=>'e', '�'=>'i', '�'=>'i', '�'=>'i', '�'=>'i', '�'=>'o', '�'=>'n', '�'=>'o', '�'=>'o',
        '�'=>'o', '�'=>'o', '�'=>'o', '�'=>'o', '�'=>'u', '�'=>'u', '�'=>'u', '�'=>'y', '�'=>'y', '�'=>'b',
        '�'=>'y', 'R'=>'R', 'r'=>'r',
    );

    return strtr($string, $table);
}

function validate_texto($nombre){
	//$nombre=eliminar_acentos($nombre);
	$result=preg_match("#^[-A-Za-z' ]*$#",$nombre);

	return $result;
}

function isLength($s,$min,$max){ //string_to_be_validate,minimum_length,maximum_length
    $curLength = strlen($s);
    return (($curLength >= (int)($min)) && ($curLength <= (int)($max)))? true : false;
}

function dayPeriod($ending, $starting){ //SAME AS NIGHT QTY FUNCTIONS
      $inicio=strtotime($starting); //return in seconds the introduced date
      $final=strtotime($ending);

      $result=floor(($final-$inicio)/(60*60*24));

     return $result;
   }

function daysDifference2($endDate, $beginDate){ //WITHOUT 2 THIS FUNCTION IS DUPLICATED-this work fine but with warnings sometimes if not add @ begining


	   //explode the date by "-" and storing to array
	   $date_parts1=explode("-", $beginDate);
	   $date_parts2=explode("-", $endDate);
	   //gregoriantojd() Converts a Gregorian date to Julian Day Count
	   $start_date=gregoriantojd($date_parts1[1], $date_parts1[2], $date_parts1[0]);
	   $end_date=gregoriantojd($date_parts2[1], $date_parts2[2], $date_parts2[0]);
	   return $end_date - $start_date;
   }

function  validate_date($date){ //well only check numbers no dates exactly
	$formats  = array('####-##-##');

	$format = trim(ereg_replace("[0-9]", "#", $date));

	return (in_array($format, $formats)) ? true : false;
}

function IsDate($Str)   //no working propertly
{
  $Stamp = strtotime( $Str );
  $Month = date( 'm', $Stamp );
  $Day   = date( 'd', $Stamp );
  $Year  = date( 'Y', $Stamp );

  return checkdate( $Month, $Day, $Year );
}

function is_date($date) //this function is wonderful to check any date
    {
        $date = str_replace(array('\'', '-', '.', ','), '/', $date);
        $date = explode('/', $date);

        if(    count($date) == 1 // No tokens
            and    is_numeric($date[0])
            and    $date[0] < 20991231 and
            (    checkdate(substr($date[0], 4, 2)
                        , substr($date[0], 6, 2)
                        , substr($date[0], 0, 4)))
        )
        {
            return true;
        }

        if(    count($date) == 3
            and    is_numeric($date[0])
            and    is_numeric($date[1])
            and is_numeric($date[2]) and
            (    checkdate($date[0], $date[1], $date[2]) //mmddyyyy
            or    checkdate($date[1], $date[0], $date[2]) //ddmmyyyy
            or    checkdate($date[1], $date[2], $date[0])) //yyyymmdd
        )
        {
            return true;
        }

        return false;
    }

/*=============================================================================================*/
 function send_email_smtp($from, $to, $subject, $body){
  require_once("Mail.php");

	//$from = "Your Name <email@blahblah.com>";
	//$to = "Their Name <ing.joseluis@msn.com>";
	//$subject = "Subject";


	//$host = "mailserver.blahblah.com";
	$host = "smtp.ent.lyse.net";
	$username = "smtp_username";
	$password = "smtp_password";

	$headers = array('From' => $from, 'To' => $to, 'Subject' => $subject, 'MIME-Version' => '1.0',
	        'Content-Type' => "text/html; charset=ISO-8859-1");

	$smtp = Mail::factory('smtp', array ('host' => $host,
	                                     'auth' => false,
	                                     'username' => $username,
	                                     'password' => $password));

	$mail = $smtp->send($to, $headers, $body);
 }
 /*=============================================================================================*/
/* function send_email_smtp_bcc($from, $to, $subject, $body){
  require_once("Mail.php");

	//$from = "Your Name <email@blahblah.com>";
	//$to = "Their Name <ing.joseluis@msn.com>";
	//$subject = "Subject";


	//$host = "mailserver.blahblah.com";
	$host = "smtp.ent.lyse.net";
	$username = "smtp_username";
	$password = "smtp_password";

	$headers = array('From' => $from, 'To' => $to, 'Subject' => $subject, 'MIME-Version' => '1.0',
	        'Content-Type' => "text/html; charset=ISO-8859-1","Bcc: ".ADMIN_EMAIL);

	$smtp = Mail::factory('smtp', array ('host' => $host,
	                                     'auth' => false,
	                                     'username' => $username,
	                                     'password' => $password));

	$mail = $smtp->send($to, $headers, $body);
 }

 function send_email_smtp_cc($from, $to, $subject, $body){
  require_once("Mail.php");

	//$from = "Your Name <email@blahblah.com>";
	//$to = "Their Name <ing.joseluis@msn.com>";
	//$subject = "Subject";


	//$host = "mailserver.blahblah.com";
	$host = "smtp.ent.lyse.net";
	$username = "smtp_username";
	$password = "smtp_password";

	$headers = array('From' => $from, 'To' => $to, 'Subject' => $subject, 'MIME-Version' => '1.0',
	        'Content-Type' => "text/html; charset=ISO-8859-1","Bcc: ".ADMIN_EMAIL,"CC: ".RESERVATIONS_EMAIL);

	$smtp = Mail::factory('smtp', array ('host' => $host,
	                                     'auth' => false,
	                                     'username' => $username,
	                                     'password' => $password));

	$mail = $smtp->send($to, $headers, $body);
 } */
 /*=============================================================================================*/
    function sendMail($body, $address, $subject, $from_add, $from_name) {
      /*
		$extra_header  = '';
		$extra_header  .= "MIME-Version: 1.0\n";
		$extra_header  .= "Content-type: text/html; charset=utf-8\n";
		$extra_header  .= "Content-transfer-encoding: 8bit\n";
		$extra_header  .= "Date: ". date('r'). "\n";
		$extra_header  .= "X-Priority: 3\n";   // send email with high priority; 3 is normal, 1 is high and 5 is de lowest.
		$extra_header  .= "X-Mailer: PHP\n";
		$extra_header  .= "X-MSMail-Priority: Normal\n";
		$extra_header  .= "From: $from_name <$from_add>\n";
		$extra_header  .= "Reply-to: <$from_add>\n";
		$extra_header  .= "Return-path: $from_name <$from_add>\n";
		$extra_header  .= "Bcc: ".ADMIN_EMAIL."\n";


		$mailsend = mail($address, $subject, $body, $extra_header);
        */               $from="$from_name <$from_add>";
        send_email_smtp($from, $to=ADMIN_EMAIL, $subject, $body);
        send_email_smtp($from, $to=$address, $subject, $body);
		return true;

	}

	function sendMail_copy_reservations($body, $address, $subject, $from_add, $from_name) {
       /*
		$extra_header  = '';
		$extra_header  .= "MIME-Version: 1.0\n";
		$extra_header  .= "Content-type: text/html; charset=utf-8\n";
		$extra_header  .= "Content-transfer-encoding: 8bit\n";
		$extra_header  .= "Date: ". date('r'). "\n";
		$extra_header  .= "X-Priority: 3\n";   // send email with high priority; 3 is normal, 1 is high and 5 is de lowest.
		$extra_header  .= "X-Mailer: PHP\n";
		$extra_header  .= "X-MSMail-Priority: Normal\n";
		$extra_header  .= "From: $from_name <$from_add>\n";
		$extra_header  .= "Reply-to: <$from_add>\n";
		$extra_header  .= "Return-path: $from_name <$from_add>\n";
		$extra_header  .= "Bcc: ".ADMIN_EMAIL."\n";
		$extra_header  .= "CC: ".RESERVATIONS_EMAIL."\n";


		$mailsend = mail($address, $subject, $body, $extra_header);
         */
          $from="$from_name <$from_add>";
        send_email_smtp($from, $to=ADMIN_EMAIL, $subject, $body);
        send_email_smtp($from, $to=RESERVATIONS_EMAIL, $subject, $body);
        send_email_smtp($from, $to=$address, $subject, $body);
		return true;

	}

	function sendMail_no_copies($body, $address, $subject, $from_add, $from_name) {
       /*
		$extra_header  = '';
		$extra_header  .= "MIME-Version: 1.0\n";
		$extra_header  .= "Content-type: text/html; charset=utf-8\n";
		$extra_header  .= "Content-transfer-encoding: 8bit\n";
		$extra_header  .= "Date: ". date('r'). "\n";
		$extra_header  .= "X-Priority: 3\n";   // send email with high priority; 3 is normal, 1 is high and 5 is de lowest.
		$extra_header  .= "X-Mailer: PHP\n";
		$extra_header  .= "X-MSMail-Priority: Normal\n";
		$extra_header  .= "From: $from_name <$from_add>\n";
		$extra_header  .= "Reply-to: <$from_add>\n";
		$extra_header  .= "Return-path: $from_name <$from_add>\n";
		//$extra_header  .= "Bcc: ".ADMIN_EMAIL."\n";


		$mailsend = mail($address, $subject, $body, $extra_header);
        */
        $from="$from_name <$from_add>";

        send_email_smtp($from, $to=$address, $subject, $body);
		return true;

	}

	function month_letters_2(){
	return array(
	 '01'=>'Jan',
	 '02'=>'Feb',
	 '03'=>'Mar',
	 '04'=>'Apr',
	 '05'=>'May',
	 '06'=>'Jun',
	 '07'=>'Jul',
	 '08'=>'Aug',
	 '09'=>'Sep',
	 '10'=>'Oct',
	 '11'=>'Nov',
	 '12'=>'Dec'
	);
}


function vehicles(){

	return array(
	'Abarth'=>'Abarth',
	'Alfa Romeo'=>'Alfa Romeo',
	'Artega'=>'Artega',
	'Aston Martin'=>'Aston Martin',
	'Audi'=>'Audi',
	'Bentley'=>'Bentley',
	'Bertone'=>'Bertone',
	'BMW'=>'BMW',
	'Bugatti'=>'Bugatti',
	'Buick'=>'Buick',
	'BYD'=>'BYD',
	'Cadillac'=>'Cadillac',
	'Caterham'=>'Caterham',
	'Chevrolet'=>'Chevrolet',
	'Chrysler'=>'Chrysler',
	'Citro�n'=>'Citro�n',
	'Corvette'=>'Corvette',
	'Dacia'=>'Dacia',
	'Daihatsu'=>'Daihatsu',
	'Dodge'=>'Dodge',
	'Exagon'=>'Exagon',
	'Ferrari'=>'Ferrari',
	'Fiat'=>'Fiat',
	'Fisker'=>'Fisker',
	'Ford'=>'Ford',
	'Fornasari'=>'Fornasari',
	'Geely'=>'Geely',
	'GTA'=>'GTA',
	'Hamann'=>'Hamann',
    'Honda'=>'Honda',
    'Hummer'=>'Hummer',
    'Hurtan'=>'Hurtan',
    'Hyundai'=>'Hyundai',
    'Infiniti'=>'Infiniti',
    'Isuzu'=>'Isuzu',
    'Jaguar'=>'Jaguar',
    'Jeep'=>'Jeep',
    'Kia'=>'Kia',
    'KTM'=>'KTM',
    'Lamborghini'=>'Lamborghini',
    'Lancia'=>'Lancia',
    'Land Rover'=>'Land Rover',
    'Lexus'=>'Lexus',
    'Lotus'=>'Lotus',
    'Mansory'=>'Mansory',
    'Maserati'=>'Maserati',
    'Maybach'=>'Maybach',
    'Mazda'=>'Mazday',
    'McLaren'=>'McLaren',
    'Mercedes'=>'Mercedes',
    'Mini'=>'Mini',
    'Mitsubishi'=>'Mitsubishi',
    'Morgan'=>'Morgan',
    'Nissan'=>'Nissan',
    'Opel'=>'Opel',
    'Pagani'=>'Pagani',
    'Peugeot'=>'Peugeot',
    'PGO'=>'PGO',
    'Porsche'=>'Porsche',
    'Renault'=>'Renault',
    'Rolls Royce'=>'Rolls Royce',
    'Saab'=>'Saab',
    'Santana'=>'Santana',
    'Seat'=>'Seat',
    'Skoda'=>'Skoda',
    'Smart'=>'Smart',
    'SsangYong'=>'SsangYong',
    'Subaru'=>'Subaru',
    'Suzuki'=>'Suzuki',
    'Tata'=>'Tata',
    'Tazzari'=>'Tazzari',
    'Tesla'=>'Tesla',
    'Think'=>'Think',
    'Toyota'=>'Toyota',
    'Volkswagen'=>'Volkswagen',
    'Volvo'=>'Volvo',
	'Wiesmann'=>'Wiesmann'
	);
}


function colors(){

	return array(
	'Yellow'=>'Yellow',
	'Blue'=>'Blue',
	'White'=>'White',
    'Gray'=>'Gray',
	'Brown'=>'Brown',
	'Orange'=>'Orange',
	'Black'=>'Black',
	'Red'=>'Red',
	'Green'=>'Green',
	'Violet'=>'Violet',
	'Navy'=>'Navy blue',
	'#6CD2FD'=>'Sky blue',
	'#FAAF3D'=>'Golden',
	'Fuchsia'=>'Fuchsia',
	'#8b4513'=>'Chestnut',
	'LightGreen'=>'Light green',
	'LightGray'=>'Light gray',
	'Maroon'=>'Maroon',
	'Purple'=>'Purple',
	'Silver'=>'Silver',
	'Pink'=>'Pink',
	'#ADEAEA'=>'Turquoise',
	'DarkGreen'=>'Dark green',
	'DarkGray'=>'Dark gray',
	);
}
/*
function sent_tripadvisor_request($array, $ref){

	    $body_client='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Checkoout-Msg</title>
		<style type="text/css">
		<!--
		p.MsoNormal {
		margin:0in;
		margin-bottom:.0001pt;
		font-size:11.0pt;
		font-family:"Calibri","sans-serif";
		}
		-->
		</style>
		</head>

		<body>
		<p class="MsoNormal">Hello '.$array['name'].' '.$array['lastname'].'!</p>
		<p class="MsoNormal">&nbsp;</p>
		<p class="MsoNormal">It was great hosting you here in Casa Linda recently! We do  hope that everything went perfect during your stay and we will be fortunate  enough to host you again in the near future. As always if you have any question  about <u>villa purchasing</u>, <u>future reservations</u>, or <u>any  constructive criticism</u> from your stay, feel free to e-mail me at any time  and I&rsquo;ll be sure to respond as soon as possible.</p>
		<p class="MsoNormal">&nbsp;</p>
		<p class="MsoNormal">If you felt your time here was enjoyable, <strong><u>I would  really appreciate</u></strong> a positive review on Trip Advisor from you! This  helps people to know what great things are happening in our subdivision that  maybe they aren&rsquo;t aware of as they&rsquo;ve never had the privilege to stay here. You  can do this by clicking the link I&rsquo;ve posted below:</p>
		<p class="MsoNormal">&nbsp;</p>
		<p class="MsoNormal"><span style="font-family:\'Verdana\',\'sans-serif\'; font-size:8.0pt; color:#2C2C2C; "><a href="http://www.tripadvisor.com/UserReview-g317144-d638839-m11765-Residencial_Casa_Linda-Cabarete_Dominican_Republic.html">http://www.tripadvisor.com/UserReview-g317144-d638839-m11765-Residencial_Casa_Linda-Cabarete_Dominican_Republic.html</a></span></p>
		<p class="MsoNormal"><span style="font-family:\'Verdana\',\'sans-serif\'; font-size:8.0pt; color:#2C2C2C; ">&nbsp;</span></p>
		<p class="MsoNormal"><span style="color:#2C2C2C; ">I  hope </span>your trip<span style="color:#2C2C2C; "> home was smooth and I  look forward to speaking with you again!</span></p>
		<p class="MsoNormal">&nbsp;</p>
		<p class="MsoNormal">&nbsp;</p>
		<p class="MsoNormal">&nbsp;</p>
		<p class="MsoNormal"><span style="color:#1F497D; ">Regards,</span><span style="font-size:14.0pt; color:#1F497D; "><br />
		  <br />
		  <br />
		  Chris Lawson</span></p>
		<p class="MsoNormal"><span style="font-size:9.0pt; color:#1F497D; ">Rental Manager</span></p>
		<p class="MsoNormal"><span style="font-size:6.0pt; color:#1F497D; ">&nbsp;</span></p>
		<p class="MsoNormal"><span style="color:#1F497D; "><img border="0" width="309" height="71" src="https://www.casalindacity.com/msg_ckout/clip_image001.jpg" alt="Logo horizontal-jpg" /></span><span style="color:#1F497D; "> </span></p>
		<p class="MsoNormal"><span style="color:#1F497D; ">Tel.: (+1809) 571 1190</span></p>
		<p class="MsoNormal"><span style="color:#1F497D; ">Fax: (+1809) 571 1411</span></p>
		<p class="MsoNormal"><a href="mailto:chris@casalindacity.com">Chris@CasaLindaCity.com</a><span style="color:#1F497D; "><br />
		</span><a href="http://www.casalindacity.com/">www.CasaLindaCity.com</a><span style="color:#1F497D; "> </span></p>
		<p class="MsoNormal"><span style="font-size:10.0pt; "><br />
		  For all Reservation inquiries including bookings, pricing, and availability,  please e-mail the main reservations mailbox at </span><a href="mailto:Reservations@CasaLindaCity.com"><span style="font-size:10.0pt; ">Reservations@CasaLindaCity.com</span></a><span style="font-size:10.0pt; ">.</span></p>
		</body>
		</html>';

  		@sendMail_copy_reservations($body_client, $array['email'], "Thank you for staying in Residencial Casa Linda", RESERVATIONS_EMAIL, "RCL Booking System");//send to client
		//echo $body_client;

		//guardar booking ref. en tabla tripadvisor
		$db=new DB();
		$db->insertar_tripadvisor($ref);

		//return $body_client;

		return '<p style="text-align:center; font-size:14px; color:white; background-color:green; font-weight:bold;">TripAdvisor Request Sent!</p>';

	}*/
    /*
	function tripadvisor_question(){

		echo '<p style="border:1px solid green; clear:both; padding:3px; text-transform:uppercase; color:green; font-weight:bold;">Do you want to send <img src="images/TripAdvisor.jpg" alt="TripAdvisor"/> request? <input type="radio" name="tripadvisor" value="yes" >Yes
								<input type="radio" name="tripadvisor" value="no" checked="checked">No</p>';

	} */
  //===================================================FUNCTION FOR CREATING SERVICES ON A BOOKING===================================
	function nuevo_servicios_bookings($array_servicios_activos,$qty_nights){
      //presentar como elegir un servicio aqui
      // incluyendo el array que contiene los id de los servicios que se seleccionaran con los codigos html
       $services_type=array();
       foreach($array_servicios_activos AS $s){
       	 	if(!in_array($s['type'],$services_type)){//si este tipo de servicio no esta en el arreglo de tipos de servicios
                array_push($services_type,$s['type']);//se introduce el tipo en el arreglo
        	}
       }

		foreach($services_type AS $st){

  			 ?>

            <? if($st=='Car_Rental'){
            	$count=0;
            	?>
             <p style="text-align:right; font-weight:bold; padding:0; margin:0;padding-bottom:5px;"><span id="td0"><?=$st?></span>
	             <select name="servicios_id[]" class="azul">
	              <? foreach($array_servicios_activos AS $s){
                     if($st==$s['type']){//solo para los value option
                      $count++;
                       if ($count==1) echo "<option value='0'>None</option>";
		             	?>
		             	<option value="<?=$s['id']?>"><?=substr($s['name'],0,15)?></option>
		             	<?
                     }
	              }
	              ?>
	             </select>


	              <span id="td0">Qty. days </span><select class="azul" style="text-align:right" name="qty[<?=$st.'1'?>]" size=1>
			   		<? for($i=1; $i<=90; $i++){
					 ?>
		        	 <option value="<?=$i?>"><?=$i;?></option>
		        	 <?
			   		}
		   		?></select>
             </p>
            <?}?>

              <p style="text-align:right; font-weight:bold; padding:0; margin:0;padding-bottom:5px;"><span id="td0"><?=$st?></span> <select name="servicios_id[]" class="azul">
          	<?
          	$count=0;$countlaundry=0;
  		 	foreach($array_servicios_activos AS $s){

          	//enmpiea parrafo y el input select aqui

             if($st==$s['type']){//solo para los value option
              $count++;
               if($st=='Laundry'){
                $countlaundry++;
                if ($countlaundry==1) echo "<option value='0'>None</option>";
                 $laun_qty=explode('-', $s['description']);
                 $laun_qty2=explode(' ', $laun_qty[1]);
			     if(($qty_nights>=$laun_qty[0])&&($qty_nights<=$laun_qty2[0])){
	             	?>
	             	<option value="<?=$s['id']?>"><?=substr($s['name'],0,15)." ".$s['price']?></option>
	             	<?
                 }
                  /*echo $qty_nights."(nights)";
			     	echo $laun_qty[0]."(dia 1)";
			     	echo $laun_qty2[0]."(dia 2)"; */
               }else{
               	if ($count==1) echo "<option value='0'>None</option>";

             	if($st!='Car_Rental'){/*if it is not car rentar*/?>
             	<option value="<?=$s['id']?>"><?=substr($s['name'],0,15)." ".$s['price']?></option>
                <?}else{
             	?>
             	<option value="<?=$s['id']?>"><?=substr($s['name'],0,15)?></option>
             	<?
             	}
               }
             }
          	}
             ?>
             </select>
                <?
           if($st=='Massage'){
             ?>
              <span id="td0">Qty. days </span><select class="azul" style="text-align:right" name="qty[<?=$st.'2'?>]" size=1>
			   <? for($i=1; $i<=10; $i++){
				 ?>
		         <option value="<?=$i?>"><?=$i;?></option>
		         <?
			   }
		   ?></select>
		   <?}?>

             <?
           if($st=='Car_Rental'){
             ?>
              <span id="td0">Qty. days </span><select class="azul" style="text-align:right" name="qty[<?=$st.'2'?>]" size=1>
			   <? for($i=1; $i<=90; $i++){
				 ?>
		         <option value="<?=$i?>"><?=$i;?></option>
		         <?
			   }
		   ?></select>
		   <?}?>

		     <?
           if($st=='Personal_Driver'){
             ?>
              <span id="td0">Qty. days </span><select class="azul" style="text-align:right" name="qty[<?=$st?>]" size=1>
			   <? for($i=1; $i<=90; $i++){
				 ?>
		         <option value="<?=$i?>"><?=$i;?></option>
		         <?
			   }
		   ?></select>
		   <?}?>

		   <?
             ?>
             </p>
          	<?
		}
	}

     //========================================FUNCTION FOR EDITING SEVICES ON A BOOKING===============================================
	function editar_servicios_bookings($array_servicios_activos,$qty_nights,$array_servicios_este_booking,$id_reserva){
      //presentar como elegir un servicio aqui
      // incluyendo el array que contiene los id de los servicios que se seleccionaran con los codigos html
      /*print_r($array_servicios_este_booking);
      echo "<pre>";
      print_r($array_servicios_activos);
      echo "</pre>"; */
       $services_type=array();
       foreach($array_servicios_activos AS $s){
       	 	if(!in_array($s['type'],$services_type)){//si este tipo de servicio no esta en el arreglo de tipos de servicios
                array_push($services_type,$s['type']);//se introduce el tipo en el arreglo
        	}
       }

		foreach($services_type AS $st){
            ?>
             <? if($st=='Car_Rental'){  /*SOLO SI ES RENTAL CARS*/
            	$count=0;
            	?>
             <p style="text-align:right; font-weight:bold; padding:0; margin:0;padding-bottom:5px;"><span id="td0"><?=$st?></span>
	             <select name="servicios_id[]" class="azul">
	              <? foreach($array_servicios_activos AS $s){
                     if($st==$s['type']){//solo para los value option
                      $count++;
                       if ($count==1) echo "<option value='0'>None</option>";
		             	?>
		             	<option value="<?=$s['id']?>"

		             	<? if($seleccionado!=1){?>
		             		<? if (in_array($s['id'], $array_servicios_este_booking)) {echo " SELECTED"; $seleccionado=1;} ?>
		             	 <?}?>
                          >
		             	<?=substr($s['name'],0,15)?></option>
		             	<?
                     }

	              }
	              ?>
	             </select>
                  <?
	            require_once('class/getQueries.php');
           		$db=new getQueries;
           		$carros_seleccionado=array();$array_count=0;
                 foreach($array_servicios_este_booking AS $serviceid){
                 	if(!$carros_seleccionado){/*si no hay informacion en el arreglo*/
                 	  $carros_seleccionado=$db->cosulta_servicio($serviceid, 'Car_Rental');
                 	   unset($array_servicios_este_booking[$array_count]);//quitar valor para buscar el otro vehiculo
                       $carros_d=$db->servicio_reservado_id($carros_seleccionado['id'], $id_reserva);
                 	}else{

                 		//echo "<PRE>"; print_r($array_servicios_este_booking); ECHO "</PRE>";
                 		break;
                 	}
                 	$array_count++;
                 }
             ?>
              <span id="td0">Qty. days </span><select class="azul" style="text-align:right" name="qty[<?=$st.$carros_seleccionado['id']?>]" size=1>
			   <? for($i=1; $i<=90; $i++){
				 ?>
		         <option value="<?=$i?>" <? if($carros_d['qty']==$i){ echo 'selected="selected"';}?>><?=$i;?></option>
		         <?
			   }
		   ?></select>
             </p>
            <?}/*HACER LOS DE ARRIBA SOLO SI ES RENTAL CARS*/
            /* echo "<pre>";
             print_r($array_servicios_este_booking);
             echo "</pre>";*/
            ?>

             <p style="text-align:right; font-weight:bold; padding:0; margin:0;padding-bottom:5px;"><span id="td0"><?=$st?></span> <select name="servicios_id[]" class="azul">
          	<?
          	$count=0;$countlaundry=0;
  		 	foreach($array_servicios_activos AS $s){

          	//enmpiea parrafo y el input select aqui

             if($st==$s['type']){//solo para los value option DE ESTE TIPO DE SERVICIO Y ASI NO INCLUIMOS LOS CARROS*/
              $count++;
               if($st=='Laundry'){ /*SOLO SI ES LAVANDERIA*/
                $countlaundry++;
                if ($countlaundry==1) echo "<option value='0'>None</option>";
                 $laun_qty=explode('-', $s['description']);
                 $laun_qty2=explode(' ', $laun_qty[1]);
			     if(($qty_nights>=$laun_qty[0])&&($qty_nights<=$laun_qty2[0])){
	             	?>
	             	<option value="<?=$s['id']?>" <? if (in_array($s['id'], $array_servicios_este_booking)) {echo " SELECTED";} ?>><?=substr($s['name'],0,15)." ".$s['price']?></option>
	             	<?
                 }

               }else{  /*ABOVE ONLY LAUNDRY*/
               	if ($count==1) echo "<option value='0'>None</option>";

             	if($st!='Car_Rental'){/*if it is not car rentar*/?>
             	<option value="<?=$s['id']?>" <? if (in_array($s['id'], $array_servicios_este_booking)) {echo " SELECTED";} ?>><?=substr($s['name'],0,15)." ".$s['price']?></option>
             	<?}else{             	?>
             	<option value="<?=$s['id']?>" <? if (in_array($s['id'], $array_servicios_este_booking)) {echo " SELECTED";} ?>><?=substr($s['name'],0,15)?></option>
             	<?
             	}
               }
             }
          	}
             ?>
             </select>
             <?
           if($st=='Car_Rental'){  /*SOLO SI ES RENTAL CARS*/
           		//incluir archivo de db query aqui
           		require_once('class/getQueries.php');
           		$db=new getQueries;
           		$carros_seleccionado=array();
                 foreach($array_servicios_este_booking AS $serviceid){
                 	if(!$carros_seleccionado){/*si no hay informacion en el arreglo*/
                 	  $carros_seleccionado=$db->cosulta_servicio($serviceid, 'Car_Rental');
                       $carros_d=$db->servicio_reservado_id($carros_seleccionado['id'], $id_reserva);
                 	}else{

                 		/*echo "detalles carro: "; print_r($carros_d);  */
                 		break;
                 	}
                 }
             ?>
              <span id="td0">Qty. days </span><select class="azul" style="text-align:right" name="qty[<?=$st.$carros_seleccionado['id']?>]" size=1>
			   <? for($i=1; $i<=90; $i++){
				 ?>
		         <option value="<?=$i?>" <? if($carros_d['qty']==$i){ echo 'selected="selected"';}?>><?=$i;?></option>
		         <?
			   }
		   ?></select>
		   <?}?>

		     <?
           if($st=='Personal_Driver'){/*IF IT IS A PERSONAL DRIVER SERVICE*/
           	//incluir archivo de db query aqui
           		require_once('class/getQueries.php');
           		$db=new getQueries;
           		$chofer_seleccionado=array();
           		 foreach($array_servicios_este_booking AS $serviceid){
                 	if(!$chofer_seleccionado){/*si no hay informacion en el arreglo*/
                 	  $chofer_seleccionado=$db->cosulta_servicio($serviceid, 'Personal_Driver');
                     /*print_r($chofer_seleccionado); */

                      $chofer_d=$db->servicio_reservado_id($chofer_seleccionado['id'], $id_reserva);
                 	}else{

                 		/*echo "detalles cofer: "; print_r($chofer_d);*/
                 		break;
                 	}
                 }
             ?>
              <span id="td0">Qty. days </span><select class="azul" style="text-align:right" name="qty[<?=$st?>]" size=1>
			   <? for($i=1; $i<=90; $i++){
				 ?>
		         <option value="<?=$i?>"<? if($chofer_d['qty']==$i){ echo 'selected="selected"';}?>><?=$i;?></option>
		         <?
			   }
		   ?></select>
		   <?/*echo "consulta";*/ /* echo $id_reserva;*//* echo $chofer_seleccionado['id']*//* print_r($chofer_seleccionado);*/print_r($chofer_deta);  ?>
		   <?}/*DO ABOVE ONLY IF PERSONAL DRIVER*/?>

		  </p>


          	<?

		}/*END SERVICES TYPE*/

	}


   //===========================FUNCTION FOR ESPECIAL EVENT MANAGMENT==============================================================
   function special_event($starting_date, $ending_date, $price){
     //buscar evento en estas fechas del booking  que estan activos
     require_once('class/getQueries.php');
     $db=new getQueries;
     $evento=$db->active_event($starting_date, $ending_date);
     //sin encontro eventos aplicar los nuevos aumentos  o descenso de precios
     if($evento){
     	 if($evento[0]['type']==1){/*percent*/
          $cantidad_precio=$price*($evento[0]['qty']/100);
     	 }else{/*suponemos que es (2) o amount*/
          $cantidad_precio=$evento[0]['qty'];
     	 }

     	 if($evento[0]['increase']==1){/*increase*/
           $new_price=$price+$cantidad_precio;  /*increase priding*/
     	 }else{/*suponemos que es descontar*/
           $new_price=$price-$cantidad_precio; /*decrease pricing*/
     	 }
     	 //GUARDAR EVENTO AQUI EN UNA VARIABLE DE SESSION
         $_SESSION['evento']=$evento[0];
     }else{
     //sino encontro eventos dejar el precio igual.
       $new_price=$price;
     }
     /* return $evento;*/
   return $new_price;
   }

   function quitar_evento(){
    //quitar evento antes de realizar un booking que se le aplica el evento. (por se habia una seccion guardada de otro booking)
   	 if($_SESSION['evento']){ unset($_SESSION['evento']);}

   }

   function booking_status($status){
      switch ($status){
		       	case 0:
		         	$status_booking="<span style='color:red'>Cancelled</span>";
			       	break;
		       	case 1:
		         	$status_booking="<span class='azul2'>Checked in - Short</span>";
			       	break;
			    case 2:
		         	$status_booking="<span class='azul2'>Confirmed - Short</span>";
			       	break;
			    case 3:
		         	$status_booking="<span class='morado'>No Confirmed - Short </span>";
			       	break;
				case 4:
		         	$status_booking="<span class='outck'>Checked out - Short</span>";
			       	break;
			    case 5:
		         	$status_booking="<span style='color:red'>Maintenance (out of service)</span>";
			       	break;
			   case 6:
		         	$status_booking="<span class='r_vip'>Checked in - VIP, Short</span>";
			       	break;
			    case 7:
		         	$status_booking="<span class='r_owner'>Checked in - Owner, Short</span>";
			       	break;
			    case 8:
		         	$status_booking="<span class='r_long'>Checked in - Long</span>";
			       	break;
			    case 9:
		         	$status_booking="<span class='r_long'>Confirmed - Long</span>";
			       	break;
			 	case 10:
		         	$status_booking="<span class='r_long'>No Confirmed - Long</span>";
			       	break;
			    case 11:
		         	$status_booking="<span class='r_long'>Checked Out - Long</span>";
			       	break;
			 	case 12:
		         	$status_booking="<span class='r_vip'>Confirmed - VIP, Short</span>";
			       	break;
			    case 13:
		         $status_booking="<span class='r_vip'>No Confirmed - VIP, Short</span>";
			       	break;
			 	case 14:
		         	$status_booking="<span class='r_vip'>Checked Out - VIP, Short</span>";
			       	break;
			    case 15:
		         	$status_booking="<span class='r_vip'>Checked in - VIP, Long</span>";
			       	break;
			 	case 16:
		         	$status_booking="<span class='r_vip'>Confirmed - VIP, Long</span>";
			       	break;
			    case 17:
		         	$status_booking="<span class='r_vip'>No Confirmed - VIP, Long</span>";
			       	break;
			 	case 18:
		         	$status_booking="<span class='r_vip'>Checked Out - VIP, Long</span>";
			       	break;
			    case 19:
		         	$status_booking="<span class='r_long'>Confirmed - Owner, Short</span>";
			       	break;
			 	case 20:
		         	$status_booking="<span class='r_long'>No confirmed - Owner, Short</span>";
			       	break;
			    case 21:
		         	$status_booking="<span class='r_long'>Checked Out - Owner, Short</span>";
			       	break;
			 	case 22:
		         	$status_booking="<span class='r_long'>Checked in - Owner, Long</span>";
			       	break;
			    case 23:
		         	$status_booking="<span class='r_long'>Confirmed - Owner, Long</span>";
			       	break;
			 	case 24:
		         	$status_booking="<span class='r_long'>No confirmed - Owner, Long</span>";
			       	break;
			    case 25:
		         	$status_booking="<span class='r_long'>Checked Out - Owner, Long</span>";
			       	break;
		       	default:
			       $status_booking="<span class='negro'><u>Unavailabe</u></span>";
			       #	break;
	  }

	  return $status_booking;
   }

  //------------------FIND OUT WHEN A VILLA IS AVAILABLE OR NOT TO MAKE A BOOKING OR EDIT A BOOKING------------------
   function check_villa_new($id_villa, $start_date, $end_date){ /*CHECK IF THIS VILLA IS BUSY WHILE CREATING A NEW BOOKING*/
       //buscar todas esas ocupaciones
         //SI ARRAY COUNT ES MAYOR QUE 0 ENTONCES HAY RESERVAS
     require_once('class/getQueries.php');
     $db=new getQueries;
     $ocupaciones=$db->availability_new_booking($id_villa, $start_date, $end_date);
     return $ocupaciones;
   }

   function check_villa_edit($id_villa, $start_date, $end_date, $id_this_reserve){ /*CHECK IF A VILLA IS OCCUPIED WHILE CHANGING A RESERVATION*/
      require_once('class/getQueries.php');
     $db=new getQueries;
     $ocupaciones=$db->availability_edit_booking($id_villa, $start_date, $end_date, $id_this_reserve);


     return $ocupaciones;
   }

   function new_booking_busy_error($from, $to, $link){
   	?>
     <h1><span style="color:red">ERROR:</span> We are sorry, this villa is now occupied between <u><?=date("d M Y",strtotime($from))?></u> to <u><?=date("d M Y",strtotime($to))?></u>, please, try again.</h1>

     <h2><a href="<?=$link?>" alt="">Click here to start once more</a></h2>
   	<?
   }

   function change_booking_busy_error($from, $to){
    ?>
      <h1><span style="color:red">ERROR:</span> It is impossible to change this booking, because this villa is occupied between <u><?=date("d M Y",strtotime($from))?></u> to <u><?=date("d M Y",strtotime($to))?></u></h1>
   	<?
   }
  //-----------------------------determinar la tarifa semanal y mensual para los administradores----------------------------------------------------
   function price_rent($qty_nights, $normal_price){
    //apply to short term and rental online
    require_once('class/getQueries.php');
     $db=new getQueries;
     $price_settings=$db->show1_active('price_settings');
    //rate weekly
     if(($qty_nights>=$price_settings['week_nights'])&&($qty_nights<$price_settings['month_nights'])){
         $percent_to_reduce=(1-($price_settings['week_disc']/100));
         $rate_per_nights=$normal_price*$percent_to_reduce;

     }elseif(($qty_nights>=$price_settings['month_nights'])&&($qty_nights<$price_settings['Long_nights'])){
      //rate monthly
       $percent_to_reduce=(1-($price_settings['month_disc']/100));
       $rate_per_nights=$normal_price*$percent_to_reduce;

      //hacer un error igual al long term aqui para clientes online

     }elseif($qty_nights>=$price_settings['Long_nights']){  //apply long term pricing
     	//lanzar error decir que se debe elegir de largo plazo, si admin
     	//hacer un error aqui para los clientes enlinea tambiem
       /*die('This booking must be a long term, go back and try again');*/
	    $percent_to_reduce=(1-($price_settings['month_disc']/100));/*calculate per months anyways*/
       $rate_per_nights=$normal_price*$percent_to_reduce;/*calculate per months anyways*/
     }else{ //apply normal pricing
     	//corresponden precios sin descuentos, menos de una semana
      $rate_per_nights=$normal_price;
     }

    return $rate_per_nights;
   }
    //-----------------------------determinar la tarifa semanal y mensual para los clientes online----------------------------------------------------
	function price_rent_online($qty_nights, $normal_price){
      //apply to short term and rental online
    require_once('class/getQueries.php');
     $db=new getQueries;
     $price_settings=$db->show1_active('price_settings');
    //rate weekly
     if(($qty_nights>=$price_settings['week_nights'])&&($qty_nights<$price_settings['month_nights'])){
         $percent_to_reduce=(1-($price_settings['week_disc']/100));
         $rate_per_nights=$normal_price*$percent_to_reduce;

     }elseif(($qty_nights>=$price_settings['month_nights'])&&($qty_nights<$price_settings['Long_nights'])){
      //rate monthly
       $percent_to_reduce=(1-($price_settings['month_disc']/100));
       $rate_per_nights=$normal_price*$percent_to_reduce;
      #die('Please, contact us at: reservations@CasaLindaCity.com, in order to make this booking.');
      //hacer un error igual al long term aqui para clientes online

     }elseif($qty_nights>=$price_settings['Long_nights']){  //apply long term pricing
     	//lanzar error decir que se debe elegir de largo plazo, si admin
     	//hacer un error aqui para los clientes enlinea tambiem
       die('Please, contact us at: reservations@CasaLindaCity.com, in order to make this booking.');
     }else{ //apply normal pricing
     	//corresponden precios sin descuentos, menos de una semana
      $rate_per_nights=$normal_price;
     }

    return $rate_per_nights;

	}
   //-------------------------------------determinar el monto semanal-------------------------------------------------
	function weekly_rate($normal_price){
     //apply to short term and rental online
    require_once('class/getQueries.php');
     $db=new getQueries;
     $price_settings=$db->show1_active('price_settings');
    //rate weekly
         $percent_to_reduce=(1-($price_settings['week_disc']/100));
         $rate_per_week=($normal_price*$percent_to_reduce)*$price_settings['week_nights'];

     return $rate_per_week;
	}
    //------------------------------------determinar el monto mensual--------------------------------------------------
	function monthly_rate($normal_price){
       //apply to short term and rental online
    require_once('class/getQueries.php');
     $db=new getQueries;
     $price_settings=$db->show1_active('price_settings');
    //rate monthly
       $percent_to_reduce=(1-($price_settings['month_disc']/100));
       $rate_per_month=($normal_price*$percent_to_reduce)*$price_settings['month_nights'];

    return $rate_per_month;

	}

	function flat_amount($ref, $flat_type, $flat_amount){
       /* $flat_type=1 monthly flat*/ /* $flat_type=2 booking flat*/
         require_once('class/getQueries.php'); //llamar las consultas
         require_once('class/DB_class.php');  //llamar a insertar
         $db=new getQueries; //consulta
         $data= new DB;

         //buscar referencia en flat
         $flat_guardado=$db->show_active_limit1($table='flat_amount_long', $field='ref', $value=$ref, $operator='=');

         if ($flat_guardado[0]){/*si enontro flat activo*/
          //si la encuentro actualizo y pongo active en 0
          //e inserto un nuevo flat(para que tengan diferentes id admin si son diferentes)
       	  $data->update_flat_disable($flat_guardado[0]['id']);
          $data->insert_flat_pricing($date=date("Y-m-d G:i:s"), $type=$flat_type, $amount=$flat_amount, $ref, $id_adm=$_SESSION['info']['id'], $active='1');
         }else{
           	//si no la encuentro entonces inserto un nuevo record flat, solamente.
           $data->insert_flat_pricing($date=date("Y-m-d G:i:s"), $type=$flat_type, $amount=$flat_amount, $ref, $id_adm=$_SESSION['info']['id'], $active='1');
         }
	}

	function price_vehicle($id, $start_date, $days){
     require_once('class/getQueries.php');
     $db=new getQueries;
     $this_vehicule=$db->show_id($table='serv_add', $id);/*get details for this service*/
     //$Date = "2010-09-17";
	 $car_end=date('Y-m-d', strtotime($start_date. ' + '.$days.' days'));

     $setting_guardado=$db->show_any_data_limit1($table='vehicle_HS', $field='id', $value='1', $operator='='); /*get vehicle seasons*/
     $HS_F=$setting_guardado[0]['hs_from'];/*empieza la temporada alta*/
     $HS_T=$setting_guardado[0]['hs_to']; /*termina la temporada alta*/

     $cs=strtotime($start_date); /*car start*/
     $ce=strtotime($car_end); /*car end*/
     $ss=strtotime($HS_F); /*season start*/
     $se=strtotime($HS_T); /*season end*/

     $LS_P=$this_vehicule[0]['price']; /*precio teporada baja por menos de 5 dias*/
     $LS_PM=$this_vehicule[0]['price_min'];/*precio temporada bajo por mas de 5 dias*/
     $HS_P=$this_vehicule[0]['hs_price'];/*precio temporada alta*/
     $HS_PM=$this_vehicule[0]['hs_price2'];/*precio temporada alta minimo*/

	 if(($cs<=$se)&&($ce>=$ss)){/*precio temporada alta*/
      #$price=$HS_P;
        if($days>=5){ /*precio minimo de la temporada*/
          $price=$HS_PM;
      	}else{
          $price=$HS_P;
      	}
	 }else{/*precio temporada baja*/
        if($days>=5){ /*precio minimo de la temporada*/
          $price=$LS_PM;
      	}else{
          $price=$LS_P;
      	}
	 }
      //SI HAY PRECIOS DE TEMPRADA ALTA Y TEMPORADA BAJA
      //ENTONCES SOLO PONER PRECIO DE TEMPORADA ALTA
	return $price;
	}

 function fecha_in($y, $m, $d){
 	$fe=$y.'-'.$m.'-'.$d;
   	$date=date("Y-m-d",strtotime($fe));
   return $date;
 }

 function sp2($va){
  $num=str_pad($va, 2, '0', STR_PAD_LEFT);
 return $num;
 }

 function fecha_insert($name_add, $fecha){

    if(($fecha!='')&&($fecha!='1969-12-31')&&($fecha!='0000-00-00')){
	 $f0=strtotime($fecha);
	 $fh['d']=date("d",$f0); /* echo "<br/>"; */
	 $fh['mo']=date("m",$f0); /*echo "<br/>";*/
	 $fh['y']=date("Y",$f0); /*echo "<br/>";*/
	}else{
      $fh['d']='00';
      $fh['mo']='00';
      $fh['y']='0000';
	}

 ?>
     <!--//D  day//-->
      <select name="day<?=$name_add?>">
      <!--//	<option value="00" <? if($fh['d']=='00'){?> selected="selected" <?}?> >&nbsp;</option>//-->
      	<?
      	for($i=1; $i<=31; $i++){?>
         <option value="<?=sp2($i)?>" <? if($fh['d']==sp2($i)){?> selected="selected" <?}?> ><?=sp2($i)?></option>
	      <?
	      }
      	?>
      </select>
      <!--//  month//-->
      <select name="month<?=$name_add?>">
      	<!--//<option value="00" <? if($fh['mo']=='00'){?> selected="selected" <?}?> >&nbsp;</option>//-->
      	<?
      	for($i=1; $i<=12; $i++){?>
         <option value="<?=sp2($i)?>" <? if($fh['mo']==sp2($i)){?> selected="selected" <?}?> ><?=date('F',strtotime(sp2('2012-'.$i.'-01')))?></option>
	      <?
	      }
      	?>
      </select>

      <!--// year //--><select name="year<?=$name_add?>">
     <!--// <option value="0000" <? if($fh['y']=='0000'){?> selected="selected" <?}?> >&nbsp;</option>//-->
      	<?
      	for($i=(date('Y')-5); $i<=date('Y')+1; $i++){?>
         <option value="<?=$i?>" <? if($fh['y']==$i){?> selected="selected" <?}?> ><?=$i?></option>
	      <?
	      }
      	?>
      </select>
 <?
 }

 function expedia_fields($id_exp, $amount_exp){ 	if($_SESSION['exp_id']){ unset($_SESSION['exp_id']);}
 	if($_SESSION['exp_amount']){ unset($_SESSION['exp_amount']);}
 	?>
 	  <p style="text-align:right; font-size:10px; font-weight:bold; padding:0; margin:0;">
 	  Expedia ID<input  style="padding:" type="text" name="exp_id" value="<?=$id_exp?>"/>
 	  Expedia Amount<input type="text" name="exp_amount" value="<?=$amount_exp?>"/>
 	  </p>
 	<? }

  function insert_or_update_exp($rcl_ref, $id_referral, $expedia_id, $expedia_amount){
		    $link= new getQueries();
		    $expedia=$link->show_any_data_limit1('expedia', 'rcl_ref', $rcl_ref, '=');
		    $db= new subDB (); //CONNECT TO DATABASE
			  if ($expedia){
			    $actualizado=$db->update_expedia($expedia[0]['id'], $rcl_ref, $id_referral, $expedia_id, $expedia_amount);
			  }else{
				$result=$db->insert_expedia($rcl_ref, $id_referral, $expedia_id, $expedia_amount);
			  }
			  //$db debe existir como la clase de insertar los campos
  }
?>