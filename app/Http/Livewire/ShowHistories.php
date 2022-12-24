<?php
/*
namespace App\Http\Livewire;

use App\Models\Contact;
use App\Models\ContactHistory;
use Livewire\Component;

class ShowHistories extends Component
{
    public $contact;
    public $histories;

    public function render()
    {
        return view('livewire.show-histories', [
            'histories' => ContactHistory::where('contact_id', $this->contact->id)->orderBy('created_at', 'DESC')->get()
        ]);
    }

    public function mount($id){
        $this->contact = Contact::find($id);
    }
}*/
