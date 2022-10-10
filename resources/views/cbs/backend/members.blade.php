<!-- Developed By CBS -->
    @extends('cbs.backend.layouts.layout')
    @section('pageTitle', 'Members')
    @push('style')
    	<!---DataTables css-->
        <link href="{{ asset('cbs/backend/plugins/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
        <link href="{{ asset('cbs/backend/plugins/datatable/responsivebootstrap4.min.css') }}" rel="stylesheet">
        <link href="{{ asset('cbs/backend/plugins/datatable/fileexport/buttons.bootstrap4.min.css') }}" rel="stylesheet">
        <!---Select2 css-->
        <link href="{{ asset('cbs/backend/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    @endpush
    @section('content')

        <!-- Page Content-->
            <div class="container-fluid">

                <!-- Page Header -->
					<div class="page-header">
						<div>
							<h2 class="main-content-title tx-24 mg-b-5">Members</h2>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
								<li class="breadcrumb-item active" aria-current="page">Members</li>
							</ol>
						</div>
						<div> 
                            <button type="button" id="new-super-user" class="adddata btn btn-sm btn-success">+ Add Super User</button>
						</div>
					</div>
                    <div class="d-flex justify-content-between">
                        <div></div>
                        <div> 
                            Total : {{$total}} Users
                        </div>
                    </div>
				<!-- End Page Header -->

                <!-- Row -->
                    <h4>Paid Member</h4>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card custom-card overflow-hidden">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table" id="example1">
                                                <thead>
                                                    <tr>
                                                        <th class="wd-5p" style="text-align:center; font-weight: bold;">#</th>
                                                        <th class="wd-20p" style="text-align:left; font-weight: bold;">Email</th>
                                                        <th class="wd-20p" style="text-align:center; font-weight: bold;">Status</th>
                                                        <th class="wd-20p" style="text-align:center; font-weight: bold;">Super User</th>
                                                        <th class="wd-20p" style="text-align:center; font-weight: bold;">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($paid_users as $key => $member)
                                                        <tr>
                                                            <td  style="text-align:center; font-weight: bold;">{{ $key+1 }}</td>
                                                            <td style="text-align:left;">{{ $member->email }}</td>
                                                            <td style="text-align:center;"><span class="badge {{ $member->status == 'offline' ?  'badge-danger' : 'badge-success' }}">{{ $member->status }}<span></td>
                                                                <td style="text-align:center;"><span class="badge {{ $member->super_user == 0 ?  'badge-danger' : 'badge-success' }}">{{ $member->super_user == 0 ?  'No' : 'Yes' }}<span></td>
                                                            <td style="text-align:center;">
                                                                <button type="button" id="{{ $member->id }}" class="showdata btn btn-sm btn-success"><i class="fa fa-eye"></i></button>
                                                                <button type="button" id="{{ $member->id }}" class="editdata btn btn-sm btn-warning"><i class="fa fa-edit"></i></button>
                                                                <button class="btn btn-sm btn-danger" type="button" onclick="destroy({{ $member->id }})"><i class="fe fe-trash"></i></button>
                                                                <form id="delete-form-{{$member->id}}" action="{{ route('admin.member.destroy',$member->id) }}" method="POST" style="display: none;">@csrf</form>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
				<!-- End Row -->

                <!-- Row -->
                <h4>Non-Paid Member</h4>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card custom-card overflow-hidden">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table" id="nonPaidMember">
                                        <thead>
                                            <tr>
                                                <th class="wd-5p" style="text-align:center; font-weight: bold;">#</th>
                                                <th class="wd-20p" style="text-align:left; font-weight: bold;">Email</th>
                                                <th class="wd-20p" style="text-align:center; font-weight: bold;">Status</th>
                                                <th class="wd-20p" style="text-align:center; font-weight: bold;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($nonpaid_users as $key => $member)
                                                <tr>
                                                    <td  style="text-align:center; font-weight: bold;">{{ $key+1 }}</td>
                                                    <td style="text-align:left;">{{ $member->email }}</td>
                                                    <td style="text-align:center;"><span class="badge {{ $member->status == 'offline' ?  'badge-danger' : 'badge-succeess' }}">{{ $member->status }}<span></td>
                                                    <td style="text-align:center;">
                                                        <button type="button" id="{{ $member->id }}" class="showdata btn btn-sm btn-success"><i class="fa fa-eye"></i></button>
                                                        <button type="button" id="{{ $member->id }}" class="editdata btn btn-sm btn-warning"><i class="fa fa-edit"></i></button>
                                                        <button class="btn btn-sm btn-danger" type="button" onclick="destroy({{ $member->id }})"><i class="fe fe-trash"></i></button>
                                                        <form id="delete-form-{{$member->id}}" action="{{ route('admin.member.destroy',$member->id) }}" method="POST" style="display: none;">@csrf</form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        <!-- End Row -->

                <!-- Member Show Model -->
					<div class="modal" id="memberShowModal">
						<div class="modal-dialog" role="document">
							<div class="modal-content modal-content-demo shadow">
								<div class="modal-header">
									<h6 class="modal-title" style="text-transform: uppercase;">Member Information</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
								</div>

								<div class="modal-body">
                                    <div id="data"></div>
                                </div>

								<div class="modal-footer">
                                    <button class="btn ripple btn-danger" data-dismiss="modal" type="button" style="font-weight: bold;text-transform: uppercase;">Close</button>
								</div>
							</div>
						</div>
					</div>
				<!-- Member Show Model -->

                 <!-- User Edit Model -->
					<div class="modal" id="memberAddModal">
						<div class="modal-dialog" role="document">
							<div class="modal-content modal-content-demo shadow">
								<div class="modal-header">
									<h6 class="modal-title" style="text-transform: uppercase;">Add Super User</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
								</div>
                            <form method="POST" action="{{ route('admin.superuser.add') }}" enctype="multipart/form-data">
                                @csrf
								<div class="modal-body">
                                    <div class="row"> 
                                    <div class="col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="name">User Name </label>
                                            <div id="addusername">
                                                <input type="text" class="form-control" id="username" name="username" value="" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="name">First Name </label>
                                            <div id="addfirstName">
                                                <input type="text" class="form-control" id="firstName" name="firstName" value="" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="name">Last Name </label>
                                            <div id="addlastName">
                                                <input type="text" class="form-control" id="lastName" name="lastName" value="" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="name">Email </label>
                                            <div id="addemail">
                                                <input type="text" class="form-control" id="email" name="email" value="" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="name">Birthday </label>
                                            <div id="adddob">
                                                <input class="form-control" type="date" id="dob" placeholder="Fødselsdag" name="dob" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="name">Gender </label>
                                            <div id="addsex">
                                                <select class="form-control select select2" id="sex" name="sex">
                                                    <option value="Mand">MAND</option>
                                                    <option value="Kvinder">KVINDE</option>
                                                    <option value="Par">PAR</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="name">I'm looking for </label>
                                            <div id="addseek">
                                                <select class="form-control select select2" id="seek" name="seek">
                                                    <option value="Sexpartner">Sexpartner</option>
                                                    <option value="Kæreste">Kæreste</option>
                                                    <option value="Venner">Venner</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="name">I am looking for (gender) </label>
                                            <div id="addseekg">
                                                <select class="form-control select select2" id="seekg" name="seekg">
                                                    <option value="Kvinder">Kvinder</option>
                                                    <option value="Mand">Mænd</option>
                                                    <option value="Par">Par</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                        <div class="col-md-4 col-lg-4 col-xl-4">
                                            <div class="form-group">
                                                <label>Land</label>
                                                <select class="form-control select select2" id="country" name="country" >
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
                                                <label>Postnummer</label>
                                                <input type="text" id="zipcode" name="zipCode" class="form-control" placeholder="Postnummer" value="{{old('zipcode')}}" >
                                                @if ($errors->has('zipcode'))
                                                <span class=" text-danger" role="alert">
                                                    <strong>{{ $errors->first('zipcode') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-lg-4 col-xl-4">
                                            <div class="form-group">
                                                <label>Civilstatus</label>
                                                <select name="civilStatus" id="civilStatus" class="form-control select select2" >
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
                                                <label>Seksualitet</label>
                                                <select name="sexualOrientation" id="sexualOrientation" class="form-control select select2" >
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
                                                <label>Højde</label>
                                                <select name="height" id="height" class="form-control select select2" >
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
                                                <label>Vægt</label>
                                                <select name="weight" id="weight" class="form-control select select2" >
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
                                                <label>Øjenfarve</label>
                                                <select name="eyeColor" id="eyeColor" class="form-control select select2" >
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
                                                <label>Hårfarve</label>
                                                <select name="hairColor" id="hairColor" class="form-control select select2" >
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
                                                <label>Kropsbygning</label>
                                                <select name="bodyType"  id="bodyType" class="form-control select select2" >
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
                                                <label>Børn</label>
                                                <select name="children" id="children" class="form-control select select2" >
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
                                                <div><label>Matchord</label></div>
                                                <input data-role="tagsinput" id="matchWords" class="form-control" placeholder="Skriv Matchord"
                                                    name="matchWords" value="{{old('matchWords')}}">
                                            </div>
                                        </div>
        
                                        <div class="col-md-4 col-lg-4 col-xl-4">
                                            <div class="form-group">
                                                <div><label>Negative Matchord <span style="color:blue">(Hvis
                                                            Nogen)</span></label></div>
                                                <input data-role="tagsinput" id="nMatchWords" class="form-control"
                                                    placeholder="Skriv Negative Matchord" name="nMatchWords"
                                                    class="input-height" value="{{old('nMatchWords')}}">
                                            </div>
                                        </div>
                                        
        
                                        <div class="col-md-4 col-lg-4 col-xl-4">
                                            <div class="form-group">
                                                <label>Rediger profiltekst</label>
                                                <textarea type="textarea" id="profile_detail" rows="4" placeholder="Skriv Noget..."
                                                    class="form-control" name="profile_detail" ></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-lg-4 col-xl-4">
                                            <div class="form-group">
                                                <input title="Upload Dit Billede" type="file" class="dropify"
                                                    id="profileImageUpload" accept=".png, .jpg, .jpeg"
                                                    data-max-file-size="5M" data-height="130" data-width="250"
                                                    name="profilePicture" >
                                            </div>
                                        </div>
                                        {{-- <div class="col-md-4 col-lg-4 col-xl-4">
                                            <div class="form-group">
                                                <label>Portal</label>
                                                <select name="portal" id="portal" class="form-control select select2" >
                                                    @foreach ($portals as $portal)
                                                    <option value="{{ $portal->id }}">{{ $portal->portalType }}</option>
                                                    @endforeach
                                                </select> 
                                            </div>
                                        </div> --}}
                                        <div class="col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label for="name">Password  <span style="color:green">(if any)</span></label>
                                                <input type="password" class="form-control" name="password"> 
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label for="name">Confirm Password  <span style="color:green">(if any)</span></label>
                                                <input type="password" class="form-control" name="confirm-password"> 
                                            </div>
                                        </div>
                                    </div>
                                </div>

								<div class="modal-footer">
                                <button class="btn ripple btn-success" type="submit" style="font-weight: bold;text-transform: uppercase;">{{ __('Add') }}</button>
                                    <button class="btn ripple btn-danger" data-dismiss="modal" type="button" style="font-weight: bold;text-transform: uppercase;">Close</button>
								</div>
                            </form>

							</div>
						</div>
					</div>
				<!-- User Edit Model -->

                <!-- Member Edit Model -->
					<div class="modal" id="memberEditModal">
						<div class="modal-dialog" role="document">
							<div class="modal-content modal-content-demo shadow">
								<div class="modal-header">
									<h6 class="modal-title" style="text-transform: uppercase;">Member Edit</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
								</div>
                            <form method="POST" action="{{ route('admin.member.update') }}" enctype="multipart/form-data">
                                @csrf
								<div class="modal-body">
                                    <div class="row">
                                    <div id="editid"><input type="hidden" class="form-control" id="edit-id" name="id" value=""></div>
                                    {{-- <div class="col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="name">User Name </label>
                                            <div id="editusername">
                                                <input type="text" class="form-control" id="edit-username" name="username" value="" >
                                            </div>
                                        </div>
                                    </div> --}}
                                    <div class="col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="name">First Name </label>
                                            <div id="editfirstName">
                                                <input type="text" class="form-control" id="edit-firstName" name="firstName" value="" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="name">Last Name </label>
                                            <div id="editlastName">
                                                <input type="text" class="form-control" id="edit-lastName" name="lastName" value="" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="name">Email </label>
                                            <div id="editemail">
                                                <input type="text" class="form-control" id="edit-email" name="email" value="" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="name">Birthday </label>
                                            <div id="editdob">
                                                <input class="form-control" type="date" id="edit-dob" placeholder="Fødselsdag" name="dob" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="name">Gender </label>
                                            <div id="editsex">
                                                <select class="form-control select select2" id="edit-sex" name="sex">
                                                    <option value="Mand">MAND</option>
                                                    <option value="Kvinder">KVINDE</option>
                                                    <option value="Par">PAR</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="name">I'm looking for </label>
                                            <div id="editseek">
                                                <select class="form-control select select2" id="edit-seek" name="seek">
                                                    <option value="Sexpartner">Sexpartner</option>
                                                    <option value="Kæreste">Kæreste</option>
                                                    <option value="Venner">Venner</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="name">I am looking for (gender) </label>
                                            <div id="editseekg">
                                                <select class="form-control select select2" id="edit-seekg" name="seekg">
                                                    <option value="Kvinder">Kvinder</option>
                                                    <option value="Mand">Mænd</option>
                                                    <option value="Par">Par</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                        <div class="col-md-4 col-lg-4 col-xl-4">
                                            <div class="form-group">
                                                <label>Land</label>
                                                <select class="form-control select select2" id="edit-country" name="country" >
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
                                                <label>Postnummer</label>
                                                <input type="text" id="edit-zipcode" name="zipCode" class="form-control" placeholder="Postnummer" value="{{old('zipcode')}}" >
                                                @if ($errors->has('zipcode'))
                                                <span class=" text-danger" role="alert">
                                                    <strong>{{ $errors->first('zipcode') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-lg-4 col-xl-4">
                                            <div class="form-group">
                                                <label>Civilstatus</label>
                                                <select name="civilStatus" id="edit-civilStatus" class="form-control select select2" >
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
                                                <label>Seksualitet</label>
                                                <select name="sexualOrientation" id="edit-sexualOrientation" class="form-control select select2" >
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
                                                <label>Højde</label>
                                                <select name="height" id="edit-height" class="form-control select select2" >
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
                                                <label>Vægt</label>
                                                <select name="weight" id="edit-weight" class="form-control select select2" >
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
                                                <label>Øjenfarve</label>
                                                <select name="eyeColor" id="edit-eyeColor" class="form-control select select2" >
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
                                                <label>Hårfarve</label>
                                                <select name="hairColor" id="edit-hairColor" class="form-control select select2" >
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
                                                <label>Kropsbygning</label>
                                                <select name="bodyType"  id="edit-bodyType" class="form-control select select2" >
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
                                                <label>Børn</label>
                                                <select name="children" id="edit-children" class="form-control select select2" >
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
                                                <div><label>Matchord</label></div>
                                                <input data-role="tagsinput" id="edit-matchWords" class="form-control" placeholder="Skriv Matchord"
                                                    name="matchWords" value="{{old('matchWords')}}">
                                            </div>
                                        </div>
        
                                        <div class="col-md-4 col-lg-4 col-xl-4">
                                            <div class="form-group">
                                                <div><label>Negative Matchord <span style="color:blue">(Hvis
                                                            Nogen)</span></label></div>
                                                <input data-role="tagsinput" id="edit-nMatchWords" class="form-control"
                                                    placeholder="Skriv Negative Matchord" name="nMatchWords"
                                                    class="input-height" value="{{old('nMatchWords')}}">
                                            </div>
                                        </div>
                                        
        
                                        <div class="col-md-4 col-lg-4 col-xl-4">
                                            <div class="form-group">
                                                <label>Rediger profiltekst</label>
                                                <textarea type="textarea" id="edit-profile_detail" rows="4" placeholder="Skriv Noget..."
                                                    class="form-control" name="profile_detail" ></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-lg-4 col-xl-4">
                                            <div class="form-group">
                                                <input title="Upload Dit Billede" type="file" class="dropify"
                                                    id="edit-profileImageUpload" accept=".png, .jpg, .jpeg"
                                                    data-max-file-size="5M" data-height="130" data-width="250"
                                                    name="profilePicture" >
                                            </div>
                                        </div>
                                        {{-- <div class="col-md-4 col-lg-4 col-xl-4">
                                            <div class="form-group">
                                                <label>Portal</label>
                                                <select name="portal" id="edit-portal" class="form-control select select2" >
                                                    @foreach ($portals as $portal)
                                                    <option value="{{ $portal->id }}">{{ $portal->portalType }}</option>
                                                    @endforeach
                                                </select> 
                                            </div>
                                        </div> --}}
                                        <div class="col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label for="name">Password  <span style="color:green">(if any)</span></label>
                                                <input type="password" class="form-control" name="password"> 
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label for="name">Confirm Password  <span style="color:green">(if any)</span></label>
                                                <input type="password" class="form-control" name="confirm-password"> 
                                            </div>
                                        </div>
                                    </div>
                                </div>

								<div class="modal-footer">
                                <button class="btn ripple btn-success" type="submit" style="font-weight: bold;text-transform: uppercase;">{{ __('Update') }}</button>
                                    <button class="btn ripple btn-danger" data-dismiss="modal" type="button" style="font-weight: bold;text-transform: uppercase;">Close</button>
								</div>
                            </form>

							</div>
						</div>
					</div>
				<!-- Member Edit Model -->


            </div>
        <!-- Page Content-->

    @endsection
    @push('script')
    	<!-- Data Table js -->
        <script src="{{ asset('cbs/backend/plugins/datatable/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('cbs/backend/plugins/datatable/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('cbs/backend/js/table-data.js') }}"></script>
        <script src="{{ asset('cbs/backend/plugins/datatable/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('cbs/backend/plugins/datatable/fileexport/dataTables.buttons.min.js') }}"></script>
        <script src="{{ asset('cbs/backend/plugins/datatable/fileexport/buttons.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('cbs/backend/plugins/datatable/fileexport/jszip.min.js') }}"></script>
        <script src="{{ asset('cbs/backend/plugins/datatable/fileexport/pdfmake.min.js') }}"></script>
        <script src="{{ asset('cbs/backend/plugins/datatable/fileexport/vfs_fonts.js') }}"></script>
        <script src="{{ asset('cbs/backend/plugins/datatable/fileexport/buttons.html5.min.js') }}"></script>
        <script src="{{ asset('cbs/backend/plugins/datatable/fileexport/buttons.print.min.js') }}"></script>
        <script src="{{ asset('cbs/backend/plugins/datatable/fileexport/buttons.colVis.min.js') }}"></script>

        <!-- Model JS -->
            <script>
                $(document).ready(function(){

                    // Member Data Model
                        $(document).on('click', '.showdata', function(){
                            var id = $(this).attr('id');
                            // $('#form_result').html('');
                            $.ajax({
                            url:"memberShowModal/"+id+"",
                            dataType:"json",
                            success:function(html){
                                $('#data').html(html.data);
                                $('#memberShowModal').modal('show');
                            }
                            })
                        });

                    // Member Data Model
                        $(document).on('click', '.editdata', function(){
                            var id = $(this).attr('id');
                            // $('#form_result').html('');
                            $.ajax({
                            url:"memberEditModal/"+id+"",
                            dataType:"json",
                            success:function(html){
                                $("#edit-id").val(html.data.id);
                                $("#edit-username").val(html.data.username);
                                $("#edit-firstName").val(html.data.firstName);
                                $("#edit-lastName").val(html.data.lastName);
                                $("#edit-dob").val(html.data.dob);
                                $("#edit-sex").val(html.data.sex).trigger('change');
                                $("#edit-seek").val(html.data.seek).trigger('change');
                                $("#edit-seekg").val(html.data.seekg).trigger('change');
                                $("#edit-email").val(html.data.email);
                                $("#edit-country").val(html.data.country).trigger('change');
                                $("#edit-zipcode").val(html.data.zipCode);
                                $("#edit-civilStatus").val(html.data.civilStatus).trigger('change');
                                $("#edit-sexualOrientation").val(html.data.sexualOrientation).trigger('change');
                                $("#edit-height").val(html.data.height).trigger('change');
                                $("#edit-weight").val(html.data.weight).trigger('change');
                                $("#edit-eyeColor").val(html.data.eyeColor).trigger('change');
                                $("#edit-hairColor").val(html.data.hairColor).trigger('change');
                                $("#edit-bodyType").val(html.data.bodyType).trigger('change');
                                $("#edit-children").val(html.data.children).trigger('change');
                                $("#edit-matchWords").val(html.data.matchWords);
                                $("#edit-nMatchWords").val(html.data.nMatchWords);
                                $("#edit-profile_detail").val(html.data.profile_detail);
                                var base_url = window.location.origin;
                                $(".dropify-preview").show();
                                $('.dropify-preview .dropify-render').html(`<img src=`+base_url+`/`+html.data.profilePicture+` />`);
                                // $("#edit-portal").val(html.data.portal_id).trigger('change');
                                $('#memberEditModal').modal('show');
                            }
                            })
                        });
                    // Member Data Model

                     // Add User Data Model
                    $(document).on('click', '.adddata', function(){
                        $(".dropify-preview").hide();
                        $('.dropify-preview .dropify-render img').remove();
                        $('#memberAddModal').modal('show');
                    });
                    // Add User Data Model
                });
            </script>
        <!-- Model JS -->

        <!-- Delete Sweet Alert -->
            <script type="text/javascript">
                function destroy(id) {

                    swal({
                    title: "Are you sure ?",
                    text: "You will not be able to recover this imaginary file !",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Yes, Delete It !",
                    cancelButtonText: "No, Cancel Please !",
                    closeOnConfirm: false,
                    closeOnCancel: false
                    },
                    function(isConfirm) {
                    if (isConfirm) {
                        event.preventDefault();
                        document.getElementById('delete-form-'+id).submit();
                    // swal("Deleted!", "Your imaginary file has been deleted.", "success");
                    } else {
                    swal("Cancelled", "Your imaginary file is safe :)", "error");
                    }
                    });

                }
            </script>
        <!-- Delete Sweet Alert -->



        <!-- Non Paid Member DataTable -->
    <script>
        $('#nonPaidMember').DataTable({
            language: {
                searchPlaceholder: 'Search...',
                sSearch: '',
                lengthMenu: '_MENU_ items/page',
            }
        });
    </script>
        <!-- Non Paid Member DataTable -->



        

    @endpush
<!-- Developed By CBS -->