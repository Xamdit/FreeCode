<?php

header('Content-Type: application/json');

class Checkupdate

{

    private function DOMXPath($html, $qry)

    {

        $doc = new DOMDocument();

        @$doc->loadHTML($html);

        $xpath = new DOMXPath($doc);

        $nodeList = $xpath->query($qry);



        return $nodeList;

    }
    public function check()

    {



        $url = file_get_contents('https://ag1.ufabet.com');

        $res = @explode("<script language='javascript'>window.open('", $url);

        $res = @explode("','_top');</script>", $res[1]);

        if ($res[0] != '') {



            $url = file_get_contents('https://ag1.ufabet.com/Public/' . $res[0]);

            $rows = $this->DOMXPath($url, '//td[@class="smartFont"]');

            $data = $rows[0]->nodeValue;

            $string = trim(preg_replace('/\s\s+/', ' ', $data));

            return  true;
        }else{

            return false;

        }

    }

}

