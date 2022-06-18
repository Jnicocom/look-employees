@props(['name', 'placeholder'])

<label>
    <select name="{{ $name }}">
        {{ $slot }}
    </select>
</label>
