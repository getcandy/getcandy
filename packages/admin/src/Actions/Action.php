<?php

namespace GetCandy\Hub\Actions;

abstract class Action
{
    /**
     * The action this action should override.
     *
     * @var string|null
     */
    protected $override = null;

    /**
     * Render the action.
     *
     * @param  ActionParams  $params
     * @return string
     */
    abstract public function component(): string;

    /**
     * Return the title for the action.
     *
     * @return string
     */
    abstract public function title(): string;
}
