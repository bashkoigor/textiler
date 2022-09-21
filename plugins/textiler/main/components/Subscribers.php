<?php namespace Textiler\Main\Components;

use Mail;
use Lang;
use Input;
use Flash;
use Cms\Classes\ComponentBase;
use Textiler\Main\Models\Subscriber;

/**
 * Subscribers Component
 */
class Subscribers extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name' => 'Subscribers Component',
            'description' => 'Store of subscribers.'
        ];
    }

    public function defineProperties()
    {
        return [
            'email' => [
                'title'       => 'Email',
                'description' => 'Если Email указан, на этот email будут приходить оповещения о новых подписчиках.',
            ]
        ];
    }

    public function onAddItem()
    {
        $data = [
            'name'      => e(Input::get('name')),
            'surname'   => e(Input::get('surname')),
            'email'     => e(Input::get('email')),
            'country'   => e(Input::get('country')),
            'city'      => e(Input::get('city')),
            'zip_code'  => e(Input::get('zip_code')),
            'street'    => e(Input::get('street')),
            'house'     => e(Input::get('house')),
            'apartment' => e(Input::get('apartment')),
        ];

        $item = new Subscriber;
        $item->name      = $data['name'];
        $item->surname   = $data['surname'];
        $item->email     = $data['email'];
        $item->country   = $data['country'];
        $item->city      = $data['city'];
        $item->zip_code  = $data['zip_code'];
        $item->street    = $data['street'];
        $item->house     = $data['house'];
        $item->apartment = $data['apartment'];
        $success = $item->save();

        if ($success === true) {

            $email = $this->property('email');
            if (isset($email)) {
                Mail::send('textilere.sendmail:mail:subscribers', $data, function($message) use ($email) {
                    $message->to($email, 'На сайте textiler появился новый подписчик.');
                });
            }

            Flash::success( Lang::get('textiler.main::lang.validation.success') );
        } else {
            Flash::success( Lang::get('textiler.main::lang.validation.error') );
        }
    }
}
