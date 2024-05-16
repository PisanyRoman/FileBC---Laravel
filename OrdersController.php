<?php

namespace App\Http\Controllers;

use App\Delivery;
use App\Gift;
use App\Orders;
use App\Shop;
use App\Status;
use App\User;
use App\Source;
use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrdersController extends Controller
{
    public function index() {

        $orders = Orders::orderBy('id', 'desc')->paginate(10);
        return view('orders.index')->with(compact('orders'));
    }

    public function active() {
        $orders = Orders::where('idstatus', 1)->OrderBy('id', 'desc')->paginate(10);
        return view('orders.active')->with(compact('orders'));
    }

    public function activeparam($dates) {
        
        switch ($dates) {
            case '1':
                $date = date('Y-m-d');
                break;
            case '2':
                $date = date('Y-m-d', strtotime('+1 day'));
                break;
            case '3':
                $date = date('Y-m-d', strtotime('+2 day'));
                break;
            case '5':
                $date = date('Y-m-d', strtotime('-1 day'));
                break;
            case '6':
                $date = date('Y-m-d', strtotime('-2 day'));
                break;
            default;
                $date = date('Y-m-d');
                break;
            }
        
        if ($dates == '4') {
            $date = date('Y-m-d', strtotime('2 day'));
            $orders = Orders::where('idstatus', 1)->where('dateout', '>', $date)->paginate(10);
        } else {
            $orders = Orders::where('idstatus', 1)->where('dateout', $date)->paginate(10);
        }
        return view('orders.active')->with(compact('orders'));
    }
    
    public function archive() {
        $orders = Orders::where('idstatus', 2)->OrderBy('id', 'desc')->paginate(10);
        return view('orders.archive')->with(compact('orders'));
    }
    public function deleted() {
        $orders = Orders::where('idstatus', 3)->OrderBy('id', 'desc')->paginate(10);
        return view('orders.deleted')->with(compact('orders'));
    }
    public function create() {
        $shops = Shop::all();
        $statuses = Status::all();
        $deliveries = Delivery::all();
        $gifts = Gift::all();
        $users = User::all();
        $sources = Source::all();
        $setting = Setting::find(1);
        return view('orders.create')->with(compact('shops', 'statuses', 'deliveries','gifts', 'users', 'sources', 'setting'));
    }

    public function store() {
        $setting = Setting::find(1);
        $data = request()->validate([
            'iduser' => 'integer',
            'idstatus'=> 'integer',
            'number'=> 'integer',
            'idshop'=> 'integer',
            'idsource'=> 'integer',
            'fio'=> '',
            'telephone'=> '',
            'email'=> '',
            'address'=> '',
            'underground'=> '',
            'iddelivery'=> 'integer',
            'timeout'=> '',
            'dateout'=> '',
            'sum'=> '',
            'idgift'=> 'integer',
            'сomposition'=> '',
            'note'=> '',
        ]);
        Orders::create($data);
        $setting->increment('to_number');
        return redirect()->route('orders.index');
    }

    public function show(Orders $orders) {
        return view('orders.show', compact('orders'));
    }

    public function edit(Orders $orders) {
        $shops = Shop::all();
        $statuses = Status::all();
        $deliveries = Delivery::all();
        $gifts = Gift::all();
        $sources = Source::all();
        return view('orders.edit', compact('orders','shops', 'statuses', 'deliveries','gifts', 'sources'));
    }

    public function update(Orders $orders) {
        $data = request()->validate([
            'idstatus'=> 'integer',
            'number'=> 'integer',
            'idshop'=> 'integer',
            'idsource'=> 'integer',
            'fio'=> '',
            'telephone'=> '',
            'email'=> '',
            'address'=> '',
            'underground'=> '',
            'iddelivery'=> 'integer',
            'timeout'=> '',
            'dateout'=> '',
            'sum'=> '',
            'idgift'=> 'integer',
            'сomposition'=> '',
            'note'=> '',
        ]);
        $orders->update($data);
        return redirect()->route('orders.show', $orders->id);
    }

    public function destroy(Orders $orders) {
        $orders->delete();
        return redirect()->route('orders.index');
    }
}
