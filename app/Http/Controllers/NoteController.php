<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNoteRequest;
use App\Http\Resources\NoteResource;
use App\Models\Note;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $notes = Note::paginate(10);
        return $this->handleResponse(NoteResource::collection($notes));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreNoteRequest $request
     * @return JsonResponse
     */
    public function store(StoreNoteRequest $request)
    {
        try {
            $note = Note::create($request->all());
            return $this->handleResponse(new NoteResource($note), 'The new notes have been successfully created.');
        } catch (\Exception $exception) {
            return $this->handleError($exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Note $note
     * @return JsonResponse
     */
    public function show(Note $note)
    {
        return $this->handleResponse(new NoteResource($note));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreNoteRequest $request
     * @param Note $note
     * @return JsonResponse
     */
    public function update(StoreNoteRequest $request, Note $note)
    {
        try {
            $note->update($request->all());
            return $this->handleResponse(new NoteResource($note), 'The note have been successfully updated.');
        } catch (\Exception $exception) {
            return $this->handleError($exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Note $note
     * @return JsonResponse
     */
    public function destroy(Note $note)
    {
        try {
            $note->delete();
            return $this->handleResponse([], 'The note have been successfully deleted.');
        } catch (\Exception $exception) {
            return $this->handleError($exception->getMessage());
        }
    }
}
