@props([
    'label',
    'model',
    'options' => [],
    'placeholder' => 'Select an option',
])

<div
    class="animated-select"
    x-data="{
        open: false,
        value: $wire.entangle('{{ $model }}').live,

        get selectedLabel() {
            const options = @js($options);

            return options[this.value] ?? @js($placeholder);
        },

        select(value) {
            this.value = String(value);
            this.open = false;
        }
    }"
    x-on:click.outside="open = false"
    x-on:keydown.escape.window="open = false"
>
    <label class="animated-select-label">
        {{ $label }}
    </label>

    <button
        type="button"
        class="animated-select-trigger"
        x-on:click="open = !open"
        x-bind:class="{ 'is-open': open }"
        x-bind:aria-expanded="open"
    >
        <span
            class="animated-select-value"
            x-text="selectedLabel"
        ></span>

        <svg
            class="animated-select-arrow"
            viewBox="0 0 20 20"
            fill="none"
            aria-hidden="true"
        >
            <path
                d="M5 7.5L10 12.5L15 7.5"
                stroke="currentColor"
                stroke-width="1.6"
                stroke-linecap="round"
                stroke-linejoin="round"
            />
        </svg>
    </button>

    <div
        class="animated-select-menu"
        x-show="open"
        data-lenis-prevent
        x-transition:enter="animated-select-enter"
        x-transition:enter-start="animated-select-enter-start"
        x-transition:enter-end="animated-select-enter-end"
        x-transition:leave="animated-select-leave"
        x-transition:leave-start="animated-select-leave-start"
        x-transition:leave-end="animated-select-leave-end"
        x-cloak
    >
        <button
            type="button"
            class="animated-select-option"
            x-on:click="select('')"
            x-bind:class="{ 'is-selected': value === '' }"
        >
            {{ $placeholder }}

            <span
                class="animated-select-check"
                x-show="value === ''"
            >
                ✓
            </span>
        </button>

        @foreach ($options as $optionValue => $optionLabel)
            <button
                type="button"
                class="animated-select-option"
                x-on:click="select(@js((string) $optionValue))"
                x-bind:class="{
                    'is-selected': value === @js((string) $optionValue)
                }"
            >
                {{ $optionLabel }}

                <span
                    class="animated-select-check"
                    x-show="value === @js((string) $optionValue)"
                >
                    ✓
                </span>
            </button>
        @endforeach
    </div>
</div>