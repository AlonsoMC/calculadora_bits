<?php
define('BITS_IN_BYTE', 8);

$units = [
    [    'bits',     'bytes'], // 0
    ['kilobits', 'kilobytes'], // 1
    ['megabits', 'megabytes'], // 2
    ['gigabits', 'gigabytes'], // 3
    ['terabits', 'terabytes'], // 4
    ['petabits', 'petabytes']  // 5
];

$calc = new stdClass();
$calc->value = $_GET['value'];
$calc->notation = $_GET['notation'];
$calc->units = json_decode($_GET['units']);

$bits = $calc->value * pow($calc->notation, $calc->units->group) * (($calc->units->unit == 1) ? BITS_IN_BYTE : 1);

echo "<table border=1><thead><tr><th>UNIDAD</th><th>VALOR</th></tr></thead>";
echo "<tbody>";
echo "<tr><td>{$units[0][0]}</td><td>$bits</td></tr>";

foreach($units as $k => $v) {
    if($v[0] != $units[0][0]) {
        echo "<tr><td>$v[0]</td><td>" . $bits/$calc->notation . "</td></tr>";
        $bits /= $calc->notation;
    }
    echo "<tr><td>$v[1]</td><td>" . $bits/BITS_IN_BYTE . "</td></tr>";
}

echo "</tbody></table>";
?>