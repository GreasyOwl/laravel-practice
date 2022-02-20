<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class XMLController extends Controller
{
    public function createXML()
    {
        $content = <<<XML
            <?xml version="1.0" encoding="UTF-8"?>
            <tag1 att1="valueofatt1">
                <!--this is a comment.-->
                <tag11>This is a sample text, ä</tag11>
            </tag1>
            <testc><![CDATA[This is cdata content]]></testc>
            <testc><![CDATA[test cdata2]]></testc>
        XML;

        Storage::disk('public')->put('test.xml', $content);
    }
}
