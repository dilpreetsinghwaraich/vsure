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
    	
    	$questions = Questions::whereIn('question_id', (isset($data['service_question']['question_ids'])?$data['service_question']['question_ids']:[]))->get();
        $question_term_ids = [];
        if (!empty($questions)) {
            foreach ($questions as $question) {
                $question_terms = \Helper::maybe_unserialize($question->question_terms);
                if (!empty($question_terms)) {
                    foreach ($question_terms as $question_term) {
                        $question_term_ids[] = $question_term;
                    }
                }
            }
        }
        $data['questions'] = $questions;
        $data['question_tabs'] = Terms::whereIn('term_id', $question_term_ids)->get();
    	$data['features'] = Features::whereIn('feature_id', (isset($data['service_feature']['feature_ids'])?$data['service_feature']['feature_ids']:[]))->get();
    	$data['packages'] = Packages::whereIn('package_id', (isset($data['service_package']['package_ids'])?$data['service_package']['package_ids']:[]))->get();
    	$data['documents'] = Documents::whereIn('document_id', (isset($data['service_document']['document_ids'])?$data['service_document']['document_ids']:[]))->get();
        $data['process_results'] = ProcessResults::whereIn('process_id', (isset($data['service_process_results']['process_ids'])?$data['service_process_results']['process_ids']:[]))->get();

    	$data['title'] = $service->service_title;
        $data['view'] = 'Service.PartnershipFirmRegistration';
        
        return view('Includes.commonTemplate',$data);
    }
}
