<div class="container mx-auto w-3/4 pb-8 pt-2 px-2">
  <div class="w-4/5 mx-auto">
    <h3 class="text-center text-grey mb-4 font-bold">Comments? Suggestions?</h3>
    <div id="disqus_thread"></div>
  </div>
</div>
<script>
var disqus_config = function () {
  this.page.url = '{{ url()->current() }}';
  this.page.identifier = '{{ $page->id }}';
};
(function() {
var d = document, s = d.createElement('script');
s.src = 'https://406-io.disqus.com/embed.js';
s.setAttribute('data-timestamp', +new Date());
(d.head || d.body).appendChild(s);
})();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
                            