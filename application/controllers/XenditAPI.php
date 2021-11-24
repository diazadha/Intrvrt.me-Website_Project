<?php

defined('BASEPATH') or exit('No direct script access allowed');
require 'vendor/autoload.php';
use Xendit\Xendit;

class XenditAPI extends CI_Controller
{
    private function token(){
        return 'xnd_development_E7UdRyMnxY1B18FytIEHESZeclPJ4OcrZvZ0m1Cs3AloopFHBRRRnRotWcBEL';
    }

    public function getVA(){
        Xendit::setApiKey($this->token());
        $getVABanks = \Xendit\VirtualAccounts::getVABanks();
        $d="";
        foreach($getVABanks as $va){
            if($va['is_activated']){
                $d.= $va['name'].'<br>';
            }
        }
        echo $d;
    }   
}