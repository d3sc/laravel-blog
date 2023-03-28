<?php

//* file yang ada didalam routes digunakan sebagai tempat untuk mengatur url dalam sebuah website

//* Mengarahkan model class Post yang nantinya akan digunakan dibawah 

use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\AllPostController;
use App\Models\Post;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;

use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\DashboardPostsController;
use App\Http\Controllers\NewAdminController;
use App\Http\Controllers\BannedUserController;

//* menggunakan/menerapkan Controller pada MainController
//ini jika menggunakan controller, [namaController::class, 'namaMethod']

Route::get('/', [MainController::class, 'root']);

Route::get('/about', [MainController::class, 'about']);

Route::get('/posts', [PostController::class, 'index']);

//* Mengganti yang tadi defaultnya mencari id, diganti menjadi mencari tabel slug lalu akan mencocokan dengan nilai yang ada di url.
// post disitu hanya nama variable url yang nantinya akan terlempar ke PostController.
// cara menambahkan tabelnya adalah dengan cara :slug (slug bisa diganti nama tabel yang ingin di kondisikan).
//* {post:slug} , post adalah nama variable yang harus sama dengan parameter function pada PostController yang menangani route ini. (kalau beda nama variablenya antara route ini dan controller nya maka akan error)
Route::get('posts/{post:slug}', [PostController::class, 'show']);

Route::get('/categories', [CategoriesController::class, 'categories']);

Route::get('/authors', [AuthorController::class, 'authors']);

// Menggunakan middleware pada saat user mengunjungi route /login.
//* middleware guest adalah middleware yang mengatur route, dengan keadaan tertentu seperti user yang belum ter-authenticate.
//* jadi artinya middleware('guest'), kita menggunakan middleware dengan nama guest. lalu guna nya adalah jika kita ingin mengakses halaman login, hanya bisa diakses oleh user yang belum ter-authenticate/login.
//* dan untuk method name('login'). digunakan untuk memberikan nama pada route yang nanti akan digunakan oleh middleware auth, jika user belum ter-autentikasi dan dia akan diarahkan ke dalam route login. tetapi syaratnya,
//* kita harus memberi tahu route login itu dimana, dengan memberi nama login pada route /login jadi middleware auth nya tau kalau itu route yang bernama login. (liat dokumentasi laravel Named Routes)
Route::get('/login', [LoginController::class, "index"])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, "authenticate"]);
Route::post('/logout', [LoginController::class, "logout"]);

Route::get('/register', [RegisterController::class, "index"])->middleware('guest');
Route::post('/register', [RegisterController::class, "store"]);

//* jadi artinya middleware('auth'), kita menggunakan middleware dengan nama auth. lalu guna nya adalah jika kita ingin mengakses halaman dashboard, hanya bisa diakses oleh user yang sudah ter-authenticate/login.
Route::get('/dashboard', function () {
    return view('dashboard.index');
})->middleware(['auth', 'banned']);

// dilakukan untuk mengecekkan slug
Route::get('/dashboard/posts/checkSlug', [DashboardPostsController::class, 'checkSlug'])->middleware(['auth', 'banned']);
Route::resource('/dashboard/posts', DashboardPostsController::class)->middleware(['auth', 'banned']);

// Admin base
Route::resource('/dashboard/categories', AdminCategoryController::class)->except('show')->middleware(['auth', 'banned', 'admin']);
Route::get('/dashboard/categories/checkSlug', [AdminCategoryController::class, 'checkSlug'])->middleware(['auth', 'banned', 'admin']);

Route::get('/dashboard/allposts', [AllPostController::class, "index"])->middleware(['auth', 'banned', 'admin']);

Route::get('/dashboard/newadmin', [NewAdminController::class, "index"])->middleware(['auth', 'banned', 'admin']);
Route::put('/dashboard/newadmin/add', [NewAdminController::class, "store"])->middleware(['auth', 'banned', 'admin']);
Route::put('/dashboard/newadmin/delete', [NewAdminController::class, "delete"])->middleware(['auth', 'banned', 'admin']);

Route::get('/dashboard/banned-user', [BannedUserController::class, "index"])->middleware(['auth', 'banned', 'admin']);
Route::put('/dashboard/banned-user/add', [BannedUserController::class, "store"])->middleware(['auth', 'banned', 'admin']);
Route::put('/dashboard/banned-user/delete', [BannedUserController::class, "delete"])->middleware(['auth', 'banned', 'admin']);