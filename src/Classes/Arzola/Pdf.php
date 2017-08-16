<?php namespace Arzola;

use mPDF;

class Pdf
{
    private $generator;
    private $data;

    public function __construct($generator=null)
    {
        $this->generator = (is_null($generator))? new mPDF : $generator;
    }

    public function setData($data)
    {
        $this->data = $data;
    }

    public function create($data)
    {
        $content = $this->generator->WriteHTML($this->data);
        return $this->generator->Output($content,'S');
    }

    public function save()
    {
        return file_put_contents('file.pdf',$this->create($this->data));
    }

}