<?php

// $data =  [
//                 "label" =>  $item->Product->name
//             ];
//             $counter = [];
//             $carbon = Carbon::now();
//             for ($i = 1; $i <= $range; $i++) {
//                 $c = $item;
//                 array_push($counter, $c);
//                 $carbon->subDays(1);
//             }
//             $data['data'] = $counter;
//             return $data;

use App\Models\Vendor;
use Carbon\Carbon;

$vendor = Vendor::find(9);

$carbon = Carbon::now();
$c = $vendor->ProductVendor->find(16)->TransactionDetail();

$a = $c->whereDate('created_at', $carbon->toDateString());
