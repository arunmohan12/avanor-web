{{-- Kept off-screen so humans never interact with it; automated form fillers commonly do. --}}
<div aria-hidden="true" style="position:absolute;left:-10000px;width:1px;height:1px;overflow:hidden;">
    <label>
        Website
        <input type="text" name="website" tabindex="-1" autocomplete="off">
    </label>
</div>

<input type="hidden" name="form_started_at" value="{{ now()->timestamp }}">
