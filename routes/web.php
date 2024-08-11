<?php

use App\Livewire\ShowFaq;
use App\Livewire\ShowBlog;
use App\Livewire\ShowHome;
use App\Livewire\ShowPage;
use App\Livewire\ShowBlogs;
use App\Livewire\ShowMember;
use App\Livewire\ShowAboutUs;
use App\Livewire\ShowService;
use App\Livewire\ShowServices;
use App\Livewire\ShowContactUs;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',ShowHome::class)->name('home');
Route::get('services',ShowServices::class)->name('services');
Route::get('service/{id}',ShowService::class)->name('service');
Route::get('members',ShowMember::class)->name('members');
Route::get('faqs',ShowFaq::class)->name('faqs');
Route::get('blogs',ShowBlogs::class)->name('blogs');
Route::get('blog/{slug}',ShowBlog::class)->name('blog');
Route::get('about',ShowAboutUs::class)->name('about');
Route::get('contact',ShowContactUs::class)->name('contact-us');
Route::get('{slug}',ShowPage::class)->name('page');
