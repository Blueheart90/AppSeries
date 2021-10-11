<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="min-h-screen font-sans antialiased bg-gradient-to-r from-teal-400 to-blue-500">

		<!-- Page Content -->
		<div class="font-sans antialiased text-gray-900">
			<!--Nav-->	
			<nav x-data="{ open: false }" id="header" class="fixed top-0 z-30 w-full text-white">
				<div class="container flex flex-wrap items-center justify-between w-full py-2 mx-auto mt-0">
					<div class="flex items-center pl-4">
						<a class="text-2xl font-bold text-white no-underline toggleColour hover:no-underline lg:text-3xl" href="#">
							<svg xmlns="http://www.w3.org/2000/svg" class="inline h-8 "  viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
								<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
								<rect x="3" y="7" width="18" height="13" rx="2"></rect>
								<polyline points="16 3 12 7 8 3"></polyline>
							</svg>
							SeriesApp
						</a>
					</div>
					<!-- Hamburger -->
					<div class="block pr-4 sm:hidden">
						<button @click="open = ! open" class="inline-flex items-center justify-center p-2 text-white transition duration-150 ease-in-out rounded-md toggleColour ">
							<svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
								<path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
								<path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
							</svg>
						</button>
					</div>
					<div class="z-20 hidden w-full p-0 mt-2 text-black sm:flex sm:items-center sm:w-auto sm:mt-0 sm:bg-transparent " id="nav-content">
						<ul class="">

							@if (Route::has('login'))
								<li class="mr-3">
									@auth
										<a class="inline-block px-4 py-2 font-bold text-white no-underline toggleColour" href="{{ url('/series') }}" class="">{{ __('Go Home') }}</a>
									@else
										<a class="inline-block px-4 py-2 font-bold text-white no-underline toggleColour" href="{{ route('login') }}" class="">{{ __('Login') }}</a>

										@if (Route::has('register'))
											<a class="inline-block px-4 py-2 font-bold text-white no-underline toggleColour" href="{{ route('register') }}" class="ml-4 ">{{ __('Register') }}</a>
										@endif
									@endauth
								</li>
							@endif

						</ul>
					</div>						
				</div>
				<div :class="{'flex': open, 'hidden': ! open}" class="z-20 w-full p-0 mt-2 text-black bg-white sm:hidden" >
					<ul class="items-center justify-end flex-1 list-reset ">
						@if (Route::has('login'))
							<li class="flex justify-end mr-3">
								@auth
									<a class="inline-block px-4 py-2 font-bold no-underline " href="{{ url('/series') }}" class="">{{ __('Go Home') }}</a>
								@else
									<a class="inline-block px-4 py-2 font-bold no-underline " href="{{ route('login') }}" class="">{{ __('Login') }}</a>

									@if (Route::has('register'))
										<a class="inline-block px-4 py-2 font-bold no-underline " href="{{ route('register') }}" class="ml-4 ">{{ __('Register') }}</a>
									@endif
								@endauth
							</li>
						@endif

					</ul>
				</div>
				<hr class="py-0 my-0 border-b border-gray-100 opacity-25" />
					
				
			</nav>

			<!--Hero-->
			<div class="p-20 text-white ">
				<div class="container flex flex-col flex-wrap items-center px-3 mx-auto md:flex-row">
					<!--Left Col-->
					<div class="flex flex-col items-start justify-center w-full text-center md:w-2/5 md:text-left">
						<p class="w-full uppercase tracking-loose">
							Organiza tu entretenimiento
						</p>
						<h1 class="my-4 text-5xl font-bold leading-tight">
							Lleva el control de tus series y peliculas
						</h1>
						<p class="mb-2 text-2xl leading-normal ">
							Comparte tus opiniones, califica y crea tus propias listas.
						</p>
						<p class="mb-8 text-2xl leading-normal">
							Millones de películas y programas de televisión por descubrir. Explora ahora.
						</p>
						<a href="{{ route('register') }}">
							<button class="px-8 py-4 mx-auto my-6 font-bold text-gray-800 transition duration-300 ease-in-out transform bg-white rounded-full shadow-lg lg:mx-0 hover:underline focus:outline-none focus:shadow-outline hover:scale-105">
								¡Probarlo!
							</button>
						</a>
					</div>
					<!--Right Col-->
					<div 
						class="hidden w-full text-center sm:block py-15 md:w-3/5" 
						style="background: url({{ asset('/storage/svg/blob.svg') }}) center center / cover no-repeat;"
					>
						<img class="z-50 w-full md:w-4/5" src="{{ Storage::url('img/cherry-horror-film.png') }}" alt="peaple watching tv">
					</div>
				</div>
			</div>
			<!--Waves svg-->
			<div class="-mt-4 lg:-mt-24">
				<svg viewBox="0 0 1428 174" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
					<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
						<g transform="translate(-2.000000, 44.000000)" fill="#FFFFFF" fill-rule="nonzero">
							<path d="M0,0 C90.7283404,0.927527913 147.912752,27.187927 291.910178,59.9119003 C387.908462,81.7278826 543.605069,89.334785 759,82.7326078 C469.336065,156.254352 216.336065,153.6679 0,74.9732496" opacity="0.100000001"></path>
							<path
								d="M100,104.708498 C277.413333,72.2345949 426.147877,52.5246657 546.203633,45.5787101 C666.259389,38.6327546 810.524845,41.7979068 979,55.0741668 C931.069965,56.122511 810.303266,74.8455141 616.699903,111.243176 C423.096539,147.640838 250.863238,145.462612 100,104.708498 Z"
								opacity="0.100000001"
							></path>
							<path d="M1046,51.6521276 C1130.83045,29.328812 1279.08318,17.607883 1439,40.1656806 L1439,120 C1271.17211,77.9435312 1140.17211,55.1609071 1046,51.6521276 Z" id="Path-4" opacity="0.200000003"></path>
						</g>
						<g transform="translate(-4.000000, 76.000000)" fill="#FFFFFF" fill-rule="nonzero">
							<path
								d="M0.457,34.035 C57.086,53.198 98.208,65.809 123.822,71.865 C181.454,85.495 234.295,90.29 272.033,93.459 C311.355,96.759 396.635,95.801 461.025,91.663 C486.76,90.01 518.727,86.372 556.926,80.752 C595.747,74.596 622.372,70.008 636.799,66.991 C663.913,61.324 712.501,49.503 727.605,46.128 C780.47,34.317 818.839,22.532 856.324,15.904 C922.689,4.169 955.676,2.522 1011.185,0.432 C1060.705,1.477 1097.39,3.129 1121.236,5.387 C1161.703,9.219 1208.621,17.821 1235.4,22.304 C1285.855,30.748 1354.351,47.432 1440.886,72.354 L1441.191,104.352 L1.121,104.031 L0.457,34.035 Z"
							></path>
						</g>
					</g>
				</svg>
			</div>

			<!--Cards-->
			<section class="px-5 py-4 text-center bg-white">
				<h2 class="w-full text-5xl font-bold leading-tight text-center text-gray-800 py-15">Caracteristicas</h2>
				<div class="container grid grid-cols-1 gap-5 px-10 mx-auto sm:px-20 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 pb-15">
					<div class="rounded-3xl">
						<div class="relative text-white bg-gray-200 rounded-t-3xl">
							<img src="{{ Storage::url('img/feature cards/list1.png') }}" alt="list">
							<svg class="absolute bottom-0 border-2 border-t-0 border-b-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="currentColor" fill-opacity="1" d="M0,192L120,202.7C240,213,480,235,720,218.7C960,203,1200,149,1320,122.7L1440,96L1440,320L1320,320C1200,320,960,320,720,320C480,320,240,320,120,320L0,320Z"></path></svg>
						</div>
						<div class="p-5 pt-0 text-gray-600 bg-white border-2 border-t-0 rounded-b-3xl">
							<h3 class="mb-4 text-2xl font-bold leading-tight text-center ">Crea listas</h3>
							<p class="text-lg text-center ">Agrupa tus series y peliculas preferidas de forma sencilla para no perderte nada. </p>
						</div>

					</div>
					<div class="rounded-3xl ">
						<div class="relative text-white bg-gray-200 rounded-t-3xl">
							<img src="{{ Storage::url('img/feature cards/rating1.png') }}" alt="list">
							<svg class="absolute bottom-0 border-2 border-t-0 border-b-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="currentColor" fill-opacity="1" d="M0,192L120,202.7C240,213,480,235,720,218.7C960,203,1200,149,1320,122.7L1440,96L1440,320L1320,320C1200,320,960,320,720,320C480,320,240,320,120,320L0,320Z"></path></svg>
							{{-- <svg class="absolute bottom-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="currentColor" fill-opacity="1" d="M0,224L1440,128L1440,320L0,320Z"></path></svg> --}}
						</div>
						<div class="p-5 pt-0 text-gray-600 bg-white border-2 border-t-0 rounded-b-3xl">
							<h3 class="mb-4 text-2xl font-bold leading-tight text-center ">Pon tu calificación</h3>
							<p class="text-lg text-center ">Da tu puntuación de lo que acabas de ver y compartelo con nuestra comunidad</p>
						</div>

					</div>
					<div class="rounded-3xl">
						<div class="relative text-white bg-gray-200 rounded-t-3xl">
							<img src="{{ Storage::url('img/feature cards/review1.png') }}" alt="list">
							<svg class="absolute bottom-0 border-2 border-t-0 border-b-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="currentColor" fill-opacity="1" d="M0,192L120,202.7C240,213,480,235,720,218.7C960,203,1200,149,1320,122.7L1440,96L1440,320L1320,320C1200,320,960,320,720,320C480,320,240,320,120,320L0,320Z"></path></svg>
							{{-- <svg class="absolute bottom-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="currentColor" fill-opacity="1" d="M0,224L1440,128L1440,320L0,320Z"></path></svg> --}}
						</div>
						<div class="p-5 pt-0 text-gray-600 bg-white border-2 border-t-0 rounded-b-3xl">
							<h3 class="mb-4 text-2xl font-bold leading-tight text-center ">Expresa tu opinion</h3>
							<p class="text-lg text-center ">Ayuda a los demas a decidir si vale la pena la serie que viste anoche.</p>
						</div>

					</div>
					<div class="rounded-3xl">
						<div class="relative text-white bg-gray-200 rounded-t-3xl">
							<img src="{{ Storage::url('img/feature cards/free1.png') }}" alt="list">
							<svg class="absolute bottom-0 border-2 border-t-0 border-b-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="currentColor" fill-opacity="1" d="M0,192L120,202.7C240,213,480,235,720,218.7C960,203,1200,149,1320,122.7L1440,96L1440,320L1320,320C1200,320,960,320,720,320C480,320,240,320,120,320L0,320Z"></path></svg>
							{{-- <svg class="absolute bottom-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="currentColor" fill-opacity="1" d="M0,224L1440,128L1440,320L0,320Z"></path></svg> --}}
						</div>
						<div class="p-5 pt-0 text-gray-600 bg-white border-2 border-t-0 rounded-b-3xl">
							<h3 class="mb-4 text-2xl font-bold leading-tight text-center ">Todo esto por solo $0</h3>
							<p class="text-lg text-center ">Tu dinero no sirve aqui!</p>
						</div>

					</div>
					
					
					
				</div>
			</section>
			<!--Unete-->
			<section class="px-5 py-4 bg-white ">
				<h2 class="w-full text-5xl font-bold leading-tight text-center text-gray-800 py-15">Únete hoy</h2>
				<div class="container grid grid-cols-1 gap-5 px-10 mx-auto text-lg justify-items-center md:grid-cols-2 sm:px-20 lg:grid-cols-3 xl:grid-cols-4 pb-15">
					<img class="w-64 animate-bounce md:col-span-2 lg:col-span-3 xl:col-span-4" src="{{ Storage::url("img/gifs/animat-lightbulb-color.gif") }}" alt="lightbulb">
					<div class=" lg:col-span-2">
						<p>Obtén acceso para mantener tus propias listas personalizadas, lleva un seguimiento de lo que has visto, busca y filtra lo proximo que veras, independientemente de si está en cines, en televisión o disponible en servicios de transmisión populares como Netflix, Disney Plus, Amazon Prime Video y ponlo en una lista de "Planeando ver"</p>					
						<a href="{{ route('register') }}" >
							<button class="px-6 py-4 mx-auto my-6 font-bold text-white transition duration-300 ease-in-out transform rounded-full shadow-lg bg-gradient-to-r from-teal-400 to-blue-500 lg:mx-0 hover:underline focus:outline-none focus:shadow-outline hover:scale-105">
								{{__('Register')}}
							</button>
						</a>
					</div>
					<ul class="pl-4 list-disc xl:col-span-2">
						<li>Disfruta de SeriesApp sin anuncios</li>
						<li>Mantén una lista de seguimiento personal</li>
						<li>Filtra por tus busquedas por categorias y encuentra algo que ver</li>
						<li>Registra las películas y programas de televisión que has visto</li>
						<li>Crea listas personalizadas</li>
					</ul>
					
				</div>
			</section>

			<!--Waves-->
			<svg class="text-white wave-top" viewBox="0 0 1439 147" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
				<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
					<g transform="translate(-1.000000, -14.000000)" fill-rule="nonzero">
					<g class="wave" fill="currentcolor">
						<path
						d="M1440,84 C1383.555,64.3 1342.555,51.3 1317,45 C1259.5,30.824 1206.707,25.526 1169,22 C1129.711,18.326 1044.426,18.475 980,22 C954.25,23.409 922.25,26.742 884,32 C845.122,37.787 818.455,42.121 804,45 C776.833,50.41 728.136,61.77 713,65 C660.023,76.309 621.544,87.729 584,94 C517.525,105.104 484.525,106.438 429,108 C379.49,106.484 342.823,104.484 319,102 C278.571,97.783 231.737,88.736 205,84 C154.629,75.076 86.296,57.743 0,32 L0,0 L1440,0 L1440,84 Z"
						></path>
					</g>
					<g transform="translate(1.000000, 15.000000)" fill="#FFFFFF">
						<g transform="translate(719.500000, 68.500000) rotate(-180.000000) translate(-719.500000, -68.500000) ">
						<path d="M0,0 C90.7283404,0.927527913 147.912752,27.187927 291.910178,59.9119003 C387.908462,81.7278826 543.605069,89.334785 759,82.7326078 C469.336065,156.254352 216.336065,153.6679 0,74.9732496" opacity="0.100000001"></path>
						<path
							d="M100,104.708498 C277.413333,72.2345949 426.147877,52.5246657 546.203633,45.5787101 C666.259389,38.6327546 810.524845,41.7979068 979,55.0741668 C931.069965,56.122511 810.303266,74.8455141 616.699903,111.243176 C423.096539,147.640838 250.863238,145.462612 100,104.708498 Z"
							opacity="0.100000001"
						></path>
						<path d="M1046,51.6521276 C1130.83045,29.328812 1279.08318,17.607883 1439,40.1656806 L1439,120 C1271.17211,77.9435312 1140.17211,55.1609071 1046,51.6521276 Z" opacity="0.200000003"></path>
						</g>
					</g>
					</g>
				</g>
			</svg>

			{{-- <section class="container py-6 mx-auto mb-12 text-center">
				<h1 class="w-full my-2 text-5xl font-bold leading-tight text-center text-white">
					Call to Action
				</h1>
				<div class="w-full mb-4">
					<div class="w-1/6 h-1 py-0 mx-auto my-0 bg-white rounded-t opacity-25"></div>
				</div>
				<h3 class="my-4 text-3xl leading-tight">
					Main Hero Message to sell yourself!
				</h3>
				<button class="px-8 py-4 mx-auto my-6 font-bold text-gray-800 transition duration-300 ease-in-out transform bg-white rounded-full shadow-lg lg:mx-0 hover:underline focus:outline-none focus:shadow-outline hover:scale-105">
					Action!
				</button>
			</section> --}}

			    <!--Footer-->
			<footer class="">
				<div class="container px-8 mx-auto">
					<div class="flex flex-col w-full py-6 md:flex-row">
						<div class="flex-1 mb-6 text-white">
							<a class="text-2xl font-bold no-underline hover:no-underline lg:text-4xl" href="#">					
								<svg xmlns="http://www.w3.org/2000/svg" class="inline h-8 "  viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
									<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
									<rect x="3" y="7" width="18" height="13" rx="2"></rect>
									<polyline points="16 3 12 7 8 3"></polyline>
								</svg>
							SeriesApp
							</a>
						</div>
						<div class="flex-1">
							<p class="font-bold text-white uppercase md:mb-6">Links</p>
							<ul class="mb-6 list-reset">
								<li class="inline-block mt-2 mr-2 md:block md:mr-0">
									<a href="#" class="text-white no-underline hover:underline hover:text-gray-300">FAQ</a>
								</li>
								<li class="inline-block mt-2 mr-2 md:block md:mr-0">
									<a href="#" class="text-white no-underline hover:underline hover:text-gray-300">Help</a>
								</li>
								<li class="inline-block mt-2 mr-2 md:block md:mr-0">
									<a href="#" class="text-white no-underline hover:underline hover:text-gray-300">Support</a>
								</li>
							</ul>
						</div>
						<div class="flex-1">
							<p class="font-bold text-white uppercase md:mb-6">Legal</p>
							<ul class="mb-6 list-reset">
								<li class="inline-block mt-2 mr-2 md:block md:mr-0">
									<a href="#" class="text-white no-underline hover:underline hover:text-gray-300">Terms</a>
								</li>
								<li class="inline-block mt-2 mr-2 md:block md:mr-0">
									<a href="#" class="text-white no-underline hover:underline hover:text-gray-300">Privacy</a>
								</li>
							</ul>
						</div>
						<div class="flex-1">
							<p class="font-bold text-white uppercase md:mb-6">Social</p>
							<ul class="mb-6 list-reset">
								<li class="inline-block mt-2 mr-2 text-white md:block md:mr-0">
									<svg class="inline w-6" role="img" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><title>Facebook</title><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
									<a href="#" class="no-underline hover:underline hover:text-gray-300">Facebook</a>
								</li>
								<li class="inline-block mt-2 mr-2 text-white md:block md:mr-0">
									<svg class="inline w-6" role="img" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><title>LinkedIn</title><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
									<a href="#" class="no-underline hover:underline hover:text-gray-300">Linkedin</a>
								</li>
								<li class="inline-block mt-2 mr-2 text-white md:block md:mr-0">
									<svg class="inline w-6" role="img" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><title>Twitter</title><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
									<a href="#" class="no-underline hover:underline hover:text-gray-300">Twitter</a>
								</li>
							</ul>
						</div>
						<div class="flex-1">
							<p class="font-bold text-white uppercase md:mb-6">Company</p>
							<ul class="mb-6 list-reset">
								<li class="inline-block mt-2 mr-2 md:block md:mr-0">
									<a href="#" class="text-white no-underline hover:underline hover:text-gray-300">Official Blog</a>
								</li>
								<li class="inline-block mt-2 mr-2 md:block md:mr-0">
									<a href="#" class="text-white no-underline hover:underline hover:text-gray-300">About Us</a>
								</li>
								<li class="inline-block mt-2 mr-2 md:block md:mr-0">
									<a href="#" class="text-white no-underline hover:underline hover:text-gray-300">Contact</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</footer>
		</div>


        @stack('modals')

        @livewireScripts

		<script>
			var scrollpos = window.scrollY;
			var header = document.getElementById("header");
			var navcontent = document.getElementById("nav-content");

			var brandname = document.getElementById("brandname");
			var toToggle = document.querySelectorAll(".toggleColour");

			document.addEventListener("scroll", function () {
				/*Apply classes for slide in bar*/
				scrollpos = window.scrollY;

				if (scrollpos > 10) {
					header.classList.add("bg-white");

					//Use to switch toggleColour colours
					for (var i = 0; i < toToggle.length; i++) {
					toToggle[i].classList.add("text-gray-800");
					toToggle[i].classList.remove("text-white");
					}
					header.classList.add("shadow");
					navcontent.classList.remove("bg-gray-100");
					navcontent.classList.add("bg-white");
				} else {
					header.classList.remove("bg-white");

					//Use to switch toggleColour colours
					for (var i = 0; i < toToggle.length; i++) {
					toToggle[i].classList.add("text-white");
					toToggle[i].classList.remove("text-gray-800");
					}

					header.classList.remove("shadow");
					navcontent.classList.remove("bg-white");
					navcontent.classList.add("bg-gray-100");
				}
			});
		</script>
    </body>
</html>


