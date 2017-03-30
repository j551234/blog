<?php
Event::listen('Illuminate\Database\Events\QueryExecuted', function ($query) {
    var_dump($query->sql);
    var_dump($query->bindings);
    var_dump($query->time);
});?>