<?php

Route::get('/mwp', function () {
    $json = '[{"id":1,"name":"Create Any Member","checked":false},{"id":2,"name":"Edit Any Member","checked":false},{"id":3,"name":"View Any Member","checked":true},{"id":4,"name":"Deactivate Any Member","checked":true},{"id":5,"name":"Create Coven Member","checked":true},{"id":6,"name":"Edit Coven Member","checked":true},{"id":7,"name":"View Coven Member","checked":true},{"id":8,"name":"Deactivate Coven Member","checked":true},{"id":9,"name":"Imprison Wrongdoers","checked":false},{"id":10,"name":"Make Breakfast","checked":false}]';

    $fromEditor = json_decode($json);

    $fromEditor = collect($fromEditor);
    !d($fromEditor);
});
