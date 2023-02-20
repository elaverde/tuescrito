<?php
namespace App\Models;
use App\Providers\OutlookEmailProvider;
use App\Interfaces\EmailProviderInterface;
use Slim\Container as SlimContainer;

class EmailService
{
    private $container;

    public function __construct()
    {
        $container = new SlimContainer();
        $this->container = $container;
        $this->container['emailProvider'] = function () {
            return new OutlookEmailProvider();
        };
    }

    public function getEmailProvider()
    {
        return $this->container->get('emailProvider');
    }
    public function sendEmail($to, $subject, $message)
    {
        $emailProvider = $this->getEmailProvider();
        return $emailProvider->send($to, $subject, $message);
    }
}
