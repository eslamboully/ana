<?php
namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Mail\UserInvitation;
use App\Models\Board;
use App\Models\Comment;
use App\Models\File;
use App\Models\SmallBoard;
use App\Models\User;
use App\Models\VerySmallBoard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;

class BoardController extends Controller {

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
        $board = Board::create(['name' => $request->get('name'),'user_id' => $user->id,'isPersonalities' => 0]);

        $managerRole = Role::create(['name' => "manager-board-$board->id"]);
        $monitorRole = Role::create(['name' => "monitor-board-$board->id"]);
        $employeeRole = Role::create(['name' => "employee-board-$board->id"]);

        $user->assignRole($managerRole);

        return redirect()->route('board.index',['id' => $board->id,'name' => str_replace(' ','-',$board->name)]);
    }

    public function sendInvitation(Request $request)
    {
        $board = Board::find($request->get('id'));
        $data['board'] = $board;
        $data['user']  = auth()->user()->id;
        Mail::to($request->get('email'))->send(new UserInvitation($data));

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
                auth()->user()->assignRole("employee-board-$board->id");
            }
            // register or login before accept invitation
            return redirect()->route('register',['board_id' => $board->id]);
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
            ->where('board_id',$request->get('board_id'))->first();
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

    public function usersPermissionsGet(Request $request)
    {
        $board_id = $request->get('id');

        $users = User::with(['roles'])->role([
            "manager-board-$board_id",
            "monitor-board-$board_id",
            "employee-board-$board_id"
        ])->where('id','!=',auth()->user()->id)->get();


        return response()->json(['data' => $users,'message' => null,'status' => 1]);
    }

    public function usersPermissionsUpdate(Request $request)
    {
        $board_id = $request->get('board_id');
            foreach ($request->get('users') as $id => $permissions)
            {
                $permissionsForUsers = [];
                $user = User::find($id);
                $user->removeRole("manager-board-$board_id");
                $user->removeRole("monitor-board-$board_id");
                $user->removeRole("employee-board-$board_id");
                foreach ($permissions as $permission=>$on)
                {
                    array_push($permissionsForUsers,$permission);
                }
                $user->assignRole($permissionsForUsers);
            }

        return response()->json(['data' => $user,'message' => null,'status' => 1]);
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