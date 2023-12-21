<?php
namespace App\Traits;

trait AdminPermission {
    public function checkRequestPermission()
    {
        return true;
        // if (
        //     empty(authUser()->permission['permission']['result']['list']) && \Route::is('result.teacher.create.show.all')
        // ) {
        //     return redirect()->route('teacher.dashboard');
        // }
    }
}
?>