<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\Teacher\TeacherController;
use App\Http\Middleware\AdminCheckMiddleware;
use App\Http\Middleware\StudentCheckMiddleware;
use App\Http\Middleware\TeacherCheckMiddleware;
use App\Mail\TeacherResponseMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/', function () {
    return view('welcome');
});

Route::get('sendMail', function () {
    $data = [
        'message' => "Hello this is testing mail",
    ];

    Mail::to('phwaythitsarkyaw61@gmail.com')->send(new TeacherResponseMail($data));
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {

        if (Auth::check()) {
            if (Auth::user()->role == 'admin') {
                return redirect()->route('adminDashboard');
            } else if (Auth::user()->role == 'teacher') {
                return redirect()->route('teacherCourse');
            } else if (Auth::user()->role == 'student') {
                return redirect()->route('studentCourseList');
            }
        }

    })->name('dashboard');
});

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => [AdminCheckMiddleware::class]], function () {

    //teacher
    Route::get('dashboard', [AdminController::class, 'teacherList'])->name('adminDashboard');
    Route::get('lookTeacherDetails/{teacher_id}', [AdminController::class, 'lookTeacherDetails'])->name('lookTeacherDetails');
    Route::get('downloadTeacherCSV', [AdminController::class, 'downloadTeacherCSV'])->name('downloadTeacherCSV');

    //student
    Route::get('studentList', [AdminController::class, 'studentList'])->name('studentList');
    Route::get('downloadStudentCSV', [AdminController::class, 'downloadStudentCSV'])->name('downloadStudentCSV');

    //notification
    Route::get('sendNotification', [AdminController::class, 'sendNotification'])->name('sendNotification');
    Route::post('sendNotification', [AdminController::class, 'sendNoti'])->name('sendNotification');

    //add Admin
    Route::get('addAdmin', [AdminController::class, 'addAdmin'])->name('addAdmin');
    Route::post('createAdminAccount', [AdminController::class, 'createAdminAccount'])->name('createAdminAccount');
    Route::get('adminAccountList', [AdminController::class, 'adminAccountList'])->name('adminAccountList');
    Route::get('deleteAdminAccount/{admin_id}', [AdminController::class, 'deleteAdminAccount'])->name('deleteAdminAccount');

});

Route::group(['prefix' => 'teacher', 'namace' => 'Teacher', 'middleware' => [TeacherCheckMiddleware::class]], function () {

    // Course
    Route::get('course', [TeacherController::class, 'courseInfo'])->name('teacherCourse');
    Route::get('courseList', [TeacherController::class, 'courseList'])->name('courseList');
    Route::post('createCourse', [TeacherController::class, 'createCourse'])->name('createCourse');
    Route::get('deleteCourse/{course_id}', [TeacherController::class, 'deleteCourse'])->name('deleteCourse');
    Route::get('updatePage/{course_id}', [TeacherController::class, 'updatePage'])->name('updatePage');
    Route::post('courseUpdate/{course_id}', [TeacherController::class, 'courseUpdate'])->name('courseUpdate');

    //Class
    Route::get('class', [TeacherController::class, 'classInfo'])->name('teacherClass');
    Route::post('createClass', [TeacherController::class, 'createClass'])->name('createClass');
    Route::get('classList', [TeacherController::class, 'classList'])->name('classList');
    Route::get('deleteClass/{class_id}', [TeacherController::class, 'deleteClass'])->name('deleteClass');
    Route::get('updateClassPage/{class_id}', [TeacherController::class, 'updateClassPage'])->name('updateClassPage');
    Route::post('updateClass/{class_id}', [TeacherController::class, 'updateClass'])->name('updateClass');

    Route::get('classStudent', [TeacherController::class, 'classStudentInfo'])->name('teacherClassStudent');
    Route::get('changeStatus,{class_student_id},{status}', [TeacherController::class, 'changeStatus'])->name('changeStatus');

    //Profile
    Route::get('profile', [TeacherController::class, 'profileInfo'])->name('teacherProfile');
    Route::post('updateProfile/{user_id}', [TeacherController::class, 'updateProfile'])->name('updateProfile');
    Route::get('changePassword', [TeacherController::class, 'changePasswordForm'])->name('changePassword');
    Route::post('changePassword', [TeacherController::class, 'changePassword'])->name('changePassword');

    Route::get('news', [TeacherController::class, 'courseRequestList'])->name('courseRequestList');
    Route::get('notification', [TeacherController::class, 'notificationInfo'])->name('teacherNotification');

});

Route::group(['prefix' => 'student', 'namespace' => 'Student', 'middleware' => [StudentCheckMiddleware::class]], function () {

    //course
    Route::get('courseList', [StudentController::class, 'index'])->name('studentCourseList');
    Route::get('lookCourse/{course_id}', [StudentController::class, 'lookCourse'])->name('lookCourse');
    Route::get('enrollClass/{class_id}/{teacher_id}', [StudentController::class, 'enrollClass'])->name('enrollClass');

    //class
    Route::get('classList', [StudentController::class, 'classList'])->name('classList');
    Route::get('lookClassInformation/{class_id}', [StudentController::class, 'lookClassInformation'])->name('lookClassInformation');

    //teacher
    Route::get('teacherList', [StudentController::class, 'teacherList'])->name('teacherList');
    Route::get('lookTeacheCourse/{teacher_id}', [StudentController::class, 'lookTeacherCourse'])->name('lookTeacherCourse');

    //profile
    Route::get('profile', [StudentController::class, 'profileInfo'])->name('studentProfile');
    Route::post('updateStudentProfile/{user_id}', [StudentController::class, 'updateStudentProfile'])->name('updateStudentProfile');
    Route::get('changePasswordStudent', [StudentController::class, 'changePasswordForm'])->name('changePasswordStudent');
    Route::post('changePasswordStudent', [StudentController::class, 'changePassword'])->name('changePasswordStudent');

    //course request
    Route::get('courseRequest', [StudentController::class, 'courseRequest'])->name('courseRequest');
    Route::post('requestCourse', [StudentController::class, 'requestCourse'])->name('requestCourse');

});
