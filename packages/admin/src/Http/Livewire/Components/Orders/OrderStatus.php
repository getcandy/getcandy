<?php

namespace GetCandy\Hub\Http\Livewire\Components\Orders;

use GetCandy\Hub\Http\Livewire\Traits\Notifies;
use GetCandy\Models\Order;
use Livewire\Component;

class OrderStatus extends Component
{
    use Notifies;

    /**
     * Whether the dialog should be visible.
     *
     * @var bool
     */
    public $visible = false;

    /**
     * The order to update.
     *
     * @var Order
     */
    public Order $order;

    /**
     * {@inheritDoc}
     */
    public function rules()
    {
        return [
            'order.status' => 'required|string',
        ];
    }

    /**
     * Update the order status.
     *
     * @return void
     */
    public function updateStatus()
    {
        $this->order->update([
            'status' => $this->order->status,
        ]);

        $this->notify(
            __('adminhub::notifications.order.status_updated')
        );
        $this->visible = false;
        $this->emitUp('order.show.updated');
    }

    /**
     * Return the configured statuses.
     *
     * @return array
     */
    public function getStatusesProperty()
    {
        return config('getcandy.orders.statuses', []);
    }

    /**
     * Render the livewire component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('adminhub::livewire.components.orders.status')
            ->layout('adminhub::layouts.base');
    }
}
