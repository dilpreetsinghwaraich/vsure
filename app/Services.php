<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    protected $table = 'services';

    protected $primaryKey = 'service_id';

    protected $fillable = [
        'service_title', 'service_content', 'service_questions','service_short_info', 'service_features', 'service_documents', 'service_process_results', 'service_packages', 'status', 'show_nav_menu'
    ];
}
