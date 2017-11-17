<input 
	type="{{ $type or 'text' }}" 
	name="{{ $name }}"
	placeholder="{{ $placeholder or ucwords(str_replace(['-', '_'], ' ', $name)) }}"
	class="{{ $class or 'input ' }} {{ $errors->has($name) ? ' border-red' : '' }}"
	@isset($value) value="{{ $value }}" @endisset
	 {{ $attributes or '' }}>

@include('validation.errors', ['field' => $name])