<?php


namespace App\Http\Livewire;

use Livewire\Component;

class DeleteOrder extends Component
{

    /**
     * The order instance.
     *
     * @var mixed
     */
    public $order;

    /**
     * Indicates if order deletion is being confirmed.
     *
     * @var bool
     */
    public $confirmingOrderDeletion = false;

    /**
     * Mount the component.
     *
     * @param  mixed $order
     * @return void
     */
    public function mount($order)
    {
        $this->order = $order;
    }

    /**
     * Delete the order.
     *
     * @param  \App\Models\Order $order
     * @return \Illuminate\Http\Response
     */
    public function deleteOrder()
    {

        $this->order->delete($this->order);

        return redirect()->route('orders.index');
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('orders.delete');
    }
}
