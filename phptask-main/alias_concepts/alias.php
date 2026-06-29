<?php

function getColumnAlias() {
    return json_decode(file_get_contents("alias.json"), true);
}
function updateColumnAlias($newAlias) {
    file_put_contents("alias.json", json_encode($newAlias, JSON_PRETTY_PRINT));
}

function applyAlias($data) {

    $columnAlias = getColumnAlias();
    $final = [];

    foreach ($data as $key => $value) {
        $newKey = isset($columnAlias[$key]) ? $columnAlias[$key] : $key;
        $final[$newKey] = $value;
    }
    return $final;
}
?>
