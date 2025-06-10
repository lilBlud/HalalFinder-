use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\AdminController;

// Authentication Routes
Auth::routes();

// Guest Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search', [RestaurantController::class, 'index'])->name('search');

// User Routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::prefix('user')->group(function () {
        Route::get('/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
        Route::get('/favorites', [UserController::class, 'favorites'])->name('user.favorites');
        Route::post('/favorites/{restaurant}', [UserController::class, 'toggleFavorite'])->name('user.toggleFavorite');
        Route::resource('reviews', ReviewController::class)->only(['store', 'update', 'destroy']);
    });
});

// Restaurant Owner Routes
Route::middleware(['auth', 'verified', 'restaurant.owner'])->prefix('restaurant')->group(function () {
    Route::get('/dashboard', [RestaurantController::class, 'dashboard'])->name('restaurant.dashboard');
    Route::resource('profile', RestaurantController::class)->except(['show', 'destroy']);
    Route::resource('certifications', CertificationController::class);
    Route::resource('menu', ProductController::class);
});

// Admin Routes
Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::resource('restaurants', AdminController::class)->only(['index', 'show', 'update']);
    Route::resource('certifications', AdminController::class)->only(['index', 'update']);
    Route::resource('users', AdminController::class)->only(['index', 'update']);
});