@push('scripts')
	<script type="text/javascript">
		new simpleMDE({ 
			renderingConfig: {
				codeSyntaxHighlighting: true
			},

			toolbar: [
				'bold', 'italic', 'code', 'quote', '|',
				'unordered-list', 'ordered-list', '|',
				'link', 'image', 'table', '|',
				'preview', 'side-by-side', 'fullscreen', '|',
				{
					name: 'save',
					title: 'Save Page',
					className: 'fa fa-save',
					action: function(editor) {
						$(editor.element).parents('form').submit();
					},
				}
			],

			// Autosaving / element binding based on create / update
			// It differs on update since the page has an id already
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