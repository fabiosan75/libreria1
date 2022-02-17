#!/usr/local/bin/php
<?php

//$ignoreArray = array();

$ignoreArray = array('.', '..', '.git');
//print_r($argc);

$path = $argv[1]; //'./';

if (!is_dir($path)) {
    throw new Exception('Ruta directorio no valida');
}

$listFiles = listFolderFiles ($path,$ignoreArray);
print_r($listFiles);
/*
$files = scandir($path);
$files = array_diff(scandir($path), $ignoreArray);

foreach ($files as $file) {
    echo ("$file \n");
}
*/

/**
 * Method listFolderFiles
 * Obtiene el listado recursivo de directorios/arvhivos contenidos
 * en el $path especificado
 * 
 * @param string $path [Ruta a directorio]
 * @param array $ignoreArray [Lista de archivos a excluir ej : (. ..)]
 *
 * @return array
 */
function listFolderFiles(string $path,array $ignoreArray): array
{
    $arr = array();
    $ffs = scandir($path);

    $listFiles = array_diff($ffs, $ignoreArray);

    foreach ($listFiles as $ff) {
        // if($ff != '.' && $ff != '..') {
        $arr[$ff] = array();
        if (is_dir($path . '/' . $ff)) {
            $arr[$ff] = listFolderFiles($path . '/' . $ff,$ignoreArray);
        }
        // }
    }

    return $arr;
}
