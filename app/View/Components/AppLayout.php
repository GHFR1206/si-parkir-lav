<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AppLayout extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $title;
    public $header;
    public $aktif;
    public $selesai;
    public $tambah;

    public function __construct($title = null, $header = null, $aktif = null, $selesai = null, $tambah = null)
    {
        $this->title = $title;
        $this->header = $header;
        $this->aktif = $aktif;
        $this->selesai = $selesai;
        $this->tambah = $tambah;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('layouts.app');
    }
}
