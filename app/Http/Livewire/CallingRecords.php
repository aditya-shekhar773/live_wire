<?php

namespace App\Http\Livewire;
use App\Models\Record;
use Livewire\Component;

class CallingRecords extends Component
{
    public $records,$search = "",$name, $contact, $email, $r_id;

    protected $listeners = ["mount"];

    public function mount(){
        
        $this->records = Record::orderby("id","desc")->get();
    }

    public function getId($id){
        $this->r_id = $id;
        $r = Record::find($this->r_id);
        $this->name = $r->name;
        $this->contact = $r->contact;
        $this->email = $r->email;

    }
    public function update(){
           
            $r = Record::find($this->r_id);
            $r->name = $this->name;
            $r->contact = $this->contact;
            $r->email = $this->email;
            $r->save();

        $this->name = $this->contact = $this->email ='';
        session()->flash('msg',"data updated successfully");
        $this->mount();
    }

   
    public function delete($record_id){
        $record = Record::find($record_id);
        $record->delete();
        session()->flash('error',$record->name . " deleted Successfully");
        $this->mount();
    }

    public function render()
    {
        
        if($this->search != ""){
            sleep(1);
            $this->records = Record::where("name","LIKE","%$this->search%")->get();
        }
        return view('livewire.calling-records');
    }
}
