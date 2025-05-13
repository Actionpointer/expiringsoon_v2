<?php

namespace App\Http\Controllers;

use App\Models\Pin;
use App\Models\Bank;
use App\Models\User;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Traits\SecurityTrait;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\StoreResource;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Notifications\UserNotifications\PasswordChangedNotification;

class UserController extends Controller
{
    use SecurityTrait;

    public function __construct(){
        $this->middleware('auth:sanctum');
    }

    public function show(){
        return new UserResource(User::findOrFail(auth()->id()));
    }

    public function update(Request $request){
        /** @var \App\Models\User $user **/
        // dd($request->all());
        $user = auth()->user();
        $validator = Validator::make($request->all(), [
            'firstname' => 'nullable|string',
            'surname' => 'nullable|string',
            'phone' => ['nullable','string',Rule::unique('users')->ignore($user)],
        ],[
            'photo.max' => 'The image is too heavy. Standard size is 2mb',
        ]);
        if ($validator->fails()) {
            return request()->expectsJson() ? 
            response()->json(['status' => false,'message'=> $validator->errors()->first()],401):
            redirect()->back()->withErrors($validator)->withInput();
        }
        if($request->firstname) $user->firstname = $request->firstname;
        if($request->surname) $user->surname = $request->surname;
        if($request->phone) $user->phone = $request->phone;
        if($request->hasFile('photo')){
            if($user->photo) Storage::delete('public/users/'.$user->photo);
            $photo = 'users/'.time().'.'.$request->file('photo')->getClientOriginalExtension();
            $path = storage_path('app/public/users/'.$photo);
            $imgFile = Image::make($request->file('photo'));
            $imgFile->resize(200, 200, function ($constraint) {
                $constraint->aspectRatio();
            })->save($path);
            $user->photo = $photo;
        }
        $user->save();
        return  response()->json([
                'status' => true,
                'message' => 'Profile Updated Successfully',
            ], 200);
            
    }

    public function password(Request $request){
        /** @var \App\Models\User $user **/
        $user = auth()->user();
        $validator = Validator::make($request->all(), [
            'oldpassword' => 'required|string',
            'password' => 'required','string','confirmed'
        ]);
        if ($validator->fails()) {
            return request()->expectsJson() ? 
            response()->json(['status' => false,'message'=> $validator->errors()->first()],401):
            redirect()->back()->withErrors($validator)->with(['result'=> '0','message'=> 'Incorrect Password']);
        }
        if(Hash::check($request->oldpassword, $user->password)){
            $user->password = Hash::make($request->password);
            $user->require_password_change = false;
            $user->save();
            $user->notify(new PasswordChangedNotification);
            return request()->expectsJson() ? 
            response()->json([
                'status' => true,
                'message' => 'Password Updated Successfully',
            ], 200) :
            redirect()->back()->with(['result' => '1','message'=>'Password changed successfully']); //with success
        }
        else {
            return request()->expectsJson() ? 
            response()->json([
                'status' => false,
                'message' => 'Your old Password Does not Match',
            ], 401) :
            redirect()->back()->with(['result' => '1','message'=>'Something went wrong']);
        }
    }

    

    public function pin(Request $request){
        /** @var \App\Models\User $user **/
        $user = auth()->user();
        $validator = Validator::make($request->all(), [
            'pin' => 'required|string|max:4|min:4',
            
        ]);
        if ($validator->fails()) {
            return request()->expectsJson() ? 
            response()->json(['status' => false,'message'=> $validator->errors()->first()],401):
            redirect()->back()
                        ->withErrors($validator)
                        ->withInput()->with(['result'=> '0','message'=> 'PIN operation was not successful!']);
        }
        $pin = Pin::updateOrCreate(['user_id'=> $user->id],['body'=> Hash::make($request->pin),'last_updated_at'=> now()]);
        return request()->expectsJson() ? 
            response()->json([
                'status' => true,
                'message' => 'Pin operation was successfully completed',
            ], 200) :
             redirect()->back()->with(['result' => '1','message'=>'Pin operation was successfully completed']); //with success
    }

    public function notifications(){
        /** @var \App\Models\User $user **/
        $user = auth()->user();
        $notifications = $user->notifications()->orderBy('created_at','desc')->paginate(10);
        return request()->expectsJson() ?
            response()->json([
                'status' => true,
                'message' => $user->notifications->count() ? 'Notifications retrieved Successfully':'No Notifications retrieved',
                'data' => $user->notifications->sortByDesc('created_at'),
                'count' => $user->notifications->count()
            ], 200) :
            view('customer.notifications',compact('user','notifications'));
    }

    public function readNotifications(Request $request){
        $user = auth()->user();
        $user->unreadNotifications->markAsRead();
        return request()->expectsJson() ?
            response()->json([
                'status' => true,
                'message' => 'Notifications marked read',
            ], 200) :
            redirect()->back()->with(['result'=> 1,'message'=> 'Notifications marked read']);
    }

    public function followings(){
        /** @var \App\Models\User $user **/
        $user = auth()->user();
        return request()->expectsJson() ? 
            response()->json([
                'status' => true,
                'data' => StoreResource::collection($user->following),
            ], 200) :
            view('customer.followings',with(['followings'=> $user->following]));
    }

}
