<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\FooterLayout;
use phpDocumentor\Reflection\Types\This;

#[layout('layouts.app')]
class FooterBuilder extends Component
{
    public $layout = [
        'sections' => []
    ];

    public function mount()
    {
        $footer = FooterLayout::where('name', 'default')->first();
        if ($footer) {
            $this->layout = json_decode($footer->layout, true);
        }
    }

    public function addSection($sIndex = null)
    {
        $this->layout['sections'][$sIndex] = [
            'title' => 'Section',
            'columns' => [
                ['widgets' => []]
            ]
        ];
    }

    public function addColumn($sIndex)
    {
        $this->layout['sections'][$sIndex]['columns'][] = ['widgets' => []];
    }

    public function deleteColumn($sIndex, $cIndex)
    {

        if (count($this->layout['sections'][$sIndex]['columns']) == 1) {
            $this->addSection($sIndex);
        } else {
            array_splice($this->layout['sections'][$sIndex]['columns'], $cIndex, 1);
        }
    }

    public function deleteSection($sIndex)
    {
        if (count($this->layout['sections']) > 1) {
            array_splice($this->layout['sections'], $sIndex, 1);
        } else {
            $this->layout['sections'] = [];
        }
    }

    public function addWidget($sIndex, $cIndex, $type = 'text')
    {
        $this->layout['sections'][$sIndex]['columns'][$cIndex]['widgets'][] = [
            'type' => $type,
            'content' => '',
            'label' => '',
            'url' => '',
            'icon' => ''
        ];
    }
    public function deleteWidget($sIndex, $cIndex, $wIndex)
    {
        if (count($this->layout['sections'][$sIndex]['columns'][$cIndex]['widgets']) > 1) {
            # code...
            array_splice($this->layout['sections'][$sIndex]['columns'][$cIndex]['widgets'], $wIndex, 1);
        } else {
            $this->layout['sections'][$sIndex]['columns'][$cIndex]['widgets'] = [];
        }
    }

    public function save()
    {
        FooterLayout::updateOrCreate(
            ['name' => 'default'],
            ['layout' => json_encode($this->layout)]
        );

        session()->flash('success', 'Footer layout saved!');
    }
    public function render()
    {
        return view('livewire.footer-builder');
    }
}
