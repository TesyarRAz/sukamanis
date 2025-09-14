<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        @foreach($carousels as $key => $carousel)
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="{{ $key }}"
                class="{{ $key == 0 ? 'active' : '' }}"
                aria-current="{{ $key == 0 ? 'true' : '' }}"
                aria-label="Slide {{ $key+1 }}"></button>
        @endforeach
    </div>

    <div class="carousel-inner">
        @foreach($carousels as $key => $carousel)
            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                <img src="{{ asset($carousel->image) }}" class="d-block w-100" style="height:500px; object-fit:cover;" alt="...">
            </div>
        @endforeach
    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>
</div>
