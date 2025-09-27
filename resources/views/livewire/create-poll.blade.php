<div>
  @if (session()->has('message'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
      {{ session('message') }}
    </div>
  @endif

  <form wire:submit.prevent="createPoll">
    <label for="title">Poll Title</label>

    <input type="text" id="title" name="title" wire:model.live="title" />

    @error('title')
      <div class="error">{{ $message }}</div>
    @enderror

    <div class="mb-4 mt-4">
      <button class="btn" wire:click.prevent="addOption">Add Option</button>
    </div>

    <div>
      @foreach ($options as $index => $option)
        <div class="mb-4">
          <label for="option-{{ $index + 1 }}">Option {{ $index + 1 }}</label>
          <div class="flex gap-2">
            <input type="text" id="option-{{ $index + 1 }}" name="option-{{ $index + 1 }}" wire:model.live="options.{{ $index }}" />
            <button class="btn" wire:click.prevent="removeOption({{ $index }})">Remove</button>
          </div>
          @error('options.{{ $index }}')
            <div class="error">{{ $message }}</div>
          @enderror
        </div>
      @endforeach
    </div>

    <button type="submit" class="btn">Create Poll</button>
  </form>
</div>