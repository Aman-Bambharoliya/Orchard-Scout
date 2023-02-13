<?php

namespace App\Http\Controllers;

use App\Models\InspectionItem;
use App\Models\InspectionType;
use App\Models\QuestionItem;
use App\Models\QuestionItemAttribute;
use App\Models\ItemOptionValue;
use App\Models\CropCommodity;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Auth;


class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            // $data = InspectionItem::all();
            $data=QuestionItem::orderBy('id', 'DESC');    

            if ($request->get('scout_report_category_id') != '' && $request->get('scout_report_category_id')!=null) {
                $data = $data->where('scout_report_category_id',$request->get('scout_report_category_id'));
            }    
            if ($request->get('status') != '' && $request->get('status')!=null) {
                $data = $data->where('status',$request->get('status'));
            }   
            if ($request->get('commodity_types') != '' && $request->get('commodity_types')!=null) {
                $data = $data->whereJsonContains('commodity_types',$request->get('commodity_types'));
            }  
          
            if ($request->get('is_deleted_at') != '' && $request->get('is_deleted_at')!=null) {
              
                if($request->get('is_deleted_at')=='true'){                   
                    $data = $data->withTrashed();
                }
            }             
            
            $data = $data->get();

            return DataTables::of($data)
                ->addColumn('action', function (QuestionItem $item) {

                    $user_data = Auth::user();
                    $actionBtn = '';
                    $edit_button = '';
                    $delete_button = '';
                    if ($user_data->hasPermission('questions', 'update')) {
                    $edit_button = '<a href="' . route('questions.edit', $item->id) . '" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                    <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                    <span class="svg-icon svg-icon-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="currentColor"></path>
                            <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="currentColor"></path>
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                </a>';
                    }
                    if ($user_data->hasPermission('questions', 'delete')) {
                    if(is_null($item->deleted_at)){
                        $delete_button = '<a href="#" data-id="' . route('questions.destroy', $item->id) . '" class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm me-1 delete_item">
                            <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                            <span class="svg-icon svg-icon-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="currentColor"></path>
                                    <path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="currentColor"></path>
                                    <path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="currentColor"></path>
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </a>';
                    }else{
                         $delete_button = '<a title="UnDelete" href="#" data-id="' . route('questions.undelete', $item->id) . '" class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm me-1 delete_request">
                        <span class="svg-icon svg-icon-3"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M14.5 20.7259C14.6 21.2259 14.2 21.826 13.7 21.926C13.2 22.026 12.6 22.0259 12.1 22.0259C9.5 22.0259 6.9 21.0259 5 19.1259C1.4 15.5259 1.09998 9.72592 4.29998 5.82592L5.70001 7.22595C3.30001 10.3259 3.59999 14.8259 6.39999 17.7259C8.19999 19.5259 10.8 20.426 13.4 19.926C13.9 19.826 14.4 20.2259 14.5 20.7259ZM18.4 16.8259L19.8 18.2259C22.9 14.3259 22.7 8.52593 19 4.92593C16.7 2.62593 13.5 1.62594 10.3 2.12594C9.79998 2.22594 9.4 2.72595 9.5 3.22595C9.6 3.72595 10.1 4.12594 10.6 4.02594C13.1 3.62594 15.7 4.42595 17.6 6.22595C20.5 9.22595 20.7 13.7259 18.4 16.8259Z" fill="currentColor"/>
                        <path opacity="0.3" d="M2 3.62592H7C7.6 3.62592 8 4.02592 8 4.62592V9.62589L2 3.62592ZM16 14.4259V19.4259C16 20.0259 16.4 20.4259 17 20.4259H22L16 14.4259Z" fill="currentColor"/>
                        </svg></span>
                        </a>';
                       }
                    }
                    return $edit_button . " " . $delete_button;
                })
                ->editColumn('status', function (QuestionItem $item) {
                    if ($item->status == '1') {
                        $active = '<span class="badge badge-success">Active</span>';
                    } else {
                        $active = '<span class="badge badge-danger">De-Active</span>';
                    }
                    return $active;
                })
                ->editColumn('commodity_types', function (QuestionItem $item) {
                    $active='';
                    if($item->commodity_types!=null && $item->commodity_types!='')
                    {
                        $commodity_types=json_decode($item->commodity_types);
                        if(!empty($commodity_types))
                        {
                            foreach($commodity_types as $vt)
                            {
                                $commodity=CropCommodity::where('id',$vt)->first();
                                if($commodity!='' && $commodity!=null)
                                {
                                    $active.='<div class=""><span class="badge badge-primary">'.$commodity->name.'</span></div>';
                                }
                            }
                        }
                    }
                    return $active;
                })
                ->editColumn('scout_report_category_id', function (QuestionItem $item) {
                    if (isset($item->scout_report_category_name)) {
                        return $item->scout_report_category_name;
                    } else {
                        return '-';
                    };
                })
                ->rawColumns(['action', 'status','commodity_types'])
                ->make(true);
        } else {
            $ScoutReportCategories = getScoutReportCategories();
            $CropCommodities = getCropCommodities();
            return view('questions.index',compact('ScoutReportCategories','CropCommodities'));
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ScoutReportCategories = getScoutReportCategories();
        $CropCommodities = getCropCommodities();
        return view('questions.create', compact('ScoutReportCategories', 'CropCommodities'));
    }

    public function get_inspection_types($id)
    {
        $types = InspectionType::where('status', 1)->where('location_id', $id)->get();
        $type_box = '<option value="">Select Inspection Type...</option>';
        foreach ($types as $type) {
            $type_box .= '<option value="' . $type->id . '">' . $type->type . '</option>';
        }
        echo json_encode(array('status' => 1, 'data' => $type_box));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'scout_report_category_id' => 'required',
                // 'position' => 'required',
            ],
        );

        $request['commodity_types'] = json_encode($request->commodity_types);

        $data = $request->all();
       
        $max_position = QuestionItem::max('position');
        if ($max_position != '' && $max_position != null) {
            $next_position = $max_position + 1;
        } else {
            $next_position = 1;
        }
        $data['position'] = $next_position;
        $result = QuestionItem::create($data);
        if ($result) {
            $data['question_item_id'] = $result->id;
                if ($request->kt_docs_repeater_advanced != null && !empty($request->kt_docs_repeater_advanced)) {
                    foreach ($request->kt_docs_repeater_advanced as $item) {
                        if ($item['label'] != '') {
                            $datas = [
                                'question_item_id' => $result->id,
                                'label' => $item['label']                               
                            ];
                            $result_sub = QuestionItemAttribute::create($datas);
                        }
                   }
                } 
                    return redirect()->route('questions.index')
                        ->with('success', "Questions Created");
        } else {
            return redirect()->route('questions.create')
                ->with('error', "Something Went Wrong");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\InspectionItem  $inspectionItem
     * @return \Illuminate\Http\Response
     */
    public function show(QuestionItem $inspectionItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\InspectionItem  $inspectionItem
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $questionItem= QuestionItem::with('getItemOptionAttributes')->where('id',$id)->first();
        $ScoutReportCategories = getScoutReportCategories();
        $CropCommodities = getCropCommodities();
        return view('questions.edit', compact('questionItem','ScoutReportCategories', 'CropCommodities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\InspectionItem  $inspectionItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'scout_report_category_id' => 'required',               
                'position' => 'required',
            ],
        );

        $questionItem= QuestionItem::with('getItemOptionAttributes')->where('id',$id)->first();
        if(!is_null($questionItem)){
        $request['commodity_types'] = json_encode($request->commodity_types);

        $data = $request->all();
        $old_position = $questionItem->position;
        $new_position = $request->position;
        if ($new_position < $old_position) {
            $items_to_update = QuestionItem::whereBetween('position', [$new_position, $old_position])->get();
            foreach ($items_to_update as $item) {
                DB::table('question_items')
                    ->where('id', $item->id)
                    ->update([
                        'position' => DB::raw('position + 1'),
                    ]);
            }
        } elseif ($new_position > $old_position) {
            $items_to_update = QuestionItem::whereBetween('position', [$old_position, $new_position])->get();
            foreach ($items_to_update as $item) {
                DB::table('question_items')
                    ->where('id', $item->id)
                    ->update([
                        'position' => DB::raw('position - 1'),
                    ]);
            }
        }
        $old_item_option_attributes_id_array=$questionItem->getItemOptionAttributes->pluck('id')->toArray();
        $result = $questionItem->update($data);
        if ($result) {
            $new_item_option_attributes_id_array=[];
                if ($request->kt_docs_repeater_advanced != null && !empty($request->kt_docs_repeater_advanced)) {
                    
                    foreach ($request->kt_docs_repeater_advanced as $item) {
                        if ($item['label'] != '') {
                            if(isset($item['item_option_attributes_id']) && $item['item_option_attributes_id']!='' && $item['item_option_attributes_id']!=null)
                            {
                                //update existing items
                                $item_option_attributes_id=$item['item_option_attributes_id'];
                                $new_item_option_attributes_id_array[]= $item_option_attributes_id;
                                $item_option_attribute=QuestionItemAttribute::find($item_option_attributes_id);
                                $item_option_attribute->label =$item['label'];
                                $item_option_attribute_result = $item_option_attribute->save();
                            
                            }
                            else
                            {
                                //insert new items
                                $datas = [
                                    'question_item_id' => $questionItem->id,
                                    'label' => $item['label']
                                ];
                               
                                $result_sub = QuestionItemAttribute::create($datas);
                            }
                        }
                    }
                }
                $delete_item_option_attributes=array_diff($old_item_option_attributes_id_array,$new_item_option_attributes_id_array); 
                if(!empty($delete_item_option_attributes) && $delete_item_option_attributes!=null)
                {
                    $category_delete=QuestionItemAttribute::whereIn('id',$delete_item_option_attributes)->delete();
                }
                    return redirect()->route('questions.index')
                        ->with('success', "Questions Updated");
        } else {
            return redirect()->route('questions.create')
                ->with('error', "Something Went Wrong");
        }

        } else {
            return redirect()->route('questions.create')
                ->with('error', "Something Went Wrong");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\InspectionItem  $inspectionItem
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $delete_item = QuestionItem::where('id',$id)->delete();
        if ($delete_item) {
            return response()->json([
                'status' => 1,
                'result' => 'Success',
                'message' => "Deleted",
            ]);
        } else {
            return response()->json([
                'status' => -1,
                'result' => 'fail',
                'message' => "Not Deleted",
            ]);
        }
    }

    public function undelete($id)
    {
        $delete_request=QuestionItem::where('id', $id)->withTrashed()->restore();
        if ($delete_request) {
            return response()->json([
                'status' => 1,
                'result' => 'Success',
                'message' => "UnDeleted",
            ]);
        } else {
            return response()->json([
                'status' => -1,
                'result' => 'fail',
                'message' => "Not UnDeleted",
            ]);
        }
    }

}
