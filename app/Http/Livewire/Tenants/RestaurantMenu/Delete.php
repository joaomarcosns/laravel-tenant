<?php

namespace App\Http\Livewire\Tenants\RestaurantMenu;

use App\Models\Tenant\Menu;
use Livewire\Component;

class Delete extends Component
{
    public $menu;

    public function mount(int $menu)
    {
        $this->menu = Menu::find($menu);
    }

    public function deleteItem()
    {
        $this->menu->delete();
        $this->emit('menuItemDeleted');
    }

    public function render()
    {
        return view('livewire.tenants.restaurant-menu.delete');
    }
}
