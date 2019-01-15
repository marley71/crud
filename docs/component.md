# Component

La classe principale di tutte le componenti grafiche è `Component`, definisce il comportamento
generale che un componente deve avere nella visualizzazione di un html. Un componente, quando viene disegnato,
chiama in sequenza una serie di metodi che rappresentano gli agganci dove noi possiamo scrivere il nostro codice
che caratterizzerà la componente.

La classe ha un metodo `template` che ritorna una stringa html del componente. Il concetto principale è quello di 
inserire nel template del componente dei marcatori (attributi dal formato **data-{marcatore}**). 
Questi marcatori permettono di avere la possibilità di stravolgere completamente il template di base senza modificare 
il comportamento del nostro componente. L'unico obbligo è di mantenere questi marcatori per il suo corretto funzionamento.

E' stata inserita la possibilità di avere dei `traits` che ne permetteno l'estensione
con funzionalità proprie della nostra applicazione senza dover per forza ridefinire la classe componente. 
Oltre ai traits è stata inserita la possibilità di avere dei `traitsTemplate` sono dei traits particolari e il loro 
metodo viene chiamato subito dopo che il template è stato iniettato nel dom della pagina.
Possiamo considerarli come post elaborazioni da fare sul dom html non previste dalla libreria. Vedremo più
avanti il loro utilizzo.

Per convenzione i metodi preceduti da "_" sono da considerarsi privati e non andrebbero mai ridefiniti se non per cambiare
sostanzialmente il comportamento della classe a basso livello.


#### Proprietà

- `className` : 'Component' - Questa proprietà è stata introdotta a causa del fatto che javascript non è un linguaggio 
ad oggetti e per avere la possibilità di poter estendere le classi, è stato utilizzata un trucchetto. Questo trucchetto 
rende impossibile sapere, a runtime, in quale classe ci si trovi.

- `defaultTraitsTemplate` : ['TraitTranslate','TraitTemplate','TraitPlaceholder'] - vettore di traits definiti di default
in particolare :
    - `TraitTranslate` ha il compito per la sostituzione di tutti i marcatori data-label presenti nel template con le nostre 
    definizioni. Molto utile nei siti multi lingua, o dove ci sono delle parti di un html che hanno label variabili.
    - `TraitTemplate`: Ha il compito di poter spezzare un template complesso in sottotemplate magari interscambiabili.
    utilizza i marcatori data-template che si trovano dentro la stringa template e ci inietta il risultato della
    chiamata {valore}Template. Per esempio se dentro il marcatore data-template troviamo il valore *subItem* verrà chiamata
    il metodo componente.subItemTemplate() e il risultato sarà iniettato dentro il tag dove è presente il marcatore data-template="subItem" 
    - `TraitPlaceholder`: ha il compito di inserire il risultato della traduzione del valore del marcatore data-placeholder nell'attributo
    placeholder che si trovano negli input.
- `traitsTemplate` : [] - vettore di eventuali altri traits custom che vogliamo siano eseguiti subito dopo avere iniettato il template
- `traits` : [] - traits per estendere funzionalità del component senza ridefinirne la classe.
- `container` : null - rappresenta l'eventuale container html prensente nel dom della pagina dove verrà
disegnato il componente.

#### Metodi

- `init(attributes)`: costruttore, attributes rappresentano gli attributi
che si vogliono sostituire, è possibile passare anche delle function e ridefinire i metodi della classe
o aggiungerne dei nuovi. 

- `attrs(attrs)` : permettere di ridefinire proprietà o metodi dell'oggetto

- `template()` :  metodo che restituisce il template html del componente

- `getTemplate()` : metodo che un oggetto jquery('div') che wrappa il template del componente.

- `html()` : ritorna l'html puntato dalla proprietà container del componente
- `jQe(selector)` : ritorna l'oggetto jquery associato al container del componente, se viene
passato il parametro *selector* allora si posiziona all'elemento puntato dal selector all'interno
del container.

- `beforeRender(callback)` : questo metodo viene chiamato prima di eseguire il render. Questo metodo rappresenta
il primo punto in cui scrivere codice che si vuole eseguire prima di renderizzare il componente

- `render(callback)` : metodo dove viene iniettato nel container l'html del componente in 
base alle proprie politiche.

- `afterRender(callback)` : metodo che viene chiamato dopo il metodo render.

- `beforeFinalize(callback)` : metodo per il proprio codice custom chiamato prima del finalize
- `finalize(callback)` : metodo per aggiungere eventi o istanziare plugins 
- `afterFinalize(callback)` : metodo custom per eventuali esigenze su oggetti dopo che sono stati visualizzati agganciati
eventi e istanziati plugins.

- `_prepareContainer()`  : scrive l'html che viene restituito dal metodo *template* dentro il container.
Se il container è null viene creato un oggetto jquery contentente l'html. Dopo viene chiamato *_executeTraitsTemplate*

- `_executeTraitsTemplate()` : metodo eseguito dopo che si è scritto l'html. Utilizzare questo metodo
se si vogliono eseguire dei particolari filtri con il concetto di trait

- `_loadExternalResources(callback)` : carica eventuali risorse esterne prima di far partire il render del component
@param callback : funzione di ritorno 
    
- `draw(callback)` : disegna l'html del componente e poi richiama la callback.
Il metodo draw esegue in seguenza diversi metodi che vengono richiamati attraverso la
callback e che permettono la possibilità di definire il comporamento del componente mentre viene disegnato o di aggangiare
eventi custom. Tutti questi metodi hanno una callback come parametro che rappresenta la funzione da chiamare dopo che si
è finito di operare dentro il metodo. Questo modo di eseguire i metodi permette di poter inserire anche delle funzioni
asincrone aspettare il termine delle chiamate prima di procedere. Nello stesso tempo permette di bloccare il flusso
semplicemente non richiamando la callback. Sotto viene rappresentato il flusso delle chiamate del metodo draw.
 
   
    - `_loadExternalResources(callback)`;
    - `beforeRender(callback)`
    - `_prepareContainer()` 
    - `render(callback)`
    - `afterRender(callback)`
    - `beforeFinalize(callback)`
    - `finalize(callback)`
    - `afterFinalize(callback)`

`Component.parseHtml(templateString,tplData)` : metodo statico che crea un oggetto jquery eseguendo
il parse della stringa passata. In caso vengono passati dei con tplData tutti i tag che hanno il marcatore
data-field="field" vengono iniettati i valori. Vedere la sezione ... per ulteriori dettagli.

`Component.uid` = 0; variabile statica per la generazione di id univoci.

`Component.newID()` : metodo statico che ritorna un id univoco fomato da 'c_{int}'+ dove {int} è un intero incrementale


## Traits che agiscono sui template

coming soon.

## Render dei template con dati dinamici

coming soon