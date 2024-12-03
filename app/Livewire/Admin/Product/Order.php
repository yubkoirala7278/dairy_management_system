<?php

namespace App\Livewire\Admin\Product;

use App\Helpers\NumberHelper;
use App\Models\Order as ModelsOrder;
use App\Models\OrderItem;
use App\Models\Withdraw;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Livewire\WithPagination;
use Livewire\Component;

class Order extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    private $productRepository;
    public $entries = 10;
    public $search = '';
    public $page = 'product';
    public $orderDetails = [];
    public $order_summary;
    public $status = '';

    public function boot(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    // ==========filter=========
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $orders = $this->productRepository->getAllOrders($this->entries, $this->search);
        return view('livewire.admin.product.order', [
            'orders' => $orders
        ]);
    }

    public function getOrderDetails($id)
    {
        $orders = OrderItem::with('product')->where('order_id', $id)->latest()->get();
        $order_summary = ModelsOrder::with('user')->where('id', $id)->first();
        if ($order_summary) {
            // Convert numbers to Nepali
            $order_summary->sub_total_nepali = NumberHelper::toNepaliNumber($order_summary->sub_total);
            $order_summary->shipping_charge_nepali = NumberHelper::toNepaliNumber($order_summary->shipping_charge);
            $order_summary->total_charge_nepali = NumberHelper::toNepaliNumber($order_summary->total_charge);
            $this->status = $order_summary->status;
        }


        // Transform the collection
        $orders->transform(function ($order, $key) {
            // Convert numbers to Nepali
            $order->qty_nepali = NumberHelper::toNepaliNumber($order->qty);
            $order->price_nepali = NumberHelper::toNepaliNumber($order->price);
            $order->total_nepali = NumberHelper::toNepaliNumber($order->total);

            // Add a custom "count" column in Nepali
            $order->nepali_count = NumberHelper::toNepaliNumber($key + 1); // +1 to start count from 1

            return $order;
        });

        // Assign the transformed orders to orderDetails
        $this->orderDetails = $orders;
        $this->order_summary = $order_summary;
    }

    public function updatedStatus()
    {
        $this->dispatch('warning',);
    }
    public function confirmUpdateStatus()
    {
        // Update the status in the database
        $this->order_summary->status = $this->status;
        $this->order_summary->save();
        // Pending
        if ($this->status == 'pending') {
            $withdraw=Withdraw::where('order_id',$this->order_summary->id)->first();
            if($withdraw){
                $withdraw->delete();
            }
            $this->dispatch('success', title: 'अर्डर विचाराधीन अवस्थामा छ।');
        }
        // Delivered
        if ($this->status == 'delivered') {
            Withdraw::create([
                'user_id'=>$this->order_summary->user_id,
                'withdraw'=>$this->order_summary->total_charge,
                'order_id'=>$this->order_summary->id
            ]);
            $this->dispatch('success', title: 'अर्डर सफलतापूर्वक पुर्याइएको छ।');
        }
        // Cancelled
        if ($this->status == 'cancelled') {
            $withdraw=Withdraw::where('order_id',$this->order_summary->id)->first();
            if($withdraw){
                $withdraw->delete();
            }
            $this->dispatch('success', title: 'अर्डर रद्द गरिएको छ।');
        }
    }
}
