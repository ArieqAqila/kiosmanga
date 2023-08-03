<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Mangaka;
use App\Models\Genre;
use App\Models\Penerbit;

class listFilter extends Component
{
    public $genres;
    public $mangakas;
    public $penerbits;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->genres = Genre::select('nama_genre')->get();
        $this->mangakas = Mangaka::select('nama_mangaka')->get();
        $this->penerbits = Penerbit::select('nama_penerbit')->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.list-filter');
    }
}
