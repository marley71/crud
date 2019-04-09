# Template

Classe che estende `Component` e incapsula il template per la visualizzazione di un render,
all'interno di una vista. Questo ci permette di avere strutture per ogni singolo render all'interno
di una vista. In questo modo possiamo coprire tutte le esigenze di layout della nostra applicazione.


#### Metodi

- `html()` : ritorna l'html del template 


`Template.factory `: metodo statico per creare un template a partire nome
e attrs secondo la convenzione sui nomi 

`Template.getRenderContainer` : ritorna l'elemento dom destinato
a contenere il render


## Template Implementati

La libreria mette a disposizione dei template standard usati dalle view di default. Questi possono 
essere sovrascritti o inventati di nuovi


## TemplateLeft
Utilizzato soprattuto dalle views edit,insert,view

#### Metodi 

- `template() `

```html
<div class="view-field clearfix">
    <div class="col col-sm-12 view-msg" crud-label="msg">
            
    </div>
    <div class="col col-sm-4">
        <div class="col col-sm-10">

            <label crud-html_label crud-label="label"></label>
        
        </div>
    </div>
    
 
    <div class="col col-sm-8" crud-render>
            
    </div>
    <div class="col col-sm-12">
        <small crud-label="addedLabel" class="view-addedLabel"></small>
    </div>
    <div class="col col-sm-12 view-field-error text-danger" crud-label="error">
            
    </div>
</div>
```

## TemplateTop
Utilizzato soprattutto dalle views edit,insert,view per i controlli
che hanno bisogno di spazio

#### Metodi 

#### template
```html
<div class="view-field clearfix">
    <div class="col col-sm-12">
        <label crud-label="label">

        </label>
    </div>
    <div class="col col-sm-12 view-msg" crud-label="msg">

    </div>
    <div class="col col-sm-12" crud-render>

    </div>
    <div class="col col-sm-12 view-field-error" crud-label="error">

    </div>
</div>
```

## TemplateNo 

nessun template solo un div  utilizzato soprattutto dalla viewlist

Metodi 

- template() 
```html
<div class="col col-xs-12" crud-render>
</div>
```

## TemplateSimple
nessun template solo un div utilizzato soprattutto dalla viewlist
Metodi 

- template() 
```html
<div crud-render>
</div>
```