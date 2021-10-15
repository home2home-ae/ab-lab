<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SelectGroup extends Component
{
    public $label;
    public $name;
    public $list;
    public $value;
    public $placeholder;
    public $id;

    /**
     * Select constructor.
     * @param $label
     * @param $name
     * @param $list
     * @param $placeholder
     * @param null $value
     */
    public function __construct($label, $name, $list, $placeholder = null, $value = null, $id = null)
    {
        $this->label = $label;
        $this->name = $name;
        $this->list = $list;
        $this->placeholder = $placeholder;
        $this->value = $value;
        $this->id = $id;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.select-group');
    }

    public function isSelected($value)
    {
        if (null === $this->value) {
            return false;
        }

        return $this->value == $value;
    }

    public function getPlaceholder()
    {
        if ($this->placeholder) {
            return $this->placeholder;
        }

        return "Select {$this->name}";
    }
}
