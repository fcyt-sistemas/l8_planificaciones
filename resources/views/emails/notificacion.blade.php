@component('mail::message')
# Introduction

<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>Sus cambios han sido actualizados correctamente</title>
</head>
<body>
    <p>¡Hola! Se han realizado cambios en su cuenta, si no fuiste tú, por favor informarnos inmediatamente.</p>
   
 </body>
 </html>

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent