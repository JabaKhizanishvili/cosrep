<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { text-align: center; font-family: DejaVu Sans, sans-serif; }
        .title { font-size: 28px; margin-top: 50px; }
        .name { font-size: 22px; margin: 30px 0; }
        .date { font-size: 16px; margin-top: 50px; }
    </style>
</head>
<body>
<h1 class="title">ს ე რ ტ ი ფ ი კ ა ტ ი</h1>
<p>წარმატებით დაეუფლა ტრენინგს</p>
<p><strong>{{ $trainingName->name }}</strong></p>
<p class="name">{{ $user->name }}</p>
<p>პერსონალურ მონაცემთა დაცვის ოფიცერი</p>
<p class="date">თარიღი: {{ $date }}</p>
<p class="date">ხელმოწერა: {{ $signature }}</p>
</body>
</html>
