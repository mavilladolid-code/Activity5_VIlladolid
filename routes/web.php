<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\studentcontroller;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/liststudent', [studentcontroller:: class, 'studentinfo']);
Route::get('/studentarray', [studentcontroller:: class, 'studentarray']);
Route::get('/studentwith', [studentcontroller:: class, 'studWith']);
Route::get('/studentcompact', [studentcontroller:: class, 'studcompact']);
Route::get('/masterlist', [studentcontroller:: class, 'studmasterlist'])->name('student.list');
route::post('/student/update/{index}', [studentcontroller::class, 'updatestudent'])->name('student.update');
Route::post('/student/add', [studentcontroller:: class, 'addstudent'])->name('add.student');
Route::get('/student/edit/{index}', [studentcontroller::class, 'editstudent'])->name('student.edit');
Route::delete('/student/delete/{index}', [studentcontroller::class, 'deletestudent'])->name('student.delete');