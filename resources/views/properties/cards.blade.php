<div class="mb-4">

<h5>

{{ $properties->total() }}

Properties Found

</h5>

</div>

<pre>

{{ json_encode($properties->items(), JSON_PRETTY_PRINT) }}

</pre>

{{ $properties->links() }}