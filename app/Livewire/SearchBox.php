<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;

class SearchBox extends Component
{
    public ?string $search;
 
    public function update ()
    {  
        $this->dispatch('search', search : $this->search);
    }


    public function render()
    {
        return view('livewire.search-box');
    }
}
