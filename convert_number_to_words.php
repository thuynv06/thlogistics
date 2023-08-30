<?php
function convert_number_to_words($number)
{
if (strpos($number, '.')) {//có phần lẻ thập phân
list($integer, $fraction) = explode(".", (string)$number);
} else { //không có phần lẻ
$integer = $number;
$fraction = NULL;
}

$output = "";

if ($integer[0] == "-") {
$output = "âm ";
$integer = ltrim($integer, "-");
} else if ($integer[0] == "+") {
$output = "dương ";
$integer = ltrim($integer, "+");
}

if ($integer[0] == "0") {
$output .= "không";
} else {
$integer = str_pad($integer, 36, "0", STR_PAD_LEFT);
$group = rtrim(chunk_split($integer, 3, " "), " ");
$groups = explode(" ", $group);

$groups2 = array();
foreach ($groups as $g) {
$groups2[] = convertThreeDigit($g[0], $g[1], $g[2]);
}

for ($z = 0; $z < count($groups2); $z++) {
if ($groups2[$z] != "") {
$output .= $groups2[$z] . convertGroup(11 - $z) . (
$z < 11
&& !array_search('', array_slice($groups2, $z + 1, -1))
&& $groups2[11] != ''
&& $groups[11][0] == '0'
? " "
: ", "
);
}
}

$output = rtrim($output, ", ");
}

if ($fraction > 0) {
$output .= " phẩy";
for ($i = 0; $i < strlen($fraction); $i++) {
$output .= " " . convertDigit($fraction[$i]);
}
}

return $output;
}

function convertGroup($index)
{
switch ($index) {
case 11:
return " decillion";
case 10:
return " nonillion";
case 9:
return " octillion";
case 8:
return " septillion";
case 7:
return " sextillion";
case 6:
return " quintrillion";
case 5:
return " Nghìn Triệu Triệu";
case 4:
return " Nghìn Tỷ";
case 3:
return " Tỷ";
case 2:
return " Triệu";
case 1:
return " Nghìn";
case 0:
return "";
}
}

function convertThreeDigit($digit1, $digit2, $digit3)
{
$buffer = "";

if ($digit1 == "0" && $digit2 == "0" && $digit3 == "0") {
return "";
}

if ($digit1 != "0") {
$buffer .= convertDigit($digit1) . " Trăm";
if ($digit2 != "0" || $digit3 != "0") {
$buffer .= " ";
}
}

if ($digit2 != "0") {
$buffer .= convertTwoDigit($digit2, $digit3);
} else if ($digit3 != "0") {
$buffer .= convertDigit($digit3);
}

return $buffer;
}

function convertTwoDigit($digit1, $digit2)
{
if ($digit2 == "0") {
switch ($digit1) {
case "1":
return "Mười ";
case "2":
return "Hai Mươi";
case "3":
return "Ba Mươi";
case "4":
return "Bốn Mươi";
case "5":
return "Năm Mươi";
case "6":
return "Sáu Mươi";
case "7":
return "Bảy Mươi";
case "8":
return "Tám Mươi";
case "9":
return "Chín Mươi";
}
} else if ($digit1 == "1") {
switch ($digit2) {
case "1":
return "Mười Một";
case "2":
return "Mười Hai";
case "3":
return "Mười Ba";
case "4":
return "Mười Bốn";
case "5":
return "Mười Lăm";
case "6":
return "Mười Sáu";
case "7":
return "Mười Bảy";
case "8":
return "Mười Tám";
case "9":
return "Mười Chín";
}
} else {
$temp = convertDigit($digit2);
if ($temp == 'năm') $temp = 'lăm';
if ($temp == 'một') $temp = 'mốt';
switch ($digit1) {
case "2":
return "Hai Mươi $temp";
case "3":
return "Ba Mươi $temp";
case "4":
return "Bốn Mươi $temp";
case "5":
return "Năm Mươi $temp";
case "6":
return "Sáu Mươi $temp";
case "7":
return "Bảy Mươi $temp";
case "8":
return "Tám Mươi $temp";
case "9":
return "Chín Mươi $temp";
}
}
}

function convertDigit($digit)
{
switch ($digit) {
case "0":
return "Không";
case "1":
return "Một";
case "2":
return "Hai";
case "3":
return "Ba";
case "4":
return "Bốn";
case "5":
return "Năm";
case "6":
return "Sáu";
case "7":
return "Bảy";
case "8":
return "Tám";
case "9":
return "Chín";
}
}

?>