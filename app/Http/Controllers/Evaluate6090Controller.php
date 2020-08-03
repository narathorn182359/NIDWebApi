<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Evaluate6090Controller extends Controller
{

  




    
    public function kpi_manual(request $request)
    {


    }






    public function enable90(request $request)
    {
        DB::table('ngg_operational_6090')
            ->where('id_ev', $request->id)
            ->update([
                'pass_90_status' => '1',
            ]);

    }

    public function save_eva90(request $request)
    {

        if ($request->assessor60 == $request->assessor90) {

            DB::table('ngg_operational_6090')
                ->where('assessor', $request->assessor60)
                ->where('assessed', $request->assessed60)
                ->update([
                    'pass_90_status' => '1',
                ]);

        } else {

            $data = DB::table('ngg_operational_6090')
                ->where('assessor', $request->assessor60)
                ->where('assessed', $request->assessed60)
                ->first();

            DB::table('ngg_operational_6090')->insert([
                'assessor' => $request->assessor90,
                'assessed' => $request->assessed60,
                'pass_60' => $data->pass_60,
                'pass_90' => $data->pass_90,
                'degree' => $data->degree,
                'pass_90_status' => '1',
                'pass_60_status' => '0',
                'option_eva' => $data->option_eva,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

        }

        return response()->json($request->assessed60);

    }

    public function save_evar6090(request $request)
    {

        if ($request->pass == '60') {

            if ($request->degree == 'ระดับปฏิบัติการ') {

                foreach ($request->evar as $item_1) {

                    $eva = DB::table('ngg_operational_office')
                        ->where('id_opf', $item_1['number'])
                        ->first();
                    $result = number_format(($item_1['score'] / 5) * ($eva->weight_opf / 100), 2);

                    DB::table('ngg_operation_history_answer')->insert([
                        'assessor_ha' => $request->assessor,
                        'assessed_ha' => $request->assessed,
                        'id_oper_ha' => $item_1['number'],
                        'score_ha' => $result,
                        '60or90' => $request->pass,

                    ]);
                }
                $result_final = DB::table('ngg_operation_history_answer')
                    ->where('assessor_ha', $request->assessor)
                    ->where('assessed_ha', $request->assessed)
                    ->where('60or90', $request->pass)
                    ->where('active_ha', '1')
                    ->sum('score_ha');
                $result_evar = number_format($result_final * 100, 2);

                DB::table('ngg_operational_score_6090')->insert([
                    'assessor_evascore' => $request->assessor,
                    'assessed_evascore' => $request->assessed,
                    'evaluation_evascore' => $result_evar,
                    'remark_evascore' => $request->remark,
                    '60or90_evascore' => $request->pass,

                ]);

                DB::table('ngg_operational_6090')
                    ->where('assessor', $request->assessor)
                    ->where('assessed', $request->assessed)
                    ->update([
                        'pass_60_status' => '0',
                    ]);

            } else if ($request->degree == 'ระดับผู้บังคับบัญชา') {

                foreach ($request->evar as $item_1) {

                    $eva = DB::table('ngg_operational_sup')
                        ->where('id_ops', $item_1['number'])
                        ->first();
                    $result = number_format(($item_1['score'] / 5) * ($eva->weight_ops / 100), 2);

                    DB::table('ngg_operation_history_answer')->insert([
                        'assessor_ha' => $request->assessor,
                        'assessed_ha' => $request->assessed,
                        'id_oper_ha' => $item_1['number'],
                        'score_ha' => $result,
                        '60or90' => $request->pass,

                    ]);
                }
                $result_final = DB::table('ngg_operation_history_answer')
                    ->where('assessor_ha', $request->assessor)
                    ->where('assessed_ha', $request->assessed)
                    ->where('60or90', $request->pass)
                    ->where('active_ha', '1')
                    ->sum('score_ha');
                $result_evar = number_format($result_final * 100, 2);

                DB::table('ngg_operational_score_6090')->insert([
                    'assessor_evascore' => $request->assessor,
                    'assessed_evascore' => $request->assessed,
                    'evaluation_evascore' => $result_evar,
                    'remark_evascore' => $request->remark,
                    '60or90_evascore' => $request->pass,

                ]);

                DB::table('ngg_operational_6090')
                    ->where('assessor', $request->assessor)
                    ->where('assessed', $request->assessed)
                    ->update([
                        'pass_60_status' => '0',
                    ]);
            }

        } else if ($request->pass == '90') {

            if ($request->degree == 'ระดับปฏิบัติการ') {

                foreach ($request->evar as $item_1) {

                    $eva = DB::table('ngg_operational_office')
                        ->where('id_opf', $item_1['number'])
                        ->first();
                    $result = number_format(($item_1['score'] / 5) * ($eva->weight_opf / 100), 2);

                    DB::table('ngg_operation_history_answer')->insert([
                        'assessor_ha' => $request->assessor,
                        'assessed_ha' => $request->assessed,
                        'id_oper_ha' => $item_1['number'],
                        'score_ha' => $result,
                        '60or90' => $request->pass,

                    ]);
                }
                $result_final = DB::table('ngg_operation_history_answer')
                    ->where('assessor_ha', $request->assessor)
                    ->where('assessed_ha', $request->assessed)
                    ->where('60or90', $request->pass)
                    ->where('active_ha', '1')
                    ->sum('score_ha');
                $result_evar = number_format($result_final * 100, 2);

                DB::table('ngg_operational_score_6090')->insert([
                    'assessor_evascore' => $request->assessor,
                    'assessed_evascore' => $request->assessed,
                    'evaluation_evascore' => $result_evar,
                    'remark_evascore' => $request->remark,
                    '60or90_evascore' => $request->pass,

                ]);

                DB::table('ngg_operational_6090')
                    ->where('assessor', $request->assessor)
                    ->where('assessed', $request->assessed)
                    ->update([
                        'pass_60_status' => '0',
                        'pass_90_status' => '2',
                        'status_eva' => '1',
                    ]);

            } else if ($request->degree == 'ระดับผู้บังคับบัญชา') {

                foreach ($request->evar as $item_1) {

                    $eva = DB::table('ngg_operational_sup')
                        ->where('id_ops', $item_1['number'])
                        ->first();
                    $result = number_format(($item_1['score'] / 5) * ($eva->weight_ops / 100), 2);

                    DB::table('ngg_operation_history_answer')->insert([
                        'assessor_ha' => $request->assessor,
                        'assessed_ha' => $request->assessed,
                        'id_oper_ha' => $item_1['number'],
                        'score_ha' => $result,
                        '60or90' => $request->pass,

                    ]);
                }
                $result_final = DB::table('ngg_operation_history_answer')
                    ->where('assessor_ha', $request->assessor)
                    ->where('assessed_ha', $request->assessed)
                    ->where('60or90', $request->pass)
                    ->where('active_ha', '1')
                    ->sum('score_ha');
                $result_evar = number_format($result_final * 100, 2);

                DB::table('ngg_operational_score_6090')->insert([
                    'assessor_evascore' => $request->assessor,
                    'assessed_evascore' => $request->assessed,
                    'evaluation_evascore' => $result_evar,
                    'remark_evascore' => $request->remark,
                    '60or90_evascore' => $request->pass,

                ]);

                DB::table('ngg_operational_6090')
                    ->where('assessor', $request->assessor)
                    ->where('assessed', $request->assessed)
                    ->update([
                        'pass_60_status' => '0',
                        'pass_90_status' => '2',
                        'status_eva' => '1',
                    ]);
            }
        }

        return response()->json([$request->remark,
            $request->assessor,
            $request->assessed,
        ]);
    }

    public function save_select(request $request)
    {

        if ($request->name == 'แบบตัวเลือก') {
            DB::table('ngg_operational_6090')
                ->where('assessor', $request->assessor)
                ->where('assessed', $request->assessed)
                ->update([
                    'option_eva' => $request->name,
                ]);
        } else {
            DB::table('ngg_operational_6090')
                ->where('assessor', $request->assessor)
                ->where('assessed', $request->assessed)
                ->update([
                    'option_eva' => $request->name,
                ]);
        }

    }

    public function index_userassessor($id)
    {

        $staff = DB::table('ngg_operational_6090')
            ->leftJoin('users_detail', 'ngg_operational_6090.assessed', 'users_detail.Code_Staff')
            ->where('assessor', $id)
            ->where('pass_60_status', '1')
            ->where('active_op', '1')
            ->get();

        $staff_90 = DB::table('ngg_operational_6090')
            ->leftJoin('users_detail', 'ngg_operational_6090.assessed', 'users_detail.Code_Staff')
            ->where('assessor', $id)
            ->where('pass_90_status', '1')
            ->where('active_op', '1')
            ->get();

        $data = array(
            'staff' => $staff,
            'staff_90' => $staff_90,
        );

        return view('assessor.index_assessor', $data);
    }

    public function index_option($assessor, $assessed)
    {

        $check = DB::table('ngg_operational_6090')
            ->leftJoin('users_detail', 'ngg_operational_6090.assessed', 'users_detail.Code_Staff')
            ->where('assessor', $assessor)
            ->where('assessed', $assessed)
            ->where('option_eva', null)
            ->where('active_op', 1)
            ->first();

        $check_2 = DB::table('ngg_operational_6090')
            ->leftJoin('users_detail', 'ngg_operational_6090.assessed', 'users_detail.Code_Staff')
            ->where('assessor', $assessor)
            ->where('assessed', $assessed)
            ->where('active_op', 1)
            ->first();

        if ($check_2->option_eva == 'แบบตัวเลือก') {
            if ($check_2->degree == 'ระดับปฏิบัติการ') {

                $eva = DB::table('ngg_operational_office')->get();
                foreach ($eva as $item) {
                    $get = DB::table('ngg_operation_select_office')->where('id_office', $item->id_opf)->get();
                    foreach ($get as $getu) {
                        $data = array(
                            'id_select_opf' => $getu->id_select_opf,
                            'id_office' => $getu->id_office,
                            'select' => $getu->name_select_opf,
                            'remark' => $getu->remark_opf,
                        );
                        $get_data[] = $data;
                    }

                    $data = array(
                        'name_operation' => $item->name_opf,
                        'remark_opf' => $item->remark_opf,
                        'select' => $get_data,

                    );

                    $data_all[] = $data;
                    $get_data = [];

                }

                $data = array(
                    'check' => $check_2,
                    'assessor' => $assessor,
                    'data_all' => $data_all,
                );

                return view('assessor.index_option', $data);
            } else if ($check_2->degree == 'ระดับผู้บังคับบัญชา') {

                $eva = DB::table('ngg_operational_sup')->get();
                foreach ($eva as $item) {
                    $get = DB::table('ngg_operation_select_sup')->where('id_sup_sup', $item->id_ops)->get();
                    foreach ($get as $getu) {
                        $data = array(
                            'id_select_opf' => $getu->id_select_sup,
                            'id_office' => $getu->id_sup_sup,
                            'select' => $getu->name_select_sup,
                            'remark' => $getu->remark_sup,
                        );
                        $get_data[] = $data;
                    }

                    $data = array(
                        'name_operation' => $item->name_ops,
                        'remark_opf' => $item->remark_ops,
                        'select' => $get_data,

                    );

                    $data_all[] = $data;

                    $get_data = [];

                }

                $data = array(
                    'check' => $check_2,
                    'assessor' => $assessor,
                    'data_all' => $data_all,
                );

                return view('assessor.index_option', $data);
                $eva = DB::table('ngg_operational_sup')->get();
            }
            $data = array(
                'check' => $check,
                'assessor' => $assessor,

            );
            return view('assessor.index_option', $data);
        } else if ($check_2->option_eva == 'แบบกำหนดเอง') {

            $data = array(
                'check' => $check_2,
                'assessor' => $assessor,

            );
            return view('assessor.index_option', $data);

        }

        $data = array(
            'check' => $check,
            'assessor' => $assessor,

        );
        return view('assessor.index_option', $data);

    }

    public function index_evaluate()
    {
        $staff = DB::table('users_detail')->get();
        $evalu_wait = DB::table('ngg_operational_6090')
            ->where('status_eva', '0')
            ->count();
        $evalu_pass = DB::table('ngg_operational_6090')
            ->where('status_eva', '1')
            ->count();
        $option_1 = DB::table('ngg_operational_6090')
            ->where('option_eva', 'แบบตัวเลือก')
            ->count();
        $option_2 = DB::table('ngg_operational_6090')
            ->where('option_eva', 'กำหนดเอง')
            ->count();
        $data = array(
            'staff' => $staff,
            'evalu_wait' => $evalu_wait,
            'evalu_pass' => $evalu_pass,
            'option_1' => $option_1,
            'option_2' => $option_2,
        );

        return view('admin.index_evaluate6090', $data);
    }

    public function save_datasetevalu6090(request $request)
    {

        /*  $check = DB::table('ngg_operational_6090')
        ->where('assessor', $request->assessor)
        ->where('assessed', $request->assessed)
        ->count();

        if ($check <= 0) { */

        DB::table('ngg_operational_6090')->insert([
            'assessor' => $request->assessor,
            'assessed' => $request->assessed,
            'pass_60' => $request->reservation_60,
            'pass_90' => $request->reservation_90,
            'degree' => $request->degree,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        /*     } else {

        return response()->json('500');

        } */

        return response()->json('200');

    }

    public function delete_userset_6090(request $request)
    {

        DB::table('ngg_operational_6090')
            ->where('assessed', $request->id)
            ->update([
                'active_op' => '0',
            ]);

        DB::table('ngg_operation_history_answer')
            ->where('assessed_ha', $request->id)
            ->update([
                'active_ha' => '0',
            ]);

        DB::table('ngg_operational_score_6090')
            ->where('assessed_evascore', $request->id)
            ->update([
                'active_evascore' => '0',
            ]);

        return response()->json('200');
    }

    public function get_data_user_6090(request $request)
    {
        $columns = array(
            0 => 'Code_Staff',
            1 => 'Name_Thai',
            2 => 'Position',
            4 => 'Code_Staff',
        );

        $totalData = DB::table('users_detail')->count();
        $totalFiltered = $totalData;
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {

            $posts = DB::table('users_detail')
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();

        } else {

            $search = $request->input('search.value');
            $posts = DB::table('users_detail')
                ->where('Code_Staff', 'LIKE', "%{$search}%")
                ->orWhere('Name_Thai', 'LIKE', "%{$search}%")
                ->orWhere('Position', 'LIKE', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();

            $totalFiltered = DB::table('users_detail')
                ->where('Code_Staff', 'LIKE', "%{$search}%")
                ->orWhere('Name_Thai', 'LIKE', "%{$search}%")
                ->orWhere('Position', 'LIKE', "%{$search}%")
                ->count();

        }

        $data = array();
        if (!empty($posts)) {
            foreach ($posts as $post) {
                $nestedData['Code_Staff'] = $post->Code_Staff;
                $nestedData['Name_Thai'] = $post->Name_Thai;
                $nestedData['Position'] = $post->Position;
                $nestedData['Department'] = $post->Department;
                $nestedData['options'] = "
                        <a href='javascript:void(0)' class='btn btn-warning btn-circle btn-xs addusername' data-id='{$post->Code_Staff}'>เพิ่มผู้ประเมิน</a>";
                $data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data,
        );
        echo json_encode($json_data);

    }

    public function get_data_userset_6090(request $request)
    {
        $columns = array(
            0 => 'assessor',
            1 => 'assessed',

        );

        $totalData = DB::table('ngg_operational_6090')->count();
        $totalFiltered = $totalData;
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {

            $posts = DB::table('ngg_operational_6090')
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)

                ->get();

        } else {

            $search = $request->input('search.value');
            $posts = DB::table('ngg_operational_6090')
                ->orWhere('assessor', 'LIKE', "%{$search}%")
                ->orWhere('assessed', 'LIKE', "%{$search}%")

                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)

                ->get();

            $totalFiltered = DB::table('ngg_operational_6090')
                ->orWhere('assessor', 'LIKE', "%{$search}%")
                ->orWhere('assessed', 'LIKE', "%{$search}%")

                ->count();

        }

        $data = array();
        if (!empty($posts)) {
            foreach ($posts as $post) {
                if ($post->option_eva == '') {
                    $option_eva = 'ยังไม่ได้เลือก';
                } else {
                    $option_eva = $post->option_eva;
                }
                $i = "<a href='javascript:void(0)' class='btn btn-info btn-circle btn-xs save_eva90'  data-assessor60='{$post->assessor}' data-assessed60='{$post->assessed}'   >เลือกผู้ประเมินสำหรับ 90 วัน</a>";
                if ($post->pass_60_status == 0 && $post->pass_90_status == 1 && $post->active_op == 1) {
                    $status_eva = "<p class='text-warning'>รอประเมิน 90 วัน</p>";
                    $i = '';
                    $j = "";

                } else if ($post->pass_60_status == 0 && $post->pass_90_status == 0 && $post->active_op == 1) {
                    $status_eva = "<p class='text-info'>รอเปิดประเมิน 90 วัน</p>";
                    $i = "";
                    $j = "<a href='javascript:void(0)' class='btn btn-info btn-circle btn-xs enable90'  data-id='{$post->id_ev}' >เปิดประเมิน 90</a>";

                    /*  $j ="<a href='javascript:void(0)' class='btn btn-danger btn-circle btn-xs deleteEva'  data-id='{$post->id_ev}' >ยกเลิกผลการประเมิน</a>"; */
                } else if ($post->active_op == 0) {
                    $status_eva = "<p class='text-danger'>ยกเลิกผลการประเมิน</p>";
                    $i = '';
                    $j = 'ต่อการทดลองงานใหม่';
                } else if ($post->pass_60_status == 1 && $post->pass_90_status == 0 && $post->active_op == 1) {
                    $status_eva = "<p class='text-warning'>รอประเมิน 60 วัน</p>";
                    $i = '';
                    $j = "";
                } else if ($post->status_eva == 1 && $post->active_op == 1) {
                    $status_eva = "<p class='text-success'>ประเมินครบแล้ว</p>";
                    $i = '';
                    $j = "
                    <a href='/evaluation/{$post->assessed}/{$post->degree}' class='btn btn-success btn-circle btn-xs'>รายงานผล</a>
                    <a href='javascript:void(0)' class='btn btn-danger btn-circle btn-xs deleteEva'  data-id='{$post->assessed}' >ยกเลิกผลการประเมิน</a>";
                }

                $nestedData['assessor'] = $post->assessor;
                $nestedData['assessed'] = $post->assessed;
                $nestedData['option_eva'] = $option_eva;
                $nestedData['status_eva'] = $status_eva;
                $nestedData['options'] = "{$i} {$j}";
                $data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data,
        );
        echo json_encode($json_data);

    }

}
