<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;
use App\Services;
use App\Documents;
use App\Features;
use App\Packages;
use App\Questions;
use App\ProcessResults;
use App\Terms;

class ServiceController extends Controller
{
    public function partnershipFirmRegistration($service_slug = null)
    {
    	if (empty($service_slug)) {
	    	$view = 'Pages.404';
        	return view('Includes.commonTemplate',compact('view'));
    	}
    	$service = Services::where('status',1)->where('service_slug', $service_slug)->get()->first();

    	if (empty($service)) {
	    	$view = 'Pages.404';
        	return view('Includes.commonTemplate',compact('view'));
    	}
    	$data = [];
    	$data['service'] = $service;
    	$data['service_question'] = \Helper::maybe_unserialize($service->service_questions);
        $data['service_feature'] = \Helper::maybe_unserialize($service->service_features);
        $data['service_short_info'] = \Helper::maybe_unserialize($service->service_short_info);
        $data['service_document'] = \Helper::maybe_unserialize($service->service_documents);
        $data['service_process_results'] = \Helper::maybe_unserialize($service->service_process_results);
        $data['service_package'] = \Helper::maybe_unserialize($service->service_packages);
    	
        $question_term_ids = (isset($data['service_question']['question_terms'])?$data['service_question']['question_terms']:[]);
    	$data['questions'] = Questions::whereIn('question_terms', $question_term_ids)->get();       
        
        $data['question_tabs'] = Terms::whereIn('term_id', $question_term_ids)->get();
    	$data['features'] = Features::whereIn('feature_terms', (isset($data['service_feature']['feature_terms'])?$data['service_feature']['feature_terms']:[]))->get();
    	$data['packages'] = Packages::whereIn('package_terms', (isset($data['service_package']['package_terms'])?$data['service_package']['package_terms']:[]))->get();
    	$data['documents'] = Documents::whereIn('document_terms', (isset($data['service_document']['document_terms'])?$data['service_document']['document_terms']:[]))->get();
        $data['process_results'] = ProcessResults::whereIn('process_terms', (isset($data['service_process_results']['process_terms'])?$data['service_process_results']['process_terms']:[]))->get();

    	$data['title'] = $service->service_title;
        $data['view'] = 'Service.SingleService';
        
        return view('Includes.commonTemplate',$data);
    }
}
