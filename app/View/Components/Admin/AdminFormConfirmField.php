<?php

namespace App\View\Components\Admin;

use Illuminate\View\Component;

class AdminFormConfirmField extends Component
{
    public $label;
    public $name;
    public $value;
    public $option;
    public $type;
    public $value_show;
    public $show;
    public $hidden;
    public $require;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($label, $name, $value = '', $type = '', $option = [], $show = true, $require = false, $hidden = false)
    {
        $this->label      = $label;
        $this->name       = $name;
        $this->value      = $value;
        $this->type       = $type;
        $this->option     = $option;
        $this->value_show = $value;
        $this->show       = $show;
        $this->hidden     = $hidden;
        $this->require    = '';


        if ($require) {
            $this->require = '<span class="red">[必須]</span>';
        }

        switch ($type) {
            case 'password':
                $this->value_show = '••••••';
                break;
            case 'zip':
                $this->value_show = '〒' . $value;
                break;
            case 'textarea':
                $this->value_show = nl2br(htmlentities($value));
                break;

            case 'textarea_ckeditor':
                $this->value_show = $value;
                break;

            case 'image':
                if ($name == 'license_file') {
                    $value_show = $value ? $this->createPresignedRequestPrivate($value) : '/noimage.jpg';
                } else {
                    $value_show = $value ?  env('AWS_URL') . $value : '/noimage.jpg';
                }
                $this->value_show = "<img style='width:100px' src='{$value_show}'>";
                break;

            case 'radio':
                $this->value_show = '';
                foreach ($this->option as $key => $val) {
                    $this->value_show .= '［' . ($key == $this->value ? '◉' : '　') . '］' . $val . '<br>';
                }
                break;
            case 'checkbox':
                $this->value_show = '';
                foreach ($this->option as $key => $val) {
                    $this->value = is_array($this->value) ? $this->value : [];
                    $this->value_show .= '［' . (in_array($key, $this->value) ? '◉' : '　') . '］' . $val . '<br>';
                }
                break;

            case 'select':
                $this->value_show = $this->option[$this->value] ?? '';
                break;

            default:
                $this->value_show = htmlentities($value);
                break;
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin.admin-form-confirm-field');
    }

    public function createPresignedRequestPrivate($file_path, $time = "+3540 seconds")
    {
        if (!$file_path) {
            return "";
        }

        $adapter = \Storage::disk('s3_secure')->getDriver()->getAdapter();
        $command = $adapter->getClient()->getCommand('GetObject', [
            'Bucket' => $adapter->getBucket(),
            'Key'    => $adapter->getPathPrefix() . ltrim($file_path, '/'),
        ]);
        $request = $adapter->getClient()->createPresignedRequest($command, $time);
        return ((string) $request->getUri());
    }
}
