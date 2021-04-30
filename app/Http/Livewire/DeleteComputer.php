<?php


namespace App\Http\Livewire;

use Livewire\Component;

class DeleteComputer extends Component
{

    /**
     * The team instance.
     *
     * @var mixed
     */
    public $computer;

    /**
     * Indicates if team deletion is being confirmed.
     *
     * @var bool
     */
    public $confirmingComputerDeletion = false;

    /**
     * Mount the component.
     *
     * @param  mixed $computer
     * @return void
     */
    public function mount($computer)
    {
        $this->computer = $computer;
    }

    /**
     * Delete the team.
     *
     * @param  \App\Models\Computer $computer
     * @return \Illuminate\Http\Response
     */
    public function deleteComputer()
    {

        $this->computer->delete($this->computer);

        return redirect()->route('computers.index');
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('computers.delete');
    }
}
