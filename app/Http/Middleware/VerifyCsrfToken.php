<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        '/payment/success',
        '/school/student/restorestudent/*',
        '/school/student/Pdeletestudent/*',
        '/school/finance/feerestore/*',
        '/school/finance/feepdelete/*',
        '/school/finance/studentMontyFeerestore/*',
        '/school/finance/studentMonthlyFeepdelete/*',
        '/restorAdmission/*',
        '/pdeleteAdmission/*',
        '/school/booksTyperestore/*',
        '/school/booksType/P/Delete/*',
        '/school/books/restore/*',
        '/school/books/P/Delete/*',
        '/school/borrowe/restore/*',
        '/school/borrower/P/Delete/*',
        '/school/teacher/restoreteacher/',
        '/school/teacher/Pdeletestudent/*',
        '/school/finance/expenserestore/*',
        '/school/finance/expensepdelete/*',
        '/school/finance/fundrestore/*',
        '/school/finance/fundpdelete/*',
        '/school/staff/restorestaff/*',
        '/school/staff/PDelete/staff/*',
    ];

}
