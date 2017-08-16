<?php

use PHPUnit\Framework\TestCase;
use Arzola\Pdf;

class PdfLibraryTest extends TestCase
{

    private $mpdf;

    public function setUp()
    {
        parent::setUp();
        $this->mpdf = Mockery::mock('mPDF');
        $this->mpdf->shouldReceive('create')
        ->with(\Mockery::any())
        ->shouldReceive('setData')->with(\Mockery::any())
        ->shouldReceive('WriteHTML')->with(\Mockery::any())
        ->shouldReceive('Output')->andReturn('file');
    }

    public function test_if_pdf_is_created()
    {
        $pdf = new Pdf($this->mpdf);
        $content = $pdf->create('Hola mundo');
        $this->assertNotNull($content);
    }

    public function test_if_pdf_is_saved()
    {
        $pdf = new Pdf($this->mpdf);
        $pdf->setData('Hello World Saved');
        $file = $pdf->save();
        $this->assertNotFalse($file);
    }
}