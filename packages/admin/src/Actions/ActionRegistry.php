<?php

namespace GetCandy\Hub\Actions;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class ActionRegistry
{
    /**
     * The collection of available slots.
     *
     * @var type
     */
    protected Collection $slots;

    /**
     * Instantiate the registry.
     */
    public function __construct()
    {
        $this->slots = collect([
            new ActionSlot('orders.view.top'),
        ]);
    }

    /**
     * Getter/Setter for the requested slot. If the slot does not exist
     * then a new one will be added to the slots property and returned.
     *
     * @param  string  $handle
     * @return \GetCandy\Hub\Menu\MenuSlot
     */
    public function slot($handle): ActionSlot
    {
        $handle = Str::slug($handle);

        $slot = $this->slots->first(function ($slot) use ($handle) {
            return $slot->getHandle() == $handle;
        });

        if ($slot) {
            return $slot;
        }

        $slot = new ActionSlot($handle);
        $this->slots->push($slot);

        return $slot;
    }
}
