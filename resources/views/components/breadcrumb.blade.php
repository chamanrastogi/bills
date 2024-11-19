@props(['title', 'name'])
<div class="breadcrumb__area breadcrumb__overlay breadcrumb__bg p-relative fix"
    data-background="{{ asset('frontend/assets/img/breadcrumb/breadcurmb.jpg') }}">
    <div class="container">
        <div class="row">
            <div class="col-xxl-12">
                <div class="breadcrumb__content z-index">
                    <div class="breadcrumb__list mb-10">
                        <span><a href="{{ url('/') }}">Home</a></span>
                        <span class="dvdr"><i class="fa-solid fa-angle-right"></i></span>
                        <span>{{ $title }}</span>
                    </div>
                    <div class="breadcrumb__section-title-box mb-20">
                        <h3 class="breadcrumb__title tp-split-text tp-split-in-right">{{ $name }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
