<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>
        @font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: normal;
            src: url("{{ public_path('fonts/THSarabunNew.ttf') }}") format('truetype');
        }

        @font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: bold;
            src: url("{{ public_path('fonts/THSarabunNew Bold.ttf') }}") format('truetype');
        }

        @font-face {
            font-family: 'THSarabunNew';
            font-style: italic;
            font-weight: normal;
            src: url("{{ public_path('fonts/THSarabunNew Italic.ttf') }}") format('truetype');
        }

        @font-face {
            font-family: 'THSarabunNew';
            font-style: italic;
            font-weight: bold;
            src: url("{{ public_path('fonts/THSarabunNew BoldItalic.ttf') }}") format('truetype');
        }

        body {
            font-family: "THSarabunNew";
        }

        table,
        td,
        th {
            border: 1px solid black;
         
        }

        table {

            border-collapse: collapse;

        }

        .page_break {
            page-break-before: always;
        }

    </style>
</head>
<?php $sum = ($ngg_operational_score_60->evaluation_evascore + $ngg_operational_score_90->evaluation_evascore) / 2; 


?>

<body>
    <table style="width: 100%">
    
        <tr>
         
            
            <td align="center" colspan="3" style=" border: 1px solid rgb(255, 255, 255);"><img
                    src="{{ public_path('/img/NGG.jpg') }}" alt="" width="90px" height="90px">       
                </td>
        </tr>
        <tr>
            <td colspan="3" align="center" style=" border: 1px solid rgb(255, 255, 255);">
                <h2> รายงานผลการทดลองงาน</h2>
            </td>
        </tr>
        <tr>

            <td style=" border: 1px solid rgb(255, 255, 255);" style="width: 40%"
                style=" border: 1px solid rgb(255, 255, 255);"><b>ชื่อ-สกุล:</b> {{ $users_detail->Name_Thai }}</td>
            <td style=" border: 1px solid rgb(255, 255, 255);"><b>ตำแหน่ง:</b> {{ $users_detail->Position }}</td>
            <td style=" border: 1px solid rgb(255, 255, 255);"><b>ฝ่าย:</b> {{ $users_detail->Faction }}</td>
        </tr>
        <tr>

            <td style=" border: 1px solid rgb(255, 255, 255);"><b>แผนก:</b> {{ $users_detail->Department }}</td>
            <td style=" border: 1px solid rgb(255, 255, 255);" colspan="2"><b>บริษัท:</b> {{ $users_detail->Company }}
            </td>

        </tr>

    </table>




    @isset($data_60_A)
    <table style="width: 100%">
        <tr>
            <th>รายงานผลประเมิน 60 วัน </th>
            <th>ตั้งแต่วันที่ {{ $ngg_operational_6090->pass_60 }} </th>

        </tr>
        <tr>
            <th>หัวข้อประเมิน</th>
            <th>คะแนน</th>

        </tr>
        @foreach ($data_60_A as $item)
            <tr>
                <td style="width: 50%">{{ $item->name_opf }}</td>
                <?php $i = $item->score_ha * 100; ?>
                <td align="center">{{ $i }}</td>

            </tr>
        @endforeach
        <tr>
            <td style="width: 50%" align="center"><b>คะแนนรวม</b> </td>

            <td align="center">{{ $ngg_operational_score_60->evaluation_evascore }}/100</td>

        </tr>
    </table>
    @endisset


    @isset($data_90_A)
    <div class="page_break"></div>
    <table style="width: 100%">
        <tr>
            <th>รายงานผลประเมิน 90 วัน </th>
            <th>ตั้งแต่วันที่ {{ $ngg_operational_6090->pass_60 }} </th>

        </tr>
        <tr>
            <th>หัวข้อประเมิน</th>
            <th>คะแนน</th>
        </tr>
        @foreach ($data_90_A as $item)
            <tr>
                <td style="width: 50%">{{ $item->name_opf }}</td>
                <?php $i = $item->score_ha * 100; ?>
                <td align="center">{{ $i }}</td>

            </tr>

        @endforeach
        <tr>
            <td style="width: 50%" align="center"> <b>คะแนนรวม</b> </td>
            <td align="center">{{ $ngg_operational_score_90->evaluation_evascore }}/100</td>
        </tr>
        <tr>
            <td style="width: 50%" align="center"> <b>สรุปคะแนน</b> {{ $ngg_operational_score_60->evaluation_evascore }}
                X {{ $ngg_operational_score_90->evaluation_evascore }} / 2 
            
                @if ($sum >= 75)
                <div class="text-center"> <h3>ผ่านการทดลองงาน</h3></div>        
                    @else
                    <div class="text-center">  <h3>ไม่ผ่านการทดลองงาน</h3></div>        
                    @endif
        
            
            </td>

            <td align="center"> <b style="font-size: 30px"> {{ $sum }}/100</b></td>

        </tr>
        <tr>
            <td colspan="2"><b> ความคิดเห็น 60 วัน:</b> {{ $ngg_operational_score_60->remark_evascore }}</td>

        </tr>
        <tr>
            <td colspan="2"><b>ความคิดเห็น 90 วัน:</b> {{ $ngg_operational_score_90->remark_evascore }}</td>

        </tr>
    </table>


    @endisset

    @isset($data_60_B)
        <table style="width: 100%">
            <tr>
                <th>รายงานผลประเมิน 60 วัน </th>
                <th>ตั้งแต่วันที่ {{ $ngg_operational_6090->pass_60 }} </th>

            </tr>
            <tr>
                <th>หัวข้อประเมิน</th>
                <th>คะแนน</th>

            </tr>
            @foreach ($data_60_B as $item)
                <tr>
                    <td style="width: 50%">{{ $item->name_ops }}</td>
                    <?php $i = $item->score_ha * 100; ?>
                    <td align="center">{{ $i }}</td>

                </tr>
            @endforeach
            <tr>
                <td style="width: 50%" align="center"><b>คะแนนรวม</b> </td>

                <td align="center">{{ $ngg_operational_score_60->evaluation_evascore }}/100</td>

            </tr>
        </table>

    @endisset
   




    @isset($data_90_B)

        <table style="width: 100%">
            <tr>
                <th>รายงานผลประเมิน 90 วัน </th>
                <th>ตั้งแต่วันที่ {{ $ngg_operational_6090->pass_60 }} </th>

            </tr>
            <tr>
                <th>หัวข้อประเมิน</th>
                <th>คะแนน</th>
            </tr>
            @foreach ($data_60_B as $item)
                <tr>
                    <td style="width: 50%">{{ $item->name_ops }}</td>
                    <?php $i = $item->score_ha * 100; ?>
                    <td align="center">{{ $i }}</td>

                </tr>

            @endforeach
            <tr>
                <td style="width: 50%" align="center"> <b>คะแนนรวม</b> </td>
                <td align="center">{{ $ngg_operational_score_90->evaluation_evascore }}/100</td>
            </tr>
            <tr>
                <td style="width: 50%" align="center"> <b>สรุปคะแนน</b> {{ $ngg_operational_score_60->evaluation_evascore }}
                    X {{ $ngg_operational_score_90->evaluation_evascore }} / 2 
                
                    @if ($sum >= 75)
                    <div class="text-center"> <h3>ผ่านการทดลองงาน</h3></div>        
                        @else
                        <div class="text-center">  <h3>ไม่ผ่านการทดลองงาน</h3></div>        
                        @endif
            
                
                </td>

                <td align="center"> <b style="font-size: 30px"> {{ $sum }}/100</b></td>

            </tr>
            <tr>
                <td colspan="2"><b> ความคิดเห็น 60 วัน:</b> {{ $ngg_operational_score_60->remark_evascore }}</td>

            </tr>
            <tr>
                <td colspan="2"><b>ความคิดเห็น 90 วัน:</b> {{ $ngg_operational_score_90->remark_evascore }}</td>

            </tr>
        </table>






    @endisset











  

            <table style="width: 100%">
    
                <tr>
        
                    <td style=" border: 1px solid rgb(255, 255, 255);" align="center"><b>ลงชื่อผู้ประเมิน:</b><br> ....................................................................<br>
{{$assessor_evascore->Name_Thai}} ({{$assessor_evascore->Position}})
                    </td>
                    <td style=" border: 1px solid rgb(255, 255, 255);" colspan="2"  align="center"><b>ลงชื่อพนักงาน:</b><br>....................................................................<br>
                     {{ $users_detail->Name_Thai }} ( {{ $users_detail->Position }} )
                    </td>
        
                </tr>
        
            </table>
        

</body>

</html>
