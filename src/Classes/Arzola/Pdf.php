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
        $this->addHeader();
        $content = $this->generator->WriteHTML($this->data);
        return $this->generator->Output($content,'S');
    }

    public function save()
    {
        return file_put_contents('file.pdf',$this->create($this->data));
    }

    private function addHeader()
    {
        $header = "<img src='http://blog.legacyteam.info/wp-content/uploads/2014/10/laravel-logo-white.png' />";
        $this->data = "$header<p>{$this->data}</p>";
    }

}