<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use PDF;

class PDFController extends Controller
{

    public function evaluation($code_staff, $degree)
    {

        if ($degree == 'ระดับปฏิบัติการ') {

            $users_detail = DB::table('users_detail')
                ->where('Code_Staff', $code_staff)
                ->first();

            $ngg_operational_6090 = DB::table('ngg_operational_6090')
                ->where('assessed', $code_staff)
                ->first();
            $ngg_operational_score_60 = DB::table('ngg_operational_score_6090')
                ->where('60or90_evascore', '60')
                ->where('assessed_evascore', $code_staff)
                ->first();
            $ngg_operational_score_90 = DB::table('ngg_operational_score_6090')
                ->where('60or90_evascore', '90')
                ->where('assessed_evascore', $code_staff)
                ->first();

            $data_60_A = DB::table('ngg_operation_history_answer')
                ->leftJoin('ngg_operational_office', 'ngg_operation_history_answer.id_oper_ha', 'ngg_operational_office.id_opf')
                ->where('assessed_ha', $code_staff)
                ->where('60or90', '60')
                ->where('active_ha', '1')->get();

            $data_90_A = DB::table('ngg_operation_history_answer')
                ->leftJoin('ngg_operational_office', 'ngg_operation_history_answer.id_oper_ha', 'ngg_operational_office.id_opf')
                ->where('assessed_ha', $code_staff)
                ->where('60or90', '90')
                ->where('active_ha', '1')->get();

            $ngg_operational_6090 = DB::table('ngg_operational_6090')
                ->where('assessed', $code_staff)
                ->first();
            $assessor_evascore = DB::table('users_detail')
                ->where('Code_Staff', $ngg_operational_score_60->assessor_evascore)
                ->first();
            $data = array(
                'data_60_A' => $data_60_A,
                'data_90_A' => $data_90_A,
                'users_detail' => $users_detail,
                'ngg_operational_6090' => $ngg_operational_6090,
                'ngg_operational_score_60' => $ngg_operational_score_60,
                'ngg_operational_score_90' => $ngg_operational_score_90,
                'assessor_evascore' => $assessor_evascore,

            );

        } else if ($degree == 'ระดับผู้บังคับบัญชา') {

            $users_detail = DB::table('users_detail')
                ->where('Code_Staff', $code_staff)
                ->first();
            $ngg_operational_6090 = DB::table('ngg_operational_6090')
                ->where('assessed', $code_staff)
                ->first();
            $ngg_operational_score_60 = DB::table('ngg_operational_score_6090')
                ->where('60or90_evascore', '60')
                ->where('assessed_evascore', $code_staff)
                ->first();
            $ngg_operational_score_90 = DB::table('ngg_operational_score_6090')
                ->where('60or90_evascore', '90')
                ->where('assessed_evascore', $code_staff)
                ->first();

            $data_60_B = DB::table('ngg_operation_history_answer')
                ->leftJoin('ngg_operational_sup', 'ngg_operation_history_answer.id_oper_ha', 'ngg_operational_sup.id_ops')
                ->where('assessed_ha', $code_staff)
                ->where('60or90', '60')
                ->where('active_ha', '1')->get();

            $data_90_B = DB::table('ngg_operation_history_answer')
                ->leftJoin('ngg_operational_sup', 'ngg_operation_history_answer.id_oper_ha', 'ngg_operational_sup.id_ops')
                ->where('assessed_ha', $code_staff)
                ->where('60or90', '90')
                ->where('active_ha', '1')->get();

            $ngg_operational_6090 = DB::table('ngg_operational_6090')
                ->where('assessed', $code_staff)
                ->first();
            $assessor_evascore = DB::table('users_detail')
                ->where('Code_Staff', $ngg_operational_score_60->assessor_evascore)
                ->first();

            $data = array(
                'data_60_B' => $data_60_B,
                'data_90_B' => $data_90_B,
                'users_detail' => $users_detail,
                'ngg_operational_6090' => $ngg_operational_6090,
                'ngg_operational_score_60' => $ngg_operational_score_60,
                'ngg_operational_score_90' => $ngg_operational_score_90,
                'assessor_evascore' => $assessor_evascore,

            );
        }

        $pdf = PDF::loadView('assessor.index_pdf', $data);
        return @$pdf->stream('ผลการประเมิน' . $code_staff . '.pdf');
    }

}
