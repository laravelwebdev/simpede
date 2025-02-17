<script>
    document.addEventListener('DOMContentLoaded', function() {
      var searchInput = document.getElementById('input-cari');
      var searchButton = document.getElementById('tombol-cari');
    
      function updateURL() {
        var search = searchInput.value;
        var url = new URL(window.location.href);
        url.searchParams.set('search', search);
        url.searchParams.delete('page');
        window.location.href = url.toString();
      }
    
      searchButton.addEventListener('click', updateURL);
    
      searchInput.addEventListener('keypress', function(event) {
        if (event.key === 'Enter') {
          updateURL();
        }
      });
    
      var urlParams = new URLSearchParams(window.location.search);
      var search = urlParams.get('search');
      if (search) {
        searchInput.value = search;
      }
    });
</script>