<!-- Developed By CBS -->
    @extends('dashlead.layouts.layout')
    @section('pageTitle', 'Medlemskab')
    @section('content')
            <!-- Main Content-->
                <div class="main-content pt-0">
                    <div class="container">

                    <!-- Page Header -->
                    <div class="page-header">
                        </div>
                    <!-- End Page Header -->

                    <!-- Row -->
                        <div class="row">

                            <!-- Setting Sidebar -->
                                @include('frontEnd.settings.leftSidebar')
                            <!-- Setting Sidebar -->

                            <!-- Setting Body Part -->
                                <div class="col-lg-8 col-md-12">

                                    <!-- Membership Change -->
                                        <div class="card custom-card">
                                            <div class="card-body">

                                                <div>
                                                    <h6 class="card-title mb-1">Skift Medlemskab</h6><hr>
                                                </div>

                                                <form action="{{route('go.free')}}" method="POST">
                                                    @csrf
                                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                                        <div class="form-group">
                                                            <label class="custom-switch">
                                                                <input type="checkbox" onChange="this.form.submit()" class="custom-switch-input" name="isFreeMembership" {{!auth()->user()->isEnableAutoPayment() ? 'checked' : ''}} />
                                                                <span class="custom-switch-indicator"></span>
                                                                <span class="custom-switch-description">Medlemskab Status</span>
                                                            </label>
                                                        </div>
                                                        <!-- <div align="right">
                                                            <button class="btn ripple btn-success" type="submit" style="font-weight: bold;text-transform: uppercase;">Gem ??ndring</button>
                                                        </div> -->
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    <!-- Membership Change -->

                                    <!-- Profile Deactivation -->
                                        <div class="card custom-card">
                                            <div class="card-body">

                                                <div>
                                                    <h6 class="card-title mb-1">Deaktiver Min Profil</h6><hr>
                                                </div>

                                                <form action="{{route('setting.profile.deactivation')}}" method="POST">
                                                    @csrf
                                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                                        <div class="form-group">
                                                            <label class="custom-switch">
                                                                <input type="checkbox" class="custom-switch-input" name="profile_disable" value="{{ $profile_disable == 1 ? 0 : 1 }}" {{$profile_disable == 1 ? 'checked' : ''}}/>
                                                                <span class="custom-switch-indicator"></span>
                                                                <span class="custom-switch-description">Deaktiverings Status</span>
                                                            </label>
                                                        </div>
                                                        <div align="right">
                                                            <button class="btn ripple btn-success" type="submit" style="font-weight: bold;text-transform: uppercase;">Gem ??ndring</button>
                                                        </div>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    <!-- Profile Deactivation -->

                                    <!-- Profile Delete -->
                                        <div class="card custom-card">
                                            <div class="card-body">

                                                <div>
                                                    <h6 class="card-title mb-1">Slet Min Profil</h6><hr>
                                                </div>

                                                <form action="{{route('security.setting.delete')}}" method="POST">
                                                    @csrf
                                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                                        <div class="form-group">
                                                            <label class="custom-switch">
                                                                <input type="checkbox" class="custom-switch-input" name="isDeactivate" {{$isDeactivate == 1 ? 'checked' : ''}}/>
                                                                <span class="custom-switch-indicator"></span>
                                                                <span class="custom-switch-description">Slet Profil</span>
                                                            </label>
                                                            <p style="color:#F1948A;" align="justify">
                                                                *Bem??rk at din profil vil blive slettet fra denne portal, og der ikke gives penge retur for evt. k??bte medlemskaber eller andre betalingsydelser (Opslag p?? v??ggen, fremh??vninger etc.) Har du profiler p?? flere portaler skal disse slettes enkeltvis.
                                                            </p>
                                                        </div>
                                                        <div align="right">
                                                            <button class="btn ripple btn-success" type="submit" style="font-weight: bold;text-transform: uppercase;">Gem ??ndring</button>
                                                        </div>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    <!-- Profile Delete -->
                                    
                                </div>
                            <!-- Setting Body Part -->

                        </div>
                    <!-- End Row -->

                    </div>
                </div>
            <!-- End Main Content-->
    @endsection
<!-- Developed By CBS -->