<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Healthy Pets - Mis Citas</title>
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/citas.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

<div class="app-container">
    <!-- Barra Lateral -->
    <aside class="sidebar">
        <div class="sidebar-logo">
        <div class="paw-icon-top"><i class="fa-solid fa-paw"></i></div>
            <div>
                <h1>Healthy Pets</h1>
                <span>Clínica Veterinaria</span>
            </div>
        </div>

       <nav class="sidebar-nav">
    <!-- Botón Inicio (Casita) -> Redirige al Login -->
    <a href="{{ route('login') }}" class="nav-item">
        <i class="fa-solid fa-house"></i> <span>Inicio</span>
    </a>

    <!-- Botón Agendar cita (Calendario) -> Redirige al index -->
    <a href="{{ route('home') }}" class="nav-item">
        <i class="fa-regular fa-calendar-days"></i> <span>Agendar cita</span>
    </a>

    <!-- Botón Mis citas -> Redirige a la vista de citas -->
    <a href="{{ route('citas') }}" class="nav-item">
        <i class="fa-solid fa-list-check"></i> <span>Mis citas</span>
    </a>

    <!-- Botón Agenda -> Se mantiene en la agenda -->
    <a href="{{ route('agenda') }}" class="nav-item">
        <i class="fa-solid fa-calendar-week"></i> <span>Agenda</span>
    </a>

      </nav>
    </aside>

    <!-- Contenido Principal -->
    <main class="main-content">
        <header class="top-header">
            <div class="user-profile"><span>👤 Usuario</span></div>
        </header>

        <div class="form-container-wrapper" style="padding: 40px;">
            <h2>Mis Citas Registradas</h2>
            <p>Aquí podrás visualizar el historial de las citas de tus mascotas.</p>
            <!-- Contenedor del listado -->
            <div id="lista-citas" style="background: white; padding: 20px; border-radius: 12px; margin-top: 20px;">
                <p>No hay citas registradas todavía.</p>
            </div>
        </div>
    </main>
</div>
</body>
</html>

