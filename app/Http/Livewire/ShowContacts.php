<?php

namespace App\Http\Livewire;

use App\Models\Contact;
use Livewire\Component;

class ShowContacts extends Component
{
    public $first_name, $last_name, $email, $phone_number, $contact_id;
    public $isOpen = 0, $historyOpen=0;
    public $histories;

    public function render()
    {
        return view('livewire.show-contacts', [
            'contacts' => Contact::orderBy('first_name', 'ASC')->get(),
            'total' => Contact::all()->count()
    ]);
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    private function resetInputFields()
    {
        $this->first_name = '';
        $this->last_name = '';
        $this->email = '';
        $this->phone_number = '';
        $this->contact_id = '';
    }

    private function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    private function openHistoryModal()
    {
        $this->historyOpen = true;
    }

    public function closeHistoryModal()
    {
        $this->historyOpen = false;
    }

    public function history(){
        $this->openHistoryModal();
    }

    public function contactHistory($id){
        $contact = Contact::findOrFail($id);
        $this->histories = $contact->history()->orderBy('created_at', 'DESC')->get();
        $this->openHistoryModal();
    }

    public function store()
    {
        if ($this->contact_id){
            $this->validate([
                'first_name' => 'required|string|min:4',
                'last_name' => 'required|string|min:4',
                'phone_number' => 'required',
            ]);
        }else{
            $this->validate([
                'first_name' => 'required|string|min:4',
                'last_name' => 'required|string|min:4',
                'email' => 'required|string|max:500|unique:contacts',
                'phone_number' => 'required',
            ]);
        }


        Contact::updateOrCreate(['id' => $this->contact_id],[
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone_number' => $this->phone_number
        ]);

        session()->flash('message', $this->contact_id ? 'Contact Updated Successfully' : 'Contact Created Successfully');

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $contact = Contact::findOrFail($id);
        $this->contact_id = $id;
        $this->first_name = $contact->first_name;
        $this->last_name = $contact->last_name;
        $this->email = $contact->email;
        $this->phone_number = $contact->phone_number;

        $this->openModal();
    }

    public function delete($id)
    {
        Contact::find($id)->delete();
        session()->flash('message', 'Contact Deleted Successfully.');
    }
}
