    <div class="container">



        <div class="row justify-content-between align-items-center">
            <div class="col-lg-6">
                <div class="title-area">
                    <span class="sub-title-dark">SIGNATURE COLLECTIONS</span>
                    <h2 class="sec-title brand-light">Exclusive Property Picks </h2>
                </div>
            </div>
            <div class="col-lg-6 d-none d-lg-flex justify-content-end">

                <a
                    href="{{ route('properties.index') }}"
                    class=" show-allproperties-btn "> VIEW ALL </a>

            </div>
        </div>

        <div class="avanor-developers-grid" id="developerGrid">

            @foreach (array_slice($developers, 0, 10) as $developer)

            <a
                href="{{ route('developers.show', $developer['slug']) }}"
                class="avanor-developer-card"
                data-index="{{ $loop->index }}">
                <img
                    src="{{ $developer['logo']
                    ? \Illuminate\Support\Facades\Storage::disk('public')->url($developer['logo'])
                    : asset('assets/img/default-developer-logo.webp') }}"
                    alt="{{ $developer['name'] }}"
                    class="developer-logo-brand">
            </a>

            @endforeach

        </div>

    </div>