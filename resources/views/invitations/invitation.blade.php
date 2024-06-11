<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }
        h4 {
            font-weight: normal;
            margin-bottom: 40px;
        }
        .logo {
            width: 106.40px;
            height: 70px;
        }
        .heading {
            margin: 25px 0;
            text-align: center;
            float: right;
            height: auto;
            width: 80%;
        }
        .text-center {
            text-align: center;
        }
        .text-right {
            text-align: right;
        }
        .bold {
            font-weight: bold;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #000;
        }
        th, td {
            padding: 20px;
        }
        .ml3 {
            margin-left: 130px;
        }
        .mt-5 {
            margin-top: 50px;
        }
    </style>

    <title>Покана за ОС</title>
</head>

<body>
    <header class="header-container">
        <img src="{{ public_path().'/images/logo.png' }}" class="logo" style="width: 106.40px; height: 69.60px;">
        <h4 class="heading">ДИГИТАЛНА УСЛУГА  В ПОМОЩ НА ДОМОУПРАВИТЕЛИТЕ</h4>
    </header>
    
    <h4 class="text-center">
        <strong>ПОКАНА</strong><br/>
        От Управителя на ЕС {{ $invitation['manager'] }}, на основание {{ $invitation['reason'] }}<br/>
        ЗА ОБЩО СЪБРАНИЕ НА СОБСТВЕНИЦИТЕ НА ЕТАЖНА СОБСТВЕНОСТ с адрес:<br/>
        {{ $invitation['address'] }}<br/>
    </h4>

    <p>което ще се проведе:</p>
    <p>на {{ $invitation['meet_date'] }}г от {{ $invitation['meet_time'] }} часа 
        на {{ $invitation['location'] }}</p>
    <p>С ДНЕВЕН РЕД:</p>
    <ul>
        @foreach ($agendas as $agendaItems)
            <li>
                {{ $agendaItems['name'] }}
            </li>
        @endforeach
    </ul>

    <p>поставена на: ______________________________</p>
    <p class="ml3">/ дата и час /</p>
    <p>______________________________<br/>
        / име и фамилия на Председателя на УС/Управителя /
    </p>
    <p class="text-right">
        / подпис /
    </p>

    <p>УТОЧНЕНИЯ:</p>
    <ul>
        <li>Собственик или ползвател, който не може да участва в общото събрание, може да упълномощи пълнолетен член на домакинството си, който е вписан в книгата на етажната собственост, или друг собственик, който да го представлява. Упълномощаването може да бъде направено устно на същото или на предходно заседание на общото събрание, което се отразява в протокола на събранието, или в писмена форма.</li>
        <li>Собственик или ползвател може писмено да упълномощи и друго лице, което да го представлява, с нотариална заверка на подписа или адвокат с писмено пълномощно.</li>
        <li>Едно лице може да представлява най-много трима собственици и/или ползватели.</li>
        <li>В случай, че в посоченият час не се явят собственици, представляващи не по-малко от 67% от етажната собственост, Събранието ще се проведе час по късно по реда на чл. 15, ал.2 от ЗУЕС. Ако при повторното преброяване час по-късно, не присъстват собственици или упълномощени представители, представляващи 33% от общите части, Събранието ще се проведе на следващия ден в същия час и място, като решенията ще бъдат законно взети, независимо от кворума.</li>
    </ul>

    <p class="mt-5">Тази покана е поставена на видно място - {{ $invitation['stick_place'] }} 
        на дата: ________________  в ________ часа
    </p>

    <div>
        ______________________________<br/>
        / име и фамилия на Председателя на УС/Управителя /
    </div>
    <div class="text-right">
        / подпис /
    </div>

    <div>
        ______________________________<br/>
        / име и фамилия на вписано в книгата на ЕС лице  /
    </div>
    <div class="text-right">
        / подпис /
    </div>

    <p class="text-center">Инструкция за използване от Вход Експерт:</p>
    <p>Попълнете маркирания в жълто текст съгласно особеностите на Вашата сграда.</p>
</body>
</html>