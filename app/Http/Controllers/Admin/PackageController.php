<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PackageController extends Controller
{
    protected $langs = ['ar' => 'Arabic','en' => 'English'];

    public function index()
    {
        $elements = Package::all();
        return view('Admin.Packages.index',['elements' => $elements]);
    }

    public function create()
    {
        return view('Admin.Packages.create',['languages' => $this->langs]);
    }

    public function store(Request $request)
    {
        $langs_rules = $this->langs_rules();
        $rules = [
            'icon' => 'required',
            'manager_num' => 'required|numeric',
            'employee_num' => 'required|numeric',
            'monitor_num' => 'required|numeric',
            'trial_days' => 'required|numeric',
            'end_days' => 'required|numeric',
            'days' => 'required|numeric',
            'price' => 'required|numeric'
        ];
        $data = $request->validate(array_merge($langs_rules,$rules),[],[
            'icon' => __('admin.icon'),
            'manager_num' => __('admin.manager_num'),
            'employee_num' => __('admin.employee_num'),
            'monitor_num' => __('admin.monitor_num'),
            'trial_days' => __('admin.trial_days'),
            'end_days' => __('admin.end_days'),
            'days' => __('admin.days'),
            'price' => __('admin.price'),
            'ar.title' => __('admin.ar.title'),
            'en.title' => __('admin.en.title'),
        ]);

        // New Object
        $package = new Package();

        // Save With Database Language Not Dimsav Locales
        foreach ($this->langs as $index=>$lang) {
            $package->translateOrNew($index)->title = $data[$index]['title'];
        }

        // Save Other Columns
        $package->manager_num = $data['manager_num'];
        $package->employee_num = $data['employee_num'];
        $package->monitor_num = $data['monitor_num'];
        $package->trial_days = $data['trial_days'];
        $package->end_days = $data['end_days'];
        $package->days = $data['days'];
        $package->price = $data['price'];

        if (array_key_exists('icon',$data)) {
            if ($request->file('icon')) {
                $image = $request->file('icon');
                $name = time().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/uploads/packages');
                $image->move($destinationPath, $name);
                $package->icon = $name;
            }
        }

        // Save The Model
        $package->save();

        Session::flash('success', __('admin.success'));

        return redirect()->route('admin.packages.index');
    }

    public function edit($id)
    {
        $element = Package::find($id);
        return view('Admin.Packages.edit',['element' => $element,'languages' => $this->langs]);
    }

    public function update(Request $request,$id)
    {
        $langs_rules = $this->langs_rules();
        $rules = [
            'icon' => 'sometimes',
            'manager_num' => 'required|numeric',
            'employee_num' => 'required|numeric',
            'monitor_num' => 'required|numeric',
            'trial_days' => 'required|numeric',
            'end_days' => 'required|numeric',
            'days' => 'required|numeric',
            'price' => 'required|numeric'
        ];
        $data = $request->validate(array_merge($langs_rules,$rules));

        $package = Package::find($id);

        // Save With Database Language Not Dimsav Locales
        foreach ($this->langs as $index=>$lang) {
            $package->translateOrNew($index)->title = $data[$index]['title'];
        }

        $package->manager_num = $data['manager_num'];
        $package->employee_num = $data['employee_num'];
        $package->monitor_num = $data['monitor_num'];
        $package->trial_days = $data['trial_days'];
        $package->end_days = $data['end_days'];
        $package->days = $data['days'];
        $package->price = $data['price'];

        if (array_key_exists('icon',$data)) {
            if ($request->file('icon')) {
                $image = $request->file('icon');
                $name = time().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/uploads/packages');
                $image->move($destinationPath, $name);
                $package->icon = $name;
            }
        }

        // Save The Model
        $package->save();

        Session::flash('success', __('admin.success'));
        return redirect()->route('admin.packages.index');
    }

    public function destroy($id)
    {
        $element = Package::find($id);
        $element->delete();

        Session::flash('success', __('admin.success'));

        return redirect()->route('admin.packages.index');
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
