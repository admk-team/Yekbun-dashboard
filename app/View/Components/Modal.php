<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Modal extends Component
{
    public $title;

    public $saveBtnText;
    public $saveBtnType;
    public $saveBtnForm;
    public $onSaveBtnClick;
    public $saveBtnClass;
    public $showSaveBtn;

    public $closeBtnText;

    public $size;
    public $show;
    public $centered;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $title = null, 

        $saveBtnText = null,
        $saveBtnType = null,
        $saveBtnForm = null,
        $onSaveBtnClick = '',
        $saveBtnClass = '',
        $showSaveBtn = true,

        $closeBtnText = null,

        $size = 'md',
        $show = false,
        $centered = true
    )
    {
        $this->title = $title;

        $this->saveBtnText = $saveBtnText;
        $this->saveBtnType = $saveBtnType;
        $this->saveBtnForm = $saveBtnForm;
        $this->onSaveBtnClick = $onSaveBtnClick;
        $this->saveBtnClass = $saveBtnClass;
        $this->showSaveBtn = $showSaveBtn;

        $this->size = $size;
        $this->show = $show;
        $this->centered = $centered;

        $this->closeBtnText = $closeBtnText;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.modal');
    }
}
