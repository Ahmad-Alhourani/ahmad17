<?php

namespace App\Http\Controllers\Backend\Job;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\Backend\Job\CreateJob;
use App\Http\Requests\Backend\Job\UpdateJob;
use App\Repositories\Backend\JobRepository;
use App\Events\Backend\Job\JobCreated;
use App\Events\Backend\Job\JobUpdated;
use App\Events\Backend\Job\JobDeleted;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Models\Job;

class JobController extends Controller
{
    /** @var $jobRepository */
    private $jobRepository;

    public function __construct(JobRepository $jobRepo)
    {
        $this->jobRepository = $jobRepo;
    }

    /**
     * Display a listing of the Job.
     *
     * @param  Request $request
     * @return Response | \Illuminate\View\View|Response
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */

    public function index(Request $request)
    {
        $this->jobRepository->pushCriteria(new RequestCriteria($request));
        $data = $this->jobRepository->paginate(25);

        return view('backend.jobs.index')->with('jobs', $data);
    }

    /**
     * Show the form for creating a new Job.
     *
     * @return Response | \Illuminate\View\View|Response
     */
    public function create()
    {
        return view('backend.jobs.create');
    }

    /**
     * Store a newly created Job in storage.
     *
     * @param CreateJob $request
     *
     * @return Response | \Illuminate\View\View|Response
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(CreateJob $request)
    {
        $obj = $this->jobRepository->create($request->only(["name"]));

        event(new JobCreated($obj));
        return redirect()
            ->route('admin.job.index')
            ->withFlashSuccess(__('alerts.frontend.job.saved'));
    }

    /**
     * Display the specified Job.
     *
     * @param Job $job
     * @return \Illuminate\View\View|Response
     * @internal param int $id
     *
     */
    public function show(Job $job)
    {
        return view('backend.jobs.show')->with('job', $job);
    }

    /**
     * Show the form for editing the specified Job.
     *
     * @param Job $job
     * @return \Illuminate\View\View|Response
     * @internal param int $id
     *
     */
    public function edit(Job $job)
    {
        return view('backend.jobs.edit')->with('job', $job);
    }

    /**
     * Update the specified Job in storage.
     *
     * @param UpdateJob $request
     *
     * @param Job $job
     * @return \Illuminate\View\View|Response
     * @internal param int $id
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(UpdateJob $request, Job $job)
    {
        $obj = $this->jobRepository->update($job, $request->all());

        event(new JobUpdated($obj));
        return redirect()
            ->route('admin.job.index')
            ->withFlashSuccess(__('alerts.frontend.job.updated'));
    }

    /**
     * Remove the specified Job from storage.
     *
     * @param Job $job
     * @return \Illuminate\View\View|Response
     * @internal param int $id
     *
     */
    public function destroy(Job $job)
    {
        $obj = $this->jobRepository->delete($job);
        event(new JobDeleted($obj));
        return redirect()
            ->back()
            ->withFlashSuccess(__('alerts.frontend.job.deleted'));
    }
}
