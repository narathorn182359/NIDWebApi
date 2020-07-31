@extends('layouts.admin')

@section('javascript')

    <script src="{{ asset('js/get_data_username_6090.js') }}"></script>

@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">จัดการประเมิน 60 90</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/home') }}">หน้าแรก</a></li>
                        <li class="breadcrumb-item active">จัดการประเมิน 60 90</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Info boxes -->
            <div class="row">
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-user-clock"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">รอการประเมิน</span>
                            <span class="info-box-number">
                                {{ $evalu_wait }}
                                <small>คน</small>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon  bg-success elevation-1"><i class="fas fa-user-check"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">ประเมินแล้ว</span>
                            {{ $evalu_pass }}
                            <small>คน</small>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

                <!-- fix for small devices only -->
                <div class="clearfix hidden-md-up"></div>

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-danger  elevation-1"><i class="far fa-copy "></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">ประเมินแบบตัวเลือก</span>
                            {{ $option_1 }}
                            <small>คน</small>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-eye-dropper"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">ประเมินกำหนดเอง</span>
                            {{ $option_2 }}
                            <small>คน</small>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">รายชื่อพนักงาน</h5>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap table-sm " id="get_data_user_6090">
                                <thead>

                                    <tr>
                                        <th>รหัสพนักงาน</th>
                                        <th>ชื่อ-สกุล</th>
                                        <th>ต่ำแหน่ง</th>
                                        <th>ฝ่าย</th>
                                        <th>ตั้งค่า</th>
                                    </tr>
                                </thead>

                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">รายชื่อจัดการประเมิน</h5>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap table-sm " id="get_data_userset_6090">
                                <thead>
                                    <tr>
                                        <th>ผู้ประเมิน</th>
                                        <th>ผู้ถูกประเมิน</th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                    <tr>
                                        <th>รหัสพนักงาน</th>
                                        <th>รหัสพนักงาน</th>
                                        <th>แบบการประเมิน</th>
                                        <th>สถานะ</th>
                                        <th>เพิ่มเติม</th>
                                    </tr>
                                </thead>

                            </table>
                        </div>
                    </div>
                </div>

            </div>


        </div>
    </section>

    <div class="modal fade" id="modal-set6090">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">เพิ่มรายชื่อผู้ถูกประเมิน</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form-addusername">
                    <input type="hidden" name="assessor" id="assessor">
                    <div class="modal-body">
                        <div class="form-group">
                            <select class="form-control  select2" name="assessed" id="assessed" required>
                                <option value="">เลือกพนักงาน</option>
                                @foreach($staff as $item)
                                    <option value="{{ $item->Code_Staff }}">{{ $item->Name_Thai }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <select class="form-control  select2" name="degree" id="degree" required>
                                <option value="">เลือกระดับ</option>
                                <option value="ระดับปฏิบัติการ">ระดับปฏิบัติการ</option>
                                <option value="ระดับผู้บังคับบัญชา">ระดับผู้บังคับบัญชา</option>

                            </select>
                        </div>
                        <div class="form-group">
                            <label>เลือกวันที่ครบ 60 วัน:</label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="far fa-calendar-alt"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control float-right" id="reservation_60"  name="reservation_60" required>
                            </div>
                            <!-- /.input group -->

                        </div>
                        <div class="form-group">
                            <label>เลือกวันที่ครบ 90 วัน:</label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="far fa-calendar-alt"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control float-right" id="reservation_90" name="reservation_90" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                        <button type="submit" class="btn btn-primary">บันทึก</button>
                    </div>
            </div>
            </form>
        </div>
    </div>


    <div class="modal fade" id="modal-set90">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">เพิ่มรายชื่อผู้ประเมิน</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form-add90">
                    <input type="hidden" id="assessor60" name="assessor60">
                    <input type="hidden" id="assessed60" name="assessed60">
                    <div class="modal-body">
                        <div class="form-group">
                            <select class="form-control  select2" name="assessor90" id="assessor90" required>
                                <option value="">เลือกพนักงาน</option>
                                @foreach($staff as $item)
                                    <option value="{{ $item->Code_Staff }}">({{ $item->Code_Staff }}) {{ $item->Name_Thai }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                        <button type="submit" class="btn btn-primary"     >บันทึก</button>
                    </div>
            </div>
            </form>
        </div>
    </div>
@endsection
