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
            width: 100%;
        }

      

    </style>
</head>

<body>





    @isset($data_60_A)
        @foreach ($data_60_A as $item)

            {{ $item->name_opf }} <br>







        @endforeach
    @endisset


    @isset($data_90_A)
        @foreach ($data_90_A as $item)

            {{ $item->name_opf }} <br>







        @endforeach
    @endisset




    @isset($data_60_B)
        <table>
            <tr>
                <th>หัวข้อประเมิน</th>
                <th>คะแนน</th>
              
            </tr>
            @foreach ($data_60_B as $item)
                <tr>
                    <td style="width: 50%">{{ $item->name_ops }}</td>
                    <?php $i =$item->score_ha * 100 ?>
                    <td align="center">{{ $i }}</td>
                   
                </tr>
            @endforeach
        </table>

    @endisset


    @isset($data_90_B)



        <table>
            <tr>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Savings</th>
            </tr>
            @foreach ($data_60_B as $item)
                <tr>
                    <td>{{ $item->name_ops }}</td>
                    <td>Griffin</td>
                    <td>$100</td>
                </tr>

            @endforeach

        </table>






    @endisset
















</body>

</html>
