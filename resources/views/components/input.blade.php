@props([
'type' => 'text',
'name',
'placeholder' => '',
'value' => ''
])

<label>
    <input
        type="{{ $type }}"
        name="{{ $name }}"
        placeholder="{{ $placeholder }}"
        value="{{ $value }}">
</label>
