@push('scripts')
	<script type="text/javascript">
		new simpleMDE({ 
			element: document.getElementById('page-content'),
			autosave: {
				enabled: true,
				uniqueId: 'page-content',
			},
		});
	</script>
@endpush