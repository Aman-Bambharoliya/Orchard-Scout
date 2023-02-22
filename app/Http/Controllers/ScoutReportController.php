<?php

namespace App\Http\Controllers;

use App\Models\CropCommodity;
use App\Models\Customer;
use App\Models\ScoutAnswerReport;
use App\Models\ScoutAnswerReportItem;
use App\Models\ScoutQuestionItem;
use App\Models\ScoutReport;
use Illuminate\Http\Request;
use DataTables;
use Exception;
use Illuminate\Support\Facades\Crypt;


class ScoutReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = ScoutReport::orderby('created_at', 'DESC')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function (ScoutReport $ScoutReport) {
                    $actionBtn = '';
                    $edit_button = '<a title="Vehicle information edit" href="' . route('scout-reports.edit', $ScoutReport->id) . '" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                    <span class="svg-icon svg-icon-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="currentColor"></path>
                            <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="currentColor"></path>
                        </svg>
                    </span>
                </a>';
                    $delete_button = '<a title="Vehicle Order Request Delete" href="#" data-id="' . route('scout-reports.destroy', $ScoutReport->id) . '" class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm me-1 delete_request">
                    <span class="svg-icon svg-icon-3">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
							<path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="currentColor"></path>
							<path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="currentColor"></path>
							<path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="currentColor"></path>
						</svg>
					</span>
                </a>';
                    return "<div class='btn-wrap-action' style='display:flex'>" . $edit_button . ' ' . $delete_button . "</div>";
                })
                ->editColumn('customer', function (ScoutReport $ScoutReport) {
                    if ($ScoutReport->hasCustomer->name != '') {
                        return $ScoutReport->hasCustomer->name;
                    } else {
                        return '';
                    }
                })
                ->editColumn('crop_location', function (ScoutReport $ScoutReport) {
                    if ($ScoutReport->hasCropLocation->name != '') {
                        return $ScoutReport->hasCropLocation->name;
                    } else {
                        return '';
                    }
                })->editColumn('date', function (ScoutReport $ScoutReport) {
                    if ($ScoutReport->date != '') {
                        return date('m/d/Y', strtotime($ScoutReport->date));
                    }
                    return $ScoutReport->date;
                })
                ->rawColumns(['action'])
                ->make(true);
        } else {
            return view('scout-reports.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $customer_id)
    {
    }

    public function store(Request $request)
    {

    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $ScoutReport = ScoutReport::findOrFail($id);
        $Customer = Customer::where('is_prospect', false)->orderBy('id', 'DESC')->get();
        $CropCommodities = CropCommodity::orderBy('id', 'DESC')->get();
        $ScoutQuestionItem = ScoutQuestionItem::with('getScoutItemOptionAttributes', 'hasScoutReportCategory')->where('status', true)->where('scout_report_id', $ScoutReport->id)->orderBy('position', 'asc')->get();
        $answers = ScoutAnswerReport::with('hasScoutAnswerReportItem')->where('scout_report_id', $ScoutReport->id)->get();
        return view('scout-reports.edit', compact('Customer', 'CropCommodities', 'ScoutReport', 'ScoutQuestionItem', 'answers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       
    }

    public function updateAnswers(Request $request)
    {
        $request->validate(
            [
                'scout_answer_report_id' => 'required',
                'scout_question_item_id' => 'required|integer',
                'scout_report_id' => 'required|integer|exists:App\Models\ScoutReport,id',
                'comment' => 'nullable|string|max:255',
            ],
        );
        if ($request->scout_answer_report_id == 'new' && !is_numeric($request->scout_answer_report_id)) {
            //new answers submitted
            try {
                if ((isset($request->scout_options) && $request->scout_options != null && !empty($request->scout_options)) || $request->comment != '') {
                    $result = ScoutAnswerReport::create([
                        'scout_report_id' => $request->scout_report_id,
                        'scout_question_item_id' => $request->scout_question_item_id,
                        'comment' => $request->comment,
                    ]);
                    if ($result) {
                        if (isset($request->scout_options) && $request->scout_options != null && !empty($request->scout_options)) {
                            $scout_options = $request->scout_options;
                            $scout_options_ans = [];
                            $scout_answer_report_id = $result->id;
                            foreach ($scout_options as $key => $value) {
                                $scout_options_ans[] = ['scout_answer_report_id' => $scout_answer_report_id, 'scout_question_item_attribute_id' => $value];
                                if (!empty($scout_options_ans)) {
                                    $ScoutAnswerReportItem = ScoutAnswerReportItem::insert($scout_options_ans);
                                    return response()->json([
                                        'result' => 'success',
                                        'status' => 1,
                                        'message' => trans('translation.updated', ['name' => 'answers'])
                                    ]);
                                }
                            }
                        } else {
                            return response()->json([
                                'result' => 'success',
                                'status' => 1,
                                'mode' => 1,
                                'message' => trans('translation.updated', ['name' => 'answers'])
                            ]);
                        }
                    } else {
                        return response()->json([
                            'result' => 'success',
                            'status' => 1,
                            'message' => trans('translation.updated', ['name' => 'answers'])
                        ]);
                    }
                } else {
                    return response()->json([
                        'result' => 'success',
                        'status' => 1,
                        'message' => trans('translation.updated', ['name' => 'answers'])
                    ]);
                }
            } catch (Exception $e) {
                return response([
                    'status' => 'error',
                    'errors' => $e->getMessage(),
                    'message' => trans('translation.error'),
                ], 404);
            }
        } else {
            //update or add
            try {
                $ScoutAnswerReport = ScoutAnswerReport::findOrFail($request->scout_answer_report_id);
                $ScoutAnswerReport->comment = $request->comment;
                $result = $ScoutAnswerReport->save();
                if ($result) {
                    $old_answers = $ScoutAnswerReport->hasScoutAnswerReportItem->pluck('scout_question_item_attribute_id')->toArray();
                    $updated_val = array();
                    if (isset($request->scout_options) && $request->scout_options != null && !empty($request->scout_options) && $request->scout_options != '') {
                        foreach ($request->scout_options as $qp) {
                            $updated_val[] = $qp;
                            $scout_question_item_attribute_id = $qp;
                            $ScoutAnswerReportItem = ScoutAnswerReportItem::updateOrCreate(
                                [
                                    'scout_answer_report_id' => $request->scout_answer_report_id, 'scout_question_item_attribute_id' => $scout_question_item_attribute_id,
                                ],
                                []
                            );
                        }
                    }
                    $delete = array_diff($old_answers, $updated_val);
                    if (!empty($delete) && $delete != null) {
                        $category_delete = ScoutAnswerReportItem::where('scout_answer_report_id', $request->scout_answer_report_id)->whereIn('scout_question_item_attribute_id', $delete)->delete();
                    }
                    return response()->json([
                        'result' => 'success',
                        'status' => 1,
                        'message' => trans('translation.updated', ['name' => 'answers'])
                    ]);
                }
            } catch (Exception $e) {
                return response([
                    'status' => 'error',
                    'errors' => $e->getMessage(),
                    'message' => trans('translation.error'),
                ], 404);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
       
    }


    public function undelete($id)
    {
       
    }
}
