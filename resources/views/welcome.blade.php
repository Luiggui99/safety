<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Safety Mindset</title>

    <!-- Fonts -->

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>

<body>
    {{-- inicion navbar --}}
    <header class="header">
        <a href="#" class="logo">
            <img src="{{ asset('images/logo.png') }}" width="120" alt="logo_safety">
        </a>

        <input type="checkbox" id="check">
        <label for="check" class="icons">
            <i class='bx bx-menu' id="menu-icon"></i>
            <i class='bx bx-x' id="close-icon"></i>
        </label>

        <nav class="navbar">
            @foreach ($menus as $index => $menu)
                <a href="{{ $menu->url_enlace }}" style="--i:{{ $index }};">{{ $menu->texto_enlace }}</a>
            @endforeach
            <div class="list-icons-red-social">
                @foreach ($redesSociales as $redSocial)
                    <div>
                        <a href="{{ $redSocial->url }}" target="_blank">
                            <i class="{{ $redSocial->icono }}"></i>
                        </a>
                    </div>
                @endforeach
            </div>
        </nav>
    </header>
    {{-- fin navbar --}}

    {{-- incio banner --}}
    <div id="inicio" class="slider">
        <div class="banner">
            @foreach ($banners as $banner)
                <div class="item">
                    <img src="{{ asset('storage/' . $banner->imagen_url) }}" alt="{{ $banner->imagen_alt }}"/>
                    <div class="banner-text">
                        @if (!is_null($banner->texto_principal))
                            <div>{{ $banner->texto_principal }}</div>
                        @endif
                        @if (!is_null($banner->texto_secundario))
                            <div>{{ $banner->texto_secundario }}</div>
                        @endif
                        @if (!is_null($banner->boton_texto))
                            <a class="btn bg-secondary" href="{{ $banner->boton_url }}" target="_blank"><i
                                    class="{{ $banner->boton_icono }}"></i> {{ $banner->boton_texto }}</a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        @php
            $total_banners = count($banners);
        @endphp
        @if ($total_banners > 1)
            <div class="buttons">
                <button id="prev"><i class='bx bxs-left-arrow'></i></button>
                <button id="next"><i class='bx bxs-right-arrow'></i></button>
            </div>
        @endif
        <ul class="dots">
            @foreach ($banners as $index => $banner)
                @if ($index == 0)
                    <li class="active"></li>
                @else
                    <li></li>
                @endif
            @endforeach
        </ul>
    </div>
    {{-- fin banner --}}

    {{-- se lista todas las secciones y se define un unico diseño en cada seccion --}}
    @foreach ($sections as $index => $section)
        {{-- se defini si la seccion esta enlazada al menu: si esta enlazado se define el id caso contrario no se declara --}}
        @if (isset($section->section_id))
            <section id="{{ substr($section->menu->url_enlace, 1) }}" class="section section-{{ $section->nombre }}" style="background: {{ $section->background }}">
        @else
            <section class="section section-{{ $section->nombre }}" style="background: {{ $section->background }}">
        @endif

        {{-- se define si la seccion principal cuenta con una imagen: se uso para la seccion de valores --}}
        @if (!is_null($section->section_titulo) && is_null($section->imagen))
            <div class="section-title">{{ $section->section_titulo }}</div>
        @elseif (!is_null($section->section_titulo) && !is_null($section->imagen))
            <div class="img-content-{{$section->nombre}}">
                <img class="img-main-{{ $section->nombre }}" src="{{ asset('storage/' . $section->imagen) }}" alt="">
                <div class="">
                    {{ $section->section_titulo }}
                </div>
            </div>
        @endif

        {{-- se define los sub items de cada seccion: condicionando el estilo de acuerdo a la seccion principal mediante condicionales --}}
        <div class="section-items-{{ $section->nombre }}">
            @foreach ($section->section_items as $index_2 => $item)
                @if ($index == 0)
                    <div class="body-{{ $section->nombre }}">
                        <div>
                            @if (!is_null($item->titulo))
                                <div class="section-title">{{ $item->titulo }}</div>
                            @endif
                            @if (!is_null($item->contenido))
                                {!! $item->contenido !!}
                            @endif
                            @if (!is_null($item->boton_nombre))
                                <div class="mt-8">
                                    <a class="btn" href="{{ $item->boton_url }}" target="_blank"
                                        style="background-color: {{ $item->boton_color }}">{{ $item->boton_nombre }}
                                        {!! $item->boton_icon !!}</a>
                                </div>
                            @endif
                        </div>
                        @if (!is_null($item->imagen))
                            <img class="border-img-v1" src="{{ asset('storage/' . $item->imagen) }}" width="450" alt="">
                        @endif
                    </div>
                @endif
                @if ($index == 1)
                    <blockquote>
                        @if (!is_null($item->contenido))
                            <div class="body-{{ $section->nombre }}"> {!! $item->contenido !!} </div>
                        @endif
                    </blockquote>
                @endif
                @if ($index == 2)
                    <div class="row">
                        <div class="col-5">
                            @if (!is_null($item->imagen))
                                <img class="img-{{ $section->nombre }}" src="{{ asset('storage/' . $item->imagen) }}" alt="">
                            @endif
                        </div>
                        <div class="col-7 content-{{ $section->nombre }}">
                            @if (!is_null($item->contenido))
                                @if (!is_null($item->titulo))
                                    <div class="section-title">{{ $item->titulo }}</div>
                                @endif
                                <div class="text-contenido-{{ $section->nombre }}">
                                    {!! $item->contenido !!}
                                </div>
                            @endif
                        </div>
                    </div>
                @endif
                @if ($index == 3)
                    <div class="card-{{ $section->nombre }}">
                        @if (!is_null($item->imagen))
                            <img src="{{ asset('storage/' . $item->imagen) }}" alt="">
                        @endif
                        <div>
                            @if (!is_null($item->titulo))
                                <div class="section-title-{{ $section->nombre }}">{{ $item->titulo }}</div>
                            @endif
                            @if (!is_null($item->descripcion))
                                <div>{{ $item->descripcion }}</div>
                            @endif
                            @if (!is_null($item->contenido))
                                <div class="list-{{ $section->nombre }}">{!! $item->contenido !!}</div>
                            @endif
                        </div>
                    </div>
                @endif
                @if ($index == 4)
                    <div class="card-{{ $section->nombre }}" style="background-color: {{ $item->section_background }}">
                        @if (!is_null($item->titulo))
                            <span class="section-title-{{ $section->nombre }}">{{ $item->titulo }}</span>
                        @endif
                        @if (!is_null($item->descripcion))
                            <div>{{ $item->descripcion }}</div>
                        @endif
                        @if (!is_null($item->contenido))
                            <div class="list-{{ $section->nombre }}" >{!! $item->contenido !!}</div>
                        @endif
                    </div>
                @endif
                @if ($index == 5)
                    <div class="card-{{ $section->nombre }}" style="background-color: {{ $item->section_background }}">
                        @if (!is_null($item->imagen))
                            <img src="{{ asset('storage/' . $item->imagen) }}" alt="">
                        @endif
                        @if (!is_null($item->titulo))
                            <span class="section-title-{{ $section->nombre }}">{{ $item->titulo }}</span>
                        @endif
                        @if (!is_null($item->descripcion))
                            <div class="descripcion-{{$section->nombre}}" >{{ $item->descripcion }}</div>
                        @endif
                        @if (!is_null($item->contenido))
                            <div class="list-{{ $section->nombre }}" >{!! $item->contenido !!}</div>
                        @endif
                    </div>
                @endif
                @if ($index == 6)
                    <div class="logos">
                        <div class="slider-logos">
                            @foreach ($clientes as $cliente)
                                <img src="{{ asset('storage/' . $cliente->imagen) }}" alt="">
                            @endforeach
                        </div>
                    </div>
                @endif
                @if ($index == 7)
                    <div class="flex items-center">
                        <div class="col-4">
                            <div class="section-title">{{ $item->titulo }}</div>
                            <div class="mt-3 descripcion-{{$section->nombre}}">{{ $item->descripcion }}</div>
                        </div>
                        <form class="col-8" id="form_contact">
                            @csrf
                            <div class="row">
                                @foreach ($formulario as $form)
                                    <div class=" {{ $form->tipo == 1 ? 'col-6' : 'col-12' }}">
                                        <label class="form-label" for="{{ $form->identificador }}">{{ $form->nombre }} @if($form->requerido) (*) @endif</label> <br>
                                        <input class="form-input" type="{{ $form->tipo_campo }}" id="{{ $form->identificador }}" name="{{ $form->identificador }}" placeholder="{{ $form->placeholder }}" {{ $form->requerido ? 'required' : '' }}">
                                    </div>
                                @endforeach
                                <div class="col-12 form-label mb-4">
                                    <input type="checkbox" required> He leído y acepto la política de privacidad.
                                </div>
                                <div class="col-12">
                                    <button class="form-btn" type="submit">Enviar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                @endif
            @endforeach
        </div>
        </section>
    @endforeach


    <footer class="px-12 pb-10 pt-20 text-white font-light" style="background-color: {{ $footer->background }}">
        <div class="flex gap-x-12 justify-around">
            <div>
                <img src="{{ asset('storage/' . $footer->imagen) }}" alt="footer_logo">
            </div>
            <div class="flex flex-col gap-4">
                @foreach ($footer->informacion as $info)
                    <div> {{ $info['nombre'] }} </div>
                @endforeach
            </div>
            <div>
                <div>Siguenos en nuestras redes: </div>
                <div class="list-icons-red-social">
                    @foreach ($redesSociales as $redSocial)
                        <div>
                            <a href="{{ $redSocial->url }}" target="_blank">
                                <i class="{{ $redSocial->icono }}"></i>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="w-full pt-20 flex justify-center">
            <div class="footer-copy text-center pt-8" style="width: 70%;"> {{ $footer->copyright }} </div>
        </div>
    </footer>
</body>
{{-- <script src="{{ asset('js/app.js') }}"></script> --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#form_contact').submit(function(e) {
            e.preventDefault();

            var formData = $(this).serialize();

            $.ajax({
                url: '/send_form',
                type: 'POST',
                data: formData,
                success: function(response) {
                    $('#mensaje').html('<p>Formulario enviado correctamente.</p>');
                    console.log(response);
                },
                error: function(xhr, status, error) {
                    $('#mensaje').html('<p>Hubo un error al enviar el formulario.</p>');
                    console.log(xhr.responseText);
                }
            });
        });
    });
    </script>

</html>
