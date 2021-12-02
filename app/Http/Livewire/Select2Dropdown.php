<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\Contact;

class Select2Dropdown extends Component
{

    public $query;
    public $contacts;
    public $highlightIndex;
 
    public function mount()
    {
        $this->resets();
    }
 
    public function resets()
    {
        $this->query = '';
        $this->contacts = [];
        $this->highlightIndex = 0;
    }
 
    public function incrementHighlight()
    {
        if ($this->highlightIndex === count($this->contacts) - 1) {
            $this->highlightIndex = 0;
            return;
        }
        $this->highlightIndex++;
    }
 
    public function decrementHighlight()
    {
        if ($this->highlightIndex === 0) {
            $this->highlightIndex = count($this->contacts) - 1;
            return;
        }
        $this->highlightIndex--;
    }
 
    public function selectContact()
    {
        $contact = $this->contacts[$this->highlightIndex] ?? null;
        if ($contact) {
            $this->redirect(route('show-contact', $contact['id']));
        }
    }
 
    public function updatedQuery()
    {
        $this->contacts = Contact::where('name', 'like', '%' . $this->query . '%')
            ->get()
            ->toArray();
    }  

    public function render()
    {
        return view('livewire.select2-dropdown')->extends('layouts.app');
    }
}