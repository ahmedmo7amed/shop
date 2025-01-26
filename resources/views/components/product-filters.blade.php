@props(['categories', 'selectedCategories' => [], 'priceRange' => ['min' => 0, 'max' => 1000]])

<div class="product-sidebar">
    <div class="filter-section">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="mb-0 f-w-600">Filters</h6>
                <button class="btn btn-link p-0 text-reset d-md-none" type="button" data-bs-toggle="collapse" data-bs-target="#filterContent">
                    <i data-feather="chevron-down"></i>
                </button>
            </div>
            <div class="collapse show" id="filterContent">
                <div class="card-body filter-cards-view">
                    <!-- Categories -->
                    <div class="product-filter mb-4">
                        <h6 class="f-w-600 mb-3">Categories</h6>
                        <div class="category-list">
                            @foreach($categories as $category)
                                <div class="form-check">
                                    <input type="checkbox" 
                                           class="form-check-input category-filter" 
                                           id="category-{{ $category->id }}"
                                           name="categories[]"
                                           value="{{ $category->id }}"
                                           @if(in_array($category->id, $selectedCategories)) checked @endif>
                                    <label class="form-check-label" for="category-{{ $category->id }}">
                                        {{ $category->name }}
                                        <span class="text-muted">({{ $category->products_count }})</span>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Price Range -->
                    <div class="product-filter mb-4">
                        <h6 class="f-w-600 mb-3">Price Range</h6>
                        <div class="price-range">
                            <div class="range-slider">
                                <input type="text" 
                                       class="js-range-slider" 
                                       name="price_range" 
                                       value=""
                                       data-type="double"
                                       data-min="0"
                                       data-max="1000"
                                       data-from="{{ $priceRange['min'] }}"
                                       data-to="{{ $priceRange['max'] }}"
                                       data-prefix="$"/>
                            </div>
                            <div class="range-input mt-2">
                                <div class="row g-2">
                                    <div class="col-6">
                                        <input type="number" 
                                               class="form-control form-control-sm" 
                                               id="price_min" 
                                               placeholder="Min"
                                               value="{{ $priceRange['min'] }}">
                                    </div>
                                    <div class="col-6">
                                        <input type="number" 
                                               class="form-control form-control-sm" 
                                               id="price_max" 
                                               placeholder="Max"
                                               value="{{ $priceRange['max'] }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Ratings -->
                    <div class="product-filter mb-4">
                        <h6 class="f-w-600 mb-3">Rating</h6>
                        <div class="rating-list">
                            @foreach(range(5, 1) as $rating)
                                <div class="form-check">
                                    <input type="checkbox" 
                                           class="form-check-input rating-filter" 
                                           id="rating-{{ $rating }}"
                                           name="ratings[]"
                                           value="{{ $rating }}">
                                    <label class="form-check-label" for="rating-{{ $rating }}">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fa fa-star{{ $i <= $rating ? ' text-warning' : '-o text-muted' }}"></i>
                                        @endfor
                                        <span class="text-muted">& Up</span>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Availability -->
                    <div class="product-filter">
                        <h6 class="f-w-600 mb-3">Availability</h6>
                        <div class="availability-list">
                            <div class="form-check">
                                <input type="checkbox" 
                                       class="form-check-input availability-filter" 
                                       id="in-stock"
                                       name="availability[]"
                                       value="in_stock">
                                <label class="form-check-label" for="in-stock">
                                    In Stock
                                </label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" 
                                       class="form-check-input availability-filter" 
                                       id="out-of-stock"
                                       name="availability[]"
                                       value="out_of_stock">
                                <label class="form-check-label" for="out-of-stock">
                                    Out of Stock
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="button" class="btn btn-primary w-100" id="apply-filters">
                        Apply Filters
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        // Initialize price range slider
        $(".js-range-slider").ionRangeSlider({
            skin: "round",
            onChange: function(data) {
                $("#price_min").val(data.from);
                $("#price_max").val(data.to);
            }
        });

        // Sync manual input with slider
        $("#price_min, #price_max").on("change", function() {
            let $slider = $(".js-range-slider").data("ionRangeSlider");
            $slider.update({
                from: $("#price_min").val(),
                to: $("#price_max").val()
            });
        });

        // Apply filters
        $("#apply-filters").on("click", function() {
            let filters = {
                categories: [],
                price_range: {
                    min: $("#price_min").val(),
                    max: $("#price_max").val()
                },
                ratings: [],
                availability: []
            };

            // Collect selected categories
            $(".category-filter:checked").each(function() {
                filters.categories.push($(this).val());
            });

            // Collect selected ratings
            $(".rating-filter:checked").each(function() {
                filters.ratings.push($(this).val());
            });

            // Collect availability
            $(".availability-filter:checked").each(function() {
                filters.availability.push($(this).val());
            });

            // Update URL with filters
            let searchParams = new URLSearchParams();
            
            if (filters.categories.length) {
                searchParams.append('categories', filters.categories.join(','));
            }
            
            searchParams.append('price_min', filters.price_range.min);
            searchParams.append('price_max', filters.price_range.max);
            
            if (filters.ratings.length) {
                searchParams.append('ratings', filters.ratings.join(','));
            }
            
            if (filters.availability.length) {
                searchParams.append('availability', filters.availability.join(','));
            }

            window.location.search = searchParams.toString();
        });
    });
</script>
@endpush
