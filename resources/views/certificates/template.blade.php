{{--<!DOCTYPE html>--}}
{{--<html>--}}
{{--<head>--}}
{{--    <meta charset="UTF-8">--}}
{{--    <style>--}}
{{--        @font-face {--}}
{{--            font-family: 'DejaVu Sans';--}}
{{--            font-style: normal;--}}
{{--            font-weight: normal;--}}
{{--            src: url({{ storage_path('fonts/DejaVuSans.ttf') }}) format('truetype');--}}
{{--        }--}}

{{--        body {--}}
{{--            text-align: center;--}}
{{--            font-family: 'DejaVu Sans', sans-serif;--}}
{{--            background-color: #f9f9f9;--}}
{{--            margin: 0;--}}
{{--            padding: 0;--}}
{{--        }--}}

{{--        .certificate-container {--}}
{{--            width: 800px;--}}
{{--            height: 600px;--}}
{{--            margin: 0 auto;--}}
{{--            padding: 40px;--}}
{{--            background-color: white;--}}
{{--            border: 15px solid #1a5276;--}}
{{--            box-shadow: 0 0 20px rgba(0,0,0,0.2);--}}
{{--            position: relative;--}}
{{--        }--}}

{{--        .watermark {--}}
{{--            position: absolute;--}}
{{--            opacity: 0.1;--}}
{{--            font-size: 120px;--}}
{{--            color: #1a5276;--}}
{{--            transform: rotate(-45deg);--}}
{{--            top: 30%;--}}
{{--            left: 10%;--}}
{{--            z-index: 1;--}}
{{--        }--}}

{{--        .title {--}}
{{--            font-size: 32px;--}}
{{--            margin-top: 30px;--}}
{{--            color: #1a5276;--}}
{{--            font-weight: bold;--}}
{{--            text-transform: uppercase;--}}
{{--            letter-spacing: 5px;--}}
{{--            position: relative;--}}
{{--            z-index: 2;--}}
{{--        }--}}

{{--        .subtitle {--}}
{{--            font-size: 18px;--}}
{{--            margin: 20px 0;--}}
{{--            color: #555;--}}
{{--            z-index: 2;--}}
{{--            position: relative;--}}
{{--        }--}}

{{--        .training-name {--}}
{{--            font-size: 24px;--}}
{{--            margin: 30px 0;--}}
{{--            color: #1a5276;--}}
{{--            font-weight: bold;--}}
{{--            text-decoration: underline;--}}
{{--            z-index: 2;--}}
{{--            position: relative;--}}
{{--        }--}}

{{--        .recipient-name {--}}
{{--            font-size: 28px;--}}
{{--            margin: 40px 0;--}}
{{--            color: #1a5276;--}}
{{--            font-weight: bold;--}}
{{--            border-bottom: 2px solid #1a5276;--}}
{{--            display: inline-block;--}}
{{--            padding-bottom: 10px;--}}
{{--            z-index: 2;--}}
{{--            position: relative;--}}
{{--        }--}}

{{--        .officer {--}}
{{--            font-size: 16px;--}}
{{--            margin: 20px 0;--}}
{{--            z-index: 2;--}}
{{--            position: relative;--}}
{{--        }--}}

{{--        .date {--}}
{{--            font-size: 16px;--}}
{{--            margin-top: 50px;--}}
{{--            z-index: 2;--}}
{{--            position: relative;--}}
{{--        }--}}

{{--        .signature {--}}
{{--            margin-top: 60px;--}}
{{--            z-index: 2;--}}
{{--            position: relative;--}}
{{--        }--}}

{{--        .signature-line {--}}
{{--            width: 200px;--}}
{{--            border-top: 1px solid #000;--}}
{{--            margin: 0 auto;--}}
{{--            margin-top: 50px;--}}
{{--        }--}}

{{--        .english {--}}
{{--            font-style: italic;--}}
{{--            color: #666;--}}
{{--            font-size: 14px;--}}
{{--            margin-top: 5px;--}}
{{--        }--}}

{{--        .logo {--}}
{{--            position: absolute;--}}
{{--            top: 20px;--}}
{{--            right: 40px;--}}
{{--            width: 100px;--}}
{{--            z-index: 2;--}}
{{--        }--}}
{{--    </style>--}}
{{--</head>--}}
{{--<body>--}}
{{--<div class="certificate-container">--}}
{{--    <!-- Optional watermark -->--}}
{{--    <div class="watermark">CERTIFICATE</div>--}}

{{--    <!-- Optional logo - replace with your actual logo path -->--}}
{{--    <img src="{{ storage_path('logo.png') }}" class="logo" alt="Company Logo">--}}
{{--    <img src="{{ front_styles('images/logo.png') }}" class="logo" alt="Company Logo">--}}

{{--    <h1 class="title">ს ე რ ტ ი ფ ი კ ა ტ ი</h1>--}}
{{--    <p class="english">CERTIFICATE</p>--}}

{{--    <p class="subtitle">წარმატებით დაეუფლა ტრენინგს</p>--}}
{{--    <p class="english">HAS SUCCESSFULLY COMPLETED TRAINING IN</p>--}}

{{--    <p class="training-name">{{ $trainingName->name }}</p>--}}

{{--    <p class="recipient-name">{{ $user->name }}</p>--}}

{{--    <p class="officer">პერსონალურ მონაცემთა დაცვის ოფიცერი</p>--}}
{{--    <p class="english">Personal data protection officer</p>--}}

{{--    <p class="officer">ადასტურებს, რომ</p>--}}
{{--    <p class="english">TO CERTIFY THAT</p>--}}

{{--    <div class="date">--}}
{{--        თარიღი/DATE: {{ $date }}--}}
{{--    </div>--}}

{{--    <div class="signature">--}}
{{--        <div class="signature-line"></div>--}}
{{--        <p>ხელმოწერა/SIGNATURE:
 <img src="{{signatureImage($trainingName->trainer->signature)}}" />
            </p>--}}
{{--    </div>--}}
{{--</div>--}}
{{--</body>--}}
{{--</html>--}}



    <!DOCTYPE html>
<html lang="ka">
<head>
    <meta charset="UTF-8">
    <title>სერტიფიკატი</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            padding: 60px;
            color: #28357e;
            background-color: #ffffff;
        }

        .certificate {
            border: 5px solid #f0b14a;
            padding: 50px;
            text-align: center;
            position: relative;
        }

        h1 {
            font-size: 36px;
            margin-bottom: 10px;
        }

        h2 {
            font-size: 24px;
            margin: 10px 0;
        }

        .name {
            font-size: 28px;
            font-weight: bold;
            margin: 30px 0 10px 0;
        }

        .text {
            font-size: 16px;
            margin-bottom: 20px;
        }

        .footer {
            margin-top: 50px;
            display: flex;
            justify-content: space-between;
        }

        .signature {
            text-align: left;
            font-size: 12px;
        }

        .date {
            text-align: right;
            font-size: 12px;
        }

        .geo {
            font-family: DejaVu Sans, sans-serif;
            letter-spacing: 4px;
        }
    </style>
</head>
<body>
<div class="certificate">
    <h1 class="geo">სერტიფიკატი</h1>
    <h2>CERTIFICATE</h2>

    <p class="text geo">დადასტურებულია, რომ</p>
    <p class="text">This is to certify that</p>

    <div class="name">{{ $user->name }}</div>

    <p class="text geo">წარმატებით დაეუფლა ტრენინგს "{{ $trainingName->name }}"</p>
    <p class="text">Has successfully completed the training "{{ $trainingName->getTranslation('title', 'en') }}"</p>

    <div class="footer">
        <div class="signature">
            <img src="{{signatureImage($trainingName->trainer->signature)}}" />
            <div>ლალი ბერიძე / Lali Beridze</div>
            <div>პერსონალურ მონაცემთა დაცვის ოფიცერი</div>
            <div>Personal Data Protection Officer</div>
        </div>
        <div class="date">
            თარიღი / Date:<br>
            <strong>{{ $date }}</strong>
        </div>
    </div>
</div>
</body>
</html>
