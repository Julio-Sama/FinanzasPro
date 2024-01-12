<?php

use App\Http\Controllers\VentaController;
use App\Http\Livewire\Calendar;
use App\Http\Livewire\Calendar2;
use App\Http\Livewire\FormAdvanced;
use App\Http\Livewire\FormEditor;
use App\Http\Livewire\FormElements;
use App\Http\Livewire\FormLayouts;
use App\Http\Livewire\FormValidation;
use App\Http\Livewire\FormWizard;
use Illuminate\Support\Facades\Route;

use App\Http\Livewire\Index;


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


use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ActivoController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\TipoController;

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

/* Rutas para el login */
Route::view('/login', 'login')->name('login');
Route::view('/registro', 'register')->name('registro');

Route::post('/validar-registro', [LoginController::class, 'register'])->name('validar-registro');
Route::post('/iniciar-sesion', [LoginController::class, 'login'])->name('iniciar-sesion');
Route::get('/cerrar-sesion', [LoginController::class, 'logout'])->name('cerrar-sesion');

/* Rutas para el dashboard */
Route::get('/', Index::class);
Route::get('index', Index::class);

Route::resource('clientes', ClienteController::class);

Route::resource('proveedores', ProveedorController::class);

Route::resource('categorias', CategoriaController::class);

Route::resource('productos', ProductoController::class);

Route::resource('compras', CompraController::class);

Route::resource('ventas', VentaController::class);

Route::resource('tipos', TipoController::class); // Tipo de activo
Route::resource('activos', ActivoController::class); // Activo
// Route::get('roles', RolController::class); // Rol


// Kardex
Route::get('kardex', [ProductoController::class, 'kardex'])->name('kardex.index');


//Route::get('/', Index::class);
//Route::get('index', Index::class);
//Route::get('index2', Index2::class);
//Route::get('index3', Index3::class);
//Route::get('index4', Index4::class);
//Route::get('index5', Index5::class);
//Route::get('about', About::class);
//Route::get('accordion', Accordion::class);
//Route::get('add-product', AddProduct::class);
//Route::get('alerts', Alerts::class);
//Route::get('avatar-radius', AvatarRadius::class);
//Route::get('avatar-round', AvatarRound::class);
//Route::get('avatar-square', AvatarSquare::class);
//Route::get('badge', Badge::class);
//Route::get('blog', Blog::class);
//Route::get('blog-details', BlogDetails::class);
//Route::get('blog-post', BlogPost::class);
//Route::get('breadcrumbs', Breadcrumbs::class);
//Route::get('buttons', Buttons::class);
Route::get('calendar', Calendar::class);
Route::get('calendar2', Calendar2::class);
//Route::get('cards', Cards::class);
//Route::get('carousel', Carousel::class);
//Route::get('cart', Cart::class);
//Route::get('chart-chartist', ChartChartist::class);
//Route::get('chart-echart', ChartEchart::class);
//Route::get('chart-flot', ChartFlot::class);
//Route::get('chart-morris', ChartMorris::class);
//Route::get('chart-nvd3', ChartNvd3::class);
//Route::get('chat', Chat::class);
//Route::get('checkout', Checkout::class);
//Route::get('colors', Colors::class);
//Route::get('construction', Construction::class);
//Route::get('counters', Counters::class);
//Route::get('crypto-currencies', CryptoCurrencies::class);
//Route::get('datatable', Datatable::class);
//Route::get('dropdown', Dropdown::class);
//Route::get('email-compose', EmailCompose::class);
//Route::get('email-inbox', EmailInbox::class);
//Route::get('email-read', EmailRead::class);
//Route::get('empty-page', EmptyPage::class);
//Route::get('error400', Error400::class);
//Route::get('error401', Error401::class);
//Route::get('error403', Error403::class);
//Route::get('error404', Error404::class);
//Route::get('error500', Error500::class);
//Route::get('error503', Error503::class);
//Route::get('faq', Faq::class);
//Route::get('file-attachments', FileAttachments::class);
//Route::get('filemanager-details', FilemanagerDetails::class);
//Route::get('filemanager-list', FilemanagerList::class);
//Route::get('filemanager', Filemanager::class);
//Route::get('footers', Footers::class);
//Route::get('forgot-password', ForgotPassword::class);
Route::get('form-advanced', FormAdvanced::class);
Route::get('form-editor', FormEditor::class);
Route::get('form-elements', FormElements::class);
Route::get('form-layouts', FormLayouts::class);
Route::get('form-validation', FormValidation::class);
Route::get('form-wizard', FormWizard::class);
//Route::get('gallery', Gallery::class);
//Route::get('icons', Icons::class);
//Route::get('icons2', Icons2::class);
//Route::get('icons3', Icons3::class);
//Route::get('icons4', Icons4::class);
//Route::get('icons5', Icons5::class);
//Route::get('icons6', Icons6::class);
//Route::get('icons7', Icons7::class);
//Route::get('icons8', Icons8::class);
//Route::get('icons9', Icons9::class);
//Route::get('icons10', Icons10::class);
//Route::get('icons11', Icons11::class);
//Route::get('invoice', Invoice::class);
//Route::get('listgroup', Listgroup::class);
//Route::get('loaders', Loaders::class);
//Route::get('lockscreen', Lockscreen::class);
//Route::get('login', Login::class);
//Route::get('maps', Maps::class);
//Route::get('maps1', Maps1::class);
//Route::get('maps2', Maps2::class);
//Route::get('mediaobject', Mediaobject::class);
//Route::get('modal', Modal::class);
//Route::get('navigation', Navigation::class);
//Route::get('notify', Notify::class);
//Route::get('notify-list', NotifyList::class);
//Route::get('offcanvas', Offcanvas::class);
//Route::get('pagination', Pagination::class);
//Route::get('pricing', Pricing::class);
//Route::get('product-details', ProductDetails::class);
//Route::get('profile', Profile::class);
//Route::get('progress', Progress::class);
//Route::get('rangeslider', Rangeslider::class);
//Route::get('rating', Rating::class);
//Route::get('register', Register::class);
//Route::get('scroll', Scroll::class);
//Route::get('scrollspy', Scrollspy::class);
//Route::get('search', Search::class);
//Route::get('services', Services::class);
//Route::get('settings', Settings::class);
//Route::get('shop', Shop::class);
//Route::get('sweetalert', Sweetalert::class);
//Route::get('switcher', Switcher::class);
//Route::get('tables', Tables::class);
//Route::get('tabs', Tabs::class);
//Route::get('tags', Tags::class);
//Route::get('terms', Terms::class);
//Route::get('thumbnails', Thumbnails::class);
//Route::get('time-line', TimeLine::class);
//Route::get('toast', Toast::class);
//Route::get('tooltipandpopover', Tooltipandpopover::class);
//Route::get('treeview', Treeview::class);
//Route::get('typography', Typography::class);
//Route::get('users-list', UsersList::class);
//Route::get('widgets', Widgets::class);
//Route::get('wishlist', Wishlist::class);
