<?php

use App\Http\Controllers\ChildrenController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MembersController;
use App\Models\Children;
use App\Models\Members;
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
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [MembersController::class, 'Login'])->name('adminLogin');

/*ADMIN ROUTES*/
Route::get('/registerAdmin',[MembersController::class,'registerAdmin'])->name('registerAdmin');
Route::post('/addAdmin', [MembersController::class,'addAdmin'])->name('addAdmin');

/*MIXED ROUTES*/
Route::get('/search', [MembersController::class,'search'])->name('search');
Route::post('/search-members', [MembersController::class,'searchMembers'])->name('searchMembers');

/*MEMBERS ROUTES*/
Route::get('/members', [MembersController::class,'index'])->name('members');
Route::get('/members/{id}', [MembersController::class,'memberDetails'])->name('memberDetails');
Route::get('/getMembersNames', [MembersController::class,'getMembersNames'])->name('getMembersNames');
Route::get('/registerMembers', [MembersController::class,'registerMember'])->name('registerMember');
Route::post('/addMember', [MembersController::class,'addMember'])->name('addMember');
Route::get('/editMember/{id}', [MembersController::class,'editMember'])->name('editMember');
Route::put('/updateMember/{id}', [MembersController::class,'updateMember'])->name('updateMember');
Route::delete('/deleteMember/{id}',[MembersController::class,'deleteMember'])->name('deleteMember');
Route::get('/searchedMember/{id}', [MembersController::class,'searchedMember'])->name('searchedMember');

/*CHILDREN ROUTES*/
Route::get('/children', [ChildrenController::class,'index'])->name('children');
Route::get('/children/{id}', [ChildrenController::class,'childDetails'])->name('childDetails');
Route::get('/registerChildren', [ChildrenController::class,'registerChild'])->name('registerChild');
Route::post('/addChild', [ChildrenController::class,'addChild'])->name('addChild');
Route::get('/editChild/{id}', [ChildrenController::class,'editChild'])->name('editChild');
Route::put('/updateChild/{id}', [ChildrenController::class,'updateChild'])->name('updateChild');
Route::delete('/deleteChild/{id}',[ChildrenController::class,'deleteChild'])->name('deleteChild');
Route::get('/searchedChild/{id}', [ChildrenController::class,'searchedChild'])->name('searchedChild');
