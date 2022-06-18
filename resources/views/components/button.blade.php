@props([
'id' => '',
'onclick' => ''
])

<button
    class="button"
    id="{{ $id }}"
    onclick="{{ $onclick }}">
    {{ $slot }}
</button>
