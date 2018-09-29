#Renders

La classe principale delle componenti Renders è la classe `Render`. 

La visualizzazione dell'oggetto render avviene con due metodi principali:

- `render` dove viene preparato l'html e aggiunto al dom della pagina
- `finalize` dove e' possibile agganciare eventuali eventi html per la gestione del comportamento del 
componente


##Render

La classe Render definisce alcune metodi di uso generale e i metodi che i veri oggetti Render
devono ridefinire per funzionare. Dobbiamo considerarla come la classe astratta che definisce l'interfaccia
da definire nei vari oggetti Render concreti.

il modo è definito nelle costanti
```javascript
Render.VIEW = 'view';
Render.EDIT = 'edit';
Render.SEARCH = 'search';
```

###Proprietà

* `_modeBeforeFunctionName` contiene il metodo da chiamare in automatico prima di effettuare il render html
```javascript
{
    'view'   : '_beforeView',
    'edit'   : '_beforeEdit',
    'search' : '_beforeSearch'
}
```
* `_modeRenderFunctionName` contiene il metodo da chiamare per la renderizzazione dell'html
```javascript
{
    'view'   : '_renderView',
    'edit'   : '_renderEdit',
    'search' : '_renderSearch'
}
```
* `_modeFinalizeFunctionName` contiene il metodo da chiamare dopo il render dell'html.
```javascript
{
    'view'   : '_finalizeView',
    'edit'   : '_finalizeEdit',
    'search' : '_finalizeSearch'
}
```
* `key` default null // chiave dell'oggetto render (il campo del db)
* `type` default null,                // type dell'oggetto per gestire le Gerarchie di classi
* `className` defult 'Render',       // nome della Classe reale dell'oggetto
* `classData` default null,           // nome per il tipo di caricamento dati e config da utilizzare nelle views per permettere caricamenti custom per oggetti particolari
* `classTemplate` default : null,       // nome utilizzato per la composozione del templateid da caricare
* `element_selector` default '[data-render_element]' selettore per trovare il container html di tutto l'elemento
* `control_selector` default '[data-render_control]',
* `caption_selector` defult '[data-render_caption]',
* `operator_selector` default '[data-control_operator]',

* `value` default : null,           // valore oggetto
* `mode` default 'edit',          // modo in edit controllo di form, default edit
* `templateId` defaul tnull,      // id del template sorgente da renderizzare,
* `templateItemId` default null,  // id del template in caso di oggetti che sono vettori di valori
* `container` default null,       // id del container html dove verrà renderizzato l'oggetto Render
* `pluginsPath` default  '',
* `resources `: // vettore risorse da caricare prima di chiamare il finalize default in base al mode
```javascript
    search : [],
    edit : [],
    view : []
```

###Metodi




- render : `function (container)`
*container* rappresenta un container jquery (facoltativo). Il metodo render chiama in sequenza. 

+ in modo view
    - `_beforeView`
    - `_renderView`
+ in modo edit
    - `_beforeEdit`
    - `_renderEdit`
+ in modo search
    - `_beforeSearch`
    - `_renderSearch`


- finalize : `function (callback)`
Il metodo chiama la il metodo in base al `mode`. Il parametro callback rappresenta una funzione
che viene chiamata quando il metodo finalize è terminato. Il metodo  viene chiamato dopo che sono 
state caricate tutte le risorse

+ in modo view
    - `_finalizeView`
+ in modo edit
    - `_finalizeEdit`
+ in modo search
    - `_finalizeSearch`


- show : `function (callback)`
Il metodo chiama in sequenza render e finalize. E' uno shortcut 
 
 





  
####getTemplate : `function (templateString)` 

ritorna jquery html con il  template associato in base al mode oppure passando 
il template nel parametro templateString. Il template automatico viene calcolato come '_'+mode+'Template'. 
Ad esempio se vogliamo definire l'html della view di un nostro componente Render, 
basta definire un metodo chiamato 
_viewTemplate. 
     *
        
    getJObject : function () {
        var self = this;
        return jQuery(self['_'+self.mode+'Template']());
    },

    getHtml : function () {
        return this.getJObject().outerHTML;
    },

    _beforeEdit : function() {
        return true;
    },

    _beforeView : function() {
        return true;
    },

    _beforeSearch : function() {
        return true;
    },

    triggerEvent : function (name,params,callback) {
        EventManager.trigger(name,params,callback);
    },

    _setHtmlAttributes : function(el) {
        var self = this;
        for(var k in self.htmlAttributes) {
            el.attr(k,self.htmlAttributes[k]);
        }
    },
    _loadExternalResources : function (resources,callback) {
        var self = this;
        EventManager.trigger('loadResources',{
                resources: resources
            },
            callback);
    },
    
    trigger : function (eventName) {
        
    },
    on : function (eventName) {
        
    },
    change : function () {
        // change event
    },

    clear : function () {
        throw this.className + ": <clear> method must be overloaded "
    }
    
#Render Implementati

La libreria mette a disposizione dei renders di default per gli usi più comuni.
Questi possono essere ridefiniti, in caso vogliamo cambiare, nella nostra applicazione,
aspetto o funzionalità. A questi definiti se ne possono aggiungere altri usando
l'erediaretà. I renders vengono istanziati in automatico dalle views, oppure possono
essere istanziati manualmente.

##- RenderAutocomplete.js

Questo render permette il popolamento di una chiave con riferimento ad una tabella
esterna permettendo la ricerca e inserendo la chiave_id  selezionata nel input nascosto.
Le risorse esterne per il funzionamento di questo render sono:
```javascript
resources : {
    'edit' : ['typeahead/bootstrap3-typeahead.min.js','typeahead/typeahead.bundle.js','typeahead/typeaheadjs.css']
}
```


##- RenderBelongsto.js

Questo render è solo per la visualizzazione di dati più complessi che non sono formati da un solo
valore, in genere viene utilizzato per la rappresentazione di campi di una tabella
esterna rispetto a campo corrente.

##- RenderDateSelect.js

Questo render è per l'inserimento o la visualizzazione di una data. Questo oggetto 
utilizza le selectbox html per l'inserimento di una data.

##- RenderDatePicker.js
Questo render è per l'inserimento o la visualizzazione di una data. Questo oggetto 
utilizza il picker bootstrap per l'inserimento di una data.

```javascript
resources : {
    edit :  [
        'bootstrap-daterangepicker/daterangepicker.css',
        'bootstrap-daterangepicker/moment.js',
        'bootstrap-daterangepicker/daterangepicker.js',
    ],
    search : [
        'bootstrap-daterangepicker/daterangepicker.css',
        'bootstrap-daterangepicker/moment.js',
        'bootstrap-daterangepicker/daterangepicker.js',
    ],
    view : []
}
```

##- RenderDateFormatted.js
Questo render è per l'inserimento o la visualizzazione di una data. Questo oggetto 
utilizza il picker nativo del broswer associato al type=date, se supportato.


##- RenderBetweenDate.js

Questo render serve per la gestione di un range di date.

##- RenderCaptcha.js

Questo render incapsula il captca con il suo relativo reload

##- RenderChoice.js




##- RenderCustom.js

Oggetto per chi vuole poter modificare l'html da renderizzare. Qui si può inserire
tutto quello che si vuole utilizzando che chiamate render e finalize.

##- RenderDecimal.js

Oggetto per la gestione dei decimali con parte intera e decimale gestiti separatamente.

##- RenderFaicon.js

##- RenderHasmany.js
Oggetto per la gestione delle relazioni esterne. Permette l'inserimento e visualizzazione
di relazioni esterne in un'unica form.

##- RenderHasmanyThrough.js

Oggetto per la gestione degli hasmany trought...

##- RenderHasmanyUpload.js

Oggetto per la gestione di hasmany che prevedo un upload di una immagini o allegati
come pdf,csv,ecc.

##- RenderImage.js

Oggetto per la renderizzazione di un'immagine proveniente da campo.

##- RenderInput.js

oggetto per la gestione degli input standard.

##- RenderInputHelped.js
Oggetto che prevede un input e dei tasti per inserimenti generali, in genere usato
per input che prendono un'insieme di valori predefinito.

##- RenderMap.js
Oggetto per la visualizzazione e la selezione di coordinate gps basato su googlemaps

##- RenderMultiUpload.js

##- RenderSelect.js
Oggetto per la selezione di un valore utilizzando le select

##- RenderSwap.js

##- RenderText.js
##- RenderTextarea.js
##- RenderTexthtml.js
##- RenderTime.js
##- RenderUpload.js