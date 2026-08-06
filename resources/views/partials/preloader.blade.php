<div class="preloader">
    <button class="th-btn style2 preloaderCls">
        Cancel Preloader
    </button>

    <div id="preloader" class="preloader-inner">

        <div class="txt-loading">
            @foreach (str_split('AVANOR CAPITAL') as $letter)
                <span data-text-preloader="{{ $letter }}" class="letters-loading">
                    {{ $letter }}
                </span>
            @endforeach
        </div>
    </div>
</div>