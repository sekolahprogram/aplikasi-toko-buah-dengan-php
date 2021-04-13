<?php

/**
 * Nama: Febri Hidayan
 * Kelas: TI4c
 * Makul: Pemograman Web II
 * Tahun: 2021
 */

date_default_timezone_set("Asia/Jakarta");

function oldTime($time)
{
    return strtotime($time . ' + 5 minutes') >= time();
}
 
/**
 * Akan memberikan pesan galat
 */
function hasMessage($message = '')
{
    if (!empty($message)) {
        echo '<article class="message is-warning">
                <div class="message-body">
                    '. $message .'
                </div>
            </article>';
    }
}

/**
 * Akan mengkonversi nilai rupiah
 */
function money($number)
{
    return 'Rp' . number_format($number, 2, ',', '.');
}

/**
 * Memungkin data lama bisa ditampilkan kembali
 */
function old($var, $val = '')
{
    return $_POST[$var] ?? $val;
}

/**
 * Mengubah waktu dan tanggal
 */
function dateTime($now)
{
    return date('d F Y H:i:s', strtotime($now));
}

/**
 * Memberikan atribut Kg
 */
function kilo($amount)
{
    return "{$amount}Kg";
}


/**
 * Query Builder
 */
function runQuery($sql)
{
    global $conn;

    if ($conn->query($sql)) return true;
    else return false;
}

function insert($table, $fields)
{

    $columns = implode(',', array_keys($fields));

    $values = '';
    foreach ($fields as $value) {
        $values .= "'{$value}',";
    }

    $sql = sprintf("INSERT INTO %s(%s) VALUES(%s)", $table, $columns, substr($values, 0, -1));

    return runQuery($sql);
}

function update($table, $fields, $column, $id)
{
    $values = '';
    foreach ($fields as $key => $value) {
        $values .= "$key = '{$value}',";
    }

    $sql = sprintf("UPDATE %s SET %s WHERE %s = '%s'", $table, substr($values, 0, -1), $column, $id);

    return runQuery($sql);
}