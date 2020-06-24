<?php
$data = [
    [
        'tplFile' => './crud-vue/dist/components/actions.html',
        'ids' => ['action-template','action-order-template'],
        'mdFile' => './docs/actions.md',
    ],
    [
        'tplFile' => './crud-vue/dist/components/widgets.html',
        'ids' => [
            'w-input-template','w-hidden-template','w-text-template',
            'w-textarea-template','w-select-template','w-input-helped-template',
            'w-radio-template','w-checkbox-template','w-custom-template',
            'w-autocomplete-template','w-belongsto-template','w-date-select-template',
            'w-date-picker-template','w-hasmany-template','w-hasmany-view-template',
            'w-upload-ajax-template','w-upload-template','w-preview-template',
            'w-swap-template','w-texthtml-template','w-b2-select2-template',
            'w-b2m-select2-template'
        ],
        'mdFile' => './docs/widgets.md',
    ]
];
echo "sostituizione tags ...\n";
foreach ($data as $proc) {
    $dom = new DomDocument();
    $template = file_get_contents($proc['tplFile']);
    $template = str_replace('<script','<template',$template);
    $template = str_replace('</script','</template',$template);
    $dom->loadHTML($template);
    $filemd = file_get_contents($proc['mdFile']);
    foreach ($proc['ids'] as $id) {
        $tpl =  $dom->saveHtml($dom->getElementById($id));
        $filemd = str_replace('{{{' . $id .'}}}',$tpl,$filemd);
    }
    file_put_contents($proc['mdFile'],$filemd);
}
echo "fine sostituzione tags\n";

echo "generazione help... \n";
exec ('sh publish.sh ./crud-vue/help/');
echo "fine generazione help\n";

echo "ripristino files md originali ... \n";
foreach ($data as $proc) {
    exec ('git checkout ' . $proc['mdFile']);
}
echo "FINE\n";

exit;



$dom = new DomDocument();
$template = file_get_contents('./crud-vue/dist/components/actions.html');
$template = str_replace('<script','<template',$template);
$template = str_replace('</script','</template',$template);
echo $template;
//echo $template;
$dom->loadHTML($template);
$xpath = new DOMXpath($dom);
$tpl =  $dom->saveHtml($dom->getElementById('action-template'));


$filemd = file_get_contents('./docs/actions.md');
$filemd = str_replace('{{{action-template}}}',$tpl,$filemd);
file_put_contents('./docs/actions.md',$filemd);
exec ('git checkout ./docs/actions.md');




exit;
exec("sed -i 's/{{{action-template}}}/" . $tpl . "/g' ./docs/actions.md" );
file_put_contents('result.txt',$tpl) ;

exit;
$tpl = getIdTemplate($xpath,'action-template');
file_put_contents('result.txt',$tpl) ;

exit;



$heading = parseToArray($xpath, 'Heading1-H');
$content = parseToArray($xpath, 'Normal-H');

var_dump($heading);
echo "<br/>";
var_dump($content);
echo "<br/>";

function parseToArray($xpath, $class)
{
    $xpathquery = "//span[@class='" . $class . "']";
    $elements = $xpath->query($xpathquery);

    if (!is_null($elements)) {
        $resultarray = array();
        foreach ($elements as $element) {
            $nodes = $element->childNodes;
            foreach ($nodes as $node) {
                $resultarray[] = $node->nodeValue;
            }
        }
        return $resultarray;
    }
}

function getIdTemplate($xpath,$id) {
    $xpathquery = "//script[@id='" . $id . "']";
    $elements = $xpath->query($xpathquery);
    echo $elements->item(0)->nodeValue;

    echo "---";
    if (!is_null($elements)) {
        return $elements[0]->textContent;
        return $elements[0]->childNodes[0]->parentNode->textContent;
        return $elements[0]->childNodes[0]->value;//childNodes[0]->nodeValue;

        $resultarray = array();
        foreach ($elements as $element) {
            $nodes = $element->childNodes;
            foreach ($nodes as $node) {
                $resultarray[] = $node->nodeValue;
            }
        }
        return $resultarray;
    }
}
