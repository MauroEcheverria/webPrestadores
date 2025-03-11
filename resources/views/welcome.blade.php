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
        <img src="{{ asset('vendor/dct_sistema/dist/img/main/service/slide2.png') }}" width="30px" heigth="20px">
        <div class="container">
          <div class="carousel-caption">
            <h1>DashBoard Proactivos</h1>
            <p>Para la Toma de Decisiones</p>
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <img src="{{ asset('vendor/dct_sistema/dist/img/main/service/slide3.png') }}" width="30px" heigth="20px">
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

  <div class="album py-5 bg-light">
    <div class="container">
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        <div class="col">
          <div class="card shadow-sm">
            <img src="{{ asset('vendor/dct_sistema/dist/img/main/service/dreconstec_s6.jpg') }}">
            <div class="card-body">
              <h3>Desarrollo de Software, acorde a tus necesidades.</h3>
              <p class="card-text" style="padding-bottom: 38px;">En Dreconstec entendemos tus necesidades y buscamos una solución a las mismas, automatizando y mejorando sus procesos en línea incluso en tiempo real.</p>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card shadow-sm">
            <img src="{{ asset('vendor/dct_sistema/dist/img/main/service/dreconstec_s7.jpg') }}">
            <div class="card-body">
              <h3>Data Mining</h3>
              <p class="card-text" style="">Entendemos lo valioso que es tu información, por ese motivo Dreconstec pone a tu disposición la poderosa herramienta de Minería de Datos. Con el cual analizaremos, depuramos y ordenaremos tu información para que sea visualizada en tableros inteligentes, para que así tú solo debas tomar las mejores decisiones para tu empresa.</p>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card shadow-sm">
            <img src="{{ asset('vendor/dct_sistema/dist/img/main/service/dreconstec_s4.jpg') }}">
            <div class="card-body">
              <h3>Que deseamos?</h3>
              <p class="card-text" style="padding-bottom: 48px;">En DreConsTec queremos que tu día a día sea más sencillo, seguro y sin complicaciones, por ese motivo traemos soluciones informáticas que automatizan sus procesos y acortan sus tiempos de entrega. Para que así disfrutes más tiempo con los tuyos.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="container px-4 py-5">
    <h2 class="pb-2 border-bottom">Nuestros Servicios</h2>
    <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
      <div class="feature col">
        <div class="feature-icon bg-primary bg-gradient dct_color_blue">
          <i class="fa-regular fa-hospital"></i>
        </div>
        <h2>Sistemas Hospitalarios</h2>
      </div>
      <div class="feature col">
        <div class="feature-icon bg-primary bg-gradient dct_color_blue">
          <i class="fa-solid fa-notes-medical"></i>
        </div>
        <h2>Salud Ocupacional</h2>
      </div>
      <div class="feature col">
        <div class="feature-icon bg-primary bg-gradient dct_color_blue">
          <i class="fa-solid fa-chart-simple"></i>
        </div>
        <h2>DashBoard Intuitivos</h2>
      </div>
    </div>
  </div>

  <div class="container px-4 py-5 contactanos_main">
    <div class="row">
      <div class="col-md-12">
        <div class="full">
          <div class="contact_us_section">
            <div class="call_icon"> 
              <img src="{{ asset('vendor/dct_sistema/dist/img/main/service/phone_icon.png') }}">
            </div>
            <div class="inner_cont">
              <h2 class="h2_20px">Solicite una cotización sin costo alguno.</h2>
              <p>Obtén respuestas y consejos a tus dudas.</p>
            </div>
            <div class="button_Section_cont"> <a class="btn dark_gray_bt" href="contactanos/">Contáctanos</a> </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="container px-4 py-5" style="padding-bottom: 0 !important;">
    <h2 class="pb-2 border-bottom">Nuestros Clientes</h2>
    <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
      <div class="feature col">
        <img src="{{ asset('vendor/dct_sistema/dist/img/main/service/dct_rehi.png') }}">
      </div>
      <div class="feature col">
        <img src="{{ asset('vendor/dct_sistema/dist/img/main/service/dct_meditategy.png') }}">
      </div>
      <div class="feature col">
        <img src="{{ asset('vendor/dct_sistema/dist/img/main/service/dct_global.png') }}">
      </div>
    </div>
  </div>

</main>
@endsection