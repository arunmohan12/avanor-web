<x-filament-panels::page>

    @if ($errors->any())
        <div style="background: #7f1d1d; color: white; padding: 20px; margin-bottom: 20px;">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form wire:submit="save">
        {{ $this->form }}

        <div class="mt-6">
            <x-filament::button type="submit">
                Save Changes
            </x-filament::button>
        </div>
    </form>

</x-filament-panels::page>