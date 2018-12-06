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
class Helper
{
	public static function SendEmail($to='',$subject='',$htmlmessage='',$Attachment='')
	{  
		Mail::send('EmailTemplate.Index', ['html' => $htmlmessage], function ($message) use($to, $subject)
        {
            $message->from('answeredu@gmail.com', 'EDU Answer');
            $message->to($to);
            $message->subject($subject);
        });
        return;
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
	public function getServiceSubMenu()
	{
		$menuHtml = '';
		$menus = Post::whereIn('post_type',['menu'])->whereNull('post_parent')->get(); 
		if (!empty($menus)) {
			foreach ($menus as $menu) {
				$subMenus = Post::whereIn('post_type',['menu'])->where('post_parent', $menu->post_id)->get()->toArray(); 
				if (!empty($subMenus)) {
					$menuHtml .='<li>
					  <ul class="nav navbar-nav navbar-right">
					    <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown">'. $menu->post_title .' <span class="fa fa-angle-down"></span> </a>
					      <ul class="dropdown-menu">
					        <li>
					          <div class="service_box">
					            <div class="row">';
					            foreach ($subMenus as $subMenu) {
					            	$menuHtml .='<div class="col-lg-12"><a href="'. url('/'.$subMenu['post_slug']) .'">'. $subMenu['post_title'] .'</a></div>';
					            }
					            $menuHtml .='</div>
					          </div>
					        </li>
					      </ul>
					    </li>
					  </ul>
					</li>';
				}else{
					if ($menu->post_slug == '/') {
						$menuHtml .='<li class="">
							<a href="'. url('/') .'">'. $menu->post_title .'</a>
						</li>';
					}else{
						$menuHtml .='<li class="">
							<a href="'. url('/'.$menu->post_slug) .'">'. $menu->post_title .'</a>
						</li>';
					}					
				}				
			}
		}
		return $menuHtml;
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
	public static function fileuploadArray($file){
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
		if (empty(session('token'))) {
			return new User();
		}
		return JWTAuth::toUser(session('token'));
	}
	public static function getCurrentUserByKey($key)
	{
		$user = self::getCurrentUser();
		if (!empty($key)) {
			return isset($user->$key)?$user->$key:0;
		}
		return $user;
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
    public static function ourClientsSection()
    {
    	return view('Template.OurClients');
    }
    public static function createInvoice($order, $type)
    {
    	return view('Template.CreateInvoice', compact('order','type'));
    }
    public static function viewInvoice($order, $type)
    {
    	return view('Template.ViewInvoice', compact('order','type'));
    }
    
    public static function getPostTermByID($term_id)
    {
    	return Terms::find($term_id);
    }

    public static function latestBlogSection()
    {
    	$posts = Post::whereIn('post_type', ['blog'])->orderBy('created_at', 'DESC')->paginate(4);
    	return view('Template.LatestBlogs',compact('posts'));
    }
    public static function SidebarPost($type, $service)
    {
    	$states = DB::table('state_city')->select('city','city_id')->orderBy('state','asc')->get();
    	$services = Services::get();
    	return view('Sidebar.SidebarPost', compact('states','services','type','service'));
    }
    public static function similarPosts($post)
    {
    	$posts = Post::whereIn('post_type', ['blog'])->where('term', $post->term)->where('post_id', '!=', $post->post_id)->orderBy('created_at', 'DESC')->paginate(3);
    	foreach ($posts as $post) {

    	  ?>
    	  <div class="card card_small_with_image grid-item"> 
    	  	<img class="card-img-top" style="width: 100%;" src="<?php echo asset('/').'/'.$post->image; ?>" alt="<?php echo $post->post_title ?>">
    	    <div class="card-body">
    	      <div class="card-title card-title-small">
    	      	<a href="<?php echo url('/'.$post->post_slug); ?>"><?php echo $post->post_excerpt; ?></a>
    	      </div>
    	      <small class="post_meta">
    	      	<a href="<?php echo url('/'.$post->post_slug); ?>"><?php echo $post->post_title ?></a>
    	      	<span><?php echo date('M, d Y',strtotime($post->created_at)); ?></span>
    	      </small> 
    	  	</div>
    	  </div>
    	  <?php
    	}
    }
    public static function comments($post)
    {
    	$comments = Comments::where('post_id', '=', $post->post_id)/*->where('status','publish')*/->paginate(10);
    	return view('Template.CommentBox',compact('comments','post'));
    }
    public static function serviceFormMenu()
    {
    	$serviceForms = ServiceForm::get();
    	$serviceIds = [];
    	foreach ($serviceForms as $serviceForm) {
    		$serviceIds[] = $serviceForm->service_id;
    	}

    	return Services::whereNotIn('service_id', $serviceIds)->select('service_id','service_title')->get()->toArray();
    }
    public static function getTabField($tabCount = 0, $title = '')
    {    	
    	return '
    			<div class="append_tab_content open" id="tab_content_'.$tabCount.'" data-tabCount="'.$tabCount.'">
    				<div class="form-group col-md-12">
    					<label>Please enter your Tab Title</label>
    					<a href="javascript:void(0)" class="removeTab btn btn-info" data-tab_id="tab_content_'.$tabCount.'">Remove</a>
    					<a href="javascript:void(0)" class="OPenCloseTab btn btn-info" data-tab_id="tab_content_'.$tabCount.'">Open/Close</a>
                    	<input type="text" class="form-control tab_title" required id="tab_title" name="form_fields['.$tabCount.'][tab_title]" value="'.$title.'" placeholder="Tab Title">
                  	</div>
                 </div>';
    }
    public static function getTextField($tabCount = 0, $fieldCount = 0, $title = '')
    {
    	return '
				<div class="form-group col-md-12 textField commonGroup">
					<label>Text field Area</label>
					<a href="javascript:void(0)" class="removeField btn btn-info" data-tab_id="tab_content_'.$tabCount.'">Remove</a>
                	<input type="text" class="form-control textFieldTitle" required id="text_title_'.$fieldCount.'" name="form_fields['.$tabCount.'][field]['.$fieldCount.'][text][title]" value="'.$title.'" placeholder="Text Title">
              	</div>';
    }
    public static function getEmailField($tabCount = 0, $fieldCount = 0, $title = '')
    {
    	return '
				<div class="form-group col-md-12 emailField commonGroup v">
					<label>Email field Area</label>
					<a href="javascript:void(0)" class="removeField btn btn-info" data-tab_id="tab_content_'.$tabCount.'">Remove</a>
                	<input type="text" class="form-control emailFieldTitle" required id="email_title_'.$fieldCount.'" name="form_fields['.$tabCount.'][field]['.$fieldCount.'][email][title]" value="'.$title.'" placeholder="Email Title">
              	</div>';
    }

    public static function getNumberField($tabCount = 0, $fieldCount = 0, $title = '')
    {
    	return '
				<div class="form-group col-md-12 numberField commonGroup">
					<label>Number field Area</label>
					<a href="javascript:void(0)" class="removeField btn btn-info" data-tab_id="tab_content_'.$tabCount.'">Remove</a>
                	<input type="text" class="form-control numberFieldTitle" required id="number_title_'.$fieldCount.'" name="form_fields['.$tabCount.'][field]['.$fieldCount.'][number][title]" value="'.$title.'" placeholder="Number Title">
              	</div>';
    }
    public static function getTextareaField($tabCount = 0, $fieldCount = 0, $title = '')
    {
    	return '
				<div class="form-group col-md-12 textareaField commonGroup">
					<label>Textarea Field Area</label>
					<a href="javascript:void(0)" class="removeField btn btn-info" data-tab_id="tab_content_'.$tabCount.'">Remove</a>
                	<input type="text" class="form-control textareaFielditle" required id="textarea_title_'.$fieldCount.'" name="form_fields['.$tabCount.'][field]['.$fieldCount.'][textarea][title]" value="'.$title.'" placeholder="Textarea Title">
              	</div>';
    }
    public static function getCheckboxField($tabCount = 0, $fieldCount = 0, $title = '', $value = '')
    {
    	return '
				<div class="form-group col-md-12 checkboxField commonGroup">
					<label>Checkbox field Area</label>
					<a href="javascript:void(0)" class="removeField btn btn-info" data-tab_id="tab_content_'.$tabCount.'">Remove</a>
					<input type="text" class="form-control checkboxFielditle" required id="textarea_title_'.$fieldCount.'" name="form_fields['.$tabCount.'][field]['.$fieldCount.'][checkbox][title]" value="'.$title.'" placeholder="Checkbox Label">
					<h4>Please enter value ^ saprated EXPAMPLE (text1^text2^text3)</h4>
                	<textarea class="form-control checkboxFieldValue" required id="checkbox_value_'.$fieldCount.'" name="form_fields['.$tabCount.'][field]['.$fieldCount.'][checkbox][value]" placeholder="Checkbox Value">'.$value.'</textarea>
              	</div>';
    }
    public static function getRadioField($tabCount = 0, $fieldCount = 0, $title = '', $value = '')
    {
    	return '
				<div class="form-group col-md-12 radioField commonGroup">
					<label>Radio field Area</label>
					<a href="javascript:void(0)" class="removeField btn btn-info" data-tab_id="tab_content_'.$tabCount.'">Remove</a>
					<input type="text" class="form-control radioFielditle" required id="radio_title_'.$fieldCount.'" name="form_fields['.$tabCount.'][field]['.$fieldCount.'][radio][title]" value="'.$title.'" placeholder="Radio Label">
					<h4>Please enter value ^ saprated EXPAMPLE (text1^text2^text3)</h4>
                	<textarea class="form-control radioFieldTitle" required id="radio_value_'.$fieldCount.'" name="form_fields['.$tabCount.'][field]['.$fieldCount.'][radio][value]" placeholder="Radio Value">'.$value.'</textarea>
              	</div>';
    }
    public static function getSelectField($tabCount = 0, $fieldCount = 0, $title = '', $value = '')
    {
    	return '
				<div class="form-group col-md-12 selectField commonGroup">
					<label>Select Option field Area</label>
					<a href="javascript:void(0)" class="removeField btn btn-info" data-tab_id="tab_content_'.$tabCount.'">Remove</a>
					<input type="text" class="form-control selectFielditle" required id="select_title_'.$fieldCount.'" name="form_fields['.$tabCount.'][field]['.$fieldCount.'][select][title]" value="'.$title.'" placeholder="Select Label">
					<h4>Please enter value ^ saprated EXPAMPLE (text1^text2^text3)</h4>
                	<textarea class="form-control selectFieldTitle" required id="select_title_'.$fieldCount.'" name="form_fields['.$tabCount.'][field]['.$fieldCount.'][select][value]" placeholder="Select Value">'.$value.'</textarea>
              	</div>';
    }

}
