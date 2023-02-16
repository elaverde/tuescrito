<?php
namespace App\Models;
use Jenssegers\Blade\Blade;

class PDFDocument
{
    protected $blade;
    protected $template;
    public function __construct()
    {
        $path = realpath(__DIR__ . "/../../resourses/views");
        $this->blade = new Blade($path, __DIR__ . "/../../resourses/compiled");
        $this->template = "";
    }
    public function renderTemplate($html)
    {
        $this->template = $this->blade->render('report.pdf', [
            'html' => $html
        ]);
        return $this->template;
    }

};