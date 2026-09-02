@props([
    'name',
    'size' => 18,
])

@switch($name)

    @case('whatsapp')
        <svg
            {{ $attributes }}
            width="{{ $size }}"
            height="{{ $size }}"
            viewBox="0 0 24 24"
            fill="currentColor"
            aria-hidden="true">
            <path d="M12.04 2a9.84 9.84 0 0 0-8.47 14.83L2 22l5.3-1.52A9.98 9.98 0 1 0 12.04 2Zm0 17.98a8.05 8.05 0 0 1-4.1-1.12l-.29-.17-3.14.9.92-3.05-.19-.31a8.03 8.03 0 1 1 6.8 3.75Zm4.41-6.03c-.24-.12-1.43-.7-1.65-.78-.22-.08-.38-.12-.54.12-.16.24-.62.78-.76.94-.14.16-.28.18-.52.06-.24-.12-1.02-.38-1.94-1.2-.72-.64-1.2-1.43-1.34-1.67-.14-.24-.02-.37.1-.49.11-.11.24-.28.36-.42.12-.14.16-.24.24-.4.08-.16.04-.3-.02-.42-.06-.12-.54-1.3-.74-1.78-.2-.47-.4-.4-.54-.41h-.46c-.16 0-.42.06-.64.3-.22.24-.84.82-.84 2s.86 2.32.98 2.48c.12.16 1.69 2.58 4.1 3.62.57.25 1.02.4 1.37.51.58.18 1.1.16 1.52.1.46-.07 1.43-.59 1.63-1.15.2-.56.2-1.04.14-1.15-.06-.1-.22-.16-.46-.28Z"/>
        </svg>
        @break

    @case('water')
        <svg
            {{ $attributes }}
            width="{{ $size }}"
            height="{{ $size }}"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round"
            aria-hidden="true">

            <path d="M2 8c2 0 2 2 4 2s2-2 4-2 2 2 4 2 2-2 4-2 2 2 4 2" />
            <path d="M2 13c2 0 2 2 4 2s2-2 4-2 2 2 4 2 2-2 4-2 2 2 4 2" />
            <path d="M2 18c2 0 2 2 4 2s2-2 4-2 2 2 4 2 2-2 4-2 2 2 4 2" />

        </svg>
        @break
    @case('phone')
        <svg
            {{ $attributes }}
            width="{{ $size }}"
            height="{{ $size }}"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round"
            aria-hidden="true">
            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6A19.79 19.79 0 0 1 2.12 4.18 2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.12.9.33 1.78.62 2.63a2 2 0 0 1-.45 2.11L8 9.73a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.85.29 1.73.5 2.63.62A2 2 0 0 1 22 16.92Z"/>
        </svg>
        @break


    @case('arrow-right')
        <svg
            {{ $attributes }}
            width="{{ $size }}"
            height="{{ $size }}"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round"
            aria-hidden="true">
            <path d="M5 12h14"/>
            <path d="m13 6 6 6-6 6"/>
        </svg>
        @break


    @case('chevron-left')
        <svg
            {{ $attributes }}
            width="{{ $size }}"
            height="{{ $size }}"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            aria-hidden="true">
            <path d="m15 18-6-6 6-6"/>
        </svg>
        @break


    @case('chevron-right')
        <svg
            {{ $attributes }}
            width="{{ $size }}"
            height="{{ $size }}"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            aria-hidden="true">
            <path d="m9 18 6-6-6-6"/>
        </svg>
        @break


    @case('check')
        <svg
            {{ $attributes }}
            width="{{ $size }}"
            height="{{ $size }}"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round"
            aria-hidden="true">
            <path d="m5 12 4 4L19 6"/>
        </svg>
        @break


    @case('child')
        <svg
            {{ $attributes }}
            width="{{ $size }}"
            height="{{ $size }}"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="1.8"
            stroke-linecap="round"
            stroke-linejoin="round"
            aria-hidden="true">

            <circle cx="12" cy="5" r="2.5"/>

            <path d="M12 8v6"/>

            <path d="M7 11l5 3 5-3"/>

            <path d="M12 14l-4 7"/>

            <path d="M12 14l4 7"/>

        </svg>
        @break


    @case('swimming')
        <svg
            {{ $attributes }}
            width="{{ $size }}"
            height="{{ $size }}"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="1.8"
            stroke-linecap="round"
            stroke-linejoin="round"
            aria-hidden="true">

            <circle cx="17" cy="5" r="2"/>

            <path d="M9 10l4-3 4 3"/>

            <path d="M13 7l-3 6"/>

            <path d="M2 16c2 0 2 2 4 2s2-2 4-2 2 2 4 2 2-2 4-2 2 2 4 2"/>

            <path d="M2 21c2 0 2 1 4 1s2-1 4-1 2 1 4 1 2-1 4-1 2 1 4 1"/>

        </svg>
        @break


    @case('dumbbell')
        <svg
            {{ $attributes }}
            width="{{ $size }}"
            height="{{ $size }}"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="1.8"
            stroke-linecap="round"
            stroke-linejoin="round"
            aria-hidden="true">

            <path d="M6 8v8"/>
            <path d="M3 10v4"/>

            <path d="M18 8v8"/>
            <path d="M21 10v4"/>

            <path d="M6 12h12"/>

        </svg>
        @break


    @case('utensils')
        <svg
            {{ $attributes }}
            width="{{ $size }}"
            height="{{ $size }}"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="1.8"
            stroke-linecap="round"
            stroke-linejoin="round"
            aria-hidden="true">

            <path d="M7 3v8"/>
            <path d="M4 3v5a3 3 0 0 0 6 0V3"/>
            <path d="M7 11v10"/>

            <path d="M17 3v18"/>
            <path d="M17 3c3 2 3 6 0 8"/>

        </svg>
        @break

    @case('spa')
        <svg
            {{ $attributes }}
            width="{{ $size }}"
            height="{{ $size }}"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="1.8"
            stroke-linecap="round"
            stroke-linejoin="round"
            aria-hidden="true">

            <path d="M12 21c4-2.5 6-6 6-10-3.5 0-5.5 1.8-6 4.5"/>
            <path d="M12 21c-4-2.5-6-6-6-10 3.5 0 5.5 1.8 6 4.5"/>
            <path d="M12 15V7"/>
            <path d="M12 7c-2-1.2-3-3-3-5 2.2 0 3 1.3 3 3.2C12 3.3 12.8 2 15 2c0 2-1 3.8-3 5Z"/>

        </svg>
        @break

    @case('leaf')
        <svg
            {{ $attributes }}
            width="{{ $size }}"
            height="{{ $size }}"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="1.8"
            stroke-linecap="round"
            stroke-linejoin="round"
            aria-hidden="true">

            <path d="M20 4C12 4 6 6.5 6 13a6 6 0 0 0 6 6c6.5 0 8-7 8-15Z"/>
            <path d="M4 21c4-6 8-9 14-12"/>

        </svg>
        @break

    @case('beach')
        <svg
            {{ $attributes }}
            width="{{ $size }}"
            height="{{ $size }}"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="1.8"
            stroke-linecap="round"
            stroke-linejoin="round"
            aria-hidden="true">

            <path d="M3 12a9 9 0 0 1 18 0Z"/>
            <path d="M12 12v8"/>
            <path d="M7 21h10"/>
            <path d="M12 3v2"/>

        </svg>
        @break

    @case('pool')
        <svg
            {{ $attributes }}
            width="{{ $size }}"
            height="{{ $size }}"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="1.8"
            stroke-linecap="round"
            stroke-linejoin="round"
            aria-hidden="true">

            <path d="M7 4v10"/>
            <path d="M12 4v10"/>
            <path d="M7 7h5"/>
            <path d="M2 16c2 0 2 2 4 2s2-2 4-2 2 2 4 2 2-2 4-2 2 2 4 2"/>
            <path d="M2 21c2 0 2 1 4 1s2-1 4-1 2 1 4 1 2-1 4-1 2 1 4 1"/>

        </svg>
        @break

    @case('users')
        <svg
            {{ $attributes }}
            width="{{ $size }}"
            height="{{ $size }}"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="1.8"
            stroke-linecap="round"
            stroke-linejoin="round"
            aria-hidden="true">

            <circle cx="9" cy="7" r="3"/>
            <path d="M3 21v-2a6 6 0 0 1 12 0v2"/>
            <path d="M16 4a3 3 0 0 1 0 6"/>
            <path d="M17 15a5 5 0 0 1 4 5"/>

        </svg>
        @break

    @case('location')
        <svg
            class="landing-about-v2-location-icon"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="1.7"
            stroke-linecap="round"
            stroke-linejoin="round"
            aria-hidden="true">

            <path d="M20 10c0 5-8 11-8 11S4 15 4 10a8 8 0 1 1 16 0Z"/>
            <circle cx="12" cy="10" r="2.5"/>

        </svg>
        @break


    @case('kids-play')
        <svg viewBox="0 0 24 24"
             fill="none"
             stroke="currentColor"
             stroke-width="1.6"
             stroke-linecap="round"
             stroke-linejoin="round">

            <circle cx="7" cy="5" r="2"/>
            <path d="M7 7v6"/>
            <path d="M4 10l3 3 3-3"/>
            <path d="M14 5h5v15"/>
            <path d="M14 5v5h5"/>
            <path d="M14 10l-4 10"/>

        </svg>
        @break


    @case('dining')
        <svg viewBox="0 0 24 24"
             fill="none"
             stroke="currentColor"
             stroke-width="1.6"
             stroke-linecap="round"
             stroke-linejoin="round">

            <path d="M7 3v8"/>
            <path d="M4 3v5c0 2 6 2 6 0V3"/>
            <path d="M7 11v10"/>
            <path d="M17 3v18"/>
            <path d="M17 3c-3 3-3 8 0 9"/>

        </svg>
        @break


    @case('cycling')
        <svg viewBox="0 0 24 24"
             fill="none"
             stroke="currentColor"
             stroke-width="1.6"
             stroke-linecap="round"
             stroke-linejoin="round">

            <circle cx="6" cy="17" r="4"/>
            <circle cx="18" cy="17" r="4"/>

            <path d="M6 17l4-8 4 8"/>
            <path d="M10 9h5"/>
            <path d="M14 17h4"/>
            <path d="M9 6h3"/>

        </svg>
        @break


    @case('jogging')


        <svg width="64px" height="64px" viewBox="0 0 24.00 24.00" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <circle cx="18.5" cy="4.5" r="2.5" stroke="#ad8144" stroke-width="1.44"></circle> <path d="M14.4 21.9998V21.1948C14.4 21.117 14.4 21.0781 14.3996 21.0411C14.377 18.9018 13.3773 16.8903 11.6857 15.5804C11.6565 15.5578 11.6255 15.5343 11.5635 15.4873C11.5235 15.457 11.5035 15.4419 11.4877 15.4294C10.5309 14.6738 10.467 13.2453 11.3524 12.4073C11.367 12.3935 11.3857 12.3765 11.4227 12.3428L12.4628 11.3973C14.0898 9.91821 13.5945 7.24444 11.5457 6.4462C10.8122 6.16044 9.99522 6.17841 9.27504 6.49613L8.75335 6.72629C8.21393 6.96427 7.94422 7.08326 7.68074 7.21404C7.24267 7.43148 6.81722 7.67347 6.40642 7.93886C6.15935 8.09847 5.91922 8.26947 5.43897 8.61147L4 9.63619" stroke="#ad8144" stroke-width="1.44" stroke-linecap="round"></path> <path d="M9 17L8.74064 17.3112C7.32089 19.0149 5.21773 20 3 20" stroke="#ad8144" stroke-width="1.44" stroke-linecap="round"></path> <path d="M16 12C17.3131 12.3283 18.6869 12.3283 20 12" stroke="#ad8144" stroke-width="1.44" stroke-linecap="round"></path> </g></svg>
        @break
    @case('park')
        <svg viewBox="0 0 24 24"
             fill="none"
             stroke="currentColor"
             stroke-width="1.6"
             stroke-linecap="round"
             stroke-linejoin="round">

            <path d="M12 3c-4 0-7 3-7 6 0 3 3 5 7 5s7-2 7-5c0-3-3-6-7-6Z"/>

            <path d="M12 14v7"/>

            <path d="M4 18h16"/>

            <path d="M16 16h5"/>
            <path d="M17 19v-3"/>
            <path d="M20 19v-3"/>

        </svg>
        @break


    @case('shield')
        <svg viewBox="0 0 24 24"
             fill="none"
             stroke="currentColor"
             stroke-width="1.6"
             stroke-linecap="round"
             stroke-linejoin="round">

            <path d="M12 3 20 6v6c0 5-3.5 8-8 9-4.5-1-8-4-8-9V6l8-3Z"/>

            <path d="m9 12 2 2 4-4"/>

        </svg>
        @break


    @case('star')
        <svg viewBox="0 0 24 24"
             fill="none"
             stroke="currentColor"
             stroke-width="1.6"
             stroke-linecap="round"
             stroke-linejoin="round">

            <path d="m12 3 2.8 5.7 6.2.9-4.5 4.4 1.1 6.2-5.6-2.9-5.6 2.9 1.1-6.2L3 9.6l6.2-.9L12 3Z"/>

        </svg>
        @break


    @case('calendar')
        <svg
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="1.6"
            stroke-linecap="round"
            stroke-linejoin="round"
            aria-hidden="true">

            <rect x="3" y="5" width="18" height="16" rx="2"/>
            <path d="M7 3v4"/>
            <path d="M17 3v4"/>
            <path d="M3 10h18"/>
            <path d="M8 14h2"/>
            <path d="M14 14h2"/>
            <path d="M8 18h2"/>
            <path d="M14 18h2"/>

        </svg>
        @break


    @case('construction')
        <svg
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="1.6"
            stroke-linecap="round"
            stroke-linejoin="round"
            aria-hidden="true">

            <path d="M4 21V7"/>
            <path d="M4 7h13"/>
            <path d="M8 4h9"/>
            <path d="M17 4v17"/>
            <path d="M17 7l4 3"/>
            <path d="M21 10v5"/>
            <path d="M19 15h4"/>
            <path d="M8 21v-7h5v7"/>
            <path d="M3 21h16"/>

        </svg>
        @break


    @case('home')
        <svg
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="1.6"
            stroke-linecap="round"
            stroke-linejoin="round"
            aria-hidden="true">

            <path d="M3 11 12 3l9 8"/>
            <path d="M5 10v11h14V10"/>
            <path d="M9 21v-6h6v6"/>

        </svg>
        @break
@endswitch
