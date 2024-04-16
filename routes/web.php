<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Models\Store;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\User;

use Illuminate\Support\Facades\Log;




Route::get('/', function () {

    return to_route('register');
    // return Inertia::render('Welcome', [
    //     'canLogin' => Route::has('login'),
    //     'canRegister' => Route::has('register'),
    //     'laravelVersion' => Application::VERSION,
    //     'phpVersion' => PHP_VERSION,
    // ]);
});

Route::middleware('auth:admin,stores')->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard', [
            'ordersCount' => Order::where('status', '!=', 'declined')->count(),
            'productsCount' => Product::count(),
            'totalByDate' => Order::select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(total) as total'), DB::raw('COUNT(id) as amount'))
                ->groupBy(DB::raw('DATE(created_at)'))
                ->orderBy('date')
                ->get()
        ]);
    })->name('dashboard');

    Route::get('/orders', function () {
        return Inertia::render('Store/Order/Index', [
            'orders' => Order::orderBy('created_at', 'desc')->get(),
        ]);
    })->name('orders.index');

    Route::get('/products', function () {
        return Inertia::render('Store/Product/Index', [
            'products' => Product::with('categories')->orderBy('created_at', 'desc')->get(),
        ]);
    })->name('products.index');

    Route::get('/category', fn () => Inertia::render('Store/Category/Index', [
        //'categories' => Category::all(),
        'save_category' => route('category.store'),
    ]))->name('category.index');

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

});

Route::middleware(['auth:admin'])->group(function () {
    Route::get('/stores', fn () => inertia('Store/Index'))->name('stores.index');

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

    Route::get('/users', fn() => inertia('Admins', ['users' => User::all()]))->name('users.index');

    Route::post('/users/store', [RegisteredUserController::class, 'store'])->name('user.store');

    Route::get('/store/emulate/{store_id?}', function ($store_id = null) {

        $store_id ? session(['store_id' => intval($store_id)]) : session()->forget('store_id');
        return to_route('dashboard');
    })->name('store.emulate');

});

Route::get('/stores/create', function () {
    return Inertia::render('Stores/Create');
})->name('stores.create');

Route::get('/stores/{store}', function (Store $store) {
    return Inertia::render('Stores/Show', [
        'store' => $store,
    ]);
})->name('stores.show');

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

    $order->fill(request()->all());
    $order->save();

    request('products') && $order->products()->attach(array_combine(
        array_column(request('products'), 'id'),
        array_reduce(request('products'), fn ($carry, $item) => $carry = [ ...$carry, [ 'qty' => $item['qty']] ], [])
    ));

    return redirect()->route('front.success', [ $order->id ]);
})->name('order.store');

Route::get('/success/{order}', function (Order $order) {
    return Inertia::render('StoreFront/Success', [
        'order' => $order,
        'store' => $order->store,
    ]);
})->name('front.success');

Route::get('/{store:slug}/{category_slug?}', function (Store $store, $category_slug = null) {
    if (!$store->is_active) return to_route('register');
    session([ 'store_id' => $store->id ]);

    $products = !$category_slug ? Product::latest()->get() : Product::whereHas('categories',
        fn ($q) => $q->where('slug', $category_slug)
    )->latest()->get();

    return Inertia::render('StoreFront/Index', compact('store', 'products'));
})->name('front');


