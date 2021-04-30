<?php


namespace App\Http\Livewire;

use Livewire\Component;

class DeleteSchool extends Component
{

    /**
     * The school instance.
     *
     * @var mixed
     */
    public $school;

    /**
     * Indicates if school deletion is being confirmed.
     *
     * @var bool
     */
    public $confirmingSchoolDeletion = false;

    /**
     * Mount the component.
     *
     * @param  mixed $school
     * @return void
     */
    public function mount($school)
    {
        $this->school = $school;
    }

    /**
     * Delete the school.
     *
     * @param  \App\Models\School $school
     * @return \Illuminate\Http\Response
     */
    public function deleteSchool()
    {

        $this->school->delete($this->school);

        return redirect()->route('schools.index');
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('schools.delete');
    }
}
