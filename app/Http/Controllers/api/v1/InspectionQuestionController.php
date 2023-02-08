<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\QuestionItem;
use App\Models\CropCommodity;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use App\Models\Inspector;
use Illuminate\Support\Facades\Validator;

class InspectionQuestionController extends Controller
{
    public function question(Request $request,$commodity_id)
    {
        $inspection_items = QuestionItem::with('getItemOptionAttributes')->where('status', true)->whereJsonContains('commodity_types',strval($commodity_id))->orderBy('position')->get();
        if (!is_null($inspection_items) && count($inspection_items) > 0) {
            $response = [];
            $newResult = [];
            foreach ($inspection_items as $row) {
                $response['position'] = $row->position;
                $response['id'] = $row->id;
                $response['scout_report_category'] = array('id' => $row->scout_report_category_id, 'name' => $row->scout_report_category_name);
                $items = $row->getItemOptionAttributes;
                $new_options = [];
                foreach ($items as $item) {
                    $option['id'] = $item->id;
                    $option['label'] = $item->label;
                    $option['label_type'] = "checkbox";
                    $new_options[] = $option;
                }
                $commodity = [];

                if($row->commodity_types!=null && $row->commodity_types!='')
                {
                    $commodity_types=json_decode($row->commodity_types);
                    
                    if(!empty($commodity_types))
                    {
                        foreach($commodity_types as $vt)
                        {                         
                            $cropCommodity=CropCommodity::where('id',$vt)->first();
                            if($cropCommodity!='' && $cropCommodity!=null)
                            {   
                                $commodity_option['id'] = $cropCommodity->id;
                                $commodity_option['name'] = $cropCommodity->name;
                                $commodity[] = $commodity_option;                                
                            }
                        }
                    }
                }
                $response['commodity'] = $commodity;
                $response['item_options'] = $new_options;

                $newResult[] = $response;
            }
            return response()->json([
                'status' => 1,
                'data' => $newResult,
                'message' => "Success...!!",
            ]);
        } else {
            return response()->json([
                'status' => -1,
                'data' => [],
                'message' => "Not Created",
            ]);
        }
    }
   
    
}
