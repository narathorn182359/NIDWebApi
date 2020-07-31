<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use PDF;

class PDFController extends Controller
{

    public function evaluation($code_staff, $degree)
    {

        if ($degree == 'ระดับปฏิบัติการ') {
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
            $data = array(
                'data_60_A' => $data_60_A,
                'data_90_A' => $data_90_A,

            );

        } else if ($degree == 'ระดับผู้บังคับบัญชา') {
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
            $data = array(
                'data_60_B' => $data_60_B,
                'data_90_B' => $data_90_B,

            );
        }

        $pdf = PDF::loadView('assessor.index_pdf', $data);
        return @$pdf->stream('ผลการประเมิน' . $code_staff . '.pdf');
    }

}
