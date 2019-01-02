<?php
namespace App\Classes;
use Illuminate\Http\Request;
use App\Http\Requests;
use Validator, DateTime, DB, Hash, File, Config, Helpers, Auth, Mail;
use Session, Redirect;
use JWTFactory;
use JWTAuth;
use App\User;
use App\Post;
use App\Comments;
use App\ServiceRequest;
use App\Services;
use App\ServiceForm;
use App\Terms;
class CurrencyCONV
{
    public static function getPrice($price, $symbole = 'with')
    {
    	$currency = self::getCurrency();
    	if ($currency != 'INR') {
	    	$rates = self::getRates($currency, 'INR');
	    	$value = (double)$price / (double)$rates;
	        $price = number_format((double)$value, 2, '.', '');
	    }	
	        
    	if ($symbole == 'without') {
			return $price;
		}
		return self::moneyFormat($price, $currency);    	
    }
    public static function getRates($fromCurrency, $toCurrency)
    {
        $url = 'https://free.currencyconverterapi.com/api/v5/convert?q=' . $fromCurrency . '_' . $toCurrency . '&compact=ultra' ;
        $handle = @fopen($url, 'r');
        if ($handle) {
            $result = fgets($handle, 4096);
            fclose($handle);
        }
        if (isset($result)) {
            $conversion = json_decode($result, true);
            if (isset($conversion[$fromCurrency . '_' . $toCurrency])) {
                return $conversion[$fromCurrency . '_' . $toCurrency];
            }
        }
        return 0;
    }
	public static function getCountryFromIP()
	{
		$ip = $_SERVER['REMOTE_ADDR'];
		$country = exec("whois $ip  | grep -i country");
		$country = str_replace("country:", "", "$country");
		$country = str_replace("Country:", "", "$country");
		$country = str_replace("Country :", "", "$country");
		$country = str_replace("country :", "", "$country");
		$country = str_replace("network:country-code:", "", "$country");
		$country = str_replace("network:Country-Code:", "", "$country");
		$country = str_replace("Network:Country-Code:", "", "$country");
		$country = str_replace("network:organization-", "", "$country");
		$country = str_replace("network:organization-usa", "us", "$country");
		$country = str_replace("network:country-code;i:us", "us", "$country");
		$country = str_replace("eu#countryisreallysomewhereinafricanregion", "af", "$country");
		$country = str_replace("", "", "$country");
		$country = str_replace("countryunderunadministration", "", "$country");
		$country = str_replace(" ", "", "$country");
		return $country;
	}
	public static function moneyFormat($amount, $currency)
    {
        $currencies = self::$currencies;
        $symbol = (isset($currencies[$currency]['symbol'])?$currencies[$currency]['symbol']:'');
        return $symbol.''.$amount;
    }
	public static function getCurrency()
	{
		$currency = array(
		  "BD" => "BDT",
		  "BE" => "EUR",
		  "BF" => "XOF",
		  "BG" => "BGN",
		  "BA" => "BAM",
		  "BB" => "BBD",
		  "WF" => "XPF",
		  "BL" => "EUR",
		  "BM" => "BMD",
		  "BN" => "BND",
		  "BO" => "BOB",
		  "BH" => "BHD",
		  "BI" => "BIF",
		  "BJ" => "XOF",
		  "BT" => "BTN",
		  "JM" => "JMD",
		  "BV" => "NOK",
		  "BW" => "BWP",
		  "WS" => "WST",
		  "BQ" => "USD",
		  "BR" => "BRL",
		  "BS" => "BSD",
		  "JE" => "GBP",
		  "BY" => "BYR",
		  "BZ" => "BZD",
		  "RU" => "RUB",
		  "RW" => "RWF",
		  "RS" => "RSD",
		  "TL" => "USD",
		  "RE" => "EUR",
		  "TM" => "TMT",
		  "TJ" => "TJS",
		  "RO" => "RON",
		  "TK" => "NZD",
		  "GW" => "XOF",
		  "GU" => "USD",
		  "GT" => "GTQ",
		  "GS" => "GBP",
		  "GR" => "EUR",
		  "GQ" => "XAF",
		  "GP" => "EUR",
		  "JP" => "JPY",
		  "GY" => "GYD",
		  "GG" => "GBP",
		  "GF" => "EUR",
		  "GE" => "GEL",
		  "GD" => "XCD",
		  "GB" => "GBP",
		  "GA" => "XAF",
		  "SV" => "USD",
		  "GN" => "GNF",
		  "GM" => "GMD",
		  "GL" => "DKK",
		  "GI" => "GIP",
		  "GH" => "GHS",
		  "OM" => "OMR",
		  "TN" => "TND",
		  "JO" => "JOD",
		  "HR" => "HRK",
		  "HT" => "HTG",
		  "HU" => "HUF",
		  "HK" => "HKD",
		  "HN" => "HNL",
		  "HM" => "AUD",
		  "VE" => "VEF",
		  "PR" => "USD",
		  "PS" => "ILS",
		  "PW" => "USD",
		  "PT" => "EUR",
		  "SJ" => "NOK",
		  "PY" => "PYG",
		  "IQ" => "IQD",
		  "PA" => "PAB",
		  "PF" => "XPF",
		  "PG" => "PGK",
		  "PE" => "PEN",
		  "PK" => "PKR",
		  "PH" => "PHP",
		  "PN" => "NZD",
		  "PL" => "PLN",
		  "PM" => "EUR",
		  "ZM" => "ZMK",
		  "EH" => "MAD",
		  "EE" => "EUR",
		  "EG" => "EGP",
		  "ZA" => "ZAR",
		  "EC" => "USD",
		  "IT" => "EUR",
		  "VN" => "VND",
		  "SB" => "SBD",
		  "ET" => "ETB",
		  "SO" => "SOS",
		  "ZW" => "ZWL",
		  "SA" => "SAR",
		  "ES" => "EUR",
		  "ER" => "ERN",
		  "ME" => "EUR",
		  "MD" => "MDL",
		  "MG" => "MGA",
		  "MF" => "EUR",
		  "MA" => "MAD",
		  "MC" => "EUR",
		  "UZ" => "UZS",
		  "MM" => "MMK",
		  "ML" => "XOF",
		  "MO" => "MOP",
		  "MN" => "MNT",
		  "MH" => "USD",
		  "MK" => "MKD",
		  "MU" => "MUR",
		  "MT" => "EUR",
		  "MW" => "MWK",
		  "MV" => "MVR",
		  "MQ" => "EUR",
		  "MP" => "USD",
		  "MS" => "XCD",
		  "MR" => "MRO",
		  "IM" => "GBP",
		  "UG" => "UGX",
		  "TZ" => "TZS",
		  "MY" => "MYR",
		  "MX" => "MXN",
		  "IL" => "ILS",
		  "FR" => "EUR",
		  "IO" => "USD",
		  "SH" => "SHP",
		  "FI" => "EUR",
		  "FJ" => "FJD",
		  "FK" => "FKP",
		  "FM" => "USD",
		  "FO" => "DKK",
		  "NI" => "NIO",
		  "NL" => "EUR",
		  "NO" => "NOK",
		  "NA" => "NAD",
		  "VU" => "VUV",
		  "NC" => "XPF",
		  "NE" => "XOF",
		  "NF" => "AUD",
		  "NG" => "NGN",
		  "NZ" => "NZD",
		  "NP" => "NPR",
		  "NR" => "AUD",
		  "NU" => "NZD",
		  "CK" => "NZD",
		  "XK" => "EUR",
		  "CI" => "XOF",
		  "CH" => "CHF",
		  "CO" => "COP",
		  "CN" => "CNY",
		  "CM" => "XAF",
		  "CL" => "CLP",
		  "CC" => "AUD",
		  "CA" => "CAD",
		  "CG" => "XAF",
		  "CF" => "XAF",
		  "CD" => "CDF",
		  "CZ" => "CZK",
		  "CY" => "EUR",
		  "CX" => "AUD",
		  "CR" => "CRC",
		  "CW" => "ANG",
		  "CV" => "CVE",
		  "CU" => "CUP",
		  "SZ" => "SZL",
		  "SY" => "SYP",
		  "SX" => "ANG",
		  "KG" => "KGS",
		  "KE" => "KES",
		  "SS" => "SSP",
		  "SR" => "SRD",
		  "KI" => "AUD",
		  "KH" => "KHR",
		  "KN" => "XCD",
		  "KM" => "KMF",
		  "ST" => "STD",
		  "SK" => "EUR",
		  "KR" => "KRW",
		  "SI" => "EUR",
		  "KP" => "KPW",
		  "KW" => "KWD",
		  "SN" => "XOF",
		  "SM" => "EUR",
		  "SL" => "SLL",
		  "SC" => "SCR",
		  "KZ" => "KZT",
		  "KY" => "KYD",
		  "SG" => "SGD",
		  "SE" => "SEK",
		  "SD" => "SDG",
		  "DO" => "DOP",
		  "DM" => "XCD",
		  "DJ" => "DJF",
		  "DK" => "DKK",
		  "VG" => "USD",
		  "DE" => "EUR",
		  "YE" => "YER",
		  "DZ" => "DZD",
		  "US" => "USD",
		  "UY" => "UYU",
		  "YT" => "EUR",
		  "UM" => "USD",
		  "LB" => "LBP",
		  "LC" => "XCD",
		  "LA" => "LAK",
		  "TV" => "AUD",
		  "TW" => "TWD",
		  "TT" => "TTD",
		  "TR" => "TRY",
		  "LK" => "LKR",
		  "LI" => "CHF",
		  "LV" => "EUR",
		  "TO" => "TOP",
		  "LT" => "LTL",
		  "LU" => "EUR",
		  "LR" => "LRD",
		  "LS" => "LSL",
		  "TH" => "THB",
		  "TF" => "EUR",
		  "TG" => "XOF",
		  "TD" => "XAF",
		  "TC" => "USD",
		  "LY" => "LYD",
		  "VA" => "EUR",
		  "VC" => "XCD",
		  "AE" => "AED",
		  "AD" => "EUR",
		  "AG" => "XCD",
		  "AF" => "AFN",
		  "AI" => "XCD",
		  "VI" => "USD",
		  "IS" => "ISK",
		  "IR" => "IRR",
		  "AM" => "AMD",
		  "AL" => "ALL",
		  "AO" => "AOA",
		  "AQ" => "",
		  "AS" => "USD",
		  "AR" => "ARS",
		  "AU" => "AUD",
		  "AT" => "EUR",
		  "AW" => "AWG",
		  "IN" => "INR",
		  "AX" => "EUR",
		  "AZ" => "AZN",
		  "IE" => "EUR",
		  "ID" => "IDR",
		  "UA" => "UAH",
		  "QA" => "QAR",
		  "MZ" => "MZN"
		);
		$code = self::getCountryFromIP();	
		return (isset($currency[$code])?$currency[$code]:$currency['IN']);
	}
	private static $currencies = [
        'ARS' => [
            'code' => 'ARS',
            'title' => 'Argentine Peso',
            'symbol' => 'AR$',
            'precision' => 2,
            'thousandSeparator' => '.',
            'decimalSeparator' => ',',
            'symbolPlacement' => 'before'
        ],
        'AMD' => [
            'code' => 'AMD',
            'title' => 'Armenian Dram',
            'symbol' => 'Դ',
            'precision' => 2,
            'thousandSeparator' => ',',
            'decimalSeparator' => '.',
            'symbolPlacement' => 'before'
        ],
        'AWG' => [
            'code' => 'AWG',
            'title' => 'Aruban Guilder',
            'symbol' => 'Afl. ',
            'precision' => 2,
            'thousandSeparator' => '.',
            'decimalSeparator' => ',',
            'symbolPlacement' => 'before'
        ],
        'AUD' => [
            'code' => 'AUD',
            'title' => 'Australian Dollar',
            'symbol' => 'AU$',
            'precision' => 2,
            'thousandSeparator' => ',',
            'decimalSeparator' => '.',
            'symbolPlacement' => 'before'
        ],
        'BSD' => [
            'code' => 'BSD',
            'title' => 'Bahamian Dollar',
            'symbol' => 'B$',
            'precision' => 2,
            'thousandSeparator' => ',',
            'decimalSeparator' => '.',
            'symbolPlacement' => 'before'
        ],
        'BHD' => [
            'code' => 'BHD',
            'title' => 'Bahraini Dinar',
            'symbol' => null,
            'precision' => 3,
            'thousandSeparator' => ',',
            'decimalSeparator' => '.',
            'symbolPlacement' => 'before'
        ],
        'BDT' => [
            'code' => 'BDT',
            'title' => 'Bangladesh, Taka',
            'symbol' => null,
            'precision' => 2,
            'thousandSeparator' => ',',
            'decimalSeparator' => '.',
            'symbolPlacement' => 'before'
        ],
        'BZD' => [
            'code' => 'BZD',
            'title' => 'Belize Dollar',
            'symbol' => 'BZ$',
            'precision' => 2,
            'thousandSeparator' => ',',
            'decimalSeparator' => '.',
            'symbolPlacement' => 'before'
        ],
        'BMD' => [
            'code' => 'BMD',
            'title' => 'Bermudian Dollar',
            'symbol' => 'BD$',
            'precision' => 2,
            'thousandSeparator' => ',',
            'decimalSeparator' => '.',
            'symbolPlacement' => 'before'
        ],
        'BOB' => [
            'code' => 'BOB',
            'title' => 'Bolivia, Boliviano',
            'symbol' => 'Bs',
            'precision' => 2,
            'thousandSeparator' => '.',
            'decimalSeparator' => ',',
            'symbolPlacement' => 'before'
        ],
        'BAM' => [
            'code' => 'BAM',
            'title' => 'Bosnia and Herzegovina convertible mark',
            'symbol' => 'KM ',
            'precision' => 2,
            'thousandSeparator' => '.',
            'decimalSeparator' => ',',
            'symbolPlacement' => 'before'
        ],
        'BWP' => [
            'code' => 'BWP',
            'title' => 'Botswana, Pula',
            'symbol' => 'p',
            'precision' => 2,
            'thousandSeparator' => ',',
            'decimalSeparator' => '.',
            'symbolPlacement' => 'before'
        ],
        'BRL' => [
            'code' => 'BRL',
            'title' => 'Brazilian Real',
            'symbol' => 'R$',
            'precision' => 2,
            'thousandSeparator' => '.',
            'decimalSeparator' => ',',
            'symbolPlacement' => 'before'
        ],
        'BND' => [
            'code' => 'BND',
            'title' => 'Brunei Dollar',
            'symbol' => 'B$',
            'precision' => 2,
            'thousandSeparator' => ',',
            'decimalSeparator' => '.',
            'symbolPlacement' => 'before'
        ],
        'CAD' => [
            'code' => 'CAD',
            'title' => 'Canadian Dollar',
            'symbol' => 'CA$',
            'precision' => 2,
            'thousandSeparator' => ',',
            'decimalSeparator' => '.',
            'symbolPlacement' => 'before'
        ],
        'KYD' => [
            'code' => 'KYD',
            'title' => 'Cayman Islands Dollar',
            'symbol' => 'CI$',
            'precision' => 2,
            'thousandSeparator' => ',',
            'decimalSeparator' => '.',
            'symbolPlacement' => 'before'
        ],
        'CLP' => [
            'code' => 'CLP',
            'title' => 'Chilean Peso',
            'symbol' => 'CLP$',
            'precision' => 0,
            'thousandSeparator' => '.',
            'decimalSeparator' => '',
            'symbolPlacement' => 'before'
        ],
        'CNY' => [
            'code' => 'CNY',
            'title' => 'China Yuan Renminbi',
            'symbol' => 'CN¥',
            'precision' => 2,
            'thousandSeparator' => ',',
            'decimalSeparator' => '.',
            'symbolPlacement' => 'before'
        ],
        'COP' => [
            'code' => 'COP',
            'title' => 'Colombian Peso',
            'symbol' => 'COL$',
            'precision' => 2,
            'thousandSeparator' => '.',
            'decimalSeparator' => ',',
            'symbolPlacement' => 'before'
        ],
        'CRC' => [
            'code' => 'CRC',
            'title' => 'Costa Rican Colon',
            'symbol' => '₡',
            'precision' => 2,
            'thousandSeparator' => '.',
            'decimalSeparator' => ',',
            'symbolPlacement' => 'before'
        ],
        'HRK' => [
            'code' => 'HRK',
            'title' => 'Croatian Kuna',
            'symbol' => ' kn',
            'precision' => 2,
            'thousandSeparator' => '.',
            'decimalSeparator' => ',',
            'symbolPlacement' => 'after'
        ],
        'CUC' => [
            'code' => 'CUC',
            'title' => 'Cuban Convertible Peso',
            'symbol' => 'CUC$',
            'precision' => 2,
            'thousandSeparator' => ',',
            'decimalSeparator' => '.',
            'symbolPlacement' => 'before'
        ],
        'CUP' => [
            'code' => 'CUP',
            'title' => 'Cuban Peso',
            'symbol' => 'CUP$',
            'precision' => 2,
            'thousandSeparator' => ',',
            'decimalSeparator' => '.',
            'symbolPlacement' => 'before'
        ],
        'CYP' => [
            'code' => 'CYP',
            'title' => 'Cyprus Pound',
            'symbol' => '£',
            'precision' => 2,
            'thousandSeparator' => '.',
            'decimalSeparator' => ',',
            'symbolPlacement' => 'before'
        ],
        'CZK' => [
            'code' => 'CZK',
            'title' => 'Czech Koruna',
            'symbol' => ' Kč',
            'precision' => 2,
            'thousandSeparator' => ' ',
            'decimalSeparator' => ',',
            'symbolPlacement' => 'after'
        ],
        'DKK' => [
            'code' => 'DKK',
            'title' => 'Danish Krone',
            'symbol' => ' kr.',
            'precision' => 2,
            'thousandSeparator' => '.',
            'decimalSeparator' => ',',
            'symbolPlacement' => 'after'
        ],
        'DOP' => [
            'code' => 'DOP',
            'title' => 'Dominican Peso',
            'symbol' => 'RD$',
            'precision' => 2,
            'thousandSeparator' => ',',
            'decimalSeparator' => '.',
            'symbolPlacement' => 'before'
        ],
        'XCD' => [
            'code' => 'XCD',
            'title' => 'East Caribbean Dollar',
            'symbol' => 'EC$',
            'precision' => 2,
            'thousandSeparator' => ',',
            'decimalSeparator' => '.',
            'symbolPlacement' => 'before'
        ],
        'EGP' => [
            'code' => 'EGP',
            'title' => 'Egyptian Pound',
            'symbol' => 'EGP',
            'precision' => 2,
            'thousandSeparator' => ',',
            'decimalSeparator' => '.',
            'symbolPlacement' => 'before'
        ],
        'SVC' => [
            'code' => 'SVC',
            'title' => 'El Salvador Colon',
            'symbol' => '₡',
            'precision' => 2,
            'thousandSeparator' => ',',
            'decimalSeparator' => '.',
            'symbolPlacement' => 'before'
        ],
        'EUR' => [
            'code' => 'EUR',
            'title' => 'Euro',
            'symbol' => '€ ',
            'precision' => 2,
            'thousandSeparator' => '.',
            'decimalSeparator' => ',',
            'symbolPlacement' => 'before'
        ],
        'GHC' => [
            'code' => 'GHC',
            'title' => 'Ghana, Cedi',
            'symbol' => 'GH₵',
            'precision' => 2,
            'thousandSeparator' => ',',
            'decimalSeparator' => '.',
            'symbolPlacement' => 'before'
        ],
        'GIP' => [
            'code' => 'GIP',
            'title' => 'Gibraltar Pound',
            'symbol' => '£',
            'precision' => 2,
            'thousandSeparator' => ',',
            'decimalSeparator' => '.',
            'symbolPlacement' => 'before'
        ],
        'GTQ' => [
            'code' => 'GTQ',
            'title' => 'Guatemala, Quetzal',
            'symbol' => 'Q',
            'precision' => 2,
            'thousandSeparator' => ',',
            'decimalSeparator' => '.',
            'symbolPlacement' => 'before'
        ],
        'HNL' => [
            'code' => 'HNL',
            'title' => 'Honduras, Lempira',
            'symbol' => 'L',
            'precision' => 2,
            'thousandSeparator' => ',',
            'decimalSeparator' => '.',
            'symbolPlacement' => 'before'
        ],
        'HKD' => [
            'code' => 'HKD',
            'title' => 'Hong Kong Dollar',
            'symbol' => 'HK$',
            'precision' => 2,
            'thousandSeparator' => ',',
            'decimalSeparator' => '.',
            'symbolPlacement' => 'before'
        ],
        'HUF' => [
            'code' => 'HUF',
            'title' => 'Hungary, Forint',
            'symbol' => ' Ft',
            'precision' => 0,
            'thousandSeparator' => ' ',
            'decimalSeparator' => '',
            'symbolPlacement' => 'after'
        ],
        'ISK' => [
            'code' => 'ISK',
            'title' => 'Iceland Krona',
            'symbol' => ' kr',
            'precision' => 0,
            'thousandSeparator' => '.',
            'decimalSeparator' => '',
            'symbolPlacement' => 'after'
        ],
        'INR' => [
            'code' => 'INR',
            'title' => 'Indian Rupee ₹',
            'symbol' => '₹',
            'precision' => 2,
            'thousandSeparator' => ',',
            'decimalSeparator' => '.',
            'symbolPlacement' => 'before'
        ],
        'IDR' => [
            'code' => 'IDR',
            'title' => 'Indonesia, Rupiah',
            'symbol' => 'Rp',
            'precision' => 2,
            'thousandSeparator' => '.',
            'decimalSeparator' => ',',
            'symbolPlacement' => 'before'
        ],
        'IRR' => [
            'code' => 'IRR',
            'title' => 'Iranian Rial',
            'symbol' => null,
            'precision' => 2,
            'thousandSeparator' => ',',
            'decimalSeparator' => '.',
            'symbolPlacement' => 'before'
        ],
        'JMD' => [
            'code' => 'JMD',
            'title' => 'Jamaican Dollar',
            'symbol' => 'J$',
            'precision' => 2,
            'thousandSeparator' => ',',
            'decimalSeparator' => '.',
            'symbolPlacement' => 'before'
        ],
        'JPY' => [
            'code' => 'JPY',
            'title' => 'Japan, Yen',
            'symbol' => '¥',
            'precision' => 0,
            'thousandSeparator' => ',',
            'decimalSeparator' => '',
            'symbolPlacement' => 'before'
        ],
        'JOD' => [
            'code' => 'JOD',
            'title' => 'Jordanian Dinar',
            'symbol' => null,
            'precision' => 3,
            'thousandSeparator' => ',',
            'decimalSeparator' => '.',
            'symbolPlacement' => 'before'
        ],
        'KES' => [
            'code' => 'KES',
            'title' => 'Kenyan Shilling',
            'symbol' => 'KSh',
            'precision' => 2,
            'thousandSeparator' => ',',
            'decimalSeparator' => '.',
            'symbolPlacement' => 'before'
        ],
        'KWD' => [
            'code' => 'KWD',
            'title' => 'Kuwaiti Dinar',
            'symbol' => 'K.D.',
            'precision' => 3,
            'thousandSeparator' => ',',
            'decimalSeparator' => '.',
            'symbolPlacement' => 'before'
        ],
        'LVL' => [
            'code' => 'LVL',
            'title' => 'Latvian Lats',
            'symbol' => 'Ls',
            'precision' => 2,
            'thousandSeparator' => ',',
            'decimalSeparator' => '.',
            'symbolPlacement' => 'before'
        ],
        'LBP' => [
            'code' => 'LBP',
            'title' => 'Lebanese Pound',
            'symbol' => 'LBP',
            'precision' => 0,
            'thousandSeparator' => ',',
            'decimalSeparator' => '',
            'symbolPlacement' => 'before'
        ],
        'LTL' => [
            'code' => 'LTL',
            'title' => 'Lithuanian Litas',
            'symbol' => ' Lt',
            'precision' => 2,
            'thousandSeparator' => ' ',
            'decimalSeparator' => ',',
            'symbolPlacement' => 'after'
        ],
        'MKD' => [
            'code' => 'MKD',
            'title' => 'Macedonia, Denar',
            'symbol' => 'ден ',
            'precision' => 2,
            'thousandSeparator' => '.',
            'decimalSeparator' => ',',
            'symbolPlacement' => 'before'
        ],
        'MYR' => [
            'code' => 'MYR',
            'title' => 'Malaysian Ringgit',
            'symbol' => 'RM',
            'precision' => 2,
            'thousandSeparator' => ',',
            'decimalSeparator' => '.',
            'symbolPlacement' => 'before'
        ],
        'MTL' => [
            'code' => 'MTL',
            'title' => 'Maltese Lira',
            'symbol' => 'Lm',
            'precision' => 2,
            'thousandSeparator' => ',',
            'decimalSeparator' => '.',
            'symbolPlacement' => 'before'
        ],
        'MUR' => [
            'code' => 'MUR',
            'title' => 'Mauritius Rupee',
            'symbol' => 'Rs',
            'precision' => 0,
            'thousandSeparator' => ',',
            'decimalSeparator' => '',
            'symbolPlacement' => 'before'
        ],
        'MXN' => [
            'code' => 'MXN',
            'title' => 'Mexican Peso',
            'symbol' => 'MX$',
            'precision' => 2,
            'thousandSeparator' => ',',
            'decimalSeparator' => '.',
            'symbolPlacement' => 'before'
        ],
        'MZM' => [
            'code' => 'MZM',
            'title' => 'Mozambique Metical',
            'symbol' => 'MT',
            'precision' => 2,
            'thousandSeparator' => '.',
            'decimalSeparator' => ',',
            'symbolPlacement' => 'before'
        ],
        'NPR' => [
            'code' => 'NPR',
            'title' => 'Nepalese Rupee',
            'symbol' => null,
            'precision' => 2,
            'thousandSeparator' => ',',
            'decimalSeparator' => '.',
            'symbolPlacement' => 'before'
        ],
        'ANG' => [
            'code' => 'ANG',
            'title' => 'Netherlands Antillian Guilder',
            'symbol' => 'NAƒ ',
            'precision' => 2,
            'thousandSeparator' => '.',
            'decimalSeparator' => ',',
            'symbolPlacement' => 'before'
        ],
        'ILS' => [
            'code' => 'ILS',
            'title' => 'New Israeli Shekel ₪',
            'symbol' => ' ₪',
            'precision' => 2,
            'thousandSeparator' => ',',
            'decimalSeparator' => '.',
            'symbolPlacement' => 'after'
        ],
        'TRY' => [
            'code' => 'TRY',
            'title' => 'New Turkish Lira',
            'symbol' => '₺',
            'precision' => 2,
            'thousandSeparator' => '.',
            'decimalSeparator' => ',',
            'symbolPlacement' => 'before'
        ],
        'NZD' => [
            'code' => 'NZD',
            'title' => 'New Zealand Dollar',
            'symbol' => 'NZ$',
            'precision' => 2,
            'thousandSeparator' => ',',
            'decimalSeparator' => '.',
            'symbolPlacement' => 'before'
        ],
        'NOK' => [
            'code' => 'NOK',
            'title' => 'Norwegian Krone',
            'symbol' => 'kr ',
            'precision' => 2,
            'thousandSeparator' => ' ',
            'decimalSeparator' => ',',
            'symbolPlacement' => 'before'
        ],
        'PKR' => [
            'code' => 'PKR',
            'title' => 'Pakistan Rupee',
            'symbol' => null,
            'precision' => 2,
            'thousandSeparator' => ',',
            'decimalSeparator' => '.',
            'symbolPlacement' => 'before'
        ],
        'PEN' => [
            'code' => 'PEN',
            'title' => 'Peru, Nuevo Sol',
            'symbol' => 'S/.',
            'precision' => 2,
            'thousandSeparator' => ',',
            'decimalSeparator' => '.',
            'symbolPlacement' => 'before'
        ],
        'UYU' => [
            'code' => 'UYU',
            'title' => 'Peso Uruguayo',
            'symbol' => '$U ',
            'precision' => 2,
            'thousandSeparator' => '.',
            'decimalSeparator' => ',',
            'symbolPlacement' => 'before'
        ],
        'PHP' => [
            'code' => 'PHP',
            'title' => 'Philippine Peso',
            'symbol' => '₱',
            'precision' => 2,
            'thousandSeparator' => ',',
            'decimalSeparator' => '.',
            'symbolPlacement' => 'before'
        ],
        'PLN' => [
            'code' => 'PLN',
            'title' => 'Poland, Zloty',
            'symbol' => ' zł',
            'precision' => 2,
            'thousandSeparator' => ' ',
            'decimalSeparator' => ',',
            'symbolPlacement' => 'after'
        ],
        'GBP' => [
            'code' => 'GBP',
            'title' => 'Pound Sterling',
            'symbol' => '£',
            'precision' => 2,
            'thousandSeparator' => ',',
            'decimalSeparator' => '.',
            'symbolPlacement' => 'before'
        ],
        'OMR' => [
            'code' => 'OMR',
            'title' => 'Rial Omani',
            'symbol' => 'OMR',
            'precision' => 3,
            'thousandSeparator' => ',',
            'decimalSeparator' => '.',
            'symbolPlacement' => 'before'
        ],
        'RON' => [
            'code' => 'RON',
            'title' => 'Romania, New Leu',
            'symbol' => null,
            'precision' => 2,
            'thousandSeparator' => '.',
            'decimalSeparator' => ',',
            'symbolPlacement' => 'before'
        ],
        'ROL' => [
            'code' => 'ROL',
            'title' => 'Romania, Old Leu',
            'symbol' => null,
            'precision' => 2,
            'thousandSeparator' => '.',
            'decimalSeparator' => ',',
            'symbolPlacement' => 'before'
        ],
        'RUB' => [
            'code' => 'RUB',
            'title' => 'Russian Ruble',
            'symbol' => ' руб',
            'precision' => 2,
            'thousandSeparator' => ' ',
            'decimalSeparator' => ',',
            'symbolPlacement' => 'after'
        ],
        'SAR' => [
            'code' => 'SAR',
            'title' => 'Saudi Riyal',
            'symbol' => 'SAR',
            'precision' => 2,
            'thousandSeparator' => ',',
            'decimalSeparator' => '.',
            'symbolPlacement' => 'before'
        ],
        'SGD' => [
            'code' => 'SGD',
            'title' => 'Singapore Dollar',
            'symbol' => 'S$',
            'precision' => 2,
            'thousandSeparator' => ',',
            'decimalSeparator' => '.',
            'symbolPlacement' => 'before'
        ],
        'SKK' => [
            'code' => 'SKK',
            'title' => 'Slovak Koruna',
            'symbol' => ' SKK',
            'precision' => 2,
            'thousandSeparator' => ' ',
            'decimalSeparator' => ',',
            'symbolPlacement' => 'after'
        ],
        'SIT' => [
            'code' => 'SIT',
            'title' => 'Slovenia, Tolar',
            'symbol' => null,
            'precision' => 2,
            'thousandSeparator' => '.',
            'decimalSeparator' => ',',
            'symbolPlacement' => 'before'
        ],
        'ZAR' => [
            'code' => 'ZAR',
            'title' => 'South Africa, Rand',
            'symbol' => 'R',
            'precision' => 2,
            'thousandSeparator' => ' ',
            'decimalSeparator' => '.',
            'symbolPlacement' => 'before'
        ],
        'KRW' => [
            'code' => 'KRW',
            'title' => 'South Korea, Won ₩',
            'symbol' => '₩',
            'precision' => 0,
            'thousandSeparator' => ',',
            'decimalSeparator' => '',
            'symbolPlacement' => 'before'
        ],
        'SZL' => [
            'code' => 'SZL',
            'title' => 'Swaziland, Lilangeni',
            'symbol' => 'E',
            'precision' => 2,
            'thousandSeparator' => ',',
            'decimalSeparator' => '.',
            'symbolPlacement' => 'before'
        ],
        'SEK' => [
            'code' => 'SEK',
            'title' => 'Swedish Krona',
            'symbol' => ' kr',
            'precision' => 2,
            'thousandSeparator' => ' ',
            'decimalSeparator' => ',',
            'symbolPlacement' => 'after'
        ],
        'CHF' => [
            'code' => 'CHF',
            'title' => 'Swiss Franc',
            'symbol' => 'SFr ',
            'precision' => 2,
            'thousandSeparator' => '\'',
            'decimalSeparator' => '.',
            'symbolPlacement' => 'before'
        ],
        'TZS' => [
            'code' => 'TZS',
            'title' => 'Tanzanian Shilling',
            'symbol' => 'TSh',
            'precision' => 0,
            'thousandSeparator' => ',',
            'decimalSeparator' => '.',
            'symbolPlacement' => 'before'
        ],
        'THB' => [
            'code' => 'THB',
            'title' => 'Thailand, Baht ฿',
            'symbol' => '฿',
            'precision' => 2,
            'thousandSeparator' => ',',
            'decimalSeparator' => '.',
            'symbolPlacement' => 'before'
        ],
        'TOP' => [
            'code' => 'TOP',
            'title' => 'Tonga, Paanga',
            'symbol' => 'T$ ',
            'precision' => 2,
            'thousandSeparator' => ',',
            'decimalSeparator' => '.',
            'symbolPlacement' => 'before'
        ],
        'AED' => [
            'code' => 'AED',
            'title' => 'UAE Dirham',
            'symbol' => 'AED',
            'precision' => 2,
            'thousandSeparator' => ',',
            'decimalSeparator' => '.',
            'symbolPlacement' => 'before'
        ],
        'UAH' => [
            'code' => 'UAH',
            'title' => 'Ukraine, Hryvnia',
            'symbol' => ' ₴',
            'precision' => 2,
            'thousandSeparator' => ' ',
            'decimalSeparator' => ',',
            'symbolPlacement' => 'after'
        ],
        'USD' => [
            'code' => 'USD',
            'title' => 'US Dollar',
            'symbol' => '$',
            'precision' => 2,
            'thousandSeparator' => ',',
            'decimalSeparator' => '.',
            'symbolPlacement' => 'before'
        ],
        'VUV' => [
            'code' => 'VUV',
            'title' => 'Vanuatu, Vatu',
            'symbol' => 'VT',
            'precision' => 0,
            'thousandSeparator' => ',',
            'decimalSeparator' => '',
            'symbolPlacement' => 'before'
        ],
        'VEF' => [
            'code' => 'VEF',
            'title' => 'Venezuela Bolivares Fuertes',
            'symbol' => 'Bs.',
            'precision' => 2,
            'thousandSeparator' => '.',
            'decimalSeparator' => ',',
            'symbolPlacement' => 'before'
        ],
        'VEB' => [
            'code' => 'VEB',
            'title' => 'Venezuela, Bolivar',
            'symbol' => 'Bs.',
            'precision' => 2,
            'thousandSeparator' => '.',
            'decimalSeparator' => ',',
            'symbolPlacement' => 'before'
        ],
        'VND' => [
            'code' => 'VND',
            'title' => 'Viet Nam, Dong ₫',
            'symbol' => ' ₫',
            'precision' => 0,
            'thousandSeparator' => '.',
            'decimalSeparator' => '',
            'symbolPlacement' => 'after'
        ],
        'ZWD' => [
            'code' => 'ZWD',
            'title' => 'Zimbabwe Dollar',
            'symbol' => 'Z$',
            'precision' => 2,
            'thousandSeparator' => ' ',
            'decimalSeparator' => '.',
            'symbolPlacement' => 'before'
        ],
    ];
}
