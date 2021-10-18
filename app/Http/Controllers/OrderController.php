<?php

namespace App\Http\Controllers;

use App\Events\SendInvoicePDF;
use App\Models\Address;
use App\Models\Category;
use App\Models\City;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\StockLowEvent;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Customer $customer, Employee $employee, Address $address, Product $products, Request $request)
    {
        if (!empty(Auth::user()->employees->first())) {
            $employee = Auth::user()->employees->first();
        } elseif (!empty(Auth::user()->customers->first())) {
            $customer = Auth::user()->customers->first();
        } else {
            return 0;
        }

        $addressEmployee = '';
        $address = $customer->address->first();
        if (isset($employee->company->address)) {
            $addressEmployee = $employee->company->address->first();
        }


        $rows = Cart::content();
        if (!empty($request->code)) {
            $str = substr($request->code, -2);
            $reduction = intval($str, 10);
        }

        $totals = [];
        foreach ($rows as $row) {
            $totals[] += $row->price * $row->qty;
        }

        $paymentMethod = ['Visa', 'MasterCard', 'Paypal', '4 fois sans frais'];
        $priceWithReduction = number_format(array_sum($totals) * (1 + (19.6 / 100)) * (1 - ($reduction / 100)), 2, '.', '');

        $categoriesParent = Category::where('parent_id', null)->get();
        return view('orders.create', compact('address', 'employee', 'addressEmployee', 'customer', 'products', 'categoriesParent', 'rows', 'reduction', 'priceWithReduction', 'paymentMethod'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $returnSuccess = redirect()->route('index')->with('success', 'Votre commande à bien été prise en compte');
        $returnError = redirect()->route('index')->with('error', 'Votre commande n\'a pas été vaildée');
        //customer?
        $customer = Auth::user()->customers->first();

        if (Auth::user()->customers === null) {
            if ($customer->type === 'particulier') {
                $amount =  'totalité';
            } else {
                $amount = 'paiement différé';
            }
        } else {
            $amount = 'totalité';
        }

        $payDate = $amount === 'totalité' ? Carbon::now() : '';

        $validator = Validator::make($request->all(), [
            'paymentMethod' => ['required', Rule::notIn(['--Choisissez une méthode de paiement--'])],
        ]);

        if ($validator->fails()) {
            //clear success message before redirect to index to avoid double message
            Session::forget(['success']);
            return $returnError;
        }

        $order = Order::create([
            'quantity_total' => Cart::count(),
            'discount' => $request->reduction,
            'extra_discount' => null,
            'tax' => 19.6,
            'amount_paid' => $amount,
            'payment_method' => $request->paymentMethod,
            'payment_date' =>  $payDate,
            'shipping_status' => 'En préparation',
            'shipping_date' => null,
        ]);

        /**
         * Association commande/produit et mise à jour stock
         */
        foreach (Cart::content() as $row) {
            $product = Product::where('label', $row->name)->first();
            $order->products()->attach($product->id);
            $newQty = $product->stock - $row->qty;

            /**
             *  event écouté si stock alert est dépassé pour notifié l'équipe suply
             *  */
            $newQty < $product->stock_alert || $newQty === 0 ? event(new StockLowEvent($product)) : '';
            $product->update([
                'stock' => $newQty
            ]);
            $product->save;
        }

        /////event pour stock alert => dans l'administration to do concernant les choses à faire

        $employee = Auth::user()->employees->first();


        /**
         * recherche si l'adresse postale du payeur = l'adresse de livraison
         */
        if (isset($customer->address)) {
            $order->model()->associate($customer)->save();
            $addressPostalStreet = $customer->address->first()->street;
        } else {
            $order->model()->associate($employee)->save();
            $addressPostalStreet = $employee->company->address->first()->street;
        }

        $address = $request->deliveryStreet === $addressPostalStreet ? $addressPostalStreet : $request->deliveryStreet;


        if ($address !== $addressPostalStreet) {
            $find = Address::where('street', $address)->first();
            if ($find !== null) {
                //rue existe dans la bdd
                $city = City::where('name', $find->city->first())->first();
                if ($city !== null && $find->city_id === $city->id) {
                    //ville existe dans la bdd + rue
                    $order->address()->attach($find->id);
                    $order->save();
                    return $returnSuccess;
                } else {
                    $newCity = City::create([
                        'name' => $request->city,
                        'postal_code' => $request->postal_code,
                    ]);
                    $find->city->associate($newCity);
                    $order->address()->attach($find->id);
                    $order->save();
                    return  $returnSuccess;
                }
            }/*sinon*/ else {
                $city1 = City::where('name', $request->city)->first();
                $request->validate([
                    'street' => ['required', 'max:255'],
                    'city_id' => ['required'],
                ]);
                $ad = Address::create([
                    'street' => $request->deliveryStreet,
                    'city_id' => $city1->id,
                ]);

                $order->address()->attach($ad->id);
                $order->save();
                return  $returnSuccess;
            }
        }

        if (isset($customer->address)) {
            $order->address()->attach($customer->address->first()->id);
        } else {
            $order->address()->attach($employee->company->address->first()->id);
        }


        $order->save();

        //generation de facture
        $customer = new Buyer([
            'name'          => 'John Doe',
            'custom_fields' => [
                'email' => 'test@example.com',
            ],
        ]);

        $item = (new InvoiceItem())->title('Service 1')->pricePerUnit(2);

        $invoice = Invoice::make()
            ->buyer($customer)
            ->discountByPercent(10)
            ->taxRate(15)
            ->shipping(1.99)
            ->addItem($item);

            ;

        foreach (Cart::content() as $row) {
            Cart::remove($row->rowId);
        }

        return event(new SendInvoicePDF($invoice->stream()));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
