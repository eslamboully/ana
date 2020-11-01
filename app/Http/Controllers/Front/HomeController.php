<?php
namespace App\Http\Controllers\Front;

use App\Events\SendMessage;
use App\Http\Controllers\Controller;
use App\Models\Board;
use App\Models\Comment;
use App\Models\File;
use App\Models\Message;
use App\Models\Package;
use App\Models\SmallBoard;
use App\Models\User;
use App\Models\VerySmallBoard;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller {

    public function site()
    {
        return view('Front.site');
    }
    public function login()
    {
        if (!auth()->check()) {
            return view('Front.login');
        }
        return redirect()->route('home');
    }

    public function login_post(Request $request)
    {
        $arr = ['email' => $request->get('email'),'password' => $request->get('password')];
        if (auth()->attempt($arr,$request->get('remember_me'))){
            return redirect()->route('home');
        }
        Session::flash('message','Invalid Email or Password');
        return redirect()->back();
    }

    public function register()
    {
        if (!auth()->check()) {
            return view('Front.register');
        }
        return redirect()->route('home');
    }

    public function register_post(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|confirmed',
        ]);
        $data['password'] = bcrypt($request->get('password'));

        $user = User::create($data);

        $board = Board::create([
            'name' => 'Personal Board',
            'user_id' => $user->id,
            'isPersonalities' => 1
        ]);

        SmallBoard::create([
            'title' => 'قائمة المهام',
            'board_id' => $board->id,
            'bg-color' => 'blue',
            'count_number' => 1
        ]);

        SmallBoard::create([
            'title' => 'قيد التنفيذ',
            'board_id' => $board->id,
            'bg-color' => 'red',
            'count_number' => 2
        ]);

        SmallBoard::create([
            'title' => 'منتهي',
            'board_id' => $board->id,
            'bg-color' => 'cyan',
            'count_number' => 3
        ]);

        // Insert Free Package 1 Year
        $package = Package::query()->first();
        DB::table('user_package')->insert([
            'user_id' => $user->id,
            'package_id' => $package->id,
            'start_at' => Carbon::now()->format('d-m-Y'),
            'end_at' => Carbon::now()->addYear()->format('d-m-Y'),
        ]);

        if ($request->get('board_id'))
        {
            $board_id = $request->get('board_id');
            $user->assignRole("employee-board-$board_id");
        }
        auth()->loginUsingId($user->id);
        return redirect()->route('home');
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('login');
    }

    public function index()
    {
        $myBoard = Board::query()
            ->where('user_id',auth()->user()->id)
            ->where('isPersonalities',1)
            ->first();
        return view('Front/home',compact('myBoard'));
    }

    public function profile() {
        return view('Front.profile');
    }

    public function profilePost(Request $request) {
        $data = $request->validate([
            'name' => 'sometimes',
            'email' => 'sometimes',
            'password' => 'sometimes',
            'photo' => 'sometimes',
            'phone' => 'sometimes',
            'country' => 'sometimes',
            'address' => 'sometimes',
            'dateOfBirth' => 'sometimes',
            'job' => 'sometimes',
        ]);

        if ($request->get('password')) {
            $data['password'] = bcrypt($request->get('password'));
        }

        if ($request->file('photo')) {
            $image = $request->file('photo');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/users');
            $image->move($destinationPath, $name);
            $data['photo'] = $name;
        }

        $data = array_filter($data);

        auth()->user()->update($data);

        Session::flash('success',__('front.update_success'));

        return redirect()->back();
    }

    public function smallBoardAdd(Request $request)
    {
        $results = SmallBoard::query()->where('board_id',auth()->user()->personal_board()->id)->get();
        $count_number = $results->count() == 0 ? 1 : $results->count() + 1;

        $small = SmallBoard::create([
            'board_id' => auth()->user()->personal_board()->id,
            'title' => $request->get('title'),
            'bg-color' => 'cyan',
            'count_number' => $count_number
        ]);

        return response()->json(['data' => $small,'message' => null,'status' => 1]);
    }

    public function smallBoardChange(Request $request)
    {
        $data = $request->validate([
            'title' => 'sometimes'
        ]);

        $results = SmallBoard::find($request->get('id'))->update($data);

        return response()->json(['data' => null,'message' => null,'status' => 1]);
    }

    public function smallBoardRemove(Request $request)
    {
        $verysmallboard = SmallBoard::where('id',$request->get('id'))
            ->where('board_id',auth()->user()->personal_board()->id)->first();
        $verysmallboard->delete();

        return response()->json(['data' => null,'message' => null,'status' => 1]);
    }

    public function verySmallBoardChange(Request $request)
    {
        $very = VerySmallBoard::find($request->get('id'));
        $very->update(['small_board_id' => $request->get('small_board_id')]);
        return response()->json(['data' => $very,'message' => null,'status' => 1]);
    }

    public function verySmallBoardComments(Request $request)
    {
        $very = VerySmallBoard::with(['comments','files'])->find($request->get('id'));

        return response()->json(['data' => $very,'message' => null,'status' => 1]);
    }

    public function verySmallBoardUpdate(Request $request)
    {
        $very = VerySmallBoard::find($request->get('id'));
        $very->update($request->only(['title','dueDate','border']));
        if ($request->get('comment') !== null) {
            Comment::create(['very_small_board_id' => $request->get('id'),'comment' => $request->get('comment')]);
        }

        if ($request->file('file')) {
            $image = $request->file('file');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/home/files');
            $image->move($destinationPath, $name);
            File::create([
                'very_small_board_id' => $request->get('id'),
                'file' => $name
            ]);
        }
        return response()->json(['data' => $very,'message' => null,'status' => 1]);
    }

    public function verySmallBoardAdd(Request $request)
    {
        $very = VerySmallBoard::create([
            'small_board_id' => $request->get('board_id'),
            'title' => $request->get('title')
        ]);

        return response()->json(['data' => $very,'message' => null,'status' => 1]);
    }

    public function verySmallBoardRemove(Request $request)
    {
        $verysmallboard = VerySmallBoard::find($request->get('id'));
        $verysmallboard->delete();

        return response()->json(['data' => null,'message' => null,'status' => 1]);
    }

    public function boardMessageSend(Request $request)
    {

        $data =  Message::create([
            'board_id' => $request->get('board_id'),
            'message' => $request->get('message'),
            'user_id' => $request->get('user_id'),
        ]);

        $user = User::find($data->user_id);
        event(new SendMessage(['data' =>$data,'user' => $user]));
        return response()->json(['data' => $data,'message' => null,'status' => 1]);
    }

    public function boardResponseMessages(Request $request)
    {

        $board = Board::find($request->get('board_id'));
        $data = Message::with(['user'])->where('board_id',$request->get('board_id'))->get();

        return response()->json(['data' => $data,'board' => $board,'message' => null,'status' => 1]);
    }

    public function lang($lang)
    {
        if (session()->has('lang')) {
            session()->forget('lang');
            session()->put('lang',$lang);
        } else {
            session()->put('lang',$lang);
        }

        return redirect()->back();
    }
}
