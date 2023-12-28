<?php

use App\Http\Controllers\AdminPageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;


Route::group(['middleware' => 'auth:admin'], function () {
    Route::get('/', [AdminPageController::class, 'admin'])->name('admin');

    Route::prefix('contact-us')->group(function () {
        Route::get('/index',             [App\Http\Controllers\AdminPageController::class, 'contactusIndex'])->name('contactus.index');
        Route::get('/edit/{id}',         [App\Http\Controllers\AdminPageController::class, 'contactusEdit'])->name('contactus.edit');
        Route::post('/update/{id}',     [App\Http\Controllers\AdminPageController::class, 'contactusUpdate'])->name('contactus.update');
        Route::get('/destroy/{id}',     [App\Http\Controllers\AdminPageController::class, 'contactusDestroy'])->name('contactus.destroy');
    });

    Route::prefix('pricing')->group(function () {
        Route::get('/index',             [App\Http\Controllers\AdminPageController::class, 'pricingIndex'])->name('pricing.index');
        Route::get('/create',             [App\Http\Controllers\AdminPageController::class, 'pricingCreate'])->name('pricing.create');
        Route::post('/store',             [App\Http\Controllers\AdminPageController::class, 'pricingStore'])->name('pricing.store');
        Route::get('/edit/{id}',         [App\Http\Controllers\AdminPageController::class, 'pricingEdit'])->name('pricing.edit');
        Route::post('/update/{id}',     [App\Http\Controllers\AdminPageController::class, 'pricingUpdate'])->name('pricing.update');
        Route::get('/destroy/{id}',     [App\Http\Controllers\AdminPageController::class, 'pricingDestroy'])->name('pricing.destroy');
    });

    Route::prefix('tutorial')->group(function () {
        Route::get('/index',             [App\Http\Controllers\AdminPageController::class, 'tutorialIndex'])->name('tutorial.index');
        Route::get('/create',             [App\Http\Controllers\AdminPageController::class, 'tutorialCreate'])->name('tutorial.create');
        Route::post('/store',             [App\Http\Controllers\AdminPageController::class, 'tutorialStore'])->name('tutorial.store');
        Route::get('/edit/{id}',         [App\Http\Controllers\AdminPageController::class, 'tutorialEdit'])->name('tutorial.edit');
        Route::post('/update/{id}',     [App\Http\Controllers\AdminPageController::class, 'tutorialUpdate'])->name('tutorial.update');
        Route::get('/destroy/{id}',     [App\Http\Controllers\AdminPageController::class, 'tutorialDestroy'])->name('tutorial.destroy');
    });

    Route::prefix('message-package')->group(function () {
        Route::get('/index',             [App\Http\Controllers\AdminPageController::class, 'messagePackageIndex'])->name('messagePackage.index');
        Route::get('/create',             [App\Http\Controllers\AdminPageController::class, 'messagePackageCreate'])->name('messagePackage.create');
        Route::post('/store',             [App\Http\Controllers\AdminPageController::class, 'messagePackageStore'])->name('messagePackage.store');
        Route::get('/edit/{id}',         [App\Http\Controllers\AdminPageController::class, 'messagePackageEdit'])->name('messagePackage.edit');
        Route::post('/update/{id}',     [App\Http\Controllers\AdminPageController::class, 'messagePackageUpdate'])->name('messagePackage.update');
        Route::get('/destroy/{id}',     [App\Http\Controllers\AdminPageController::class, 'messagePackageDestroy'])->name('messagePackage.destroy');
    });

    Route::prefix('checkout-sell')->group(function () {
        Route::get('/all',             [App\Http\Controllers\AdminPageController::class, 'confirmMessagePaymentIndex'])->name('confirm.message.payment.index');
        Route::post('/message/{id}',     [App\Http\Controllers\AdminPageController::class, 'confirmMessagePayment'])->name('confirm.message.payment');
    });

    Route::prefix('school-payment')->group(function () {
        Route::get('/all',             [App\Http\Controllers\AdminPageController::class, 'showallSchoolForPayment'])->name('show.all.School.ForPayment');
        Route::get('/details/{id}', [App\Http\Controllers\AdminPageController::class, 'showallSchoolForPaymentDetails'])->name('show.all.School.ForPayment.Details');
        Route::get('/details/send/{id}', [App\Http\Controllers\AdminPageController::class, 'showallSchoolForPaymentSendDetails'])->name('show.all.School.ForPayment.send.checkout');
        Route::post('checkout/school/fess/update/{id}', [App\Http\Controllers\AdminPageController::class, 'checkoutSchoolFessUpdate'])->name('checkout.schoolFess.update');
        Route::post('checkout/school/checkout/update/{id}', [App\Http\Controllers\AdminPageController::class, 'checkoutSchoolCheckoutUpdate'])->name('checkout.schoolCheckout.update');
    });

    Route::prefix('school')->group(function () {
        Route::get('/all',             [App\Http\Controllers\AdminPageController::class, 'showAllSchool'])->name('show.all.School');
        Route::post('/status/update/{id}', [App\Http\Controllers\AdminPageController::class, 'SchoolStatusUpdate'])->name('status.school.update');
    });

    Route::prefix('feature-page')->group(function () {
        Route::get('/create', [App\Http\Controllers\AdminPageController::class, 'featurePageCreate'])->name('featurePage.create');
        Route::post('/store', [App\Http\Controllers\AdminPageController::class, 'featurePageStore'])->name('featurePage.store');
        Route::post('/store/details', [App\Http\Controllers\AdminPageController::class, 'featureDetailsPageStore'])->name('featureDetailsPage.store');
        Route::get('/edit/{id}', [App\Http\Controllers\AdminPageController::class, 'featurePageEdit'])->name('featurePage.edit');
        Route::post('/update/{id}', [App\Http\Controllers\AdminPageController::class, 'featurePageUpdate'])->name('featurePage.update');
        Route::get('/destroy/{id}', [App\Http\Controllers\AdminPageController::class, 'featurePageDestroy'])->name('featurePage.destroy');
        Route::get('/index', [App\Http\Controllers\AdminPageController::class, 'featurePageIndex'])->name('featurePage.index');

        Route::get('/details/create',   [App\Http\Controllers\AdminPageController::class, 'featureDetailsInput'])->name('featurePage.details.input');
    });

    Route::get('/school/activity', [AdminPageController::class, 'school_activity'])->name('school.activity');
    Route::get('/setting/under/maintainnace', [App\Http\Controllers\AdminPageController::class, 'showMaintainance'])->name('under.maintenance.show');
    Route::get('/maintenance-mode', [App\Http\Controllers\AdminPageController::class, 'setMaintenanceMode'])->name('admin.maintenance.set');
    Route::get('/maintenance-mode/up', [App\Http\Controllers\AdminPageController::class, 'resetsetMaintenanceMode'])->name('admin.maintenance.reset');
});

Route::middleware('auth:admin')
->group(function () {

    Route::get('schools/view', [App\Http\Controllers\AdminPageController::class, 'school_view'])->name('Schools.list');

    Route::get('/SchoolListsearch', [AdminPageController::class, 'SchoolListsearch'])->name('SchoolListsearch');
    Route::get('/SchoolRegisterPage', [App\Http\Controllers\AdminPageController::class, 'SchoolRegisterPage'])->name('SchoolRegisterPage');

    Route::post('school/Register', [AdminPageController::class, 'school_Register'])->name('Schools.Register');
    Route::get('school/SingleView/{id}', [AdminPageController::class, 'school_SingleView'])->name('School.SingleView');
    Route::get('school/edit/{id}', [AdminPageController::class, 'school_edit'])->name('School.edit');
    Route::put('school/update/{id}', [AdminPageController::class, 'school_update'])->name('School.update');

    Route::get('changestatus/{id}', [AdminPageController::class, 'changestatus'])->name('changestatus');

    Route::get('AppReleased', [AdminPageController::class, 'AppReleased'])->name('AppReleased');
    Route::post('AppReleased/store', [AdminPageController::class, 'AppReleased_store'])->name('AppReleased.store');
    Route::get('AppReleased/List', [AdminPageController::class, 'AppReleased_List'])->name('AppReleased.List');
    Route::get('AppReleased/Delete/{id}', [AdminPageController::class, 'AppReleased_Delete'])->name('AppReleased.Delete');
    Route::get('AppReleased/Edit/{id}', [AdminPageController::class, 'AppReleased_Edit'])->name('AppReleased.Edit');
    Route::put('AppReleased/Update/{id}', [AdminPageController::class, 'AppReleased_Update'])->name('AppReleased.Update');

    //Addon in admin panel
    Route::get('AddonList', [AdminPageController::class, 'AddonList'])->name('AddonList');
    Route::get('supportDepartment/delete/{id}', [TicketController::class, 'supportDeptDel'])->name('support.dept.delete');

    Route::get('supportDepartment/create', [TicketController::class, 'supportDCreate'])->name('support.create');
    Route::post('supportDepartment/create/post', [TicketController::class, 'supportDCreatePost'])->name('support.create.post');

    Route::get('Blog/List', [AdminPageController::class, 'blogList'])->name('bloglist');
    Route::get('Blog/Create', [AdminPageController::class, 'blogCreate'])->name('blog.create');
    Route::get('Blog/edit/{id}', [AdminPageController::class, 'blogedit'])->name('blog.edit');
    Route::post('Blog/update/{id}', [AdminPageController::class, 'blogeditpost'])->name('blog.edit.post');
    Route::get('Blog/delete{id}', [AdminPageController::class, 'blogdelete'])->name('blog.delete');

    Route::post('Blog/Create/post', [AdminPageController::class, 'blogCreatepost'])->name('blog.create.post');
    Route::get('Addonform', [AdminPageController::class, 'Addon_form'])->name('Addon.form');
    Route::post('Addon/create', [AdminPageController::class, 'Addon_create'])->name('Addon.create');
    Route::get('Addon/Edit/{id}', [AdminPageController::class, 'Addon_Edit'])->name('Addon.Edit');
    Route::put('Addon/Update/{id}', [AdminPageController::class, 'Addon_Update'])->name('Addon.Update');
    Route::get('Addon/Delete/{id}', [AdminPageController::class, 'Addon_Delete'])->name('Addon.Delete');
    Route::get('Addon/status/{id}', [AdminPageController::class, 'Addon_status'])->name('Addon.status');
    Route::get('Addon/purchase/status/{id}', [AdminPageController::class, 'Addon_purchase_status'])->name('addon.purchase.status');

    //billing add
    Route::get('billing/index', [AdminPageController::class, 'billing_index'])->name('');
    Route::get('billing/page/{id}', [AdminPageController::class, 'billing_page'])->name('billing.page');
    Route::post('billing/store', [AdminPageController::class, 'billing_store'])->name('billing.store');
    Route::get('billing/status/{id}', [AdminPageController::class, 'billing_status'])->name('billing.status');

    // SEO 
    Route::get('SEO/Tools', [AdminPageController::class, 'SEO_Tool_List'])->name('seo.tool');
    Route::get('SEO/Form', [AdminPageController::class, 'SEO_form'])->name('SEO.form');
    Route::post('SEO/create', [AdminPageController::class, 'SEO_create'])->name('SEO.create');
    Route::get('SEO/Edit/{id}', [AdminPageController::class, 'SEO_Edit'])->name('SEO.Edit');
    Route::put('SEO/Update/{id}', [AdminPageController::class, 'SEO_Update'])->name('SEO.Update');
    Route::get('SEO/Delete/{id}', [AdminPageController::class, 'SEO_Delete'])->name('SEO.Delete');


    Route::get('/ticket/list/admin', [App\Http\Controllers\TicketController::class, 'adminticketmessagelist'])->name('ticketmessage.list.admin');
    Route::get('/ticket/reply/admin/{id?}', [App\Http\Controllers\TicketController::class, 'adminticketreply'])->name('ticket.reply.admin');
    Route::post('/ticket/reply/post/admin/{id?}', [App\Http\Controllers\TicketController::class, 'adminticketreplyPost'])->name('ticket.reply.post.admin');
    Route::get('/ticket/delete/admin/{id}', [App\Http\Controllers\TicketController::class, 'ticketDelete'])->name('ticket.delete');
    Route::get('/ticket/delete/admin/{id}', [App\Http\Controllers\TicketController::class, 'ticketDeleteAdmin'])->name('ticket.delete.admin');
    Route::get('/ticket/message/show/admin/{id}', [TicketController::class, 'ticketmessageshowadmin'])->name('ticketmessage.show.admin');

    //Subscription 
    Route::get('school/subscription/status/{id}', [AdminPageController::class, 'subscription_status'])->name('subscription.status');

    //testimonial image
    Route::get('testimonial/imagelist', [AdminPageController::class, 'testimonial_imagelist'])->name('testimonial.imagelist');
    Route::post('testimonial/imgstore', [AdminPageController::class, 'testimonial_imgstore'])->name('testimonial.imgstore');
    Route::get('testimonial/imgdelete/{id}', [AdminPageController::class, 'testimonial_imgdelete'])->name('testimonial.imgdelete');


    //Log Activity
    Route::get('add-to-log', [AdminPageController::class, 'data_addToLog']);
    Route::get('logActivity', [AdminPageController::class, ' log_ActivityLists']);  
    Route::get('/school/activity', [AdminPageController::class, 'school_activity'])->name('school.activity');

    //Feature list Activity
    Route::get('featurestatus/{id}', [AdminPageController::class,'feature_status'])->name('feature.status');  

    /** ----------- Chart of admin  (LIZA)
 * ================================================================*/

    Route::get("/single/Chart/yesterday/{id}", [AdminPageController::class, 'school_ChartYesterday'])->name('school.Chart.Yesterday');
    Route::get("/single/Chart/Lastweek/{id}", [AdminPageController::class, 'school_ChartLastweek'])->name('school.Chart.Lastweek');
    Route::get("/single/Chart/Lastmonth/{id}", [AdminPageController::class, 'school_ChartLastmonth'])->name('school.Chart.Lastmonth');
    Route::get("/single/Chart/Sixmonth/{id}", [AdminPageController::class, 'school_ChartSixmonth'])->name('school.Chart.Sixmonth');
    Route::get("/single/Chart/ThisYear/{id}", [AdminPageController::class, 'school_ChartThisYear'])->name('school.Chart.ThisYear');
    Route::get("/single/Chart/Total/{id}", [AdminPageController::class, 'school_ChartTotal'])->name('school.Chart.Total');


});
