<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: DejaVu Sans !important;
            word-break: break-all !important;

            margin: .5in;
            word-break: break-all;
        }
        .heading{
            font-weight: bold;
            font-size: 18px;
            text-align: center;

        }

        table{
            border: 1px solid black;
            width: 100%;
            margin-top: 50px;
            margin-bottom: 50px;

        }
        td, th{
            /* border-left: 1px solid green;
            border-bottom: 1px solid green; */

            text-align: center;
            padding: 5px;
            font-size: 12px;


        }

        .div{
            min-height: 50px;
        }

        p{
            /* margin-bottom: 20px; */

        }

        .udnerline{
            border-bottom: 1px solid #000;
            display: inline-block;
            margin-bottom: 20px
        }

        @media print {
  .noPrint{
    display:none;
  }
}

@media print {
    a[href]:after {
        content: none !important;
    }
}

@page { size: auto;  margin: 5mm; }

h1{
  color:#f6f6;
}

.noPrint{
    padding: 10px 20px;
    font-size: 20px;
    text-transform: uppercase;
    border: none;
    background: #222f3e;
    color: white;
    cursor: pointer;
    transition: 0.5s;

}

.noPrint:hover{
    opacity: 0.7;
}




    </style>


    <title></title>
</head>
<body>

    <button onclick="document.title='{{ $data['documentName'] }}'; window.print();" class="noPrint">
        Print Document
        </button>

    <div id="html-template">
    <div class="logo" style="text-align: center">
        <img src="https://cos.com.ge/front_styles/images/logo.png" alt="" width="200px">
    </div>
    <br>
    <br>

    <p class="heading" style="margin-bottom: 0">უსაფრთხო ინსტრუქტაჟის ჩატარების ფორმა</p>
    <p class="heading">HSI Instruction form</p>
    <br>
    <br>
    <br>


    <div class="section">
        <p style=""><i>თარიღი / Date of instruction: </i></p>
        <p class="udnerline"><strong>{{ $data['start_date'] }} - {{ $data['end_date'] }} </strong></p>
    </div>

    <div class="section">
        <p style=""><i>ორგანიზაცია / Organization: </i></p>
        <p class="udnerline"><strong>{{ $data['organization']->name }} </strong></p>
    </div>


    <div class="section">
        <p><i>ობიექტის დასახელება / Facility name:</i></p>
        <p class="udnerline"><strong>{{ $data['office']->name }} </strong></p>
    </div>

    <div class="section">
        <p><i>ობიექტის მისამართი / Facility address:</i></p>
        <p class="udnerline"><strong>{{ $data['office']->address }} </strong></p>
    </div>

    <div class="section">
        <p style=""><i>მოდული / Module:</i></p>
        <p class="udnerline"><strong>{{ $data['training_name'] }} </strong></p>
    </div>

    <div class="section">
        <p style=""><i>თემები / Topics:</i></p>
        @foreach ($data['media'] as $key => $m)
           @if(!empty($m->name) &&  $m->type == 'document')
            <span class="udnerline"><strong>{{ $m->name }}</span>{{ $key == count($data['media']) - 1 ? '.' : ',' }} &nbsp;<strong>
           @endif
        @endforeach
    </div>
    <br>
    <div class="section">
        <p style=""><i>პასუხისმგებელი პირი / Responsible authority:</i></p>
        <p class="udnerline"><strong>{{ $data['trainer_name'] }} </strong></p>
    </div>


    <table  width="100" border="1" style="table-layout:fixed" cellspacing="0" border="1">
        <thead>
          <tr>
            <th scope="col"  style="width:5%">#</th>
            <th scope="col" style="width: 23%">სახელი,გვარი</th>
            <th scope="col" style="width: 23%">პირადი ნომერი</th>
            <th scope="col" style="width: 23%">თანამდებობა</th>
            <th scope="col" style="width: 200px;word-wrap:break-word; width: 26%">ელ-ფოსტა</th>
            <th scope="col" style="width: 23%">ხელმოწერა</th>
          </tr>
        </thead>
        <tbody>

            @foreach ($data['customers'] as $key => $customer)
                <tr>
                    <th  style="width:5%">{{ $key + 1 }}</th>
                    <td style="width: 23%">{{ $customer->name }}</td>
                    <td style="width: 23%">{{ $customer->username }}</td>
                    <td style="width: 23%">{{ $customer->position->name }}</td>
                    <td  style="width: 200px;word-wrap:break-word; width: 26%">{{ $customer->email }}</td>
                    <td style="width: 23%"><div class="div"></div></td>
              </tr>
            @endforeach
        </tbody>
      </table>

      <div class="section">
        <p style=""><i>პასუხისმგებელი პირი / Responsible authority:</i></p>
        <p class="udnerline"><strong>{{ $data['trainer_name'] }} </strong></p>
      </div>

      <div class="section">
        <p style=""><i>ხელმოწერა / Signature:</i></p>
        <p class="udnerline"><br>
            {{-- <img src="http://cos.ge/storage/certificates/2022-02-07_00-58-32.png" style="width: 200px"> --}}
            <img src="{{ $data['trainer_signature'] }}" style="width: 200px">


        </p>
      </div>

    </div>

    <script>

    </script>
</body>
</html>
