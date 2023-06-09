<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\QuestionItem;
use App\Models\CropCommodity;
use App\Models\CropLocation;
use App\Models\Customer;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use App\Models\Inspector;
use App\Models\QuestionItemAttribute;
use App\Models\ScoutAnswerReport;
use App\Models\ScoutAnswerReportItem;
use App\Models\ScoutQuestionItem;
use App\Models\ScoutQuestionItemAttribute;
use App\Models\ScoutReport;
use Illuminate\Support\Facades\Validator;

class InspectionQuestionController extends Controller
{
    public function question(Request $request)
    {
        $request->validate(
            [
                'commodity_ids' => 'required',
            ],
        );

        $commodity_ids_str = $request->commodity_ids;
        $commodity_ids = explode(',', $commodity_ids_str);
        if ($commodity_ids != null && !empty($commodity_ids)) {
            $inspection_items = QuestionItem::with('getItemOptionAttributes.getCommodityIds')->where('status', true)->orderBy('position')->get();
            if (!is_null($inspection_items) && count($inspection_items) > 0) {
                $response = [];
                $newResult = [];
                foreach ($inspection_items as $row) {
                    $response['position'] = $row->position;
                    $response['id'] = $row->id;
                    $response['scout_report_category'] = array('id' => $row->scout_report_category_id, 'name' => $row->scout_report_category_name);
                    $items = $row->getItemOptionAttributes->filter(function ($value) use ($commodity_ids) {
                        if (array_intersect($value->getCommodityIds->pluck('crop_commodity_id')->toArray(), $commodity_ids)) {
                            return true;
                        }
                    });

                    $new_options = [];
                    foreach ($items as $item) {
                        $option['id'] = $item->id;
                        $option['label'] = $item->label;
                        $option['label_type'] = "checkbox";
                        $new_options[] = $option;
                    }
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
                    'message' => trans('translation.not_found', ['name' => 'Questions']),
                ]);
            }
        } else {
            return response()->json([
                'status' => -1,
                'data' => [],
                'message' => trans('translation.not_found', ['name' => 'Questions']),
            ]);
        }
    }
    public function getAllQuestion(Request $request)
    {
        $inspection_items = QuestionItem::with('getItemOptionAttributes.getCommodityIds')->where('status', true)->orderBy('position')->get();
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
                    $option['commodity_ids'] = $item->getCommodityIds->pluck('crop_commodity_id');
                    $new_options[] = $option;
                }
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
                'message' => trans('translation.not_found', ['name' => 'Questions']),
            ]);
        }
    }

    public function saveInspectionReport(Request $request)
    {
        $request->validate(
            [
                'data' => 'required|json',
            ],
        );
        try {
            $data_json = $request->data;
            $data = json_decode($data_json);
            if (!is_null($data) && !empty($data)) {
                $data_array = json_decode($data_json, true);
                $temp_request = new Request($data_array);
                $temp_request->validate([
                    'customer_id' => 'required|numeric',
                    'date' => 'required|date',
                    'crop_location_id' => 'required|integer|numeric',
                    'crop_location_blocks' => 'required|array|min:1',
                    'questions' => 'array',
                ]);
                $crop_location_blocks = $data->crop_location_blocks;
                $commodity_ids = [];
                foreach ($crop_location_blocks as $blocks) {
                    $cm = getCropCommodityIdByCropLocationId($blocks);
                    if ($cm != null) {
                        $commodity_ids[] = strval($cm);
                    }
                }
                if (!empty($commodity_ids)) {
                    $commodity_id = json_encode($commodity_ids);
                }
                $crop_location_blocks = json_encode($crop_location_blocks);
                $notes = $data->notes;
                $date = date('Y-m-d', strtotime($data->date));
                $answers = $data->questions;
                if (empty($answers) && ($data->notes == '' || $data->notes == null)) {
                    return response()->json([
                        'status' => -1,
                        'data' => [],
                        'message' => 'Notes is required when no question is answered',
                    ]);
                } else if (empty($commodity_ids)) {
                    return response()->json([
                        'status' => -1,
                        'data' => [],
                        'message' => 'Commodity type is required',
                    ]);
                } else {
                }
                if (isset($data->customer_id) && $data->customer_id != '' && $data->customer_id != null) {
                    //exists customer
                    $customer_id = $data->customer_id;
                    $crop_location_id = $data->crop_location_id;
                    $ScoutReport = ScoutReport::create([
                        'customer_id' => $customer_id,
                        'date' => $date,
                        'crop_location_id' => $crop_location_id,
                        'crop_commodity_ids' => $commodity_id,
                        'notes' => $notes,
                        'crop_location_blocks' => $crop_location_blocks,
                        'added_by' => auth()->user()->id
                    ]);
                    if ($ScoutReport) {
                        $scout_report_id = $ScoutReport->id;
                        $get_answers = $this->cloneQuestionData($commodity_ids, $scout_report_id, $answers);
                        if ($get_answers != null && !empty($get_answers)) {
                            $save_report = $this->saveReportAnswers($get_answers, $scout_report_id);
                            if (!in_array(false, $save_report['question_err']) && !in_array(false, $save_report['ans_err'])) {
                                return response()->json([
                                    'status' => 1,
                                    'data' => [],
                                    'inspection_status' => true,
                                    'message' => trans('translation.created', ['name' => 'Inspection Report']),
                                ]);
                            } else {
                                return response()->json([
                                    'status' => -1,
                                    'data' => [],
                                    'message' => trans('translation.error'),
                                ]);
                            }
                        } else {
                            return response()->json([
                                'status' => 1,
                                'data' => [],
                                'inspection_status' => true,
                                'message' => trans('translation.created', ['name' => 'Inspection Report']),
                            ]);
                        }
                    } else {
                        //not created scout report
                        return response()->json([
                            'status' => -1,
                            'data' => [],
                            'message' => trans('translation.error'),
                        ]);
                    }
                } else {
                    return response()->json([
                        'status' => -1,
                        'data' => [],
                        'message' => trans('translation.data_invalid'),
                    ]);
                }
            } else {
                return response()->json([
                    'status' => -1,
                    'data' => [],
                    'message' => trans('translation.data_invalid'),
                ]);
            }
            return $data;
        } catch (\Exception $e) {
            return response()->json([
                'status' => -1,
                'data' => [],
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function cloneQuestionData($crop_commodity_id, $scout_report_id, $answers)
    {
        $inspectionItems = QuestionItem::orderBy('position')->get();
        $answers_array = array();
        if ($inspectionItems->isNotEmpty() && count($inspectionItems) > 0) {
            foreach ($inspectionItems as $question) {
                $item = [];
                $max_position = ScoutQuestionItem::max('position');
                if ($max_position != '' && $max_position != null) {
                    $next_position = $max_position + 1;
                } else {
                    $next_position = 1;
                }
                $item['scout_report_id'] = $scout_report_id;
                $item['scout_report_category_id'] = $question['scout_report_category_id'];
                $item['position'] = $next_position;
                $item['status'] = $question['status'];

                $result = ScoutQuestionItem::create($item);
                if ($result) {
                    $answer_key = array_search($question->id, array_column($answers, 'question_item_id'));
                    $itemAttrs = QuestionItemAttribute::with('getCommodityIds')->where('question_item_id', $question['id'])->get();
                    $inputItemArrrs = $itemAttrs->filter(function ($value) use ($crop_commodity_id) {
                        if (array_intersect($value->getCommodityIds->pluck('crop_commodity_id')->toArray(), $crop_commodity_id)) {
                            return true;
                        }
                    });
                    $answers_attr = array();
                    if ($inputItemArrrs->isNotEmpty() && count($itemAttrs) > 0) {
                        foreach ($inputItemArrrs as $qitems) {
                            $itemVal = [];
                            $itemVal['scout_question_item_id'] = $result->id;
                            $itemVal['label'] = $qitems['label'];
                            $result_sub = ScoutQuestionItemAttribute::create($itemVal);
                            if ($result_sub) {
                                if ($answer_key !== false) {
                                    $answers_box = json_decode(json_encode($answers[$answer_key]->answers), true);
                                    if (array_search($qitems['id'], array_column($answers_box, 'question_item_attribute_id')) !== false) {
                                        $answers_attr[] = ['question_item_attribute_id' => $result_sub->id];
                                    }
                                }
                            }
                        }
                    }
                    if ($answer_key !== false) {
                        if ($answers_attr != null && !empty($answers_attr)) {
                            $ques_answers = $answers_attr;
                        } else {
                            $ques_answers = [];
                        }
                        $answers_array[] = ['question_item_id' => $result->id, 'comment' => $answers[$answer_key]->comment, 'answers' => $ques_answers];
                    }
                }
            }
        }
        return  $answers_array;
    }
    public function saveReportAnswers($get_answers, $scout_report_id)
    {
        $question_err = [];
        $ans_err = [];
        if (!empty($get_answers) && $get_answers != null) {
            foreach ($get_answers as $key => $value) {
                $question_item_id = $value['question_item_id'];
                $comment = $value['comment'];
                $answers = $value['answers'];
                $ScoutAnswerReport = ScoutAnswerReport::create([
                    'scout_report_id' => $scout_report_id,
                    'scout_question_item_id' => $question_item_id,
                    'comment' => $comment,
                ]);
                if ($ScoutAnswerReport) {
                    $question_err[] = true;
                    if ($answers !== null && !empty($answers)) {
                        foreach ($answers as $val) {
                            $ScoutAnswerReportItem = ScoutAnswerReportItem::create([
                                'scout_answer_report_id' => $ScoutAnswerReport->id,
                                'scout_question_item_attribute_id' => $val['question_item_attribute_id'],
                            ]);
                            if ($ScoutAnswerReportItem) {
                                $ans_err[] = true;
                            } else {
                                $ans_err[] = false;
                            }
                        }
                    }
                } else {
                    $question_err[] = false;
                }
            }
        } else {
            $question_err[] = false;
            $ans_err[] = false;
        }
        return ['ans_err' => $ans_err, 'question_err' => $question_err];
    }
}
