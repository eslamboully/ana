<?php
namespace App\Http\Controllers\Front;

use App\Events\AddBoard;
use App\Events\DeleteBoard;
use App\Events\SendMessage;
use App\Events\UpdateBoard;
use App\Events\UpdateOldBoard;
use App\Http\Controllers\Controller;
use App\Mail\AddMissionToUser;
use App\Mail\UserInvitation;
use App\Models\Board;
use App\Models\Comment;
use App\Models\File;
use App\Models\Log;
use App\Models\Package;
use App\Models\SmallBoard;
use App\Models\User;
use App\Models\VerySmallBoard;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class BoardController extends Controller {

    protected $langs = ['ar' => 'Arabic','en' => 'English'];
    public function board($id,$name)
    {
        $myBoard = Board::find($id);
        return view('Front.board',['myBoard' => $myBoard]);
    }

    public function boards()
    {
        return view('Front.boards');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);
        $user = auth()->user();
        // Create board
        $board = Board::create([
            'name' => $request->get('name'),
            'user_id' => $user->id,
            'isPersonalities' => 0,
            'startDate' => $request->get('startDate'),
            'endDate' => $request->get('endDate'),
        ]);

        // Create Small Board
        SmallBoard::create(['title' => 'قائمة المهام','board_id' => $board->id,'bg-color' => 'blue','count_number' => 1]);
        SmallBoard::create(['title' => 'قيد التنفيذ','board_id' => $board->id,'bg-color' => 'red','count_number' => 2]);
        SmallBoard::create(['title' => 'منتهي','board_id' => $board->id,'bg-color' => 'cyan','count_number' => 3]);

        $managerRole = Role::create(['name' => "accountant-board-$board->id"]);
        $managerRole = Role::create(['name' => "manager-board-$board->id"]);
        $monitorRole = Role::create(['name' => "monitor-board-$board->id"]);
        $employeeRole = Role::create(['name' => "employee-board-$board->id"]);

        $user->assignRole($managerRole);

        $package = new Log();

        // Save With Database Language Not Dimsav Locales
        foreach ($this->langs as $index=>$lang) {
            $package->translateOrNew($index)->title = __('front.add_board_log',['user' => auth()->user()->name],$index);
        }
        $package->board_id = $board->id;
        $package->save();

        return redirect()->route('board.index',['id' => $board->id,'name' => str_replace(' ','-',$board->name)]);
    }

    public function sendInvitation(Request $request)
    {
        $board = Board::find($request->get('id'));
        $data['board'] = $board;
        $data['user']  = auth()->user()->id;
        Mail::to($request->get('email'))->send(new UserInvitation($data));

        $package = new Log();

        // Save With Database Language Not Dimsav Locales
        foreach ($this->langs as $index=>$lang) {
            $package->translateOrNew($index)->title = __('front.invitation_board_log',['user' => auth()->user()->name],$index);
        }
        $package->board_id = $board->id;
        $package->save();
        return response()->json(['data' => null,'message' => null, 'status' => 1]);
    }

    public function acceptInvitation(Request $request)
    {
        $board = Board::find($request->get('board_id'));
        if ($board)
        {
            if (auth()->check())
            {
                // accept the invitation
                if (!auth()->user()->haveBoard($board->id)) {
                    auth()->user()->assignRole("employee-board-$board->id");

                    $package = new Log();

                    // Save With Database Language Not Dimsav Locales
                    foreach ($this->langs as $index=>$lang) {
                        $package->translateOrNew($index)->title = __('front.accept_invitation_board_log',['user' => auth()->user()->name],$index);
                    }
                    $package->board_id = $board->id;
                    $package->save();
                }
                return redirect()->route('home');
            }
            // register or login before accept invitation
            return redirect()->route('register',['token'=>'dsa334?rew32GFHR7fw@!#GSADOSAKO#$@32dssfw43543JGH??FSDfsdsdfrewrewdw$%5&^*&346346547456#$%GFsdtreetyttjtTYJ&^%nhg','board_id' => $board->id]);
        }
        abort(404);
    }

    public function smallBoardAdd(Request $request)
    {
        $results = SmallBoard::query()->where('board_id',$request->get('board_id'));
        $count_number = $results->count() == 0 ? 1 : $results->count() + 1;

        $small = SmallBoard::create([
            'board_id' => $request->get('board_id'),
            'title' => $request->get('title'),
            'bg-color' => $request->get('bg-color'),
            'count_number' => $count_number
        ]);

        $package = new Log();

        // Save With Database Language Not Dimsav Locales
        foreach ($this->langs as $index=>$lang) {
            $package->translateOrNew($index)->title = __('front.add_small_board_log',['user' => auth()->user()->name],$index);
        }
        $package->board_id = $request->get('board_id');
        $package->save();

        return response()->json(['data' => $small,'message' => null,'status' => 1]);
    }

    public function smallBoardChange(Request $request)
    {
        $data = $request->validate([
            'title' => 'sometimes',
            'bg-color' => 'sometimes'
        ]);

        $results = SmallBoard::find($request->get('id'))->update($data);

        return response()->json(['data' => null,'message' => null,'status' => 1]);
    }

    public function smallBoardRemove(Request $request)
    {
        $verysmallboard = SmallBoard::where('id',$request->get('id'))
            ->where('board_id',$request->get('board_id'))->first();

        if (
            auth()->user()->hasRole('manager-board-'.$request->get('board_id'))
            ||
            auth()->user()->hasRole('monitor-board-'.$request->get('board_id'))
        ) {
            $package = new Log();

            // Save With Database Language Not Dimsav Locales
            foreach ($this->langs as $index=>$lang) {
                $package->translateOrNew($index)->title = __('front.remove_small_board_log',['user' => auth()->user()->name,'smallboard' => $verysmallboard->title],$index);
            }
            $package->board_id = $request->get('board_id');
            $package->save();
            $verysmallboard->delete();
            return response()->json(['data' => null,'message' => null,'status' => 1]);
        }
        return response()->json(['data' => null,'message' => null,'status' => 0]);
    }

    public function verySmallBoardChange(Request $request)
    {
        $very = VerySmallBoard::with(['files','comments','users'])->find($request->get('id'));

        $very->update(['small_board_id' => $request->get('small_board_id')]);
        event(new UpdateBoard(['board' => $very , 'user' => auth()->user()]));

        $package = new Log();

        // Save With Database Language Not Dimsav Locales
        foreach ($this->langs as $index=>$lang) {
            $package->translateOrNew($index)->title = __('front.change_very_small_board_log',['user' => auth()->user()->name,'verysmallboard' => $very->title],$index);
        }
        $smallBoard = SmallBoard::find($very->small_board_id);
        $package->board_id = $smallBoard->board_id;
        $package->save();
        return response()->json(['data' => $very,'message' => null,'status' => 1]);
    }

    public function verySmallBoardComments(Request $request)
    {
        $boardFiles = File::with(['verySmallBoard'])
            ->where('board_id',$request->get('id'))
            ->orderBy('very_small_board_id','asc')
            ->get();
        $boardComments = Comment::with(['board','verySmallBoard','user'])
            ->where('board_id',$request->get('id'))
            ->orderBy('very_small_board_id','asc')
            ->get();
        return response()->json(['data' => ['comments'=> $boardComments,'files' => $boardFiles],'message' => null,'status' => 1]);
    }

    public function verySmallBoardInfo(Request $request)
    {
        $verySmallBoard = VerySmallBoard::find($request->get('id'));
        return response()->json(['data' => $verySmallBoard,'message' => null,'status' => 1]);
    }

    public function verySmallBoardUpdate(Request $request)
    {
        $very  = VerySmallBoard::with(['files','comments','users'])->find($request->get('id'));

        if ($very) {
            $very->update($request->only(['title','startDate','dueDate','duration','border']));
        }

        event(new UpdateOldBoard(['board' => $very,'user' => auth()->user()]));

        if ($request->get('comment') !== null) {
            if ($request->get('isPublic') == 0) {
                Comment::create([
                    'user_id' => auth()->user()->id,
                    'board_id' => $request->get('board_id'),
                    'very_small_board_id' => null,
                    'comment' => $request->get('comment')
                ]);
            } else {
                Comment::create([
                    'user_id' => auth()->user()->id,
                    'board_id' => $request->get('board_id'),
                    'very_small_board_id' => $request->get('id'),
                    'comment' => $request->get('comment')
                ]);
            }
        }

        if ($request->file('file')) {
            $name = $request->file('file')->store("","google");

            $url = Storage::disk('google')->url($name.'');
//            $image = $request->file('file');
//            $name = time().'.'.$image->getClientOriginalExtension();
//            $destinationPath = public_path('/uploads/home/files');
//            $image->move($destinationPath, $name);
            if ($request->get('isPublic') == 0) {
                File::create([
                    'board_id' => $request->get('board_id'),
                    'very_small_board_id' => null,
                    'file' => $url
                ]);
            } else {
                File::create([
                    'board_id' => $request->get('board_id'),
                    'very_small_board_id' => $request->get('id'),
                    'file' => $url
                ]);
            }
        }

//        $package = new Log();

        // Save With Database Language Not Dimsav Locales
//        foreach ($this->langs as $index=>$lang) {
//            $package->translateOrNew($index)->title = __('front.update_very_small_board_log',['user' => auth()->user()->name,'verysmallboard' => $very->title],$index);
//        }
//        $smallBoard = SmallBoard::find($very->small_board_id);
//        $package->board_id = $smallBoard->board_id;
//        $package->save();
        return response()->json(['data' => $very,'message' => null,'status' => 1]);
    }

    public function verySmallBoardFiles(Request $request)
    {
        $board = Board::find($request->get('id'));
        $very = $board->verySmallBoard();

        return response()->json(['data' => $very,'message' => null, 'status' => 1]);
    }

    public function verySmallBoardAdd(Request $request)
    {
        $smallBoard = SmallBoard::find($request->get('board_id'));
        if (!auth()->user()->hasRole("manager-board-$smallBoard->board_id")
            || !auth()->user()->hasRole("manager-board-$smallBoard->board_id")
        ) {
            $userId = true;
        } else {
            $userId = false;
        }
        $very = VerySmallBoard::create([
            'small_board_id' => $request->get('board_id'),
            'title' => $request->get('title')
        ]);

        if ($userId) {
            DB::table('very_small_board_user')->insert([
                'very_small_board_id' => $very->id,
                'user_id' => auth()->user()->id,
            ]);
        }

        $package = new Log();

        // Save With Database Language Not Dimsav Locales
        foreach ($this->langs as $index=>$lang) {
            $package->translateOrNew($index)->title = __('front.add_very_small_board_log',['user' => auth()->user()->name,'verysmallboard' => $very->title],$index);
        }
        $package->board_id = $smallBoard->board_id;
        $package->save();

        event(new AddBoard(['board' => $very,'user' => auth()->user()]));
        return response()->json(['data' => $very,'message' => null,'status' => 1]);
    }

    public function verySmallBoardRemove(Request $request)
    {
        $verysmallboard = VerySmallBoard::find($request->get('id'));

        $package = new Log();
        // Save With Database Language Not Dimsav Locales
        foreach ($this->langs as $index=>$lang) {
            $package->translateOrNew($index)->title = __('front.remove_very_small_board_log',['user' => auth()->user()->name,'verysmallboard' => $verysmallboard->title],$index);
        }
        $smallBoard = SmallBoard::find($verysmallboard->small_board_id);
        $package->board_id = $smallBoard->board_id;
        $package->save();

        $verysmallboard->delete();


        event(new DeleteBoard(['board_id' => $request->get('id'),'user_id' => auth()->user()->id]));
        return response()->json(['data' => null,'message' => null,'status' => 1]);
    }

    public function usersPermissionsGet(Request $request)
    {
        $board_id = $request->get('id');

        $users = User::with(['roles'])->role([
            "accountant-board-$board_id",
            "manager-board-$board_id",
            "monitor-board-$board_id",
            "employee-board-$board_id"
        ])->where('id','!=',auth()->user()->id)->get();


        return response()->json(['data' => $users,'message' => null,'status' => 1]);
    }

    public function usersPermissionsUpdate(Request $request)
    {
        $board_id = $request->get('board_id');
            foreach ($request->get('usersIds') as $id)
            {
                $user = User::find($id);
                $user->removeRole("accountant-board-$board_id");
                $user->removeRole("manager-board-$board_id");
                $user->removeRole("monitor-board-$board_id");
                $user->removeRole("employee-board-$board_id");

                $user->assignRole($request->get("permission-user-$id"));
            }

        return response()->json(['data' => null,'message' => null,'status' => 1]);
    }

    public function assignUser(Request $request)
    {
        $board_id = $request->get('board_id');
        $very_small_board = VerySmallBoard::with(['users'])->find($request->get('very_small_board_id'));
        $users = User::with(['roles'])->role([
            "manager-board-$board_id",
            "monitor-board-$board_id",
            "employee-board-$board_id"
        ])->get();

        return response()->json(['data' => ['users' => $users,'very_small_board' => $very_small_board], 'message' => null,'status' => 1]);
    }

    public function assignUserNext(Request $request)
    {
        $very_small_board = VerySmallBoard::find($request->get('very_small_board_id'));

        $bool = 0;

        $very_small_board_is_contains = DB::table('very_small_board_user')
            ->where([
                'very_small_board_id' => $very_small_board->id,
                'user_id' => $request->get('id'),
            ]);

        if ($very_small_board_is_contains->first()) {
            $very_small_board_is_contains->delete();
            $bool = 0;
        } else {
            DB::table('very_small_board_user')->insert([
                'very_small_board_id' => $very_small_board->id,
                'user_id' => $request->get('id'),
            ]);

            $board = Board::find($very_small_board->small_board->board_id);
            $data['board'] = $board;
            $data['user']  = auth()->user()->id;
            $user = User::find($request->get('id'));
            Mail::to($user->email)->send(new AddMissionToUser($data));

            $bool = 1;
        }

        return response()->json(['data' => $bool,'message' => null,'status' => 1]);
    }

    public function boardLogs(Request $request)
    {
        $logs = Log::with(['translations'])->where('board_id',$request->get('board_id'))->get();
        return response()->json(['data' => $logs,'message' => null, 'status' => 1]);
    }

    public function boardBuyPackage(Request $request)
    {
        $package = Package::find($request->get('package_id'));
        return view('Front.buy_package',compact('package'));
    }

    public function boardAfterBuyPackage(Request $request)
    {
        $package = Package::find($request->get('package_id'));
        DB::table('user_package')->insert([
            'user_id' => auth()->user()->id,
            'package_id' => $package->id,
            'start_at' => Carbon::now()->format('d-m-Y'),
            'end_at' => Carbon::now()->addDays($package->days)->format('d-m-Y'),
        ]);

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

    public function langs_rules()
    {
        $rules = [];

        foreach ($this->langs as $index=>$lang) {
            $rules[$index . '.*'] = 'required';
        }

        return $rules;
    }
}
