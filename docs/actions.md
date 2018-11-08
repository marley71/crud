#Actions


##Action
Classe principale delle azioni. Le azioni rappresentano l'aggancio per le interazioni con 
l'utente sulle views, dashboard oppure semplici bottoni html. Da questa classe
sono state definite altri due azioni generali la RecordAction e la CollectionAction che
fondamentalmente dividono il comportamento in azioni che agiscono sul singolo record
e azioni che agiscono su una collezione di record.

###Proprietà

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


###Metodi

- execute : metodo chiamato quando l'azione viene cliccata
- template : metodo che restituisce i template di tipo button o link 
- buttonTemplate : template con type button
- linkTemplate : template con type link
- callback : se definita viene chiamata al termi dell'execute
- _getData : ritorna i valori di instanza di tutti gli attributi html dell'azione

    
##RecordAction

Le recordAction sono quelle utilizzate nelle liste per ogni record

###Proprietà

- className : 'RecordAction',
- type : 'record',
- cssClass : 'btn btn-default btn-xs btn-group',

- _buttonTemplate : function ()
```html
<button data-action type="button" data-visible=visible data-class="cssClass"  data-attrs="{'title':title,'data-params':params,'target':target}" data-addclass="enabled?'':'disabled'">
    <i data-remove="!icon" data-class="icon"></i>
    <span data-field="text"></span>
</button> 
```

- _linkTemplate : function () 
```html
<a data-href="href" data-visible="visible" data-class="cssClass"  data-attrs="{'title':title,'data-params':params,'target':target}" target="_blank" data-addclass="enabled?'':'disabled'">
    <i data-remove="!icon" data-class="icon"></i>
    <span data-field="text"></span>
</a>   
```

##CollectionAction


###Proprietà

- className : 'CollectionAction'
- type : 'collection'
- buttonTemplate : 
```html
<button data-action type="button" data-visible=visible data-attrs="{'title':title,'data-params':params,'target':target}" data-class="cssClass" data-addclass="enabled?'':'disabled'">
    <i data-remove="!icon" data-class="icon"></i>
    <span data-field="text"></span>
</button> 
```
- linkTemplate : 
```html
<a data-href="href" data-visible="visible" data-class="cssClass"  data-attrs="{'title':title,'data-params':params,'target':target}" target="_blank" data-addclass="enabled?'':'disabled'">
    <i data-remove="!icon" data-class="icon"></i>
    <span data-field="text"></span>
</a>  
```

#Action Implementate


## - ActionEdit:
Estende `RecordAction`. Azione pensata per l'utilizzo dentro una view list  l'edit di un record all'interno della lista. 

Proprietà

-className : 'ActionEdit',
     title : 'Modifica',
     icon : 'fa fa-edit',
     multiText : 'Modifica',
     routeName : 'page_edit'

Metodi 

- execute - utilizza la route per una pagina in edit per richiamare la pagina nuova


## - ActionInsert
Estende `CollectionAction`. Azione pensata per l'utilizzo dentro una view list  per l'inserimento di un record all'interno della lista.

Proprietà

-className : 'ActionInsert',
     title : 'Inserisci',
     icon : 'fa fa-plus text-success',
     cssClass : 'btn btn-default btn-xs text-success',
     text : 'Nuovo',
     multiText : 'Nuovo',
     routeName : 'page_insert',
     
Metodi

- execute - utilizza al route per una pagina in insert per richiamare la pagina nuova

## - ActionSave

Estende `RecordAction`. Azione pensata per l'utilizzo dentro una view edit per salvare le modifiche


className : 'ActionSave',
    title : 'Salva',
    text : 'Salva',
    multiText : 'Salva',

- execute - utilizza le route update o save a seconda se il modello dati è in modifica o insert


## - ActionBack

Estende `RecordAction`. Azione pensata per l'utilizzo dentro una view edit ritorna alla pagina di provienienza

className : 'ActionBack',
    title : 'Indietro',
    text : 'Torna indietro',

- execute esegue sostanzialmente un history.back();


## - ActionView
Estende `RecordAction`. Azione pensata per l'utilizzo dentro una view list  per la visualizzazione di un record all'interno della lista.

Proprietà

- className : 'ActionView',
                 title :'Visualizza',
                 icon:  'fa fa-list-alt',
                 multiText : 'Visualizza',
                 routeName : 'page_view',
     
Metodi

- execute - utilizza al route per una pagina in view per richiamare la pagina nuova


## - ActionDelete
Estende `RecordAction`. Azione pensata per l'utilizzo dentro una view list  per la cancellazione di un record all'interno della lista.

Proprietà

- className : 'ActionDelete',
      title : 'Cancella',
      icon:  'fa fa-remove text-danger',
      multiText : 'Cancella',
     
Metodi

- execute - utilizza al route delete per eseguire la richiesta di cancellazione. Prima chiede conferma
- callback - metodo richiamata alla fine della execute


## - ActionMultiDelete
Estende `CollectionAction`. Azione pensata per l'utilizzo dentro una view list  per la cancellazione di tutti i record selezionati nella lista.

Proprietà

- className : 'ActionMultiDelete',
      title : 'Cancella selezionati',
      icon:  'fa fa-trash text-danger',
      cssClass : 'btn btn-default btn-xs text-danger',
      text : 'Selezionati',
      needSelection : true,
      multiText : 'Cancella Selezionati',
     
Metodi

- execute - utilizza al route delete per eseguire la richiesta di cancellazione. Prima chiede conferma
- callback - metodo richiamata alla fine della execute


## - ActionSearch
Estende `CollectionAction`. Azione pensata per l'utilizzo dentro una view search  per la ricerca dei record con i filtri della view.

Proprietà

- className : 'ActionSearch',
      title : 'Ricerca',
      icon:  'fa fa-search',
      cssClass : 'btn btn-xs btn-default text-info',
      text : 'Cerca',
     
Metodi

- execute - richiama la pagina con i parametri in get presenti nella form della vista


## - ActionReset
Estende `CollectionAction`. Azione pensata per l'utilizzo dentro una view search il reset dei parametri di 
ricerca impostati

Proprietà

- className : 'ActionReset',
      title : 'Annulla filtri ricerca',
      cssClass : 'btn btn-xs btn-default',
      text : 'Annulla filtri',
     
Metodi

- execute - richiama il metodo clear su tutti i renders della view e richiama la callback
- callback - metodo chiamato dopo il reset dei controlli




var actionNextPage = CollectionAction.extend({
    icon : 'fa fa-angle-right',
    cssClass : 'btn btn-default btn-xs',
    func : function () {
        var r =  this.view.getRoute();// Route.factory(viewList.config.routeName);
        if (this.view.data.pagination.current_page < this.view.data.pagination.last_page) {
            r.params['page'] = this.view.data.pagination.current_page +1;
            this.view.setRoute(r);
            app.renderView(this.view.keyId);
            this.callback();
        }
    }
});

var actionPrevPage = CollectionAction.extend({
    icon : 'fa fa-angle-left',
    cssClass : 'btn btn-default btn-xs',
    func : function () {
        var r =  this.view.getRoute();// Route.factory(viewList.config.routeName);
        if (this.view.data.pagination.current_page > 1) {
            r.params['page'] = this.view.data.pagination.current_page - 1;
            this.view.setRoute(r);
            app.renderView(this.view.keyId);
            this.callback();
        }

    }
});


var actionFirstPage = CollectionAction.extend({
    icon : 'fa fa fa-angle-double-left',
    cssClass : 'btn btn-default btn-xs',
    func : function () {
        var r =  this.view.getRoute();// Route.factory(viewList.config.routeName);
        if (this.view.data.pagination.current_page > 1) {
            r.params['page'] = 1;
            this.view.setRoute(r);
            app.renderView(this.view.keyId);
            this.callback();
        }

    }
});

var actionLastPage = CollectionAction.extend({
    icon : 'fa fa fa-angle-double-right',
    cssClass : 'btn btn-default btn-xs',
    func : function () {
        var r =  this.view.getRoute();// Route.factory(viewList.config.routeName);
        if (this.view.data.pagination.current_page < this.view.data.pagination.last_page) {
            r.params['page'] = this.view.data.pagination.last_page;
            this.view.setRoute(r);
            app.renderView(this.view.keyId);
            this.callback();
        }

    }
});

var actionPerPage = CollectionAction.extend({
    icon : 'fa fa fa-angle-double-right',
    htmlEvent : 'onchange',
    cssClass : 'btn btn-default btn-xs',
    init : function (params) {
        this._super(params);
        this._htmlProperties.push('pagination');
    },
    func : function () {
        var self = this;
        var r =  this.view.getRoute();// Route.factory(viewList.config.routeName);
        //console.log('html',self.container,jQuery(self.container).html());
        r.params['page'] = 1;
        r.params['paginateNumber'] = jQuery(self.container).find('select').val();
        this.view.setRoute(r);
        app.renderView(this.view.keyId);
        this.callback();

    },
    _getData : function () {
        var data = this._super();
        data.pagination.pagination_order = _.sortBy(_.keys(data.pagination.pagination_steps), function (num) {
            return parseInt(num);
        });
        return data;
    },
    _buttonTemplate : function () {
        var special_attrs = `"{'` + this.htmlEvent + `':` + this.htmlEvent + `,'title':title,'data-params':params}"`;
        return `
                <select data-field="pagination.per_page" data-source="pagination.pagination_steps" 
                        data-sourceorder="pagination.pagination_order"
                        data-attrs=`+ special_attrs + `  class="pagination-input">
        
                </select>  
            `
    },
});


