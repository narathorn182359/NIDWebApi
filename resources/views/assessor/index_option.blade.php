<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>NID</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Chakra+Petch&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Chakra Petch', sans-serif;
        }

    </style>
</head>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container">
                    <div class="row mb-2">
                        <div class="col-sm-6">


                            <a href="{{ url('/index_userassessor/' . $assessor) }}" class="btn btn-warning">ย้อนกลับ</a>
                        </div><!-- /.col -->

                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container">
                    @if ( $check->option_eva == '')
                    <div class="row">
                        <div class="col-lg-12">


                            <div class="card card-danger card-outline">
                                <div class="card-body">
                                    <h3 class="card-title">เลือกการประเมิน ของ {{ $check->Name_Thai }}</h3>
                                    <br><br>
                                    <p class="card-text">
                                        1. แบบตัวเลือก ประเมินจำนวน 12 ข้อ 1-5 คะแนน ในแต่ละหัวข้อ

                                    </p>
                                    <p class="card-text">
                                        2. แบบกำหนดเอง ทางผู้ประเมินจะต้องกำหนดการตั้งค่า

                                    </p>
                                <a href="javascript:void(0)" class="btn btn-info  select_1"  data-name="แบบตัวเลือก"   data-assessor="{{$check->assessor}}" data-assessed="{{$check->assessed}}">แบบตัวเลือก</a>
                                <a href="javascript:void(0)" class="btn btn-primary select_2" data-name="แบบกำหนดเอง" data-assessor="{{$check->assessor}}" data-assessed="{{$check->assessed}}">แบบกำหนดเอง</a>
                                </div>
                            </div><!-- /.card -->
                        </div>

                        <!-- /.col-md-6 -->
                    </div>
                    @endif

                    @if ($check->pass_60_status == 1)
                    ตั้งแต่วันที่: {{$check->pass_60}}
                    @foreach ($data_all as $item)
                    <div class="callout callout-danger">
                        <h5>{{$item['name_operation']}}</h5>
                        <p style="font-size:12px">{{$item['remark_opf']}}</p>
                        {{$item['select']}}
                      </div>
                    @endforeach
                   




                    @endif

                    @if ($check->pass_90 == '0')





                    @endif
                  
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

     

    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('assets/dist/js/adminlte.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="{{ asset('js/set_evar.js') }}"></script>
</body>

</html>
