
<h1 data-id="11" class="link" >gh</h1>
<h1 data-id="12" class="link">fg</h1>

<script>
document.querySelectorAll('.link').forEach(function(link) {
    link.addEventListener('click', function() {
        console.log(this.getAttribute('data-id'));
    });
});
</script>

