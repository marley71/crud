# Views

La view rappesenta un contenitore di controlli html associate ad un modello di dati.
Questo modello viene utilizzato per discriminare la route per il recupero dei dati.
La classe principale di una View è `View`. Da essa sono derivate le classi:
    - `RecordView` per la gestione di dati provenienti da record di un modello
    - `CollectionView` per la gestione di una collezione di record di un modello
La view accetta come parametro una configurazione. 

Nella configurazione vengono definiti:
- i campi da visualizzare, quali Render utilizzare per ogni dato
- le azioni disponibili che si possono effettuare. In caso di view che gestisce una 
  collezione di records esistono due tipi di azioni
  - `RecordAction` definite sul singolo record
  - `CollectionAction` che agisce sulla collezione dei dati


## View

Rappresenta la classe Principale
	
###Proprietà
	
* `modelName` *default null* rappresenta il nome del modello dei dati gestito

* `dummyModel` *default 'dummy'*  Questo nome è del modello dummy per view che contiene dati calcolati manualmente senza comunicazione con 
il server attraverso la route

* `renderObjs` *default []* Array degli oggetti *Render* presenti nella view

* `data` *default {}* Array associativo contente i dati della view

* `type` *default null* Tipo di view, 

* `jQe` *default null* Oggetto jQuery che punta al container della view

da verificare    langs               : [],

* `defaultRenderType` *default null*

da verficare defaultRenderClassName : null,

* `connectedObjs`       : {},
* `keyId`               : null,     // identificativo univoco della view creata e assegnata dal controller
    
* `_app`                : null,     // oggetto app proprietario della view
* `_customAttrs`        : {},       // attributi per le view custom personalizzabili a seconda delle esigenze
    // mapping delle viste con i tipi default dei render
* `viewTypeToRenderType` : 
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
   
* `pluginsPath` : "",
path dove si trovano i files javascript/css da caricare dinamicamente definiti
nel vettore resources

* `resources` : [],
vettore delle risorse esterne da caricare prima di visualizzare la view

* `route` : null,
oggetto route della view

* `routeName` : null,
nome della classe Route da agganciare


* `actions`å : [], 
vettore nome azioni da istanziare nella view

###Metodi

####render
dopo aver caricato eventuale risorse esterne come css,plugins javascript chiama la funzione _render della view
La View ha il metodo _render astratto

###Eventi

####beforeLoadData
questo evento viene chiamato prima che la view carichi i dati

####afterLoadData
questo evento viene chiamato dopo che i dati sono arrivati dal server
    
####afterRender
questo evento viene chiamato dopo che la view e tutti i suoi controlli sono stati disegnati

####afterActionConnected

    

## RecordView


_pkName : 'id',
_pkValue : null,

####_actions : [], 
vettore degli oggetti azioni istanziate nella view


####type : 'record',

    data : {
        value : {},
        metadata : {},
        resultParams : {},
        validationRules : {},
        backParams : {}
    },

###Metodi

####_render
	_render : function () {
        var self = this;
        // setto il template principale della view
        //console.log("EDIT ",self.jQe.find('[data-view_elements]'));
        self.jQe.find('[data-view_elements]').attr('data-view_elements',self.modelName);
        self._setKeys();
        self._setActions();
        for (var key in self.keys) {
            self._renderElement(self.keys[key]);
        }

        for (var i in self.keys) {
            self.renderObjs[0][ self.keys[i] ].finalize();
        }
        //if (!self.isHasMany)
        self._renderActions();
        self._attachEvents();

        for (var i in self.keys) {
            self._connectFields( self.keys[i] );
        }

    },

## CollectionView

###Proprietà

####_recordActions : [], // vettore azioni della vista,

####_globalActions : [],

####_paginatorActions : [],
    
####type : 'list',
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

###Metodi

####setOrder : function (field)
permette di ordinare una view rispetto ad un campo



    mkdocs.yml    # The configuration file.
    docs/
        index.md  # The documentation homepage.
        ...       # Other markdown pages, images and other files.


#Views Implementate
Nella libreria sono state implementate delle views di uso comune

##- ViewList
E' una collection view che renderizza i risultati su un template tabellare,
viene popolata attraverso la *RouteList* che prevede come parametro il modelName


##- ViewInsert
E' una view per la creazione di un nuovo record. Utilizza la route RouteInsert per il 
caricamento dei dati e la RouteSave per il salvataggio



##- ViewEdit
E' una view per la modifica di un record. Utilizza la route RouteEdit per il caricamento
e la RouteUpdate per il salvataggio

##- ViewSearch
E' una view per effettuare una ricerca.

##- ViewView
E' una view per visualizzare i risultati in modalità lettura.