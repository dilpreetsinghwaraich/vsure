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
use danielme85\CConverter\Currency;
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
	    return $price;    
    	if ($symbole == 'without') {
			return $price;
		}
		return moneyFormat($price, $currency);    	
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
}
