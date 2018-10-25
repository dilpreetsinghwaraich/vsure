<?php
namespace App\Classes;
use Illuminate\Http\Request;
use App\Http\Requests;
use Validator, DateTime, DB, Hash, File, Config, Helpers;
use Session, Redirect;
use App\User;
class Helper
{
	public static function SendEmail($to='',$subject='',$htmlmessage='',$Attachment='')
	{  
	    $hostlist = array('127.0.0.1', "localhost");
	    if(in_array($_SERVER['SERVER_NAME'], $hostlist)){
	        return;
	    }	    
	    $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        mail($to,$subject,$htmlmessage,$headers);
	}
	
	public static function SendSMS($mobileNumber, $message)
	{
	  return;
	    
	}
	public static function maybe_unserialize( $original ) {
		if ( self::is_serialized( $original ) ) 
		    return @unserialize( $original );
		return $original;
	}
	public static function is_serialized( $data, $strict = true ) {
		if ( ! is_string( $data ) ) {
			return false;
		}
		$data = trim( $data );
		if ( 'N;' == $data ) {
			return true;
		}
		if ( strlen( $data ) < 4 ) {
			return false;
		}
		if ( ':' !== $data[1] ) {
			return false;
		}
		if ( $strict ) {
			$lastc = substr( $data, -1 );
			if ( ';' !== $lastc && '}' !== $lastc ) {
				return false;
			}
		} 
		else 
		{
			$semicolon = strpos( $data, ';' );
			$brace     = strpos( $data, '}' );
			if ( false === $semicolon && false === $brace )
				return false;
			if ( false !== $semicolon && $semicolon < 3 )
				return false;
			if ( false !== $brace && $brace < 4 )
				return false;
		}
		$token = $data[0];
		switch ( $token ) {
			case 's' :
				if ( $strict ) {
					if ( '"' !== substr( $data, -2, 1 ) ) {
					    return false;
					}
				} 
				elseif ( false === strpos( $data, '"' ) ) {
					return false;
				}
			case 'a' :
			case 'O' :
				return (bool) preg_match( "/^{$token}:[0-9]+:/s", $data );
			case 'b' :
			case 'i' :
			case 'd' :
				$end = $strict ? '$' : '';
				return (bool) preg_match( "/^{$token}:[0-9.E-]+;$end/", $data );
		}
		return false;
	}
	 
	public static function maybe_serialize( $data ) {
		if ( is_array( $data ) || is_object( $data ) )
		     return serialize( $data );
		if ( self::is_serialized( $data, false ) )
			return serialize( $data );	 
	    return $data;
	}
	public static function fileuploadmultiple($request)
	{
	    $files = $request->file('attachments');
	    $uploaded_file = [];
	    foreach($files as $file) {
	        $destinationPath = 'public/images/uploads/'.date('Y').'/'.date('M');
	        $filename = str_replace(array(' ','-','`',','),'_',time().'_'.$file->getClientOriginalName());
	        $upload_success = $file->move($destinationPath, $filename);
	        $uploaded_file[] = 'public/images/uploads/'.date('Y').'/'.date('M').'/'.$filename;        
	    }
	    return $uploaded_file;
	}
	public static function fileupload($request){
	    $file = $request->file('image');
	    $destinationPath = 'public/images/uploads/'.date('Y').'/'.date('M');
	    $filename = time().'_'.$file->getClientOriginalName();
	    $upload_success = $file->move($destinationPath, $filename);
	    $uploaded_file = 'public/images/uploads/'.date('Y').'/'.date('M').'/'.$filename;            
	    return $uploaded_file;
	}
	public static function fileuploadExtra($request, $key){
	    $file = $request->file($key);
	    $destinationPath = 'public/images/uploads/'.date('Y').'/'.date('M');
	    $filename = time().'_'.$file->getClientOriginalName();
	    $upload_success = $file->move($destinationPath, $filename);
	    $uploaded_file = 'public/images/uploads/'.date('Y').'/'.date('M').'/'.$filename;            
	    return $uploaded_file;
	}
	public static function randomPassword() {
	    return mt_rand(100000, 999999);
	    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
	    $pass = array(); //remember to declare $pass as an array
	    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
	    for ($i = 0; $i < 8; $i++) {
	        $n = rand(0, $alphaLength);
	        $pass[] = $alphabet[$n];
	    }
	    return implode($pass); //turn the array into a string
	}
	
	public static function getCurrentUser()
	{
	    return User::first();
	}
	public static function getUser($user_id)
	{
	    return DB::table('users')->where('user_id', $user_id)->select('*')->get()->first();
	}
	public static function getPercantageAmount($amount, $percent)
	{
	    return $amount/100*$percent;
	}
	public static function getDuration($date)
	{
	  $time = '';
	  $t1 = \Carbon\Carbon::parse($date);
	  $t2 = \Carbon\Carbon::parse();
	  $diff = $t1->diff($t2);
	  if ($diff->format('%y')!=0) {
	    $time .= $diff->format('%y')." Year ";
	  }
	  if ($diff->format('%m')!=0) {
	    $time .= $diff->format('%m')." Month ";
	  }
	  if ($diff->format('%d') && $diff->format('%m')==0) {
	    $time .= $diff->format('%d')." Days ";
	  }
	  if ($diff->format('%h')!=0 && $diff->format('%m')==0) {
	    $time .= $diff->format('%h')." Hours ";
	  }
	  if ($diff->format('%i')!=0 && $diff->format('%d')==0) {
	    $time .= $diff->format('%i')." Minutes ";
	  }
	  if ($diff->format('%s')!=0 && $diff->format('%h')==0) {
	    $time .= $diff->format('%s')." Seconds ";
	  }
	  return $time;
	}
	public static function weekOfMonth($currentMonth)
	{
	    $stdate = $currentMonth.'-01';
	    $enddate = $currentMonth.'-31'; //get end date of month
	    $begin = new \DateTime('first day of ' . $stdate);
	    $end = new \DateTime('last day of ' . $enddate);
	    $interval = new \DateInterval('P1W');
	    $daterange = new \DatePeriod($begin, $interval, $end);

	    $dates = array();
	    foreach($daterange as $key => $date) {
	        $check = ($date->format('W') != $end->modify('last day of this month')->format('W')) ? '+6 days' : 'last day of this week';
	        $dates[$key+1] = array(
	            'start' => $date->format('Y-m-d'),
	            'end' => ($date->modify($check)->format('Y-m-d')),
	        );    
	        if ($dates[$key+1]['end']>date('Y-m-d', strtotime($enddate))) {
	              $dates[$key+1]['end'] = date('Y-m-d', strtotime($enddate));
	        }    
	    }
	    return $dates;
	}
	public static function displayPrice($package)
    {
        if (!empty($package->discount_start) && !empty($package->discount_end) && date('Y-m-d') >= date('Y-m-d', strtotime($package->discount_start)) && date('Y-m-d') <= date('Y-m-d', strtotime($package->discount_end))) {
            return '<span class="special-price">&#8377; '.$package->sale_price.'</span> <del>&#8377; '.$package->regular_price.'</del>';
        }else
        {
            return '<span class="special-price">&#8377; '.$package->regular_price.' </span>';
        }
    }
    public static function displayPriceOnly($package)
    {
        if (!empty($package->discount_start) && !empty($package->discount_end) && date('Y-m-d') >= date('Y-m-d', strtotime($package->discount_start)) && date('Y-m-d') <= date('Y-m-d', strtotime($package->discount_end))) {
            return $package->sale_price;
        }else
        {
            return $package->regular_price;
        }
    }
}
