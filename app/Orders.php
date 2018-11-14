<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $table = 'product_order';

    protected $primaryKey = 'order_id';

    protected $fillable = [
        'invoice_id', 'package_id', 'package_title', 'user_id', 'quantity', 'order_status', 'order_date', 'billing_address','shipping_address', 'customer_name','email','phone','purchase_details','products_details','product_package','amount_status','order_sub_total','order_tax','order_shipping','coupon_code','coupon_value','coupon_status','discount','grand_total','payment_id','payment_method','created_at','updated_at'
    ];
}
