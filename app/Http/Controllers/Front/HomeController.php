<?php
namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Board;
use App\Models\Comment;
use App\Models\File;
use App\Models\SmallBoard;
use App\Models\VerySmallBoard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller {

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

    public function logout()
    {
        auth()->logout();
        return redirect()->route('admin.login');
    }

    public function index()
    {
        $myBoard = Board::query()
            ->where('user_id',auth()->user()->id)
            ->where('isPersonalities',1)
            ->first();
        return view('Front/home',compact('myBoard'));
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
