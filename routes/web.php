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

Route::get('/checkout/{store:slug}', function (Store $store) {
    return Inertia::render('StoreFront/Checkout', compact('store'));
})->name('front.checkout');

Route::post('/order/store', function () {
    // request()->validate([
    //     'store_id' => 'required',
    //     'products.*.id' => 'required',
    //     'products.*.qty' => 'required',
    // ]);

    $order = request('id') ? Order::find(request('id')) : Order::create(request()->all());

    $order->products()->attach(request('products'));

    $order->save();
    dd($order);
    return redirect()->route('front.success', [ $order->id ]);
})->name('order.store');

Route::get('/success/{order_id}', function (Order $order) {
    return Inertia::render('StoreFront/Success', [
        'order' => $order,
    ]);
})->name('front.success');

Route::get('/{store:slug}/{category_slug?}', function (Store $store, $category_slug = null) {
    request()->merge([ 'store_id' => $store->id ]);

    $products = !$category_slug ? Product::all() : Product::whereHas('categories',
        fn ($q) => $q->where('slug', $category_slug)
    )->get();

    return Inertia::render('StoreFront/Index', compact('store', 'products'));
})->name('front');


