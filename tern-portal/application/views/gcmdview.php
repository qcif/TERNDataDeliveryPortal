<?php

$model = ModelFactory::getDefaultModel();

// Load and parse document
$model->load(GCMDBASE);

$prefLabel=new Resource(SKOS_PREFIX.'prefLabel');
$literal=new Literal("Science Keywords","en");

$result=$model->find(NULL,$prefLabel,$literal);

$it = $result->getStatementIterator();

while($it->hasNext())
{
    $statement=$it->next();
    $rootUri=$statement->getLabelSubject();
}

$subjrsc=new Resource($rootUri);

$subjlabel=findLabel($model, $subjrsc);

$tmp=  substr($rootUri,strrpos($rootUri,'/')+1);

echo '<ul>';
echo    '<li>'.strtoupper($subjlabel).'</li>';
               findChildGCMD($tmp,$model);
echo '</ul>';
?>