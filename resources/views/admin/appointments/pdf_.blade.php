<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body {
            font-family: DejaVu Sans !important;
            word-break: break-all !important;
        }
        .heading{
            font-weight: bold;
            font-size: 24px;
            text-align: center;
        }

        :root {
  --border-strong: 3px solid #777;
  --border-normal: 1px solid gray;
}

body {
  font-family: Georgia, 'Times New Roman', Times, serif;
}

table>caption {
  font-size: 6mm;
  font-weight: bolder;
  letter-spacing: 1mm;
}


/* 210 x 297 mm */

table {
  width: 297mm;
  height: 210mm;
  border-collapse: collapse;
}

td {
  padding: 1mm;
  border: var(--border-normal);
  position: relative;
  font-size: 2.1mm;
  font-weight: bold;
}

tbody tr:nth-child(odd) {
  background: #eee;
}

tbody tr:last-child {
  border-bottom: var(--border-strong);
}

tbody tr> :last-child {
  border-right: var(--border-strong);
}


/* top header */

.top_head>th {
  width: 54mm;
  height: 10mm;
  vertical-align: bottom;
  border-top: var(--border-strong);
  border-bottom: var(--border-strong);
  border-right: 1px solid gray;
}

.top_head :first-child {
  width: 27mm;
  border: var(--border-strong);
}

.top_head :last-child {
  border-right: var(--border-strong);
}


/* left header */

tbody th {
  border-left: var(--border-strong);
  border-right: var(--border-strong);
  border-bottom: 1px solid gray;
}

tbody>tr:last-child th {
  border-bottom: var(--border-strong);
}


/* row */

tbody td>div {
  height: 34mm;
  overflow: hidden;
}

.vertical_span_all {
  font-size: 5mm;
  font-weight: bolder;
  text-align: center;
  border-bottom: var(--border-strong);
}

.vertical_span_all div {
  height: 10mm;
}


/* td contents */

.left {
  width: 95%;
  position: absolute;
  top: 1mm;
  left: 1mm;
}

.left>div {
  width: 100%;
  margin-bottom: 3mm;
  border-bottom: 1px dashed;
}

.right {
  position: absolute;
  left: 1mm;
  bottom: 1mm;
}

.teacher {
  position: absolute;
  right: 1mm;
  bottom: 1mm;
}

.note {
  font-size: 3mm;
}

.note :last-child {
  float: right;
}

@page {
  margin: 5mm;
  background: red;
}
    </style>
</head>
<body>

    <p  class="heading" style="margin-bottom: 0">უსაფრთხო ინსტრუქტაჟის ჩატარების ფორმა</p>
    <p class="heading">HSIIinstruction form</p>
    <p><i>თარიღი / Date of instruction: </i>2022-Feb-11 05:00 - 2022-Feb-11 06:00</p>
    <p><i>ობიექტი / Facility:</i>  6245 Norbert Villages Suite 589 Kiehnmouth, MA 04706-3454</p>
    <p><i>თემა / Subject:</i>  Aut voluptas a molestiae fugiat tempora quo. Consectetur recusandae
        aut quo dolore non dolore.</p>

    <table class="table table-bordered">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">სახელი,გვარი</th>
            <th scope="col">თანამდებობა</th>
            <th scope="col">ელ-ფოსტა</th>
            <th scope="col">ხელმოწერა</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">1</th>
            <td>Rickie Stark</td>
            <td>Retail Sales
                person</td>
            <td>rjacobson@example.com</td>
            <td></td>
          </tr>
          <tr>
            <th scope="row">2</th>
            <td>Hollis Kling</td>
            <td>Retail Sales
                person</td>
            <td>emelia.mcclure@example.com</td>
            <td></td>

          </tr>
          <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          <td><img src="http://cos.ge/storage/certificates/2022-02-07_00-58-32.png" style="width: 200px"></td>
        </tr>
        </tbody>
      </table>
</body>
</html>



