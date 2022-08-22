<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use Illuminate\Http\Request;
use App\Http\Requests\ApplicantStoreRequest;
use App\Http\Requests\ApplicantUpdateRequest;

class ApplicantController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Applicant::class);

        $search = $request->get('search', '');

        $applicants = Applicant::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.applicants.index', compact('applicants', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Applicant::class);

        return view('app.applicants.create');
    }

    /**
     * @param \App\Http\Requests\ApplicantStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ApplicantStoreRequest $request)
    {
        $this->authorize('create', Applicant::class);

        $validated = $request->validated();

        $applicant = Applicant::create($validated);

        return redirect()
            ->route('applicants.edit', $applicant)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Applicant $applicant
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Applicant $applicant)
    {
        $this->authorize('view', $applicant);

        return view('app.applicants.show', compact('applicant'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Applicant $applicant
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Applicant $applicant)
    {
        $this->authorize('update', $applicant);

        return view('app.applicants.edit', compact('applicant'));
    }

    /**
     * @param \App\Http\Requests\ApplicantUpdateRequest $request
     * @param \App\Models\Applicant $applicant
     * @return \Illuminate\Http\Response
     */
    public function update(
        ApplicantUpdateRequest $request,
        Applicant $applicant
    ) {
        $this->authorize('update', $applicant);

        $validated = $request->validated();

        $applicant->update($validated);

        return redirect()
            ->route('applicants.edit', $applicant)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Applicant $applicant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Applicant $applicant)
    {
        $this->authorize('delete', $applicant);

        $applicant->delete();

        return redirect()
            ->route('applicants.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
