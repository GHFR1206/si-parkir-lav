<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Sidebar extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

     public $aktif;
     public $selesai;
     public $tambah;
    public function __construct($aktif = null, $selesai = null, $tambah = null)
    {
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
        return view('layouts.sidebar');
    }
}
