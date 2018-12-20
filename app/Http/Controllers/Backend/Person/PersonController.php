<?php

namespace App\Http\Controllers\Backend\Person;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\Backend\Person\CreatePerson;
use App\Http\Requests\Backend\Person\UpdatePerson;
use App\Repositories\Backend\PersonRepository;
use App\Events\Backend\Person\PersonCreated;
use App\Events\Backend\Person\PersonUpdated;
use App\Events\Backend\Person\PersonDeleted;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Models\Person;

class PersonController extends Controller
{
    /** @var $personRepository */
    private $personRepository;

    public function __construct(PersonRepository $personRepo)
    {
        $this->personRepository = $personRepo;
    }

    /**
     * Display a listing of the Person.
     *
     * @param  Request $request
     * @return Response | \Illuminate\View\View|Response
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */

    public function index(Request $request)
    {
        $this->personRepository->pushCriteria(new RequestCriteria($request));
        $data = $this->personRepository->with("jobs")->paginate(25);

        $jobs = [];
        foreach ($data as $item) {
            $jobs[$item->id] = [];
            $person_jobs = PersonJob::where('person_id', '=', $item->id)->get();
            foreach ($person_jobs as $object) {
                $temp = Job::where('id', '=', $object['job_id'])->get();
                if (isset($temp[0])) {
                    array_push($jobs[$item['id']], $temp[0]);
                }
            }
        }

        return view('backend.persons.index', compact("jobs"))->with(
            'persons',
            $data
        );
    }

    /*
     * many to many
     */

    public function job(Request $request, $foriegn_id)
    {
        $this->personRepository->pushCriteria(new RequestCriteria($request));
        $data = $this->personRepository

            ->with("jobs")

            ->paginate(25);

        foreach ($data as $key => $items) {
            $temp2 = [];
            $person_jobs = PersonJob::where(
                'person_id',
                '=',
                $items->id
            )->get();
            foreach ($person_jobs as $item2) {
                array_push($temp2, $item2->job_id);
            }
            if (!in_array($foriegn_id, $temp2)) {
                unset($data[$key]);
            }
        }

        $part = count($data);

        $jobs = [];
        foreach ($data as $item) {
            $jobs[$item->id] = [];
            $person_jobs = PersonJob::where('person_id', '=', $item->id)
                ->get()
                ->toarray();
            foreach ($person_jobs as $object) {
                $temp = Job::where('id', '=', $object['job_id'])
                    ->get()
                    ->toarray();
                if (isset($temp[0])) {
                    array_push($jobs[$item['id']], $temp[0]);
                }
            }
        }

        return view('backend.persons.index', compact("jobs"))->with([
            'persons' => $data,
            'part' => $part
        ]);
    }

    /**
     * Show the form for creating a new Person.
     *
     * @return Response | \Illuminate\View\View|Response
     */
    public function create()
    {
        $jobs = Job::all();
        $selectedJob = [];

        return view('backend.persons.create', compact("jobs", "selectedJob"));
    }

    /**
     * Store a newly created Person in storage.
     *
     * @param CreatePerson $request
     *
     * @return Response | \Illuminate\View\View|Response
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(CreatePerson $request)
    {
        $obj = $this->personRepository->create(
            $request->only(["name", "description"])
        );

        if (isset($request->all()['jobs'])) {
            foreach ($request->all()['jobs'] as $item) {
                if (is_null($item)) {
                    break;
                }
                $obj1 = new PersonJob();
                $obj1->person_id = $obj->id;
                $obj1->job_id = $item;
                $obj1->save();
            }
        }

        event(new PersonCreated($obj));
        return redirect()
            ->route('admin.person.index')
            ->withFlashSuccess(__('alerts.frontend.person.saved'));
    }

    /**
     * Display the specified Person.
     *
     * @param Person $person
     * @return \Illuminate\View\View|Response
     * @internal param int $id
     *
     */
    public function show(Person $person)
    {
        $job_ids = [];
        $person_jobs = PersonJob::where('person_id', '=', $person->id)->get();
        foreach ($person_jobs as $item) {
            array_push($job_ids, $item->job_id);
        }
        $jobs = Job::whereIn('id', $job_ids)->get();

        return view('backend.persons.show')->with('person', $person);
    }

    /**
     * Show the form for editing the specified Person.
     *
     * @param Person $person
     * @return \Illuminate\View\View|Response
     * @internal param int $id
     *
     */
    public function edit(Person $person)
    {
        $jobs = Job::all();
        $selectedJob = [];
        $related_items = PersonJob::where('person_id', '=', $person->id)->get();
        foreach ($related_items as $related_item) {
            array_push($selectedJob, $related_item->job_id);
        }

        return view(
            'backend.persons.edit',
            compact("jobs", "selectedJob")
        )->with('person', $person);
    }

    /**
     * Update the specified Person in storage.
     *
     * @param UpdatePerson $request
     *
     * @param Person $person
     * @return \Illuminate\View\View|Response
     * @internal param int $id
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(UpdatePerson $request, Person $person)
    {
        $obj = $this->personRepository->update($person, $request->all());

        event(new PersonUpdated($obj));
        return redirect()
            ->route('admin.person.index')
            ->withFlashSuccess(__('alerts.frontend.person.updated'));
    }

    /**
     * Remove the specified Person from storage.
     *
     * @param Person $person
     * @return \Illuminate\View\View|Response
     * @internal param int $id
     *
     */
    public function destroy(Person $person)
    {
        $obj = $this->personRepository->delete($person);
        event(new PersonDeleted($obj));
        return redirect()
            ->back()
            ->withFlashSuccess(__('alerts.frontend.person.deleted'));
    }
}
