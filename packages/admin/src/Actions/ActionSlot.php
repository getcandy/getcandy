<?php

namespace GetCandy\Hub\Actions;

use Illuminate\Support\Collection;

class ActionSlot
{
    /**
     * The action slot handle.
     *
     * @var string
     */
    public string $handle;

    public Collection $actions;

    public function __construct($handle)
    {
        $this->handle = $handle;
        $this->actions = collect();
    }

    /**
     * Add an item to the menu slot.
     *
     * @param  \Closure  $callback
     * @param  string  $after
     * @return static
     */
    public function addAction(Action $action, $after = null)
    {
        $index = false;

        if ($after) {
            $index = $this->actions->search(function ($item) use ($after) {
                return $item->handle == $after;
            });
        }

        if ($index) {
            $this->actions->splice($index + 1, 0, [$action]);

            return $this;
        }

        $this->actions->push($action);

        return $this;
    }

    /**
     * Add multiple items.
     *
     * @param  array  $items
     * @return static
     */
    public function addItems(array $items)
    {
        foreach ($items as $item) {
            $this->items->push($item);
        }

        return $this;
    }

    /**
     * Get the items for the action slot.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getActions(): Collection
    {
        return $this->actions;
    }

    /**
     * Get the handle of the slot.
     *
     * @return string
     */
    public function getHandle()
    {
        return $this->handle;
    }
}
