@extends('layouts.base_1')
@section('title','ServiDCT | Página Principal')
@section('content')
<main>
  
  <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="{{ asset('vendor/dct_sistema/dist/img/main/service/slide1.png') }}" width="30px" heigth="20px">
          <div class="container">
              <div class="carousel-caption text-start">
              <h1>Desarrollo de Software</h1>
              <p>Acorde a tus Necesidades</p>
              </div>
          </div>
        </div>
        <div class="carousel-item">
        <img src="{{ asset('vendor/dct_sistema/dist/img/main/service/slide2.jpg') }}" width="30px" heigth="20px">
          <div class="container">
              <div class="carousel-caption">
              <h1>DashBoard Proactivos</h1>
              <p>Para la Toma de Decisiones</p>
              </div>
          </div>
        </div>
        <div class="carousel-item">
        <img src="{{ asset('vendor/dct_sistema/dist/img/main/service/slide3.jpg') }}" width="30px" heigth="20px">
        <div class="container">
            <div class="carousel-caption text-end">
            <h1>Data Mining</h1>
            <p>Para Sacar el Mayor Provecho a tus Datos</p>
            </div>
        </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
  </div>

  <div class="container marketing">
    <div class="row featurette">
      <div class="col-md-7">
        <h2 class="featurette-heading">Desarrollo de Software, acorde a tus necesidades.
        <p class="lead">En Dreconstec entendemos tus necesidades y buscamos una solución a las mismas, automatizando y mejorando sus procesos en línea incluso en tiempo real.</p>
      </div>
      <div class="col-md-5">
        <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 500x500" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#eee"/><text x="50%" y="50%" fill="#aaa" dy=".3em">500x500</text></svg>
      </div>
    </div>
    <hr class="featurette-divider">
    <div class="row featurette">
      <div class="col-md-7 order-md-2">
        <h2 class="featurette-heading">Data Mining
        <p class="lead">Entendemos lo valioso que es tu información, por ese motivo Dreconstec pone a tu disposición la poderosa herramienta de Minería de Datos. Con el cual analizaremos, depuramos y ordenaremos tu información para que sea visualizada en tableros inteligentes, para que así tú solo debas tomar las mejores decisiones para tu empresa.</p>
      </div>
      <div class="col-md-5 order-md-1">
        <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 500x500" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#eee"/><text x="50%" y="50%" fill="#aaa" dy=".3em">500x500</text></svg>
      </div>
    </div>
    <hr class="featurette-divider">
    <div class="row featurette">
      <div class="col-md-7">
        <h2 class="featurette-heading">And lastly, this one.
        <p class="lead">And yes, this is the last block of representative placeholder content. Again, not really intended to be actually read, simply here to give you a better view of what this would look like with some actual content. Your content.</p>
      </div>
      <div class="col-md-5">
        <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 500x500" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#eee"/><text x="50%" y="50%" fill="#aaa" dy=".3em">500x500</text></svg>
      </div>
    </div>
  </div>
  
  <div class="container px-4 py-5" id="featured-3">
    <h2 class="pb-2 border-bottom">Nuestros Servicios</h2>
    <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
      <div class="feature col">
        <div class="feature-icon bg-primary bg-gradient">
          <i class="fa-regular fa-hospital"></i>
        </div>
        <h2>Sistemas Hospitalarios</h2>
        </div>
        <div class="feature col">
        <div class="feature-icon bg-primary bg-gradient">
          <i class="fa-solid fa-notes-medical"></i>
        </div>
        <h2>Salud Ocupacional</h2>
        </div>
        <div class="feature col">
        <div class="feature-icon bg-primary bg-gradient">
          <i class="fa-solid fa-chart-simple"></i>
        </div>
        <h2>DashBoard Intuitivos</h2>
      </div>
    </div>
  </div>
</main>
@endsection