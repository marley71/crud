#Component

La classe principale di tutte le componenti grafiche `Component`, definisce il comportamento
generale che un componente deve avere nella visualizzazione di un html e dati associati
più tutta la logica per la gestione del dato e delle interazioni utente.

La classe ha un metodo `template` che ritorna html del componente. Il template viene marcato
con dei marcatori (attributi di tag dal formato data-{marcatore}). Avere questi marcatori permette
la possibilità di stravolgere completamente il template di base avendo solo l'obbligo di mantenere
questi marcatori per la costruzione dell'html finale.

Nell'oggetto componente è stato inserito anche la possibilità di avere dei traits che ne permette l'estensione
con funzionalità proprie della nostra applicazione senza dover per forza ridefinire la classe componente. 
I traits sono stati differenziati in traits che agiscono sui templates e traits generali per l'aggiunta di 
funzionalità custom.

###Proprietà
- `className` : 'Component'. Questa proprietà è stata introdotta a causa della possibilità di poter estendere 
le classi con un trucchetto e che rende impossibile saper a runtime in quale classe ci si trovi.
- `defaultTraitsTemplate` : ['TraitTranslate','TraitTemplate','TraitPlaceholder'], vettore di traits definiti di default
in particolare :
    - `TraitTranslate` ha il compito per la sostituzione di tutti i marcatori data-label presenti nel template
    - `TraitTemplate`
    - `TraitPlaceholder`
- `traitsTemplate` : [] vettore di eventuali altri traits custom che vogliamo siano eseguiti subito dopo avere visualizzato il template
- `traits` : [] traits per estendere funzionalità del component senza ridefinirne la classe.
- `container` : null,

###Metodi
- `init : function (attributes)`: costruttore, attributes rappresenta gli attributi
che si vogliono sostituire, è possibile passare anche i metodi per ridefinire alcuni 
comportamenti.

- `attrs` : function (attrs) : permettere di ridefinire proprietà o metodi dell'oggetto

- `template` : function() : metodo che restituisce il template html del componente

- `getTemplate` : function () : metodo che un oggetto jquery('div') che wrappa il template
 del componente.

- `html` :  function () ritorna l'html puntato dalla proprietà container del componente
- `jQe : function (selector)` : ritorna l'oggetto jquery associato al container del componente

- `beforeRender` : function (callback) : viene chiamata prima di eseguire il render, se si vogliono
 fare di check prima di iniettare l'html del richiamare la callback per il ritorno.

- `render` : function (callback): metodo dove viene iniettato nel container l'html del componente in 
base alle proprie politiche.

- `afterRender` : function (callback) : metodo che viene chiamato dopo il metodo render.

- `beforeFinalize` : function (callback) : metodo per il proprio codice custom chiamato prima del finalize
- `finalize` : function (callback) : metodo per aggiungere eventi o istanziare plugins 
- `afterFinalize` : function (callback) : metodo custom per eventuali esigenze su oggetti modificati
- `_prepareContainer` : function () : scrive l'html che viene restituita dal metodo template dentro il container.
Se il componente ne ha uno altrimenti viene creato un oggetto jquery contentente l'html.
- `_executeTraitsTemplate` : function () metodo eseguito dopo che si è scritto l'html. Utilizzare questo metodo
se si vogliono eseguire dei particolari filtri con il concetto di trait

- `_loadExternalResources` : function (callback) 
carica eventuali risorse esterne prima di far partire il render del component
@param callback : funzione di ritorno 
    
- `draw` : function (callback) : disegna l'html del componente e poi richiama la callback
Il metodo draw esegue in seguenza diversi metodi che vengono richiamati attraverso la
callback. Questo modo di eseguire i metodi permette di fare anche delle chiamate
asincrone e aspettare il termine delle chiamate prima di procedere. 
 
    - _`prepareContainer` ;
    - _`loadExternalResources` : function (callback);
    - `beforeRender` : function (callback)
    - `render` : function (callback)
    - `afterRender` : function (callback)
    - `beforeFinalize` : function (callback)
    - `finalize` : function (callback)
    - `afterFinalize` : function (callback)

`Component.parseHtml` = function (templateString) metodo statico che crea un oggetto jquery eseguendo
il parse della stringa passata

`Component.uid` = 0;

`Component.newID` = function () metodo statico che ritorna un id univoco fomato da 'c_'+ un intero 
incrementale