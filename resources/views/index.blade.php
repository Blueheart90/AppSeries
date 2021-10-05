<x-guest-layout>
	<style>
		.hero-landing {
		background-color: #0071ff;
		}
	</style>
	<nav id="header" class="fixed top-0 z-30 w-full text-white">
		<div class="container flex flex-wrap items-center justify-between w-full py-2 mx-auto mt-0">
			<div class="flex items-center pl-4">
			<a class="text-2xl font-bold text-white no-underline toggleColour hover:no-underline lg:text-3xl" href="#">
				<!--Icon from: http://www.potlabicons.com/ -->
				{{-- <svg class="inline h-8 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512.005 512.005">
				<rect fill="#2a2a31" x="16.539" y="425.626" width="479.767" height="50.502" transform="matrix(1,0,0,1,0,0)" />
				<path
					class="plane-take-off"
					d=" M 510.7 189.151 C 505.271 168.95 484.565 156.956 464.365 162.385 L 330.156 198.367 L 155.924 35.878 L 107.19 49.008 L 211.729 230.183 L 86.232 263.767 L 36.614 224.754 L 0 234.603 L 45.957 314.27 L 65.274 347.727 L 105.802 336.869 L 240.011 300.886 L 349.726 271.469 L 483.935 235.486 C 504.134 230.057 516.129 209.352 510.7 189.151 Z "
				/>
				</svg> --}}
				{{-- <img class="inline h-10 text-cool-gray-200 " src="{{ Storage::url('svg/remote-control.svg') }}" alt=""> --}}
				<svg xmlns="http://www.w3.org/2000/svg" class="inline h-8 "  viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
				<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
				<rect x="3" y="7" width="18" height="13" rx="2"></rect>
				<polyline points="16 3 12 7 8 3"></polyline>
				</svg>
				SeriesApp
			</a>
			</div>
			<div class="z-20 flex-grow hidden w-full p-4 mt-2 text-black bg-white lg:flex lg:items-center lg:w-auto lg:mt-0 lg:bg-transparent lg:p-0" id="nav-content">
			<ul class="items-center justify-end flex-1 list-reset lg:flex">

				@if (Route::has('login'))
					<li class="mr-3">
						@auth
							<a class="inline-block px-4 py-2 font-bold text-white no-underline toggleColour" href="{{ url('/home') }}" class="">{{ __('Go Home') }}</a>
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
		<hr class="py-0 my-0 border-b border-gray-100 opacity-25" />
	</nav>

	<!--Hero-->
	<div class="p-20 pb-20 text-white bg-blue-600 ">
		<div class="container flex flex-col flex-wrap items-center px-3 mx-auto md:flex-row">
			<!--Left Col-->
			<div class="flex flex-col items-start justify-center w-full text-center md:w-2/5 md:text-left">
				<p class="w-full uppercase tracking-loose">
					Organiza tu entretenimiento
				</p>
				<h1 class="my-4 text-5xl font-bold leading-tight">
					Lleva el control de tus series y peliculas
				</h1>
				<p class="mb-8 text-2xl leading-normal">
					Comparte tus opiniones, califica y crea tus propias listas
				</p>
				<button class="px-8 py-4 mx-auto my-6 font-bold text-gray-800 transition duration-300 ease-in-out transform bg-white rounded-full shadow-lg lg:mx-0 hover:underline focus:outline-none focus:shadow-outline hover:scale-105">
					Subscribe
				</button>
			</div>
			<!--Right Col-->
			<div 
				class="w-full text-center py-15 md:w-3/5" 
				style="background: url({{ asset('/storage/svg/blob.svg') }}) center center / cover no-repeat;"
			>
				<img class="z-50 w-full md:w-4/5" src="{{ Storage::url('img/cherry-horror-film.png') }}" alt="peaple watching tv">
				{{-- <img class="z-50 w-full md:w-4/5" src="hero.png" /> --}}
				{{-- <img class="z-50 w-full md:w-4/5" src="{{ Storage::url('svg/blob.svg') }}" alt=""> --}}
			</div>
		</div>
	</div>
	<!--Waves svg-->
	<div class="relative -mt-12 bg-blue-600 lg:-mt-24">
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
	<h2 class="w-full text-5xl font-bold leading-tight text-center text-gray-800 my-15">Carateristicas</h2>
	<div class="container grid grid-cols-4 gap-5 mx-auto my-15">
		<div class="rounded-3xl">
			<div class="relative text-white bg-gray-200 rounded-t-3xl">
				<img src="{{ Storage::url('img/feature cards/list1.png') }}" alt="list">
				<svg class="absolute bottom-0 border-2 border-t-0 border-b-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="currentColor" fill-opacity="1" d="M0,192L120,202.7C240,213,480,235,720,218.7C960,203,1200,149,1320,122.7L1440,96L1440,320L1320,320C1200,320,960,320,720,320C480,320,240,320,120,320L0,320Z"></path></svg>
				{{-- <svg class="absolute bottom-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="currentColor" fill-opacity="1" d="M0,224L1440,128L1440,320L0,320Z"></path></svg> --}}
			</div>
			<div class="p-5 pt-0 text-gray-600 bg-white border-2 border-t-0 rounded-b-3xl">
				<h3 class="mb-4 text-2xl font-bold leading-tight text-center ">Crea listas</h3>
				<p class="text-lg text-center ">Agrupa tus series y peliculas preferidas de forma sencilla y  así no te perderás nada. </p>
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
				<p class="text-lg text-center ">Da tu puntución de lo que acabas de ver y compartelo con nuestra comunidad</p>
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
</x-guest-layout>
