<?php

namespace App\Http\Livewire;

use App\Models\Reply;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class ShowReply extends Component
{
    use AuthorizesRequests;

    public Reply $reply;
    public $body = '';   //This one is a property
    public $is_creating = false;
    public $is_editing = false;

    protected $listeners = ['refresh' => '$refresh'];

    public function updatedIsCreating(){
        $this->is_editing =false;
        $this->body = '';
    }

    public function updatedIsEditing(){
        $this->authorize('update', $this->reply);
        $this->is_creating =false;
        $this->body = $this->reply->body;
    }

    //if you need you can work with any variable here  public function updateReply($is_editing){
    public function updateReply(){
        $this->authorize('update', $this->reply);
        //validate
        $this->validate(['body' => 'required']);
        //update
        $this->reply->update([ 'body' => $this->body ]);
        //refresh
        $this->is_editing = false;
    }

    public function postChild(){
        if (! is_null($this->reply->reply_id)) return;
        //validate
        $this->validate(['body' => 'required']);
        //create
        auth()->user()->replies()->create([
            'reply_id' => $this->reply->id,
            'thread_id' => $this->reply->thread->id,
            'body' => $this->body 
        ]);
        //refresh
        $this->is_creating = false;
        $this->body = '';
        $this->emitSelf('refresh');
    }

    public function render()
    {
        return view('livewire.show-reply');
    }
}
