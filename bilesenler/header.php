<?php
session_start();
ob_start();


function strReplace($string)
{
    $retVal = trim(strtoupper(str_replace(' ', '-', $string)));
    $retVal = str_replace(',', '', $retVal);
    $retVal = str_replace(';', '', $retVal);
    $retVal = str_replace('?', '', $retVal);
    $retVal = str_replace('-', '', $retVal);
    $retVal = str_replace('_', '', $retVal);
    $retVal = str_replace('<', '', $retVal);
    $retVal = str_replace('>', '', $retVal);
    $change = array(
        'İ' => 'i', 'I' => 'i', 'Ş' => 's', 'ş' => 's', 'Ğ' => 'G', 'ğ' => 'g',
        'Ü' => 'u', 'ü' => 'u', 'Ç' => 'c', 'ç' => 'c', 'Ö' => 'o', 'ö' => 'o',
    );
    $retVal = strtr($retVal, $change);
    return $retVal;
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Kamp Zamanı">
    <meta name="keywords" content="Kamp, kampçılık, seyahat, gezi, doğa, orman">
    <link rel="stylesheet" href="assets/css/deneme.css">