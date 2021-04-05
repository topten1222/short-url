<?php

namespace App\Controllers;

use App\Models\ShortUrlModel;

class Home extends BaseController
{
    public function index()
    {
        $model = new ShortUrlModel();
        if (isset($_COOKIE['shortUrls'])) {
            $alias = explode(',', $_COOKIE['shortUrls']);
            $shortUrls = $model->whereIn('alias', $alias)->findAll();
        }
        return view('index', [
            'shortUrls' => isset($shortUrls) ? $shortUrls : [],
        ]);
    }

    public function shortUrl()
    {
        helper('text');
        $model = new ShortUrlModel();
        if ($this->request->isAJAX()) {
            $array = [
                'url' => $this->request->getVar('url'),
                'alias' => random_string('alnum', 5),
                'hits' => 0,
                'expire_date' => date('Y-m-d', strtotime(' +1 day'))
            ];
            if (!$model->save($array)) {
                return $this->response->setStatusCode('400')->setJSON(['message' => json_encode($model->errors())]);
            }
            $dataReturns = [
                'alias' => $array['alias'],
                'date' => date('Y-m-d'),
                'expired_date' => date('Y-m-d', strtotime(' +1 day')),
                'url' => $this->request->getVar('url')
            ];
            return $this->response->setJSON(['message' => 'success', 'data' => $dataReturns]);
        }
        return $this->response->setStatusCode('400')->setJSON(['message' => 'invalid request']);
    }

    public function redirectAlias()
    {
        $alias = $this->request->uri->getSegment(1);
        $model = new ShortUrlModel();
        $shortUrl = $model->where(['alias' => $alias])->first();
        if ($shortUrl) {
            $currentDate = date('Y-m-d');
            $expireDate = $shortUrl['expire_date'];
            if ($currentDate > $expireDate) {
                return redirect('404');
            }
            $model->update(['id' => $shortUrl['id']], ['hits' => $shortUrl['hits'] + 1]);
            return redirect()->to($shortUrl['url']);
        }
        return redirect('404');
    }

    public function notFound()
    {
        return view('not-found');
    }

    public function forceDownloadQR($alias)
    {
        $url = "https://chart.googleapis.com/chart?cht=qr&chl=".base_url($alias)."&chs=200x200&choe=UTF-8";
        $file = file_get_contents($url);
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=".$alias.".png");
        header("Cache-Control: public");
        header("Content-length: " . strlen($file)); // tells file size
        header("Pragma: no-cache");
        echo $file;
    }
}
