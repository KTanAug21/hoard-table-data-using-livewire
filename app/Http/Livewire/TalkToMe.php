<?php

namespace App\Http\Livewire;

use Livewire\Component;

class TalkToMe extends Component
{
    public $msg;

    function getResponse()
    {
        $response = (new \App\Models\ChatBot)->processMessage($this->msg);
        $this->dispatchBrowserEvent('response-received', ['response'=>$response]);
    }

    public function render()
    {
        return view('livewire.talk-to-me');
    }
}
