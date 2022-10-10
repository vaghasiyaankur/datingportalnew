<!-- Developed By CBS -->
    <!-- Promotion Slider -->
        <div class="card custom-card">

            <div class="card-header custom-card-header">
                <a href="{{route('promotion.list')}}">
                    <h6 class="card-title mb-0" style="font-weight: bold; text-transform:uppercase;">Fremhævninger</h6>
                </a>
            </div>

            <!-- Slider 1 -->
                <div class="card-body">
                    <div id="owl-demo2" class="owl-carousel owl-carousel-icons2">
                        @if(auth()->user()->totalShowPromotion(0) != 0)
                            @foreach(auth()->user()->promotionInfo
                            ->slice(0, auth()->user()->totalShowPromotion(0)) as $item)
                                @include('dashlead.layouts.promotion.imageSection',['item' => $item])
                            @endforeach
                        @else
                            @include('dashlead.layouts.promotion.emptySection')
                        @endif
                    </div>
                </div>
            <!-- Slider 1 -->

            <!-- Slider 2 -->
                <div class="card-body">
                    <div id="owl-demo2" class="owl-carousel owl-carousel-icons2">
                        @if(auth()->user()->totalShowPromotion(1) != 0)
                            @foreach(auth()->user()->promotionInfo
                                ->slice(auth()->user()->totalShowPromotion(0) , 
                                    auth()->user()->totalShowPromotion(1)) as $item)
                                @include('dashlead.layouts.promotion.imageSection',['item' => $item])
                                {{-- add empty logo when slider 1 have 1+ picture --}}
                                @if(auth()->user()->totalShowPromotion(1) == 1 && auth()->user()->totalShowPromotion(0) == 2)
                                @include('dashlead.layouts.promotion.emptySection')
                                @endif
                            @endforeach
                        @else
                            @include('dashlead.layouts.promotion.emptySection')
                        @endif
                    </div>
                </div>
            <!-- Slider 2 -->

            <!-- Slider 3 -->
                <div class="card-body">
                    <div id="owl-demo2" class="owl-carousel owl-carousel-icons2">
                      @if(auth()->user()->totalShowPromotion(2) != 0)
                            @foreach(auth()->user()->promotionInfo
                                ->slice(auth()->user()->totalShowPromotion(0) + auth()->user()->totalShowPromotion(1), 
                                    auth()->user()->totalShowPromotion(2)) as $item)
                                @include('dashlead.layouts.promotion.imageSection',['item' => $item])
                                {{-- add empty logo when slider 1(must) or 2(optional)   have 1+ picture --}}
                                @if(auth()->user()->totalShowPromotion(2) == 1 && auth()->user()->totalShowPromotion(0) == 2)
                                @include('dashlead.layouts.promotion.emptySection')
                                @endif
                            @endforeach
                        @else

                        @include('dashlead.layouts.promotion.emptySection')

                        @endif
                    </div>
                </div>
            <!-- Slider 3 -->

            <!-- Slider 4 -->
                <div class="card-body">
                    <div id="owl-demo2" class="owl-carousel owl-carousel-icons2">
             
                        @if(auth()->user()->totalShowPromotion(3) != 0)
                            @foreach(auth()->user()->promotionInfo
                                ->slice(auth()->user()->totalShowPromotion(0) + auth()->user()->totalShowPromotion(1) +
                                    auth()->user()->totalShowPromotion(2), auth()->user()->totalShowPromotion(3)) as $item)
                                @include('dashlead.layouts.promotion.imageSection',['item' => $item])
                                {{-- add empty logo when slider 1(must) , 2(optional) or 3(optional)  have 1+ picture --}}
                                @if(auth()->user()->totalShowPromotion(3) == 1 && auth()->user()->totalShowPromotion(0) == 2)
                                    @include('dashlead.layouts.promotion.emptySection')
                                @endif
                            @endforeach 
                        @else
                            @include('dashlead.layouts.promotion.emptySection')
                        @endif


                    </div>
                </div>
            <!-- Slider 4 -->

        </div>
    <!-- ./Promotion Slider -->
<!-- Developed By CBS -->

<!-- Report modal For Highlight Slider -->
@if (sizeof(auth()->user()->promotionInfo) > 0)
@foreach (auth()->user()->promotionInfo as $promotion)
<div class="modal" id="reportpromotionalModal{{ $promotion->id }}">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title" style="font-weight: bold;text-transform: uppercase;">Rapport</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <form method="POST" action="{{ route('promotion.report', $promotion->id) }}">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-6 col-md-12">
                          <div class="form-group">
                              <label for="name">Beskrivelse <span style="color:red">*</span></label>
                               <textarea maxlength="250" value="{{old('description')}}" placeholder="Skriv noget..." class="form-control" name="description" rows="3" required></textarea>
                          </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn ripple btn-success" type="submit" style="font-weight: bold;text-transform: uppercase;">Indsend</button>
                    <button class="btn ripple btn-danger" data-dismiss="modal" type="button" style="font-weight: bold;text-transform: uppercase;">Tæt</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
@endif
<!-- Report modal For Highlight Slider -->