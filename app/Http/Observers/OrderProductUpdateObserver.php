<?php

namespace App\Http\Observers;

class OrderProductUpdateObserver {

    public function updating($model) {
        $data = $model->getAttributes();

        $model->products->fill($data['products']);

        $model->push();
    }

}