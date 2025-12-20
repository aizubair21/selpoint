<div>
    {{--
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/bootstrap.min.css')}}" /> --}}

    <style>
        /* @media only screen and (max-width: 600px) { */
        @media (min-width: 767px) {
            .detail-box h1 {
                font-size: 3rem !important;
                margin-bottom: 0px;
            }
        }

        @media (min-width: 1199px) {
            .detail-box h1 {
                font-size: 4rem !important;
                margin-bottom: 0px;
            }
        }

        @media (max-width: 570px) {

            .slider_bg_box img {
                width: 100%;
                height: auto;
                /* -o-object-fit: cover; */
                /* object-fit: cover; */
                /* -o-object-position: top right;
                object-position: top right; */
                aspect-ratio: 16 / 9;
            }

            .detail-box h1 {
                font-size: 4rem !important;
                margin-bottom: 0px;
            }
        }
    </style>


    @livewire('pages.slider')


    <x-dashboard.container>

        @includeIf('components.client.display-category', ['categories' => $categories])

        @livewire('pages.new-product')
        @livewire('pages.todays-product')

        @if (count($products))

        <div class="py-4">
            <div class="py-4 flex px-2 justify-between items-center">
                <div class="text-xl font-bold">
                    Products
                </div>

                <div class="text-center">
                    <x-nav-link href="{{route('products.index')}}" class="px-3 py-2 rounded ">
                        View All
                    </x-nav-link>
                </div>
            </div>
            <div class="product_section" x-loading.disabled x-transition>
                <x-client.products-loop :$products />
            </div>

        </div>
        @endif

        @livewire('pages.topSales')
        @livewire('pages.static-slider', ['placement' => 'middle', 'page' => 'home'])
        @livewire('pages.RecomendedProducts')
        @livewire('pages.static-slider', ['placement' => 'bottom', 'page' => 'home'])
    </x-dashboard.container>
</div>

</div>