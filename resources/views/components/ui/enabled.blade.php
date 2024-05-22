@props(['enabled' => true, 'name' => 'enabled'])

<div class="form-check">
    <input class="form-check-input" type="radio" name="{{ $name }}" value="1" id="enabled" @checked($enabled)>
    <label class="form-check-label" for="enabled">有効</label>
</div>
<div class="form-check">
    <input class="form-check-input" type="radio" name="{{ $name }}" value="0" id="disabled" @checked(!$enabled)>
    <label class="form-check-label" for="disabled">利用不可</label>
</div>