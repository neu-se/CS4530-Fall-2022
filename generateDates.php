<?php
// $daysOfWeek = array("Friday", "Tuesday");
$daysOfWeek = array("Weds", "Monday");
$firstDay = "9/6/2022";
$nWeeks = 14;
$calendarWeek = 1;
function t($n){
    return str_repeat(' ', $n*2);
}
print t(1)."'" . ($calendarWeek) . "':\n";
for ($w = 0; $w < $nWeeks; $w++) {
    $contentPerDay = count($daysOfWeek) == 2 ? 1 : 2;
    $c = 0;
    foreach ($daysOfWeek as $day) {
        $d = strtotime("next $day + $w weeks", strtotime($firstDay));
        print t(2). date("D", $d) . ":\n";
        print t(3).'date: ' . date("Y/m/d", $d) . "\n";
        if ($contentPerDay == 2) {
            print t(3).'content: [' . ($w + 1) . "a," . ($w + 1) . "b]\n";
        } else {
            if ($c == 0)
                print t(3).'content: ' . ($w + 1) . "a\n";
            else
                print t(3).'content: ' . ($w + 1) . "b\n";
        }
        $c++;
        if ($day == $daysOfWeek[0]) {
            $calendarWeek++;
            print t(1)."'" . ($calendarWeek) . "':\n";
        }
    }
}
