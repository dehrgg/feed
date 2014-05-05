@foreach($scripts as $script)
  @if( isset($script['external']) )
    <script src="{{ $script['external'] }}"></script>
  @elseif(isset($script['internal']))
    <script src="{{ asset($script['internal']) }}"></script>
  @endif

  @if( isset($script['conditional']) && isset($script['check']) )
    <script>
      window.{{$script['check']}} || document.write("\x3Cscript src=\"{{ asset($script['conditional']) }}\">\x3C/script>");
    </script>
  @endif
@endforeach