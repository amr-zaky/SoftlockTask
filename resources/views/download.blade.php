@include('layouts.header')

<p>Click on the linke  to download the File To your PC<p>

<a href="{{$file}}" download>
  Dowload Here {{$file}}
</a>

@include('layouts.footer')
