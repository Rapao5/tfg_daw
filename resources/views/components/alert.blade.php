{{--
    Muestra un alert de bootstrap

    @param string   $errores           Obligatorio. Texto a mostrar
    @param string   $type              Opcional. Tipo de alerta (danger, success, warning, info). Por defecto 'danger'.
    @param string   $icon              Opcional. Icono de Bootstrap.
--}}

<div class="alert alert-{{ $type ?? 'danger' }} mt-3 d-flex align-items-center" role="alert">
    @if(isset($icon))
        <i class="{{ $icon }} me-2"></i>
    @endif
    <div>{!! $errores !!}</div>
</div>