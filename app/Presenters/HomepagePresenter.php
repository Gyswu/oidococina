<?php
declare( strict_types = 1 );

namespace App\Presenters;

final class HomepagePresenter extends BasePresenter {
    
    public function actionDefault() {
    
    }
    
    public function renderDefault() {
        $this->template->mesas = $this->orm->mesas->findAll();
    }
    
}
