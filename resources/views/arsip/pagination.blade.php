@if ($paginator->hasPages())
<div class="notification">
  <div class="level">
    <div class="level-left">
      <div class="level-item">
        <div class="buttons has-addons">
          @foreach ($elements as $element)
          @if (is_array($element))
          @foreach ($element as $page => $url)
          @if ($page == $paginator->currentPage())
          <button type="button" class="button is-active">{{ $page }}</button>
          @else
          <button onclick="window.location.href='$url'" type="button" class="button">{{ $page }}</button>
          @endif
          @endforeach
          @endif
          @endforeach
        </div>
      </div>
    </div>
  </div>
</div>
@endif