@if ($paginator->hasPages())
<nav class="pagination is-medium" role="navigation" aria-label="pagination">
  @if ($paginator->onFirstPage())
  <a class="pagination-previous is-disabled" title="This is the first page">Previous</a>
  @else
  <a href="{{ $paginator->previousPageUrl() }}" class="pagination-previous">Previous</a>
  @endif

  @if ($paginator->hasMorePages())
  <a href="{{ $paginator->nextPageUrl() }}" class="pagination-next">Next page</a>
  @else
  <a class="pagination-next is-disabled">Next page</a>
  @endif

  <ul class="pagination-list">
    @foreach ($elements as $element)
    @if (is_string($element))
    <li><span class="pagination-ellipsis">&hellip;</span></li>
    @endif

    @if (is_array($element))
    @foreach ($element as $page => $url)
    @if ($page == $paginator->currentPage())
    <li><a class="pagination-link is-current" aria-label="Page {{ $page }}" aria-current="page">{{ $page }}</a></li>
    @else
    <li><a href="{{ $url }}" class="pagination-link" aria-label="Goto page {{ $page }}">{{ $page }}</a></li>
    @endif
    @endforeach
    @endif
    @endforeach
  </ul>
</nav>
@endif

