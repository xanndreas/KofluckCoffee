<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTrainingCandidateRequest;
use App\Http\Requests\StoreTrainingCandidateRequest;
use App\Http\Requests\UpdateTrainingCandidateRequest;
use App\TrainingCandidate;
use App\TrainingClass;
use App\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class TrainingCandidateController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('training_candidate_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = TrainingCandidate::with(['training_class', 'user'])->select(sprintf('%s.*', (new TrainingCandidate)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'training_candidate_show';
                $editGate      = 'training_candidate_edit';
                $deleteGate    = 'training_candidate_delete';
                $crudRoutePart = 'training-candidates';

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
            $table->editColumn('full_name', function ($row) {
                return $row->full_name ? $row->full_name : "";
            });
            $table->editColumn('whatsapp', function ($row) {
                return $row->whatsapp ? $row->whatsapp : "";
            });
            $table->addColumn('training_class_name', function ($row) {
                return $row->training_class ? $row->training_class->name : '';
            });

            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->editColumn('user.email', function ($row) {
                return $row->user ? (is_string($row->user) ? $row->user : $row->user->email) : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'training_class', 'user']);

            return $table->make(true);
        }

        return view('admin.trainingCandidates.index');
    }

    public function create()
    {
        abort_if(Gate::denies('training_candidate_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $training_classes = TrainingClass::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.trainingCandidates.create', compact('training_classes', 'users'));
    }

    public function store(StoreTrainingCandidateRequest $request)
    {
        $trainingCandidate = TrainingCandidate::create($request->all());

        return redirect()->route('admin.training-candidates.index');
    }

    public function edit(TrainingCandidate $trainingCandidate)
    {
        abort_if(Gate::denies('training_candidate_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $training_classes = TrainingClass::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $trainingCandidate->load('training_class', 'user');

        return view('admin.trainingCandidates.edit', compact('training_classes', 'users', 'trainingCandidate'));
    }

    public function update(UpdateTrainingCandidateRequest $request, TrainingCandidate $trainingCandidate)
    {
        $trainingCandidate->update($request->all());

        return redirect()->route('admin.training-candidates.index');
    }

    public function show(TrainingCandidate $trainingCandidate)
    {
        abort_if(Gate::denies('training_candidate_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $trainingCandidate->load('training_class', 'user');

        return view('admin.trainingCandidates.show', compact('trainingCandidate'));
    }

    public function destroy(TrainingCandidate $trainingCandidate)
    {
        abort_if(Gate::denies('training_candidate_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $trainingCandidate->delete();

        return back();
    }

    public function massDestroy(MassDestroyTrainingCandidateRequest $request)
    {
        TrainingCandidate::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}