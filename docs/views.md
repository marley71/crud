## View

La `View` estende la classe `Component` rappesenta il contenitore di dati html associate ad un 
modello di dati.
Questo modello viene utilizzato per discriminare la route per il recupero dei dati.
Da essa sono derivate le classi:

- `RecordView` per la gestione di dati provenienti da record di un modello
- `CollectionView` per la gestione di una collezione di record di un modello
    
La view accetta come parametro una configurazione. 

Nella configurazione vengono definiti:

- i campi da visualizzare, quali Render utilizzare per ogni dato
- le azioni disponibili che si possono effettuare. In caso di view che gestisce una 
  collezione di records esistono due tipi di azioni
  - `RecordAction` definite sul singolo record
  - `CollectionAction` che agisce sulla collezione dei dati




Rappresenta la classe Principale
	
### Proprietà
	
- `modelName` *default null* rappresenta il nome del modello dei dati gestito

- `dummyModel` *default 'dummy'*  Questo nome è del modello dummy per view che contiene dati calcolati manualmente senza comunicazione con 
il server attraverso la route

- `renderObjs` *default []* Array degli oggetti *Render* presenti nella view

- `data` *default {}* Array associativo contente i dati della view

- `type` *default null* Tipo di view, 

- `jQe` *default null* Oggetto jQuery che punta al container della view

- `defaultRenderType` *default null*

- `connectedObjs`       : {},
- `keyId`               : null,     // identificativo univoco della view creata e assegnata dall'oggetto App   
- `app`                : null,      // oggetto app proprietario della view
- `viewTypeToRenderType` :          // mapping delle viste con i tipi default dei render
```javascript
{
    'list'      : BaseElement.VIEW,
    'edit'      : BaseElement.EDIT,
    'search'    : BaseElement.SEARCH,
    'view'      : BaseElement.VIEW,
    'calendar'  : BaseElement.VIEW,
    'csv'       : BaseElement.EDIT
}
```
- `resources` : [] - vettore delle risorse esterne da caricare prima di visualizzare la view

* `route` : null - oggetto route associata view

* `routeName` : null - nome della classe Route da agganciare ( vedere Route.factory per la convenzione sui nomi) 

* `actions` : [] - vettore nome azioni da istanziare nella view

### Metodi

- `draw(callback)` metodo per la renderizzazione della view. callback e' la chiamata che
viene effettuata alla fine se passata. La sequenza delle chiamate attraverso le callback:
Se all'interno di questi metodi non viene chiamata la callback viene interrotto il flusso di chiamate.
Utilizzare questa tecnica per interrompere la visualizzazione o il comportamento della view.
    - beforeLoadData(callback)
    - loadData(callback)
    - afterLoadData(callback)
    - _prepareContainer()
    - beforeRender(callback)
    - render(callback)
    - afterRender(callback)
    - beforeFinalize(callback)
    - _loadExternalResources(callback)
    - finalize(callback)
    - afterFinalize(callback)

- `beforeLoadData(callback)` - metodo viene chiamato prima che la view carichi i dati
- `loadData(callback)` - metodo chiamato per il caricamento dei dati attraverso la route
- `afterLoadData(callback)` - metodo chiamato dopo che i dati sono stati caricati
- `_prepareContainer()` - metodo dove viene iniettato l'html presente nel template
- `beforeRender(callback)` - metodo chiamato prima di chiamare utilizzabile per eventuali manipolazioni
- `render(callback)` - questo metodo è utilizzato per disegnare la struttura html
- `afterRender(callback)` - chiamato dopo il render
- `beforeFinalize(callback)`
- `_loadExternalResources(callback)` - chiamata per il caricamento delle risorse esterne
- `finalize(callback)` - metodo per la creazione e il disegno dei renders della view
- `afterFinalize(callback)` - metodo per agganciare eventuali eventi personali e modifiche custom
- `delete()` - metodo chiamato prima di cancellare la view per dare la possibilità alla view di 
cancellare eventuali oggetti creati 
- `setRoute(route)` - metodo per settare l'oggetto route interno alla view
- `getRoute()` - ritorna la route istanziata della view
- `setId(id)` - setta l'identificativo della view
- `setData(data)` - setta i dati della dall'esterno
- `getFormData(data)` - ritorna i dati di una form html in un vettore associativo se esiste
- `getItemTemplate(key)` - Istanzia e ritorna il template associato all'oggetto Render associato alla
key
    - @param key : nome del campo di cui si vuole il template
- `_getRenderMode(key)` - (privata) restituisce la modalita' in cui verra' disegnato l'oggetto render 
in base alla configurazione dell'oggetto nell fields_config della view
    - key : nome del campo
- `_getRenderType(key)` - (privata) ritorna il type del render in base al type definito nella fields_config della view
o alla configurazione di default
    - key : nome del campo
- `_getDefaultRenderConfig(key)` - ritorna la configurazione di default dell'oggetto render
    - key : chiave dell'oggetto render
- `_getRenderConfig(key)` - ritorna la configurazione finale dell'oggetto render, eseguendo
il merge tra la configuazione di default e quella passata alla view.

                                       


## RecordView

La `RecordView` estende `View` è pensata per tutte le viste che gestiscono un solo record del modello 
di dati.

### Proprietà
- _pkName : 'id' - nome della chiave univoca del modello dati
- _pkValue : null - valore della chiave univoca del modello dati
- _actions : [] - vettore con tutte le azioni istanziati nella vista
- actions : [] - vettore nomi delle azioni da istanziare nella vista
- type : 'record' - tipo della vista in questo caso record
- defaultItemTemplate : 'left' - Oggetto template di default che conterrà gli oggetti Renders
- data : vettore associativo dei dati dalla forma
```javascript
data : {
    value : {},     //vettore associativo key => value dei modello dati
    metadata : {},  //vettore associativo key => {} metadati che descrivono key
    validationRules : {}, // vettore associativo key => {} regole di validazione lato javascript da applicare alla key    
}
```

### Metodi

- `getRenderValue(fieldName)` : 
- `getRender : function(fieldName)`
- `resetForm()` : function () - esegue il clear di tutti i render della view
- `_callAction` : function (actionData) - (privata)
- `_setActions` : function () - (privata) instanzia tutte le azioni definite per riga e globali partendo
                                             * dalla configurazione iniziale definita nella config
                                             * far partire l'ascolto per tutti gli eventi che riguardano le proprie
                                             * azioni
- `_createAction(key)`  
- `_setKeys`: setta le keys attive per la view
- `_renderHidden(key)` : renderizza i render di tipo hidden perche' sono speciali
- `_renderObjectElement(key)` : renderizza l'oggetto render associato alla key che non sia hidden
- `_getGroup(key)`: ritorna il gruppo associato al campo nel caso di view con template strutturato a gruppi
- `_renderElement(key)` : chiama _renderHidden o _renderObjectElement in base al type
- `_createRender(container,key)` : crea l'oggetto render e gli associa il container dove
verrà disegnato
- `_renderActions()` : renderizza le azioni istanziate nella view
- `_getFieldName(key)` : ritorna il fieldName costruito a partire dalla key a seconda del 
tipo di view che stiamo realizzando. Ci permette di mettere dei prefissi o suffissi a tutte le key
del modello dei dati dovuti ad esigenze dell'html tipo view annidate per creare delle form complese.


## CollectionView

La `CollectionView` estend la `View` è pensata per tutte le viste che gestiscono una lista record del modello 
di dati.

### Proprietà

- `_recordActions` : [] - vettore azioni della vista per ogni singolo record,
- `_globalActions` : [] - vettore azioni sull'intera vista
- `_paginatorActions` : [] - vettore azioni per la paginazione
- `actionsLayout` : 'left' - tipo di layout per le azioni sui record, left o right
- `type` : 'list' - tipo di view, in questo caso list
- `defaultItemTemplate` : 'no' - classe del template da istanziare per ogni render
- `orderClass` - le classi da aggiungere all'header del campo ordinato.
```javascript
orderClass : {
  'asc': ['sorting_asc'],
  'desc' : ['sorting_desc']
}
```
- data - dati del modello dati da visualizzare, vettore associativo della forma:
```javascript
data : {
    value : [],
    metadata : {},
    pagination : {},
    resultParams : {},
    summary : {},
    validationRules : {},
    backParams : {},
    has_errors : false,
    list_header : ''
}
```
### Metodi

- `setOrder(field)` - permette di ordinare una view rispetto ad un campo
- `_setKeys()` - (privata) setta i render da renderizzare nella vista
- `_renderHeaderValues(jQrow)` - (privata) setta l'intestazione delle colonne della vista
- `_renderHeaderActions(jQrow)` - (privata) renderizza l'header della colonna action
- `_renderHeader()` - (privata) - renderizza l'header
- `_renderFooter()` - (privata) - renderizza il footer
- `_attachEvents(index)` - 
- `_attachDetailEvents()` -
- `getChecked()` - ritorna il vettore di tutte le pk delle rows selezionate.
- `_renderGlobalActions()` - renderizzare le azioni globali alla vista
- `_renderInfoHeader()` - renderizza un eventuale header di info della lista. L'html viene preso da
data.list_header
- `render(callback)` - renderizza la view
- `_renderRow(index)` - (privata) renderizza la singola riga
- `finalize(callback)` - finalizza la view e aggancia gli eventi
- `_setActions()` - (privata) instanzia tutte le azioni definite per riga e globali partendo
dalla configurazione iniziale definita nella config. Far partire l'ascolto per tutti gli eventi 
che riguardano le proprie azioni
- `_setVisibleKeys()` 
- `_renderZeroResult()`  
- `_renderPagination()` 
- `_createRender(r,key,container)` 
- `_createGrid()` 
- `_createAction(row,key)` - crea un azione se row e' null setta come modelData 
dell'azione tutti i dati altrimenti il dati della row indicata.
    * @param row : row a cui si riferisce null in caso di azione globale
    * @param key : nome dell'azione
    * @returns {*} : ritorna l'azione creata
- `_renderSingleActions()`  
- `_hasNeedSelectionAction()` - controlla che la lista abbia almeno un'azione che ha bisogno di selezionare elementi
- `_hasRecordActions()`  - controlla se la view abbia almeno una azione che lavora sul singolo record della lista








# Views Implementate
Nella libreria sono state implementate delle views di uso comune

## ViewList
E' una collection view che renderizza i risultati su un template tabellare,
viene popolata attraverso la *RouteList* che prevede come parametro il modelName, questa view è composta dal
template principale piu' altri template delle varie sezioni di una lista. Questo permette di poter configurare
le singole parti in modo più puntuale. 


<a href="http://www.pierpaolociullo.it/example?f=view_list" target="_blank">Esempio</a>

<a href="http://www.pierpaolociullo.it/example?f=view_list__custom_data" target="_blank">Esempio con dati custom</a>


#### marcatori


#### template

```html
    <div class="panel panel-default panel-body model-list">
        <div data-list_header></div>
        <div data-hidden_fields></div>
        <div class="clearfix">
            <div class="col col-md-5 col-xs-12 hidden-xs list-actions" data-view_collection_actions></div>
            <div class="col col-md-7 col-xs-12 list-pagination" data-view_pagination></div>
        </div>
        <hr/>
        <div class="table-responsive">
            
            <table class="table table-striped table-condensed table-hover table-bordered table-vertical-middle nomargin">
                <thead>
                    <tr data-view_row_headers>
                        
                    </tr>
                </thead>
                <tbody>
                    <tr data-view_row_elements>
                        
                    </tr>
                </tbody>
                <tfoot>
                    <tr data-view_row_footer><td></td></tr>
                </tfoot>
            </table>
        </div>
        <hr/>
        <div class="clearfix">
            <div class="col col-md-5 col-xs-12 list-actions" data-view_collection_actions></div>
            <div class="col col-md-7 col-xs-12 list-pagination" data-view_pagination></div>
        </div>
    </div>
```

#### recordActionTemplate
```html
    <div class="btn-group" role="group"></div>
```

#### headerTemplate
```html
    <th>
        <span data-element></span>
    </th>
```

#### orderTemplate
```html
<th class="sorting">
    <a href="javascript:void(0)" data-action="actionOrder" data-pk="">
        <span data-element></span>
    </a>
</th>
```

#### cellTemplate 
```html
    <td >
                    
    </td>
```
           
#### checkAllTemplate
```html
    <input type="checkbox" data-button="checkAll" title="Seleziona tutti">
```

#### checkTemplate
```html
    <span class="pull-left" ><input data-pk="" type="checkbox" name="check_row">&nbsp;</span>
```

#### paginatorTemplate
```html
<ul class="list-inline hidden-md hidden-sm hidden-xs">
    <li data-action_first_page><a data-first_page href="javascript:void(0)">&laquo;</a></li>
    <li data-action_prev_page><a data-prev_page href="javascript:void(0)">&lt;</a></li>
    <li>
    <span style="padding:2px" >
        <span data-keytranslate="general-pagination_total" >Tot</span>
        <b><span data-field="total"></span></b>,
    &nbsp;&nbsp;
        <span data-action_per_page></span>
        <!--<select data-action_per_page data-field="per_page" data-source="pagination_steps" self style="height:24px" class="pagination-input" data-action="actionPerPage">-->
<!---->
        <!--</select>-->
        <span data-keytranslate="general-pagination_per_page" >Per pagina</span>
    </span>
    </li>
    <li><a class="disabled" href="javascript:void(0)" data-page_info=""> <span data-field="current_page"></span> / <span data-field="last_page"></span> </a></li>
    <li data-action_next_page ><a data-next_page href="javascript:void(0)">&gt;</a></li>
    <li data-action_last_page><a data-last_page href="javascript:void(0)">&raquo;</a></li>

</ul>
<ul class="pagination pagination-sm hidden-lg hidden-xl">
    <li data-action_first_page><a data-action="ActionFirstPage" href="javascript:void(0)">&laquo;</a></li>
    <li data-action_prev_page><a data-action="ActionPrevPage" href="javascript:void(0)">&lt;</a></li>
    <li><a class="disabled" href="javascript:void(0)" data-page_info="">  <span data-field="current_page"></span> / <span data-field="last_page"></span> (<span data-field="total"></span>)</a></li>
    <li data-action_next_page><a data-action="ActionNextPage" href="javascript:void(0)">&gt;</a></li>
    <li data-action_last_page><a data-action="ActionLastPage" href="javascript:void(0)">&raquo;</a></li>

</ul>
```


## ViewInsert
E' una view per la creazione di un nuovo record. Utilizza la route RouteInsert per il 
caricamento dei dati e la RouteSave per il salvataggio

<a href="http://www.pierpaolociullo.it/example?f=view_insert" target="_blank">Esempio</a>

#### template 

```html
<div class="well" data-edit-main>
    <div data-alert class="alert alert-success hide"></div>
    <form name="data_form" class="model-edit">
        <div data-hidden_fields></div>
        <div data-view_elements>
            
        </div>
        <div data-view_action >
            <div data-field="data" data-self>

            </div>
        </div>
    </form>
</div>
```


## ViewEdit
E' una view per la modifica di un record. Utilizza la route RouteEdit per il caricamento
e la RouteUpdate per il salvataggio

<a href="http://www.pierpaolociullo.it/example?f=view_edit" target="_blank">Esempio</a>


#### template 

```html
<div class="well" data-edit-main>
    <div data-alert class="alert alert-success hide"></div>
    <form name="data_form" class="model-edit">
        <div data-hidden_fields></div>
        <div data-view_elements>
            
        </div>
        <div data-view_action >
            <div data-field="data" data-self>

            </div>
        </div>
    </form>
</div>
```
## ViewSearch
E' una view per effettuare una ricerca.

<a href="http://www.pierpaolociullo.it/example?f=view_search" target="_blank">Esempio</a>

#### template 

```html
<div class="well search-well">
    <form name="data_form" class="model-search">
        <div data-hidden_fields></div>
        <div class="search-row" data-view_elements>
        </div>

        <div class="clearfix"></div>
        <hr class=""/>

        <div data-view_action>
            <div data-field="data" data-self>
            </div>
        </div>
    </form>
</div>
```
## ViewView
E' una view per visualizzare i risultati in modalità lettura.

<a href="http://www.pierpaolociullo.it/example?f=view_view" target="_blank">Esempio</a>

#### template

```html
<div class="well model-view">
    <div data-hidden_fields></div>
    <div data-view_elements>
    </div>
    <div data-view_action >
        <div data-field="data" data-self>
           
        </div>
    </div>
</div>
```
