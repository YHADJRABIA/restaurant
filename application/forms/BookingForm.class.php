<?php

class BookingForm extends Form {
    
    public function build()
    {
        $this->addFormField('day');
        $this->addFormField('month');
        $this->addFormField('year');
        $this->addFormField('hour');
        $this->addFormField('minute');
        $this->addFormField('seats');
    }
}
