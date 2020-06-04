<?php

Route::group(['prefix' => 'admin'], function (){
    Route::get('/login', function(){
        return 'is login!';
    });
});
