<?php




namespace App\Http\Controllers;

use App\Models\Product; // Add this line if you haven't already
use App\Models\Order; // Adjust to your order model
use PDF;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function downloadPDF(Order $order)
    {
        // Check if the authenticated user owns this order
        if ($order->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }
    
        // Load the PDF view with order data
        return view('invoices.pdf', compact('order')); // Pass $order to the view
    }
    
    public function show(Product $product)
    {
        return view('invoices.show', compact('product'));
    }

}