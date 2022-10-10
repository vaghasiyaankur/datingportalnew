<?php


namespace App\Http\Controllers;


use App\User;
use App\Http\Controllers\Controller;    
use DB;
use Hash;
use App\Models\Portal;
use App\Models\PortalJoinUser;
use App\Models\Membership;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use File;


class MemberController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function index(Request $request)
    {
        
        $paid_users = User::orderBy('id','ASC')->whereHas('portalJoinUsers', function ($query)
        {
            $query->where('membership_id','!=', 1)->whereDate('membership_ends_at', '>', Carbon::now());
        })->get();

        $paid_users_ids = User::orderBy('id','ASC')->whereHas('portalJoinUsers', function ($query)
        {
             $query->where('membership_id','!=', 1)->whereDate('membership_ends_at', '>', Carbon::now());
        })->pluck('id');

        $nonpaid_users = User::whereNotIn('id', $paid_users_ids)->get();

        $total = User::count();

        $statuses = $this->reportedStatusesList();

        $portals = Portal::all();

        return view('cbs.backend.members',compact('paid_users','nonpaid_users', 'total', 'portals', 'statuses'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password'
        ]);


        $input = $request->all();
        $input['password'] = Hash::make($input['password']);


        $member = User::create($input);


        return redirect()->route('members.index')
                        ->with('success','Member created successfully');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function memberShowModal($id)
    {
        if(request()->ajax())
        {

        $member = User::find($id);

        // $data = '<h5><b>Name :</b> ' .$member->name.'</h5>';
        $data = '<h5>Email : ' .$member->email.'</h5>';


         return response()->json([
                'data' => $data,
                ]);
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     
    public function memberEditModal($id)
    {
        if(request()->ajax())
        {
            
            $member = User::where('id',$id)->with('portalJoinUsers')->first();
            $portalJoinUsers = PortalJoinUser::where('user_id', $member->id)->first();

            $data = [];
            $data['id'] = $member->id;
            $data['username'] = $portalJoinUsers->username;
            $data['email'] = $member->email;
            $data['firstName'] = $portalJoinUsers->firstName;
            $data['lastName'] = $portalJoinUsers->lastName;
            $data['dob'] = $portalJoinUsers->dob;
            $data['sexualOrientation'] = $portalJoinUsers->sexualOrientation;
            $data['sex'] = $portalJoinUsers->sex;
            $data['zipCode'] = $portalJoinUsers->zipCode;
            $data['civilStatus'] = $portalJoinUsers->civilStatus;
            $data['height'] = $portalJoinUsers->height;
            $data['weight'] = $portalJoinUsers->weight;
            $data['hairColor'] = $portalJoinUsers->hairColor;
            $data['eyeColor'] = $portalJoinUsers->eyeColor;
            $data['searching'] = $portalJoinUsers->searching ? implode(' ',json_decode(str_replace(' ', '', $portalJoinUsers->searching))) : '';
            $data['bodyType'] = $portalJoinUsers->bodyType;
            $data['tattoos'] = $portalJoinUsers->tattoos;
            $data['piercing'] = $portalJoinUsers->piercing;
            $data['children'] = $portalJoinUsers->children;
            $data['smoking'] = $portalJoinUsers->smoking;
            $data['matchWords'] = $portalJoinUsers->matchWords ? implode(' ',json_decode(str_replace(' ', '', $portalJoinUsers->matchWords))) : '';
            $data['nMatchWords'] = $portalJoinUsers->nMatchWords ? implode(' ', json_decode(str_replace(' ', '', $portalJoinUsers->nMatchWords))) : '';
            $data['profilePicture'] = $portalJoinUsers->profilePicture;
            $data['profile_detail'] = $portalJoinUsers->profile_detail;
            $data['quickblox_username'] = $portalJoinUsers->quickblox_username;
            $data['seek'] = $portalJoinUsers->seek;
            $data['seekg'] = $portalJoinUsers->seekg;
            $data['country'] = $portalJoinUsers->country;
            // $data['portal_id'] = $portalJoinUsers->portal_id;
            // dd($data['profilePicture']);
            return response()->json([
                'data' => $data
            ]);
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'email' => 'required|email|unique:users,email,'.$request->id,
            'password' => 'same:confirm-password'
        ]);
        

        $input = $request->all();
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = array_except($input,array('password'));    
        }


        $member = User::find($request->id);
        $member->update($input);

        $PortalJoinUser = PortalJoinUser::where('user_id', $request->id)->first();
        $imagePath = $PortalJoinUser->profilePicture;
         if($file = $request->file('profilePicture')){

             $name = time().'.'.$file->getClientOriginalExtension();          
             $file->move('uploads/profilePictures', $name );
             $imagePath = "uploads/profilePictures/". $name;       

            $path = public_path()."/uploads/profilePictures/$PortalJoinUser->profilePicture";
            $result = File::exists($path);

            if($result)
            {
                File::delete($path);
            }
         }

        $update = [];
        $update['profilePicture'] = $imagePath;
        // if(isset($input['username']))
        //     $update['username'] = $input['username'];
        if(isset($input['firstName']))
            $update['firstName'] = $input['firstName'];
        if(isset($input['lastName']))
            $update['lastName'] = $input['lastName'];
        if(isset($input['dob']))
            $update['dob'] = date('Y-m-d', strtotime($input['dob']));
        if(isset($input['sexualOrientation']))
            $update['sexualOrientation'] = $input['sexualOrientation'];
        if(isset($input['sex']))
            $update['sex'] = $input['sex'];
        if(isset($input['seek']))
            $update['seek'] = $input['seek'];
        if(isset($input['seekg']))
            $update['seekg'] = $input['seekg'];
        if(isset($input['country']))
            $update['country'] = $input['country'];
        if(isset($input['zipCode']))
            $update['zipCode'] = $input['zipCode'];
        if(isset($input['civilStatus']))
            $update['civilStatus'] = $input['civilStatus'];
        if(isset($input['height']))
            $update['height'] = $input['height'];
        if(isset($input['weight']))
            $update['weight'] = $input['weight'];
        if(isset($input['hairColor']))
            $update['hairColor'] = $input['hairColor'];
        if(isset($input['eyeColor']))
            $update['eyeColor'] = $input['eyeColor'];
        if(isset($input['bodyType']))
            $update['bodyType'] = $input['bodyType'];
        if(isset($input['children']))
            $update['children'] = $input['children'];
        if(isset($input['profile_detail']))
            $update['profile_detail'] = $input['profile_detail'];
        if(isset($input['matchWords']))
            $update['matchWords'] = json_encode(explode(",",$input['matchWords']));
        if(isset($input['nMatchWords']))
            $update['nMatchWords'] = json_encode(explode(",",$input['nMatchWords']));
              

        $newPortalJoinUser = PortalJoinUser::where('user_id', $request->id)->update($update);


        Toastr::success('Member Information successfully updated', 'Success');
        return redirect()->back();
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deactive($id)
    {
        if ($id =="1")
            {
                Toastr::error('Superadmin cant deactive !', 'Error');
            }
        else
            {
                $member = User::find($id);
                $member->status = "0";
                $member->save();
                Toastr::success('Member deactived successfully', 'Success');
            }

        return redirect()->back();
    }

    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('members.index')
                        ->with('success','Member deleted successfully');
    }

    /**
     * Add Super User from backend side.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addsuperuser(Request $request)
    {
        // dd(Carbon::now()->addYears(200));
        $Membership = Membership::orderBy('cost', 'desc')->first();

        $this->validate($request, [
            'email' => 'required|email|unique:users,email,'.$request->id,
            'password' => 'required|same:confirm-password',
            'username' => 'required|unique:portal_join_users'
        ]);
        
        $superUser = new User();
        $superUser->email = $request->email;
        $superUser->email_verified_at = Carbon::now();
        $superUser->password = Hash::make($request->password);
        $superUser->super_user = 1;
        $superUser->save();

        $imagePath = '';
         if($file = $request->file('profilePicture')){
             $name = time().'.'.$file->getClientOriginalExtension();          
             $file->move('uploads/profilePictures', $name );
             $imagePath = "uploads/profilePictures/". $name;       
         }

        $portals = Portal::whereIn('portalType', ['Dating', 'Sugar dating', 'Fræk dating'])->get();
        foreach($portals as $portal){
            $newPortalJoinUser = new PortalJoinUser();
            $newPortalJoinUser->user_id = $superUser->id;
            $newPortalJoinUser->portal_id = $portal->id;
            $newPortalJoinUser->membership_id = $Membership->id;
            $newPortalJoinUser->membership_ends_at = Carbon::now()->addYears(5);
            $newPortalJoinUser->username = $request->username.'_'.$portal->id;
            $newPortalJoinUser->firstName = $request->firstName;
            $newPortalJoinUser->lastName = $request->lastName;
            $newPortalJoinUser->dob = date('Y-m-d', strtotime($request->dob));
            $newPortalJoinUser->sexualOrientation = $request->sexualOrientation;
            $newPortalJoinUser->sex = $request->sex;
            $newPortalJoinUser->seek = $request->seek;
            $newPortalJoinUser->seekg = $request->seekg;
            $newPortalJoinUser->country = $request->country;
            $newPortalJoinUser->zipCode = $request->zipCode;
            $newPortalJoinUser->civilStatus = $request->civilStatus;
            $newPortalJoinUser->height = $request->height;
            $newPortalJoinUser->weight = $request->weight;
            $newPortalJoinUser->hairColor = $request->hairColor;
            $newPortalJoinUser->eyeColor = $request->eyeColor;
            $newPortalJoinUser->bodyType = $request->bodyType;
            $newPortalJoinUser->children = $request->children;
            $newPortalJoinUser->profile_detail = $request->profile_detail;
            $newPortalJoinUser->matchWords = json_encode(explode(",",$request->matchWords));
            $newPortalJoinUser->nMatchWords = json_encode(explode(",",$request->nMatchWords));
            $newPortalJoinUser->profilePicture = $imagePath;
            $newPortalJoinUser->save();
        }

        $update = User::where('id', $superUser->id)->update(['portalJoinUser_id' => $newPortalJoinUser->id]);
        

        Toastr::success('Super User successfully Added', 'Success');
        return redirect()->back();
    }
}
