<?php

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
fil
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
