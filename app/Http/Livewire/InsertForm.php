<?php

namespace App\Http\Livewire;
use App\Models\Record;
use Livewire\Component;

class InsertForm extends Component
{
    public $name, $contact, $email;
    public function store(){
        $r = new record();
            $r->name = $this->name;
            $r->contact = $this->contact;
            $r->email = $this->email;
        $r->save();

        $this->name = $this->contact = $this->email ='';
        session()->flash('msg',"data inserted successfully");
        $this->emit('mount');
    }

    public function render()
    {
        return view('livewire.insert-form');
    }
}
