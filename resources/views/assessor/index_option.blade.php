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
    <link rel="stylesheet" href="{{ asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Chakra+Petch&display=swap" rel="stylesheet">
<link href="{{asset('css/loading.css')}}" rel="stylesheet" />
    <style>
        body {
            font-family: 'Chakra Petch', sans-serif;
        }

    </style>
</head>

<body class="hold-transition layout-top-nav">
    <div id="overlay" class="loading">Loading&#8230;</div>
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
            <input type="hidden" name="assessor" id="assessor" value="{{ $assessor }}" />
            <input type="hidden" name="assessed" id="assessed" value="{{ $check->Code_Staff }}" />
            <!-- Main content -->
            <div class="content">
                <div class="container">
                    @if($check->option_eva == '')
                        <div class="row">
                            <div class="col-lg-12">


                                <div class="card card-danger card-outline">
                                    <div class="card-body">
                                        <h3 class="card-title">เลือกการประเมิน ของ {{ $check->Name_Thai }} </h3>
                                        <br><br>
                                        <p class="card-text">
                                            1. แบบตัวเลือก ประเมินจำนวน 12 ข้อ 1-5 คะแนน ในแต่ละหัวข้อ

                                        </p>
                                        <p class="card-text">
                                            2. แบบกำหนดเอง ทางผู้ประเมินจะต้องกำหนดการตั้งค่า

                                        </p>
                                        <a href="javascript:void(0)" class="btn btn-info  select_1" data-name="แบบตัวเลือก"
                                            data-assessor="{{ $check->assessor }}"
                                            data-assessed="{{ $check->assessed }}">แบบตัวเลือก</a>
                                        <a href="javascript:void(0)" class="btn btn-primary select_2"
                                            data-name="แบบกำหนดเอง" data-assessor="{{ $check->assessor }}"
                                            data-assessed="{{ $check->assessed }}">แบบกำหนดเอง</a>
                                    </div>
                                </div><!-- /.card -->
                            </div>

                            <!-- /.col-md-6 -->
                        </div>
                    @endif

                    @if($check->pass_60_status == 1 && $check->option_eva != '')
                        <input type="hidden" name="pass" id="pass" value="60" />
                        <input type="hidden" name="degree" id="degree" value="{{ $check->degree }}" />
                        <dl class="row">
                            <dt class="col-sm-4">ชื่อ-สกุล</dt>
                            <dd class="col-sm-8"> {{ $check->Name_Thai }} ( {{ $check->Code_Staff }})</dd>
                            <dt class="col-sm-4">ตำแหน่ง</dt>
                            <dd class="col-sm-8"> {{ $check->Position }}</dd>
                            <dt class="col-sm-4">ประเมิน 60 วันที่</dt>
                            <dd class="col-sm-8">
                                {{ $check->pass_60 }}
                            </dd>
                            <dt class="col-sm-4">ประเมิน 90 วันที่</dt>
                            <dd class="col-sm-8">
                                {{ $check->pass_90 }}
                        </dl>
                        <form id='form-saveevar'>
                            @foreach($data_all as $item)
                                <div class="callout callout-danger">
                                    <h5>{{ $item['name_operation'] }}</h5>
                                    <p style="font-size:12px">{{ $item['remark_opf'] }}</p>
                                    <div class="row">
                                        <div class="form-group clearfix">
                                            @foreach($item['select'] as $itemf)

                                                <div class="icheck-danger d-inline">
                                                    <input type="radio" name="{{ $itemf['id_office'] }}"
                                                        id="radioDanger{{ $itemf['id_select_opf'] }}" required
                                                        data-toggle="tooltip" title="{{ $itemf['remark'] }}"
                                                        value="{{ $itemf['select'] }}" />
                                                    <label for="radioDanger{{ $itemf['id_select_opf'] }}">
                                                        {{ $itemf['select'] }}
                                                    </label>
                                                </div>


                                @endforeach
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="row">
                <div class="col-md-12">
                    <label>ความคิดเห็น:</label>
                    <textarea class="form-control" row='5' name="remark" id="remark" maxlength="500"></textarea>
                </div>
            </div>
            <br>
            <div class="row">

                <div class="col-md-12">
                    <div class="text-center">
                        <input type="submit" class="btn btn-success" value="บันทึก" id="submit" />
                    </div>
                </div>

            </div>

            </form>
        @endif

        @if($check->pass_90_status == '1')
        <input type="hidden" name="pass" id="pass" value="90" />
        <input type="hidden" name="degree" id="degree" value="{{ $check->degree }}" />
        <dl class="row">
            <dt class="col-sm-4">ชื่อ-สกุล</dt>
            <dd class="col-sm-8"> {{ $check->Name_Thai }} ( {{ $check->Code_Staff }})</dd>
            <dt class="col-sm-4">ตำแหน่ง</dt>
            <dd class="col-sm-8"> {{ $check->Position }}</dd>
            <dt class="col-sm-4">ประเมิน 90 วันที่</dt>
            <dd class="col-sm-8">
                {{ $check->pass_90 }}
        </dl>
        <form id='form-saveevar'>
            @foreach($data_all as $item)
                <div class="callout callout-danger">
                    <h5>{{ $item['name_operation'] }}</h5>
                    <p style="font-size:12px">{{ $item['remark_opf'] }}</p>
                    <div class="row">
                        <div class="form-group clearfix">
                            @foreach($item['select'] as $itemf)

                                <div class="icheck-danger d-inline">
                                    <input type="radio" name="{{ $itemf['id_office'] }}"
                                        id="radioDanger{{ $itemf['id_select_opf'] }}" required
                                        data-toggle="tooltip" title="{{ $itemf['remark'] }}!"
                                        value="{{ $itemf['select'] }}" />
                                    <label for="radioDanger{{ $itemf['id_select_opf'] }}">
                                        {{ $itemf['select'] }}
                                    </label>
                                </div>


                @endforeach
        </div>
    </div>
</div>
@endforeach

<div class="row">
<div class="col-md-12">
    <label>ความคิดเห็น:</label>
    <textarea class="form-control" row='5' name="remark" id="remark" maxlength="500"></textarea>
</div>
</div>
<br>
<div class="row">

<div class="col-md-12">
    <div class="text-center">
        <input type="submit" class="btn btn-success" value="บันทึก" id="submit" />
    </div>
</div>

</div>

</form>




        @endif

        <br><br><br><br><br>
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
    <script src="{{ asset('js/save_evar.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
            $("#overlay").fadeOut();
            $(".main-contain").removeClass("main-contain");
        });

    </script>
</body>

</html>
