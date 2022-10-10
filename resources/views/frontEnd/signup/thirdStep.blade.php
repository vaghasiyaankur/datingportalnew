<!-- Developed By CBS -->
@extends('dashlead.layouts.signup_layout')
@section('pageTitle', 'Trin 3')
@section('content')
<!-- pageContent area-->
<div class="main-content pt-0">
    <div class="container">

        <!-- Row -->
        <div class="row row-sm">

            <!-- Page Header -->
            <div class="page-header"></div>
            <!-- End Page Header -->

            <div class="col-lg-12 col-md-12">
                <div class="card custom-card">
                    <div class="card-body">

                        <div>
                            <h5 class="card-title mb-1" style="font-weight:bold; text-transform:uppercase;">Tilmelding :
                                Trin 3</h5>
                            <hr>
                        </div>
                        <form class="d-inline" method="POST" action="{{ route('signup.submit')}}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-4 col-lg-4 col-xl-4">
                                    <div class="form-group">
                                        <label>Land <span style="color:red">*</span></label>
                                        <select class="form-control select select2" name="country" required>
                                            <option value="" selected disabled>--VÆLG--</option>
                                            @foreach (App\Models\Country::all() as $item)
                                            <option value="{{ $item->country_id }}" {{$item == old('country') ? 'selected' : ''}}>
                                                {{ $item->country }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 col-lg-4 col-xl-4">
                                    <div class="form-group">
                                        <label>Postnummer <span style="color:red">*</span></label>
                                        <input type="text" id="zipcode" name="zipCode" class="form-control" placeholder="Postnummer" value="{{old('zipcode')}}" required>
                                        @if ($errors->has('zipcode'))
                                        <span class=" text-danger" role="alert">
                                            <strong>{{ $errors->first('zipcode') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4 col-lg-4 col-xl-4">
                                    <div class="form-group">
                                        <label>Civilstatus <span style="color:red">*</span></label>
                                        <select name="civilStatus" class="form-control select select2" required>
                                            @if(old('civilStatus') == null)
                                                <option value="" selected disabled>Vælg din mulighed</option>
                                            @endif
                                            @foreach (App\Enums\CivilStatus::getValues() as $item)
                                                <option value="{{ $item }}" {{ old('civilStatus') == $item ? 'selected' : ''}}>
                                                    {{ $item }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 col-lg-4 col-xl-4">
                                    <div class="form-group">
                                        <label>Seksualitet <span style="color:red">*</span></label>
                                        <select name="sexualOrientation" class="form-control select select2" required>
                                            @if(old('sexualOrientation') == null)
                                                <option value="" selected disabled>Vælg din mulighed</option>
                                            @endif
                                            @foreach (App\Enums\SexualOrientation::getValues() as $item)
                                                <option value="{{$item}}" {{$item == old('sexualOrientation') ? 'selected' : ''}}>{{$item}} </option>
                                            @endforeach
                                        </select>  
                                    </div>
                                </div>
                                <div class="col-md-4 col-lg-4 col-xl-4">
                                    <div class="form-group">
                                        <label>Højde <span style="color:red">*</span></label>
                                        <select name="height" class="form-control select select2" required>
                                            @if(old('height') == null)
                                            <option value="" selected disabled>Vælg din mulighed</option>
                                            @endif
                                            @foreach (App\Enums\Height::getValues() as $item)
                                            <option value="{{ $item }}" {{ old('height') == $item ? 'selected' : ''}}>
                                                {{ $item }}</option>
                                            @endforeach
                                        </select> 
                                    </div>
                                </div>
                                <div class="col-md-4 col-lg-4 col-xl-4">
                                    <div class="form-group">
                                        <label>Vægt <span style="color:red">*</span></label>
                                        <select name="weight" class="form-control select select2" required>
                                            @if(old('weight') == null)
                                            <option value="" selected disabled>Vælg din mulighed</option>
                                            @endif
                                            @foreach (App\Enums\Weight::getValues() as $item)
                                            <option value="{{ $item }}" {{ old('weight') == $item ? 'selected' : ''}}>
                                                {{ $item }}</option>
                                            @endforeach
                                        </select>  
                                    </div>
                                </div>
                                <div class="col-md-4 col-lg-4 col-xl-4">
                                    <div class="form-group">
                                        <label>Øjenfarve <span style="color:red">*</span></label>
                                        <select name="eyeColor" class="form-control select select2" required>
                                            @if(old('eyeColor') == null)
                                            <option value="" selected disabled>Vælg din mulighed</option>
                                            @endif
                                            @foreach (App\Enums\EyeColor::getValues() as $item)
                                            <option value="{{ $item}}" {{ old('eyeColor') == $item ? 'selected' : ''}}>
                                                {{ $item }}</option>
                                            @endforeach
                                        </select> 
                                    </div>
                                </div>
                                <div class="col-md-4 col-lg-4 col-xl-4">
                                    <div class="form-group">
                                        <label>Hårfarve <span style="color:red">*</span></label>
                                        <select name="hairColor" class="form-control select select2" required>
                                            @if(old('hairColor') == null)
                                            <option value="" selected disabled>Vælg din mulighed</option>
                                            @endif
                                            @foreach (App\Enums\HairColor::getValues() as $item)
                                            <option value="{{ $item }}" {{ old('hairColor') == $item ? 'selected' : ''}}>
                                                {{ $item }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 col-lg-4 col-xl-4">
                                    <div class="form-group">
                                        <label>Kropsbygning <span style="color:red">*</span></label>
                                        <select name="bodyType" class="form-control select select2" required>
                                            @if(old('bodyType') == null)
                                            <option value="" selected disabled>Vælg din mulighed</option>
                                            @endif
                                            @foreach (App\Enums\BodyType::getValues() as $item)
                                            <option value="{{ $item }}" {{ old('bodyType') == $item ? 'selected' : ''}}>
                                                {{ $item }}</option>
                                            @endforeach
                                        </select> 
                                    </div>
                                </div>
                                <div class="col-md-4 col-lg-4 col-xl-4">
                                    <div class="form-group">
                                        <label>Børn <span style="color:red">*</span></label>
                                        <select name="children" class="form-control select select2" required>
                                            @if(old('children') == null)
                                            <option value="" selected disabled>Vælg din mulighed</option>
                                            @endif
                                            @foreach (App\Enums\Children::getValues() as $item)
                                            <option value="{{ $item }}" {{ old('children') == $item ? 'selected' : ''}}>
                                                {{ $item }}</option>
                                            @endforeach
                                        </select> 
                                    </div>
                                </div>
                                <div class="col-md-4 col-lg-4 col-xl-4">
                                    <div class="form-group">
                                        <div><label>Matchord <span style="color:red">*</span></label></div>
                                        <input data-role="tagsinput" class="form-control" placeholder="Skriv Matchord"
                                            name="matchWords" value="{{old('matchWords')}}">
                                    </div>
                                </div>

                                <div class="col-md-4 col-lg-4 col-xl-4">
                                    <div class="form-group">
                                        <div><label>Negative Matchord <span style="color:blue">(Hvis
                                                    Nogen)</span></label></div>
                                        <input data-role="tagsinput" class="form-control"
                                            placeholder="Skriv Negative Matchord" name="nMatchWords"
                                            class="input-height" value="{{old('nMatchWords')}}">
                                    </div>
                                </div>
                                

                                <div class="col-md-4 col-lg-4 col-xl-4">
                                    <div class="form-group">
                                        <label>Rediger profiltekst <span style="color:red">*</span></label>
                                        <textarea type="textarea" rows="4" placeholder="Skriv Noget..."
                                            class="form-control" name="profile_detail" required></textarea>
                                    </div>
                                </div>
                                <div class="col-md-4 col-lg-4 col-xl-4">
                                    <div class="form-group">
                                        <input title="Upload Dit Billede" type="file" class="dropify"
                                            id="profileImageUpload" accept=".png, .jpg, .jpeg"
                                            data-max-file-size="5M" data-height="130" data-width="250"
                                            name="profilePicture" required>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-12 col-xl-12">
                                    <button style="font-weight: bold;text-transform: uppercase;"
                                        class="btn ripple btn-main-primary btn-block">Opret profil</button>
                                </div>
                                
                        </form>


                    </div>
                </div>
            </div>

        </div>
        <!-- End Row -->

    </div>
</div>
<!-- end pageContent area-->
@endsection
<!-- Developed By CBS -->