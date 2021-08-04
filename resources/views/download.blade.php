@include('layouts.header')
<section class="section-subscribe">
  
  <div class="row">
    <div class="card__left-side">
        <img src="{{url('encryptionPhoto.jpg')}}" alt="" class="card__img">
    </div>
    <div class="card__right-side">
       <h2 class="card__title">Click on the linke to download the File TO PC</h2>
    <p class="card__text">
      <a class="card__button" href="{{$file}}" download>
        Dowload Here File
      </a>    </p>
      <p class="card__text">
      <a class="card__button backHome"  href="/" >
       Back To Main Page
      </a>  
      </p>
    </div>
 
    </div>
  </div>
</section>
@include('layouts.footer')
