<?php


namespace App\Http\Repositories\BikesAdmin;


use App\Models\Bike;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Gate;

class BikesAdminSqlRepository implements IBikesAdminRepository
{

    /**
     * @var Bike
     */
    private $bike;
    /**
     * @var User
     */
    private $user;

    public function __construct(Bike $bike , User $user)
    {
        $this->bike = $bike;
        $this->user = $user;
    }

    private function isOwner(){
        return auth()->user()->hasRole('Owner');
    }
    public function allAjax($request)
    {

        abort_if(Gate::denies('bike_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $isOwner = $this->isOwner();

        $ownerId = auth()->user()->id;
        $query = null;
        if ($request->ajax()) {
            if($isOwner){

                $query = $this->bike::where('owner_id' , $ownerId)->with(['owner'])->select(sprintf('%s.*', (new Bike)->table));
            }else{
                $query = $this->bike::with(['owner'])->select(sprintf('%s.*', (new Bike)->table));
            }

            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'bike_show';
                $editGate      = 'bike_edit';
                $deleteGate    = 'bike_delete';
                $crudRoutePart = 'bikes';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : "";
            });
            $table->editColumn('brand', function ($row) {
                return $row->brand ? $row->brand : "";
            });
            $table->addColumn('owner_name', function ($row) {
                return $row->owner ? $row->owner->name : '';
            });

            $table->editColumn('quantity', function ($row) {
                return $row->quantity ? $row->quantity : "";
            });
            $table->editColumn('price_per_day', function ($row) {
                return $row->price_per_day ? $row->price_per_day : "";
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? Bike::STATUS_SELECT[$row->status] : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'owner']);

            return $table->make(true);
        }

        $users = null;
        if($isOwner){
            $users = $this->user::where('id' , $ownerId)->get();
        }else{
            $users = $this->user::all();
        }


        return view('admin.bikes.index', compact('users'));
    }

    public function getBike(Bike $bike)
    {
        abort_if(Gate::denies('bike_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bike->load('owner', 'bikeRentals');

        return view('admin.bikes.show', compact('bike'));
    }

    public function showCreateView()
    {
        abort_if(Gate::denies('bike_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $owners = null;
        $isOwner = $this->isOwner();

        if($isOwner){
            $ownerId = auth()->user()->id;
//            $owners = $this->user->where('id' , $ownerId)->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
            return view('admin.bikes.create', compact( 'ownerId' , 'isOwner'));
        }else{
            $owners = $this->user->all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        }

        return view('admin.bikes.create', compact('owners' , 'isOwner'));
    }

    public function storeBike($values , $photos)
    {
        if ($this->isOwner()){
            $values['status'] = 'Pending';
            $values['owner_id'] = auth()->user()->id;
        }
        $bike = $this->bike->create($values);

        foreach ($photos as $file) {
            $bike->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('photos');
        }


        return redirect()->route('admin.bikes.index');
    }

    public function showUpdateView(Bike $bike)
    {
        abort_if(Gate::denies('bike_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $owners = null;
        $isOwner = $this->isOwner();
        if($isOwner){
            $ownerId = auth()->user()->id;
            return view('admin.bikes.edit', compact( 'ownerId' , 'isOwner' , 'bike'));
        }else{

            $owners = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

            $bike->load('owner');

        }

        return view('admin.bikes.edit', compact('owners', 'bike' , 'isOwner'));
    }

    public function updateBike(Bike $bike, $values , $photos)
    {
        $bike->update($values);

        if (count($bike->photos) > 0) {
            foreach ($bike->photos as $media) {
                if (!in_array($media->file_name, $photos)) {
                    $media->delete();
                }
            }
        }

        $media = $bike->photos->pluck('file_name')->toArray();

        foreach ($photos as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $bike->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('photos');
            }
        }

        return redirect()->route('admin.bikes.index');
    }

    public function deleteBike(Bike $bike)
    {
        abort_if(Gate::denies('bike_delete'),
            Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bike->delete();

        return back();
    }

    public function deleteBikes($bikes)
    {
        $this->bike::whereIn('id', $bikes)->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
