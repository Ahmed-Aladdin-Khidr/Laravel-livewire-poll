<?php

namespace App\Livewire;

use App\Models\Poll;
use App\Models\Option;
use Livewire\Component;
use Livewire\Attributes\On;

class Polls extends Component
{
    #[On('poll-created')]
    public function render()
    {
        $polls = Poll::with('options.votes')->latest()->get();
        return view('livewire.polls', [
            'polls' => $polls
        ]);
    }
    public function vote(Option $option){
        $option->votes()->create();
    }
}
