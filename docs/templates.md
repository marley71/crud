# Template

Classe che estende `Component` e incapsula il template per la visualizzazione di un render,
all'interno di una vista.


Metodi

- html() : ritorna l'html del template 


Template.factory : metodo statico per creare un template a partire nome
e attrs secondo la convenzione sui nomi 

Template.getRenderContainer : ritorna l'elemento dom destinato
a contenere il render


##Template Implementati

##TemplateLeft
Utilizzato soprattuto dalle views edit,insert,view

Metodi 

- template() 
```html
<div class="view-field clearfix">
    <div class="col col-sm-12 view-msg" data-label="msg">
            
    </div>
    <div class="col col-sm-4">
        <div class="col col-sm-10">

            <label data-html_label data-label="label"></label>
        
        </div>
    </div>
    
 
    <div class="col col-sm-8" data-render>
            
    </div>
    <div class="col col-sm-12">
        <small data-label="addedLabel" class="view-addedLabel"></small>
    </div>
    <div class="col col-sm-12 view-field-error text-danger" data-label="error">
            
    </div>
</div>
```

##TemplateTop
Utilizzato soprattutto dalle views edit,insert,view per i controlli
che hanno bisogno di spazio

Metodi 

- template() 
```html
<div class="view-field clearfix">
    <div class="col col-sm-12">
        <label data-label="label">

        </label>
    </div>
    <div class="col col-sm-12 view-msg" data-label="msg">

    </div>
    <div class="col col-sm-12" data-render>

    </div>
    <div class="col col-sm-12 view-field-error" data-label="error">

    </div>
</div>
```

##TemplateNo 
nessun template solo un div  utilizzato soprattutto dalla viewlist

Metodi 

- template() 
```html
<div class="col col-xs-12" data-render>
</div>
```

##TemplateSimple
nessun template solo un div utilizzato soprattutto dalla viewlist
Metodi 

- template() 
```html
<div data-render>
</div>
```