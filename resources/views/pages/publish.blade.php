<form method="POST" action="{{ route('pages.' . $action, $page) }}" class="inline">
	{{ csrf_field() }}
	<button type="submit" name="{{ $action }}" class="ml-4 py-1 px-2 bg-purple hover:bg-purple-dark rounded text-white">
		{{ ucwords($action) }}
	</button>
</form>