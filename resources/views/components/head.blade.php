<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>{{ config('app.name') }}</title>
	<link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
	<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
	@vite(['resources/css/app.css', 'resources/js/app.js'])
	<script src="https://kit.fontawesome.com/285c1d0655.js" crossorigin="anonymous"></script>
</head>