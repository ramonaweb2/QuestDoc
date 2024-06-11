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
        .inline-block {
            display: inline-block;
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
    </style>

    <title>Протокол от ОС</title>
</head>

<body>
    <header class="header-container">
        <img src="<?php echo e(public_path().'/images/logo.png'); ?>" class="logo" style="width: 106.40px; height: 69.60px;">
        <h4 class="heading">ДИГИТАЛНА УСЛУГА  В ПОМОЩ НА ДОМОУПРАВИТЕЛИТЕ</h4>
    </header>

    <h4 class="text-center">
        <strong>ПРОТОКОЛ</strong><br/>
        ОТ ПРОВЕДЕНО ОБЩО СЪБРАНИЕ НА СОБСТВЕНИЦИТЕ НА САМОСТОЯТЕЛНИ ОБЕКТИ В СГРАДА<br/>
        В РЕЖИМ НА ЕТАЖНА СОБСТВЕНОСТ С АДРЕС:<br/>
        <?php echo e($invitation->address); ?>

    </h4>

    <div>
        <p>Днес, <?php echo e($invitation->meet_date); ?> г., <?php echo e($invitation->location); ?> <?php echo e($invitation->address); ?>,
            се проведе общо събрание на собствениците, за което беше съобщено чрез покана 
            <?php echo e($invitation->stick_place); ?> по реда на чл. 13 от Закон за управление на етажната 
            собственост (ЗУЕС), при следния предварително обявен дневен ред:
        </p>
        <p><strong>Дневен ред:</strong></p>
        <ul>
            <?php $__currentLoopData = $agendas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $agendaItems): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li>
                    <?php $__currentLoopData = $agendaItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($key == 'approves'): ?>
                            <div>За: <?php echo e($value); ?></div>
                        <?php elseif($key == 'refuses'): ?>
                            <div>Против: <?php echo e($value); ?></div>
                        <?php elseif($key == 'abstain'): ?>
                            <div>Въздържал се: <?php echo e($value); ?></div>
                        <?php else: ?>
                            <div><?php echo e($value); ?></div>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
        <p>Присъствали: <?php echo e($protocol->meetQuorum2); ?></p>

        <p><strong>Гласуване:</strong></p>
        <?php if($voting): ?>
            <ul>
                <?php $__currentLoopData = $voting; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $votingItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <!--
                    agenda_name: 
                    participant_apartment: 
                    voting: 
                -->
                    <li>
                        <?php $__currentLoopData = $votingItem; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($key == 'voting'): ?>
                                <?php if($value == 'approves'): ?>
                                    <div>За</div>
                                <?php elseif($value == 'refuses'): ?>
                                    <div>Против</div>
                                <?php elseif($value == 'abstain'): ?>
                                    <div>Въздържал се</div>
                                <?php endif; ?>
                            <?php else: ?>
                                <div><?php echo e($value); ?></div>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        <?php endif; ?>


        <p>В <?php echo e($protocol->start_time); ?> ч., председателстващият събранието <?php echo e($invitation->manager); ?> 
            констатира, че присъстват <?php echo e($protocol->meetQuorum1); ?>% лично или чрез представители 
            по-малко от 67% собственици. Събранието НЕ събра необходимия според ЗУЕС чл15 (1) 
            кворум и председателстващият отложи събранието с един час. Собствениците останаха във
            фоаето на партера в изчакване.
        </p>
        <p>В <?php echo e($protocol->start_time_plus_1); ?> ч., се направи повторно преброяване, на което се 
            констатира, че присъстват <?php echo e($protocol->meetQuorum2); ?>% от собственици на идеални 
            части, съгласно приложен списък, съдържащ имената на собствениците или на техните 
            пълномощници и идеалните части, които притежават. Председателстващият събранието 
            обяви, че има необходимия кворум и събранието се открива на основание - чл. 15, ал2 от ЗУЕС.
        </p>
        <p>***** само в случаите, когато се съберат >67% в първоначално обявения час на събранието</p>
        <p>В <?php echo e($invitation->meet_time); ?> ч., се направи преброяване, на което се констатира, 
            че присъстват ________% от собственици на идеални части, съгласно приложен списък, 
            съдържащ имената на собствениците или на техните пълномощници и идеалните части, 
            които притежават. Председателстващият събранието обяви, че има необходимия кворум 
            и събранието се открива на основание - чл. 15, ал1 от ЗУЕС.
        </p>
        <p>***** само в случаите, когато се съберат >67% в първоначално обявения час на събранието</p>
        <p>Присъстващите са както следва: ОС списък с присъстващи и ид.ч. които притежават</p>

        <ul>
            <?php $__currentLoopData = $participants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $participant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li>Ап. <?php echo e($participant->apartment); ?> <br/>
                    Ид. части: <?php echo e($participant->parts); ?> <br/>
                    Представител: <?php echo e($participant->person); ?> <br/>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
        
        <p>По предложение на Управителя ЕС, за протоколчик, единодушно бе избран <?php echo e($protocol->minuteman); ?>.
            Ид. части използвани в този протокол са от Площообразуване/ от Н.А./ са приети на ОС
            ______________ и са приложение към протокол от ОС от ______________.
        </p>
    </div>

    <div>
        <h5>Ход на събранието и взети решения:<br/>
            По точка 1 от дневния ред се дискутира следното:</h5>
        <p>Изявления и предложения _____________________________________________________________________________</p>
        <p>По точка 1 от дневния ред се взеха следните решения:</p>
        <p>Решение (какво конкретно е гласувано и прието) _____________________________________________________________________________</p>
        <p><strong>Приема се/Не се приема</strong> с гласове:</p>
        За: <br/>
        Въздържал се: <br/>
        Против: <br/>
        Присъствали: <br/>
        <p class="bold">По точка 2 от дневния ред се дискутира следното:</p>
        <p>Изявления и предложения _____________________________________________________________________________</p>
        <p>По точка 2 от дневния ред се взеха следните решения:</p>
        <p>Решение (какво конкретно е гласувано и прието) _____________________________________________________________________________</p>
        <p><strong>Приема се/Не се приема</strong> с гласове:</p>
        За:  <br/>
        Въздържал се: <br/>
        Против: <br/>
        Присъствали: <br/>
    </div>

    <div>
        <p>Събранието се закри в <?php echo e($protocol->end_time); ?> ч.</p>
        <p>Този протокол може да бъде оспорен по правилата определени в ЗУЕС.</p>
        <p>Неразделна част от този протокол са следните документи:</p>
        <?php echo e($protocol->notes); ?>

        <p>Протоколчик:</p>
        <p>Управител на ЕС:</p>
    </div>

    <p>Днес, <?php echo e($invitation->meet_date); ?> г. в <?php echo e($invitation->meet_time); ?> на общото събрание на 
        ЕС с адрес: <?php echo e($invitation->address); ?> присъстват:
    </p>

    <table>
        <thead>
            <tr>
                <th width="5%">Ап</th>
                <th width="5%">Ид. части</th>
                <th width="80%">Представител</th>
                <th width="10%">Подпис</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>
    <p>Представени са общо: _______________ % идеални части. Използваните ид. части са от 
        Площообразуване/ от Н.А./ са приети на ОС ______________ и са приложение към протокол 
        от ОС от ______________.
    </p>
    <p>Протоколчик:</p>
    <p>Домоуправител:</p>

    <div style="page-break-after: always;"></div>
    <div class="text-center bold">
        Гласуване на решение на общото събрание на ЕС с адрес: <?php echo e($protocol->address); ?>, 
        от дата: <?php echo e($invitation->meet_date); ?> г.<br/><br/>
        Въпрос подложен на гласуване
    </div>

    <p>Конкретното решение, което се гласува Напр: За Управител ЕС се избира Иван Иванов, 
        собственик на ап1.
    </p>
    <p>
        <strong>Гласуване:</strong>
    </p>
    <table>
        <thead>
            <tr>
                <th width="85%">Име и Апартамент</th>
                <th width="5%">За /подпис/</th>
                <th width="5%">Против /подпис/</th>
                <th width="5%">Въздържал /подпис/</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>

    <p>Протоколчик:</p>
    <p>Управител на ЕС:</p>
    
    <div style="page-break-after: always;"></div>
    <h4 class="text-center bold">ПРОТОКОЛ<br/>
        ЗА ПОСТАВЕНО СЪОБЩЕНИЕ
    </h4>
    <p class="text-center">на основание чл. 16, ал. 7 от Закона за управление на етажната собственост</p>
    <p>Днес, _______________ , в _______________ часа, в присъствието на:
        _____________________________________________________________________________
        три имена на собственик/ползвател/обитател вписан в книгата на ЕС
    </p>
    <p><?php echo e($invitation->location); ?> на адрес <?php echo e($invitation->address); ?>, се постави съобщение 
        за изготвен Протокол от проведеното общо събрание на Етажната собственост на 
        дата <?php echo e($invitation->meet_date); ?> г.
    </p>
    <p>Изготвили протокола:</p>
    <p>1. __________________________________________________________________________________________ </p>
    <div class="ml3 inline-block">/ Име и фамилия на Председател на УС / Управител /</div>
    <div class="text-right inline-block" style="float: right;">/ Подпис /</div>
    
    <p>2. __________________________________________________________________________________________ </p>
    <div class="ml3 inline-block">/ Име и фамилия на Собственик/ползвател/обитател /</div>
    <div class="text-right inline-block" style="float: right;">/ Подпис /</div>
    

    <div style="page-break-after: always;"></div>
    <h5 class="text-center">Инструкция за използване от Вход Експерт:</h5>
    <p>Опишете къде залепвате поканата обикновено.</p>
    <p>Опишете кой е източника на ид.ч. който използвате.</p>
    <p> Прочетете нашата статия „Провеждане и водене на Общо събрание на Етажна собственост“.</p>
    <p>Попълнете маркирания в жълто текст съгласно особеностите на Вашата сграда.</p>
    <p>Приложете към протокола всички пълномощни, присъствения лист, бланките за гласуване.</p>
    <p>Използвайте нашия генератор на документи, за по-бързо съставяне на протокола.</p>
</html><?php /**PATH /home/ramona/PhpstormProjects/QuestDoc/resources/views/protocols/protocol.blade.php ENDPATH**/ ?>