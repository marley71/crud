# Actions


## Action
Classe principale delle azioni. Estende la classe principale `Component` Le azioni rappresentano l'aggancio per le interazioni con 
l'utente sulle views, dashboard oppure semplici bottoni html. Da questa classe
sono state definite altri due azioni generali la `RecordAction` e la `CollectionAction` che
fondamentalmente dividono il comportamento in azioni che agiscono sul singolo record
e azioni che agiscono su una collezione di record.

#### Proprietà

- `container` : default null
- `htmlEvent` : default 'onclick'      evento html associato che fa scattare l'azione
- `type` : default null può essere record o collection
- `controlType` : default 'button',
- `text` : '',
- `icon` : '',
- `cssClass` : '',
- `target` : '',
- `href` : '',
- `params` : [],
- `enabled` : true,
- `visible` : true,
- `title` : '',
- `_htmlProperties` : ['text','icon','cssClass','target','href','params','title','enabled','visible','onclick','onchange'],


#### Metodi

- `execute` : metodo chiamato quando l'azione viene cliccata
- `template` : metodo che restituisce i template di tipo button o link 
- `buttonTemplate` : template con type button
- `linkTemplate` : template con type link
- `callback` : se definita viene chiamata al termi dell'execute
- `_getData` : ritorna i valori di instanza di tutti gli attributi html dell'azione

    
## RecordAction

Le recordAction sono quelle utilizzate nelle liste per ogni record

#### Proprietà

- `className` : 'RecordAction',
- `type` : 'record',
- `cssClass` : 'btn btn-default btn-xs btn-group',

- `buttonTemplate` : function ()
```html
<button crud-action type="button" crud-visible=visible crud-class="cssClass"  crud-attrs="{'title':title,'crud-params':params,'target':target}" crud-addclass="enabled?'':'disabled'">
    <i crud-remove="!icon" crud-class="icon"></i>
    <span crud-field="text"></span>
</button> 
```

- `linkTemplate` : function () 
```html
<a crud-href="href" crud-visible="visible" crud-class="cssClass"  crud-attrs="{'title':title,'crud-params':params,'target':target}" target="_blank" crud-addclass="enabled?'':'disabled'">
    <i crud-remove="!icon" crud-class="icon"></i>
    <span crud-field="text"></span>
</a>   
```

## CollectionAction

Discriminano le azioni sulla vista globale, per esempio una view a lista ci sono le record actions che lavorano
sul singolo record, mentre le collection action agisco sul modello. Oltre a questa differenza vengono 
renderizzate anche in un posto diverso.

#### Proprietà

- `className` : 'CollectionAction'
- `type` : 'collection'
- `buttonTemplate` : 
```html
<button crud-action type="button" crud-visible=visible crud-attrs="{'title':title,'crud-params':params,'target':target}" crud-class="cssClass" crud-addclass="enabled?'':'disabled'">
    <i crud-remove="!icon" crud-class="icon"></i>
    <span crud-field="text"></span>
</button> 
```
- `linkTemplate` : 
```html
<a crud-href="href" crud-visible="visible" crud-class="cssClass"  crud-attrs="{'title':title,'crud-params':params,'target':target}" target="_blank" crud-addclass="enabled?'':'disabled'">
    <i crud-remove="!icon" crud-class="icon"></i>
    <span crud-field="text"></span>
</a>  
```

# Action Implementate

La libreria, come per tutti gli altri componenti, mette a disposizione delle azioni già predefinite, 
utilizzabili immediamente. Queste azioni rappresentano le azioni più comuni in una libreria crud. Ovviamente
possono essere estese o definite delle nuove.

## ActionEdit:
Estende `RecordAction`. Azione pensata per l'utilizzo dentro una view list e rappresent l'edit di un record 
all'interno della lista. 

#### Proprietà

- `className` : 'ActionEdit'
- `title` : 'Modifica',
- `icon` : 'fa fa-edit',
- `multiText` : 'Modifica', // questo testo viene utilizzato quando l'azione si trova all'interno di un gruppo
di azioni.
- `routeName` : 'page_edit'

#### Metodi 

- `execute` - utilizza la route per una pagina in edit per richiamare la pagina nuova


## ActionInsert
Estende `CollectionAction`. Azione pensata per l'utilizzo dentro una view list  per l'inserimento di un record all'interno della lista.

#### Proprietà

- `className` : 'ActionInsert',
- `title` : 'Inserisci',
- `icon` : 'fa fa-plus text-success',
- `cssClass` : 'btn btn-default btn-xs text-success',
- `text` : 'Nuovo',
- `multiText` : 'Nuovo',
- `routeName` : 'page_insert',
     
#### Metodi

- `execute` - utilizza al route per una pagina in insert per richiamare la pagina nuova

## ActionSave

Estende `RecordAction`. Azione pensata per l'utilizzo dentro una view edit per salvare le modifiche


- `className` : 'ActionSave',
- `title` : 'Salva',
- `text` : 'Salva',
- `multiText` : 'Salva',

- `execute` - utilizza le route update o save a seconda se il modello dati è in modifica o insert


## ActionBack

Estende `RecordAction`. Azione pensata per l'utilizzo dentro una view edit ritorna alla pagina di provienienza

- `className` : 'ActionBack',
- `title` : 'Indietro',
- `text` : 'Torna indietro',

- `execute` esegue sostanzialmente un history.back();


## ActionView
Estende `RecordAction`. Azione pensata per l'utilizzo dentro una view list  per la visualizzazione di un record all'interno della lista.

### Proprietà

- `className` : 'ActionView',
- `title` :'Visualizza',
- `icon`:  'fa fa-list-alt',
- `multiText` : 'Visualizza',
- `routeName` : 'page_view',
     
### Metodi

- `execute` - utilizza al route per una pagina in view per richiamare la pagina nuova


## ActionDelete
Estende `RecordAction`. Azione pensata per l'utilizzo dentro una view list  per la cancellazione di un record all'interno della lista.

### Proprietà

- `className` : 'ActionDelete',
- `title` : 'Cancella',
- `icon`:  'fa fa-remove text-danger',
- `multiText` : 'Cancella',
     
### Metodi

- `execute` - utilizza al route delete per eseguire la richiesta di cancellazione. Prima chiede conferma
- `callback` - metodo richiamata alla fine della execute


## ActionMultiDelete
Estende `CollectionAction`. Azione pensata per l'utilizzo dentro una view list  per la cancellazione di tutti i record selezionati nella lista.

### Proprietà

- `className` : 'ActionMultiDelete',
- `title` : 'Cancella selezionati',
- `icon`:  'fa fa-trash text-danger',
- `cssClass` : 'btn btn-default btn-xs text-danger',
- `text` : 'Selezionati',
- `needSelection` : true,
- `multiText` : 'Cancella Selezionati',
     
### Metodi

- `execute` - utilizza al route delete per eseguire la richiesta di cancellazione. Prima chiede conferma
- `callback` - metodo richiamata alla fine della execute


## ActionSearch
Estende `CollectionAction`. Azione pensata per l'utilizzo dentro una view search  per la ricerca dei record con i filtri della view.

### Proprietà

- `className` : 'ActionSearch',
- `title` : 'Ricerca',
- `icon`:  'fa fa-search',
- `cssClass` : 'btn btn-xs btn-default text-info',
- `text` : 'Cerca',
     
### Metodi

- `execute` - richiama la pagina con i parametri in get presenti nella form della vista


## ActionReset
Estende `CollectionAction`. Azione pensata per l'utilizzo dentro una view search il reset dei parametri di 
ricerca impostati

### Proprietà

- `className` : 'ActionReset',
- `title` : 'Annulla filtri ricerca',
- `cssClass` : 'btn btn-xs btn-default',
- `text` : 'Annulla filtri',
     
### Metodi

- `execute` - richiama il metodo clear su tutti i renders della view e richiama la callback
- `callback` - metodo chiamato dopo il reset dei controlli




## ActionNextPage
nextpage del navigatore di una lista

Proprietà    
- `icon` : 'fa fa-angle-right',
- `cssClass` : 'btn btn-default btn-xs',

### Metodi 

- `execute` : incrementa di uno il parametro page della route associata alla lista

## ActionPrevPage
Pagina precendente di una view

### Proprietà

- `icon` : 'fa fa-angle-left',
- `cssClass` : 'btn btn-default btn-xs'

- `execute` : Decrementa di uno il parametro page della route associata alla lista


## ActionFirstPage

- `icon` : 'fa fa fa-angle-double-left',
- `cssClass` : 'btn btn-default btn-xs',
- `execute` : Setta il parametro page a uno della route associata alla lista

## ActionLastPage

- `icon` : 'fa fa fa-angle-double-right',
- `cssClass` : 'btn btn-default btn-xs',
- `execute` : Setta il parametro page all'ultima pagina della route associata alla lista

## ActionPerPage

- `icon` : 'fa fa fa-angle-double-right',
- `htmlEvent` : 'onchange',
- `cssClass` : 'btn btn-default btn-xs',
- `execute` : setta il parametro page e paginateNumber della route associata alla lista

- `_getData` : setta i valori della select prendendoli da data.pagination.pagination_steps

- `buttonTemplate` : 
```html
<select crud-field="pagination.per_page" crud-source="pagination.pagination_steps" 
        crud-sourceorder="pagination.pagination_order"
        crud-attrs=`+ special_attrs + `  class="pagination-input">

</select>  
```
