<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
  integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="shortcut icon" href="https://img.icons8.com/?size=100&id=7LhMaNDFgoYK&format=png&color=000000"
  type="image/x-icon">
  <link rel="stylesheet" href="{{url('/css/style.css')}}">
  <title>{{ $title ?? 'ChronoJournal - Write journals and keep them safe and secure - We use end to end encryption' }}</title>
  @livewireStyles
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>

<body class="">
  {{-- @include('components.header') --}}
  
  @livewire('header')
  <div style="min-height: 69.1vh;">
    {{ $slot }}
  </div>
  @include('components.footer')
  @livewireScripts
  <script src="{{url('/js/activityDetector.js')}}"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
<script src="{{asset('/js/script.js')}}"></script>
</body>

</html>
