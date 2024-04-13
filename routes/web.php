<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Models\Store;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
        'stores' => Store::all(),
        'products' => Product::all(),
        'categories' => Category::all(),
        'orders' => Order::all(),
    ]);
});

Route::middleware('auth:admin,stores')->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::get('/products/index', function () {
        return Inertia::render('Store/Product/Index', [
            'products' => Product::with('categories')->get(),
        ]);
    })->name('products.index');

    Route::get('/category/index', fn () => Inertia::render('Store/Category/Index', [
        //'categories' => Category::all(),
        'save_category' => route('category.store'),
    ]))->name('category.index');


});


Route::get('/stores', function () {
    return Inertia::render('Store/Index', [
        //'stores' => Store::all(),
    ]);
})->middleware('auth:admin')->name('stores.index');

Route::post('/stores', function () {
    // request()->validate([
    //     'name' => 'required',
    // ]);
    if (request('id')) {
        $store = Store::find(request('id'));
        $store->fill(request()->all());
        $store->save();
    } else {
        //Store::create(request()->all());
    }
    return redirect()->route('stores.index');
})->name('stores.store');

Route::get('/stores/create', function () {
    return Inertia::render('Stores/Create');
})->name('stores.create');

Route::get('/stores/{store}', function (Store $store) {
    return Inertia::render('Stores/Show', [
        'store' => $store,
    ]);
})->name('stores.show');




Route::post('/products/store', function () {
    request()->validate([
        'name' => 'required',
        'price' => 'required',
    ]);

    if (request('id')) {
        $product = Product::find(request('id'));
        $product->fill(request()->all());
        $product->save();
    } else {
        $product = Product::create(request()->all());
    }

    if (request('categories')) {
        $product->categories()->sync(array_column(request('categories'), 'id'));
    }

    return redirect()->route('products.index');
})->name('products.store');


Route::post('/category/store', function () {
    request()->validate([
        'name' => 'required',
    ]);

    if (request('id')) {
        $category = Category::find(request('id'));
        $category->attributes = request()->all();
        $category->save();
    } else {
        Category::create(request()->all());
    }

    return redirect()->route('category.index');
})->name('category.store');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
