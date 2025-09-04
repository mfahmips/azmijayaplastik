<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Models\StoreSettingModel;

abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * Helpers to be loaded automatically.
     *
     * @var list<string>
     */
    protected $helpers = ['url', 'form', 'pager'];

    /**
     * Properti untuk data pengaturan toko.
     *
     * @var array|null
     */
    protected $store_info;

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Load data pengaturan toko dari database
        $storeModel = new StoreSettingModel();
        $this->store_info = $storeModel->first();

        // Kirim data ini ke semua view sebagai variabel global
        $this->renderer = service('renderer');
        $this->renderer->setVar('store_info', $this->store_info);

    }
}
