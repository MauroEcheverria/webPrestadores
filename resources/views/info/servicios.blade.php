@extends('layouts.base_1')
@section('title','ServiDCT | Página Principal')
@section('content')
<main>
  <div class="container px-4 py-5 about_cont_blog">
    <h2 class="pb-2 border-bottom" style="margin-bottom: 75px;">Cartera de Servicios</h2>
    <div class="row featurette">
      <div class="col-md-7">
        <h2 class="">A un paso de conocer cómo hacer crecer tu negocio.</h2>
        <p class="justificaTexto">
          Con más de 6 años de experiencia en el sistema hospitalario y financiero. En DreConsTec ponemos a su disposición toda una gama de aplicativos que tiene como fin agilizar y mejorar sus procesos en forma significativa.
        </p>
        <p class="justificaTexto">
          Todos nuestros sistemas poseen características responsive, las cuales permiten adaptarse a cualquier dispositivo móvil, de igual manera cuentan con monitoreo en tiempo real, envío de correo electrónico hacia sus clientes, además de poseer una fácil integración con televisores inteligentes, impresoras térmicas, matriciales y de manillas. Garantizando así facilidad de uso, flexibilidad, gestión de informes, portabilidad y más que todo seguridad en su información.
        </p>
        <p class="justificaTexto">
          Para el área de toma de decisiones todos nuestros aplicativos cuentan con la posibilidad de realizar descargas en los formatos ya conocidos Excel, PDF. Para la visualización de datos contamos con tableros proactivos los cuales permitirá que usted y su empresa tomen las mejores decisiones de manera ágil y asertiva.
          Contáctate con nosotros para analizar qué herramienta es la mejor opción para su negocio y así poder presentarle un presupuesto  que se acomode a su situación financiera.
        </p>
      </div>
      <div class="col-md-5">
        <img src="{{ asset('vendor/dct_sistema/dist/img/main/service/dreconstec_s4.jpg') }}" style="width:500px;">
      </div>
    </div>
    <hr class="featurette-divider">
    <div class="row featurette">
      <div class="col-md-7 order-md-2">
        <h2 class="">Sistema Hospitalario</h2>
        <h3>¿Qué podemos ofrecerte?</h3>
        <p class="justificaTexto"> Agilitaremos su flujo de procesos concernientes a pacientes, visitas hospitalarias, censo de camas, personal administrativo y médico e incluso a áreas como talento humano y financiero. Proveyéndoles de aplicativos que facilitaran su trabajo de manera asertiva a través de informes gerenciales para una toma de decisiones precisa y oportuna. </p>
        <h3 class="serLineaBloques">Módulos</h3>
        <ul>
          <li><i class="fa fa-check-circle"></i>Generación de Turnos - Atención al afiliados.</li>
          <li><i class="fa fa-check-circle"></i>Agendas de Servicios Médicos.</li>
          <li><i class="fa fa-check-circle"></i>Triajes para Emergencia.</li>
          <li><i class="fa fa-check-circle"></i>Inventarios de Insumos, Fármacos o Suministros.</li>
          <li><i class="fa fa-check-circle"></i>Requisiciones Internas o Externas.</li>
          <li><i class="fa fa-check-circle"></i>Formularios Epidemiológicos.</li>
          <li><i class="fa fa-check-circle"></i>Formularios Eventos Adversos.</li>
          <li><i class="fa fa-check-circle"></i>Salud Ocupacional.</li>
        </ul>
      </div>
      <div class="col-md-5 order-md-1">
        <img src="{{ asset('vendor/dct_sistema/dist/img/main/service/dreconstec_s4.jpg') }}" style="width:500px;">
      </div>
    </div>
      <hr class="featurette-divider">
      <div class="row featurette">
        <div class="col-md-7">
          <h2 class="">Sistemas de Citas Virtual</h2>
          <h3>Se ajusta a cualquier propósito</h3>
          <p class="justificaTexto"> Debido a la terrible situación que atravesamos por esta pandemia, los negocios se han visto afectados de gran manera y la comunicación la cual era algo cotidiano entre sus clientes, ahora se ha visto frenado por una pared invisible. Para ello los negocios deben tener un método efectivo en la que sus clientes tengan la posibilidad de agendar sus citas de manera personal y además virtual en los servicios que ofrecen. En Dreconstec tenemos la solución a este problema a través de agendas virtuales con envíos de correos electrónicos, las acoplan a cualquier tipo de negocio ofreciéndoles a sus clientes la posibilidad de escoger el día y hora en la cual puedan acudir a su negocio, sin complicaciones y desde la comodidad de su hogar. </p>
          <h3 class="serLineaBloques">Módulos</h3>
          <ul>
            <li><i class="fa fa-check-circle"></i>Calendario intuitivo para que tus citas tengan otro nivel.</li>
            <li><i class="fa fa-check-circle"></i>Reportería en tiempo real de las citas agendadas por tus clientes.</li>
            <li><i class="fa fa-check-circle"></i>Envío de correo electrónico tanto para sus clientes y su negocio.</li>
          </ul>
        </div>
        <div class="col-md-5">
          <img src="{{ asset('vendor/dct_sistema/dist/img/main/service/dreconstec_s4.jpg') }}" style="width:500px;">
        </div>
      </div>
      <hr class="featurette-divider">
      <div class="row featurette">
        <div class="col-md-7 order-md-2">
          <h2 class="">Área contable</h2>
          <h3>Para que lleves el control de tu negocio</h3>
          <p class="justificaTexto"> Llevar la contabilidad de tu negocio a otro nivel es la tarea de Dreconstec, imagina controlar tu negocio desde cualquier lugar y dispositivo móvil, en tiempo real y con dashboard intuitivos que te permitan darte cuenta con tan solo un vistazo de la situación financiera y logística de tu negocio. En Dreconstec estamos en la capacidad de hacer eso y mucho más. </p>
          <h3 class="serLineaBloques">Módulos</h3>
          <ul>
            <li><i class="fa fa-check-circle"></i>Sistema de Kardex</li>
            <li><i class="fa fa-check-circle"></i>Ventas y Facturación</li>
            <li><i class="fa fa-check-circle"></i>Inventario</li>
            <li><i class="fa fa-check-circle"></i>Roles de Pago</li>
            <li><i class="fa fa-check-circle"></i>Cuentas por Cobrar y Pagar</li>
            <li><i class="fa fa-check-circle"></i>Presupuestos</li>
            <li><i class="fa fa-check-circle"></i>Activos Fijos</li>
            <li><i class="fa fa-check-circle"></i>Seguridad y Administración</li>
            <li><i class="fa fa-check-circle"></i>Requisiciones Internas o Externas</li>
            <li><i class="fa fa-check-circle"></i>Proformas</li>
          </ul>
        </div>
        <div class="col-md-5 order-md-1">
          <img src="{{ asset('vendor/dct_sistema/dist/img/main/service/dreconstec_s4.jpg') }}" style="width:500px;">
        </div>
      </div>
      <hr class="featurette-divider">
      <div class="row featurette">
        <div class="col-md-7">
          <h2 class="">Minería de datos</h2>
          <h3>El poder de la información en tus manos</h3>
          <p class="justificaTexto"> Haz tenido hojas de Excel que ya no pueden con más información y deben recurrir a otra y por cosas de la vida se llega a perder o simplemente se daña el archivo y con el pierdes todas tu información. Por otro lado tiene una base de datos muy grande pero que no tienes el conocimiento de cómo modelarla o entenderla. Pues en Dreconstec tenemos a solución a este y muchos problemas que se desprenden de tener mucha información y no saber cómo tratarla. Para ellos tomaremos esa información de varios canales, medios o base de datos que posea su negocio, la procesaremos, organizaremos y luego se las presentaremos en tableros o dashboard los cuales serán de fácil análisis parar una toma de decisión pronta y oportuna para su negocio. </p>
          <h3 class="serLineaBloques">Módulos</h3>
          <ul>
            <li><i class="fa fa-check-circle"></i>Ingesta de datos</li>
            <li><i class="fa fa-check-circle"></i>Procesamientos de datos</li>
            <li><i class="fa fa-check-circle"></i>Visualización de datos (Tableros en tiempo real )</li>
            <li><i class="fa fa-check-circle"></i>Informes por correo electrónico</li>
          </ul>
        </div>
        <div class="col-md-5">
          <img src="{{ asset('vendor/dct_sistema/dist/img/main/service/dreconstec_s4.jpg') }}" style="width:500px;">
        </div>
      </div>
  </div>
</main>
@endsection