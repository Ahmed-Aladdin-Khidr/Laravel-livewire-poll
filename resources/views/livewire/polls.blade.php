<div>
    {{-- The whole world belongs to you. --}}
    @forelse ($polls as $poll)
        <div class="mb-4">
            <h3 class="mb-4 text-xl">{{ $poll->title }}</h3>
            @foreach ($poll->options as $option)
                <div class="mb-2">
                    <button class="btn" wire:click="vote({{ $option->id }})">Vote</button>
                    <span>{{ $option->name }} ({{ $option->votes->count() }})</span>
                </div>
            @endforeach
        </div>
    @empty
        <p>No polls found</p>
    @endforelse
</div>