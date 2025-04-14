<div>
    @props(['data'])
    @if (isset($data) && count($data) > 0)
        {{$slot}}
    {{-- @foreach ($data as $key => $item)
        @endforeach --}}
    @else
        <div class="alert alert-danger">No Data Found !</div>
    @endif    
</div>