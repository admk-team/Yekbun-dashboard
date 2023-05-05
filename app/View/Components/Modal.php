<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Modal extends Component
{
    public $title;
    public $titleCentered;
    public $titleTag;

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
    public $showFooter;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $title = null,
        $titleCentered = false,
        $titleTag = 'h4',

        $saveBtnText = null,
        $saveBtnType = null,
        $saveBtnForm = null,
        $onSaveBtnClick = '',
        $saveBtnClass = '',
        $showSaveBtn = true,

        $closeBtnText = null,

        $size = 'md',
        $show = false,
        $centered = true,
        $showFooter = true
    )
    {
        $this->title = $title;
        $this->titleCentered = $titleCentered;
        $this->titleTag = $titleTag;

        $this->saveBtnText = $saveBtnText;
        $this->saveBtnType = $saveBtnType;
        $this->saveBtnForm = $saveBtnForm;
        $this->onSaveBtnClick = $onSaveBtnClick;
        $this->saveBtnClass = $saveBtnClass;
        $this->showSaveBtn = $showSaveBtn;

        $this->size = $size;
        $this->show = $show;
        $this->centered = $centered;
        $this->showFooter = $showFooter;

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
