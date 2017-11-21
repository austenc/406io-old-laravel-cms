@push('scripts')
	<script type="text/javascript">
		new simpleMDE({ 

			@isset ($page)
			element: document.getElementById('page-content-{{ $page->id }}'),
			autosave: {
				enabled: true,
				uniqueId: 'page-content-' + {{ $page->id }},
			},
			@else
			element: document.getElementById('page-content'),
			@endisset
		});
	</script>
@endpush