<?php


namespace App\Http\Repositories\RentalAdmin;


use App\Models\Bike;
use App\Models\Rental;
use App\Models\User;
use Gate;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class RentalSqlRepository implements IRentalRepository
{

    /**
     * @var Bike
     */
    private $rental;
    /**
     * @var User
     */
    private $user;
    /**
     * @var Bike
     */
    private $bike;

    public function __construct(Rental $rental , User $user , Bike $bike)
    {
        $this->rental = $rental;
        $this->user = $user;
        $this->bike = $bike;
    }

    private function isOwner(){
        return auth()->user()->hasRole('Owner');
    }

    public function allAjax($request)
    {
        abort_if(Gate::denies('rental_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $isOwner = $this->isOwner();
        $query = null;
        $ownerId = auth()->user()->id;

        if ($request->ajax()) {
            if($isOwner){
                $ownerId = auth()->user()->id;
                $query = $this->rental::whereHas('bike' , function($q) use($ownerId){
                    $q->where('owner_id' , $ownerId);
                } )->with(['bike', 'client'])

                    ->with('bike.owner')
                    ->select(sprintf('%s.*', (new Rental)->table));
            }else{
                $query = $this->rental::with(['bike', 'client'])

                    ->with('bike.owner')
                    ->select(sprintf('%s.*', (new Rental)->table));
            }

            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;&nbsp;&nbsp;');


            $table->editColumn('actions', function ($row) {
                $viewGate      = 'rental_show';
                $editGate      = 'rental_edit';
                $deleteGate    = 'rental_delete';
                $crudRoutePart = 'rentals';

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
            $table->addColumn('bike_brand', function ($row) {
                return $row->bike ? $row->bike->brand : '';
            });

            $table->addColumn('bike_owner', function ($row) {
                return $row->bike ? $row->bike->owner->name : '';
            });

            $table->addColumn('client_name', function ($row) {
                return $row->client ? $row->client->name : '';
            });

            $table->editColumn('quantity', function ($row) {
                return $row->quantity ? $row->quantity : "";
            });
            $table->editColumn('period_in_days', function ($row) {
                return $row->period_in_days ? $row->period_in_days : "";
            });
            $table->editColumn('amount', function ($row) {
                return $row->amount ? $row->amount : "";
            });

            $table->editColumn('status', function ($row) {
                return $row->status ? Rental::STATUS_SELECT[$row->status] : '';
            });


            $table->rawColumns(['actions', 'placeholder', 'bike', 'client']);



            return $table->make(true);
        }


        $owners = null;
        $bikes = null;
        if($isOwner){
            $owners= $this->user::where('id' , $ownerId)->get();
            $bikes = $this->bike::where('owner_id' , $ownerId)->get();
        }else{
            $owners = $this->user::all();
            $bikes = $this->bike::all();
        }


        //TODO: show based on role
        $users = $this->user::all();


        return view('admin.rentals.index', compact('bikes', 'users' , 'owners'));
    }

    public function getRental(Rental $rental)
    {
        abort_if(Gate::denies('rental_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $rental->load('bike', 'client');

        return view('admin.rentals.show', compact('rental'));
    }

    public function showCreateView()
    {
        abort_if(Gate::denies('rental_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bikes = $this->bike::all()->pluck('brand', 'id')->prepend(trans('global.pleaseSelect'), '');

        $clients = $this->user::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.rentals.create', compact('bikes', 'clients'));
    }

    public function storeRental($values)
    {
        $rental = $this->rental->create($values);

        return redirect()->route('admin.rentals.index');
    }

    public function showUpdateView(Rental $rental)
    {
        abort_if(Gate::denies('rental_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bikes = $this->bike::all()->pluck('brand', 'id')->prepend(trans('global.pleaseSelect'), '');

        $clients = $this->user::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $rental->load('bike', 'client');

        return view('admin.rentals.edit', compact('bikes', 'clients', 'rental'));
    }

    public function updateRental(Rental $rental, $values)
    {
        $rental->update($values);

        return redirect()->route('admin.rentals.index');
    }

    public function deleteRental(Rental $rental)
    {
        abort_if(Gate::denies('rental_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $rental->delete();

        return back();
    }

    public function deleteRentals($rentals)
    {
        $this->rental->whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
