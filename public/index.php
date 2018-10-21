<?php
/**
 * User: andrei
 * Date: 20.10.2018
 * Time: 21:02
 */
?><!DOCTYPE html>
<html lang="en">
<head>
    <title>bb-test-3</title>
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, minimum-scale=1.0">
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="./favicon.ico?v=andrei-gheorghiu">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <style>.\31\/\33 {min-height: 33.33vh}</style>
</head>
<body>
<?php

$format = 'Y-m-d \| H:i';

$dateTime = isset($_REQUEST['datetime']) && strlen($_REQUEST['datetime']) > 0 ?
    DateTime::createFromFormat($format, $_REQUEST['datetime']) :
    new DateTime('NOW');
$nextWed = strtotime('next wednesday', $dateTime->getTimestamp() - 86400);
$nextSat = strtotime('next saturday', $dateTime->getTimestamp() - 86400);
$nextTime = min($nextWed, $nextSat) + 20 * 60 * 60;

$nextDraw = date('l, F jS, Y \@ g:i a', $nextTime);

?>
<div class="container">
    <form class="align-items-center d-flex flex-direction-column 1/3 justify-content-center" action="/" method="post">
        <div class="form-group row w-100">
            <div class="col-md-9">
                <input class="form-control form-control-lg"
                       type="datetime-local"
                       value="<?= $dateTime->format($format);?>"
                       id="date-input" name="datetime"
                       aria-describedby="dateTimeHelp"
                >
                <small id="dateTimeHelp" class="form-text text-muted pl-3">yyyy-mm-dd | hh:mm</small>
            </div>
            <div class="col-lg-2 offset-lg-1 col-md-3 offset-md-0">
                <button type="submit" class="btn btn-primary btn-block btn-lg">Submit</button>
            </div>
        </div>
    </form>
    <?php if ($nextDraw) { ?>
    <div class="row">
        <div class="col">
            <p class="pl-3">
                Next lottery draw: <code><?= $nextDraw; ?></code><span id="duration">..</span>.
        </div>
    </div>
    <?php } ?>
</div>
<script type="application/javascript" src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script type="application/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.js"></script>
<script type="application/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment-duration-format/2.2.2/moment-duration-format.min.js"></script>
<script type="application/javascript">
	flatpickr('#date-input', {
        enableTime: true,
        dateFormat: '<?=$format;?>',
        defaultDate: '<?=$dateTime->format($format);?>'
    });
	document.querySelector('#duration').innerHTML = ' ('+ moment.duration(<?=$nextTime - $dateTime->getTimestamp();?>, 'seconds').format() + ' from selected date)';
</script>
</body>
</html>
