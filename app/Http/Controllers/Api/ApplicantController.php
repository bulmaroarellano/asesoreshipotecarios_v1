<?php

namespace App\Http\Controllers\Api;

use App\Models\Applicant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ApplicantResource;
use App\Http\Resources\ApplicantCollection;
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
            ->paginate();

        return new ApplicantCollection($applicants);
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

        return new ApplicantResource($applicant);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Applicant $applicant
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Applicant $applicant)
    {
        $this->authorize('view', $applicant);

        return new ApplicantResource($applicant);
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

        return new ApplicantResource($applicant);
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

        return response()->noContent();
    }
}
