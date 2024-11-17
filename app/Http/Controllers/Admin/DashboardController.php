<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Transaction;
use App\Models\TransactionDetail;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $customer = User::count();
        $revenue = Transaction::where('transaction_status', 'SUCCESS')->sum('total_price');
        $transaction = Transaction::count();

        $sellTransactions = TransactionDetail::with(['transaction.user','product.galleries'])
                            ->whereHas('product', function($product){
                                $product->where('users_id', Auth::user()->id);
                            })->get();
        
        return view('pages.admin.dashboard', [
            'customer'=> $customer,
            'revenue'=> $revenue,
            'transaction'=>$transaction,
            'sellTransactions' => $sellTransactions,
        ]);
    }

    public function statistics(){
        return view('pages.admin.pengelolaan.statistics');
    }
}
