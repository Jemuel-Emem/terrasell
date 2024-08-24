<?php

namespace App\Livewire\Admin;
use Livewire\WithPagination;
use WireUi\Traits\Actions;
use App\Models\User as user;
use Livewire\WithFileUploads;
use Livewire\Component;

class AddAgent extends Component
{
    use WithFileUploads;
    use Actions;
    use  WithPagination;
    public $add_modal = false;
    public $edit_modal = false;
    public $search, $name, $number, $address, $username, $password, $accounttype, $agent_id;
    public function render()
    {
        $search = '%' . $this->search . '%';
        return view('livewire.admin.add-agent', [
            'agents' => User::where('name', 'like', $search)
                             ->where('is_admin', 2)
                             ->paginate(10),
        ]);
    }


    public function addagent(){
        $this->validate([
            'name' => 'required',
            'number' => 'required',
            'address' => 'required',
            'username' => 'required',
            'password' => 'required',

        ]);


        user::create([
            'name' => $this->name,
            'number' => $this->number,
            'address' => $this->address,
            'email' => $this->username,
            'password' => $this->password,
            'is_admin' => "2",

        ]);

        $this->notification()->success(
            $title = 'Data saved!',
            $description = 'The data was saved successfully'
        );

        $this->add_modal = false;
        $this->reset([
            'name', 'number', 'address','username', 'password'
        ]);
    }

    public function edit($id){
        $data = user::where('id', $id)->first();

        if ($data->is_admin=='1'){
            $this->accounttype = "Admin";
        }

        else {
            $this->accounttype = "Agent";
        }
        if ($data) {

                    $this->name= $data->name;
                    $this->address = $data->address;
                    $this->number = $data->number;
                    $this->username = $data->email;
                    $this->password = $data->password;
                    $this->accounttype = $this->accounttype;
                    $this->agent_id = $data->id;
                    $this->edit_modal = true;

                }
    }

    public function updateagent()
    {
        $this->validate([
            'name' => 'required',
            'number' => 'required',
            'address' => 'required',
            'username' => 'required',
            'password' => 'required',
            'accounttype' => 'required',
        ]);

        $agent = User::find($this->agent_id);

        if ($agent) {
            $this->accounttype = ($this->accounttype == 'admin') ? 1 : 2;

            $agent->update([
                'name' => $this->name,
                'number' => $this->number,
                'address' => $this->address,
                'email' => $this->username,
                'password' => $this->password,
                'is_admin' => $this->accounttype,
            ]);

            $this->notification()->success(
                $title = 'Data updated!',
                $description = 'The data was updated successfully'
            );

            $this->edit_modal = false;
            $this->reset(['name', 'number', 'address', 'username', 'password']);
        }
    }

    public function delete($id)
    {
        $agent = User::find($id);

        if ($agent) {
            $agent->delete();

            $this->notification()->success(
                $title = 'Data deleted!',
                $description = 'The data was deleted successfully'
            );


            $this->reset(['name', 'number', 'address', 'username', 'password', 'accounttype', 'agent_id']);
        }
    }

    public function close(){
        $this->reset(['name', 'number', 'address', 'username', 'password']);
    }

}
