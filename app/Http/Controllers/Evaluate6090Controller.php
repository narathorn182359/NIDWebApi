<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class Evaluate6090Controller extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }


   
    public function  save_select(request $request){

        if($request->name == 'แบบตัวเลือก'){
            DB::table('egg_evalu_6090')
            ->where('assessor',$request->assessor)
            ->where('assessed',$request->assessed)
            ->update([
                'option_eva' => $request->name
            ]);
        }else{
            DB::table('egg_evalu_6090')
            ->where('assessor',$request->assessor)
            ->where('assessed',$request->assessed)
            ->update([
                'option_eva' => $request->name
            ]);
        }
      

    }


    public function index_userassessor($id){

        $staff =  DB::table('egg_evalu_6090')
        ->leftJoin('users_detail','egg_evalu_6090.assessed','users_detail.Code_Staff')
        ->where('assessor',$id)
        ->where('status_eva','0')
        ->get();

       $data =  array(
           'staff' => $staff
       );

        return view('assessor.index_assessor',$data);
    }


    public function index_option($assessor,$assessed){

        $check =  DB::table('egg_evalu_6090')
        ->leftJoin('users_detail','egg_evalu_6090.assessed','users_detail.Code_Staff')
        ->where('assessor',$assessor)
        ->where('assessed',$assessed)
        ->first();


        if( $check->option_eva == 'แบบตัวเลือก'){
            if($check->degree == 'ระดับปฏิบัติการ'){
                  $eva = DB::table('ngg_operational_office')->get();
                       foreach($eva as $item){
                           $get = DB::table('ngg_operation_select_office')->where('id_office',$item->id_opf)->get();
                            
                                   $data = array(
                                       'name_operation' => $item->name_opf,
                                       'remark_opf' => $item->remark_opf,
                                       'select' => $get
                                      
                                   );
                               
                            $data_all[]=$data;

                       }
                     

            }else{
                $eva = DB::table('ngg_operational_sup')->get();
            }

        }






       $data =  array(
           'check' => $check,
           'assessor' =>$assessor,
          
           'data_all'  =>$data_all
       );

        return view('assessor.index_option',$data);

    }







    public function index_evaluate()
    {
        $staff =  DB::table('users_detail')->get();
        $evalu_wait = DB::table('egg_evalu_6090')
        ->where('status_eva','0')
        ->count();
        $evalu_pass = DB::table('egg_evalu_6090')
        ->where('status_eva','1')
        ->count();
        $option_1 = DB::table('egg_evalu_6090')
        ->where('option_eva','ตัวเลือก')
        ->count();
        $option_2 = DB::table('egg_evalu_6090')
        ->where('option_eva','กำหนดเอง')
        ->count();
        $data =  array(
            'staff' => $staff,
            'evalu_wait' => $evalu_wait,
            'evalu_pass' => $evalu_pass,
            'option_1' => $option_1,
            'option_2' => $option_2,
        );

        return view('admin.index_evaluate6090',$data);
    }


    public function save_datasetevalu6090(request $request)
    {


       $check = DB::table('egg_evalu_6090')
       ->where('assessor',$request->assessor)
       ->where('assessed',$request->assessed)
       ->count();


    if($check <= 0){

        DB::table('egg_evalu_6090')->insert([
            'assessor' => $request->assessor,
            'assessed' => $request->assessed,
            'pass_60'=>$request->reservation_60,
            'pass_90'=>$request->reservation_90,
            'degree' =>$request->degree,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
           ]);

    }else{


        return  response()->json('500');

    }

    return  response()->json('200');



    }

    public function delete_userset_6090(request $request)
    {

        DB::table('egg_evalu_6090')
       ->where('id_ev',$request->id)->delete();
       return  response()->json('200');
    }
    




    public function get_data_user_6090(request $request){
        $columns = array(
            0 =>'Code_Staff',
            1 =>'Name_Thai',
            2=> 'Position',
            4 =>'Code_Staff',
        );

            $totalData =  DB::table('users_detail')->count();
            $totalFiltered = $totalData;
            $limit = $request->input('length');
            $start = $request->input('start');
            $order = $columns[$request->input('order.0.column')];
            $dir = $request->input('order.0.dir');

        if(empty($request->input('search.value')))
        {

            $posts =  DB::table('users_detail')
            ->offset($start)
            ->limit($limit)
            ->orderBy($order,$dir)
            ->get();


        }
        else {

            $search = $request->input('search.value');
            $posts = DB::table('users_detail')
            ->where('Code_Staff','LIKE',"%{$search}%")
            ->orWhere('Name_Thai', 'LIKE',"%{$search}%")
            ->orWhere('Position', 'LIKE',"%{$search}%")
            ->offset($start)
            ->limit($limit)
            ->orderBy($order,$dir)
            ->get();

            $totalFiltered =  DB::table('users_detail')
            ->where('Code_Staff','LIKE',"%{$search}%")
            ->orWhere('Name_Thai', 'LIKE',"%{$search}%")
            ->orWhere('Position', 'LIKE',"%{$search}%")
            ->count();

             }

             $data = array();
            if(!empty($posts))
              {
                 foreach ($posts as $post)
                     {
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
    "draw"            => intval($request->input('draw')),
    "recordsTotal"    => intval($totalData),
    "recordsFiltered" => intval($totalFiltered),
    "data"            => $data
    );
    echo json_encode($json_data);

    }


 public function get_data_userset_6090(request $request){
        $columns = array(
            0 =>'assessor',
            1 =>'assessed',
          
        );

            $totalData =  DB::table('egg_evalu_6090')->count();
            $totalFiltered = $totalData;
            $limit = $request->input('length');
            $start = $request->input('start');
            $order = $columns[$request->input('order.0.column')];
            $dir = $request->input('order.0.dir');

        if(empty($request->input('search.value')))
        {

            $posts =  DB::table('egg_evalu_6090')
            ->offset($start)
            ->limit($limit)
            ->orderBy($order,$dir)
            ->get();


        }
        else {

            $search = $request->input('search.value');
            $posts = DB::table('egg_evalu_6090')
            ->orWhere('assessor', 'LIKE',"%{$search}%")
            ->orWhere('assessed', 'LIKE',"%{$search}%")
            ->offset($start)
            ->limit($limit)
            ->orderBy($order,$dir)
            ->get();

            $totalFiltered =  DB::table('egg_evalu_6090')
            ->orWhere('assessor', 'LIKE',"%{$search}%")
            ->orWhere('assessed', 'LIKE',"%{$search}%")
            ->count();

             }

             $data = array();
            if(!empty($posts))
              {
                 foreach ($posts as $post)
                     {
                            if($post->option_eva == ''){
                              $option_eva = 'ยังไม่ได้เลือก';
                            }else{
                                $option_eva = $post->option_eva;
                            }

                            if($post->status_eva == 1){
                                $status_eva = 'ประเมินแล้ว';
                            }else{
                                $status_eva = 'รอการประเมิน';
                            }

                        $nestedData['assessor'] = $post->assessor;
                        $nestedData['assessed'] = $post->assessed;
                        $nestedData['option_eva'] =  $option_eva;
                        $nestedData['status_eva'] =  $status_eva;
                        $nestedData['options'] = "<a href='javascript:void(0)' class='btn btn-danger btn-circle btn-xs deleteEva'  data-id='{$post->id_ev}'>ลบ</a>";
                        $data[] = $nestedData;
                    }
                  }

    $json_data = array(
    "draw"            => intval($request->input('draw')),
    "recordsTotal"    => intval($totalData),
    "recordsFiltered" => intval($totalFiltered),
    "data"            => $data
    );
    echo json_encode($json_data);
    
    }



}
