<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Mi agenda - Healthy Pets</title>
  <<link rel="stylesheet" href="{{ asset('css/global.css') }}">
  <link rel="stylesheet" href="{{ asset('css/agenda.css') }}">
  <!-- Iconos -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
  <div class="app-container">
    <!-- Barra Lateral -->
    <aside class="sidebar">
      <div class="sidebar-logo">
        <div class="paw-icon-top"><i class="fa-solid fa-paw"></i></div>
        <div>
          <h2>Healthy Pets</h2>
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
      
      <!-- Cabecera Superior con Botones de Acción -->
      <header class="agenda-top-header">
        <div>
          <h1>Mi agenda</h1>
          <p>¡El cuidado y bienestar de las mascotas es nuestra prioridad!</p>
        </div>
        
      </header>

      <!-- Tarjetas de Estadísticas (Dinámicas o vacías) -->
      <div class="stats-row">
        <div class="stat-card">
          <div class="stat-icon"><i class="fa-regular fa-calendar-check"></i></div>
          <div class="stat-info">
            <h3 id="stat-citas-hoy">{{ $citasHoy }} citas hoy</h3>
            <span>Sin atenciones registradas</span>
          </div>
        </div>
        <div class="stat-card">
          <div class="stat-icon"><i class="fa-solid fa-dog"></i></div>
          <div class="stat-info">
            <h3 id="stat-en-espera">{{ $citasEnEspera }} en espera</h3>
            <span>Recepción vacía</span>
          </div>
        </div>
        <div class="stat-card">
          <div class="stat-icon"><i class="fa-regular fa-clock"></i></div>
          <div class="stat-info">
            <h3>Horas de consulta</h3>
            <span>Jornada de ..</span>
          </div>
        </div>
      </div>

      <!-- Sección Principal de Agenda (Contenedor vacío listo para JS / Base de Datos) -->
      <div class="right-agenda-column full-width">
        <div class="agenda-toolbar">
          <div class="agenda-title-date">
            <h2>Mi agenda</h2>
            <span id="mes-actual-label">Noviembre 2026</span>
          </div>
          <div class="agenda-views">
            <button class="view-btn active">Día</button>
            <button class="view-btn">Semana</button>
            <button class="view-btn">Mes</button>
          </div>
        </div>

        <!-- Selector de Días de la Semana -->
        <div class="days-selector">
          <button class="arrow-btn"><i class="fa-solid fa-chevron-left"></i></button>
          <div class="day-item"><small>Lun</small><b>12</b></div>
          <div class="day-item"><small>Mar</small><b>13</b></div>
          <div class="day-item"><small>Mié</small><b>14</b></div>
          <div class="day-item active"><small>Jue</small><b>15</b></div>
          <div class="day-item"><small>Vie</small><b>16</b></div>
          <div class="day-item"><small>Sáb</small><b>17</b></div>
          <div class="day-item"><small>Dom</small><b>18</b></div>
          <button class="arrow-btn"><i class="fa-solid fa-chevron-right"></i></button>
        </div>

        <!-- Sub-cabecera del día seleccionado -->
        <strong>{{ \Carbon\Carbon::now()->translatedFormat('l, d \d\e F') }}</strong> <span class="badge badge-today">Hoy</span>
          <div class="agenda-filters">
            <span id="contador-citas-dia">{{ $citas->count() }} citas</span>
            <button class="filter-dropdown-btn"><i class="fa-solid fa-sliders"></i> Todos los estados</button>
          </div>
        </div>

        <!-- LISTADO VACÍO (Aquí se inyectarán las citas mediante JavaScript o tu Backend) -->
        <div id="contenedor-agenda-dinamica" class="agenda-list">
          <!-- Mensaje predeterminado cuando no hay citas -->
         <!-- LISTADO DINÁMICO DE CITAS -->
                <div id="contenedor-agenda-dinamica" class="agenda-list">
                    @forelse ($citas as $cita)
                        <div class="agenda-card" style="background: #fff; border: 1px solid #e5e7eb; border-radius: 10px; padding: 14px; margin-bottom: 12px;">
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <strong>{{ \Carbon\Carbon::parse($cita->fecha_hora)->format('d/m/Y h:i A') }}</strong>
                                <span class="badge">{{ ucfirst($cita->estado) }}</span>
                            </div>
                            <p style="margin: 6px 0 0;">
                                <strong>Paciente:</strong> {{ $cita->mascota_nombre }} ({{ $cita->especie }}) —
                                <strong>Servicio:</strong> {{ $cita->nombre_servicio }}
                            </p>
                            <small style="color: #6b7280;">
                                Veterinario: Dr(a). {{ $cita->vet_nombre }} {{ $cita->vet_apellidos }}
                            </small>
                        </div>
                    @empty
                        <div class="empty-state-agenda" style="text-align: center; padding: 40px; color: #888;">
                            <i class="fa-regular fa-calendar-xmark" style="font-size: 3rem; margin-bottom: 10px; color: #b5838d;"></i>
                            <p>No hay citas programadas para este día.</p>
                        </div>
                    @endforelse
                </div>

        <!-- Pie de Agenda -->
        <div class="agenda-footer-bar">
          <span><i class="fa-regular fa-clock"></i> Próximo horario disponible: <strong id="proximo-horario">--:--</strong></span>
          <a href="#" class="link-disponibilidad">Ver disponibilidad <i class="fa-solid fa-arrow-right"></i></a>
        </div>

      </div>

    </main>
  </div>
</body>
</html>