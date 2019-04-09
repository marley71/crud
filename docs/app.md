# App

App è la classe per la gestione della pagina. Permette di aggiungere e cancellare view, 
creare dashboards ecc.


### Proprietà

- `resources` : [] - vettore di risorse iniziali della pagina da caricare 
- `pluginsPath` : '/cupparis4/plugins/' - directory base dove cercare i plugins da caricare
- `log` = null  : oggetto per il log dei messaggi, viene istanziato nel costruttore dell'app.
- `show_log` : false - se visualizzare o no i messaggi in console del browser
- `mobile` : false - se la libreria viene istanziata su un dispositivo mobile,
- `locale` : 'it' - locale di default, viene utilizzato per la configurazione delle date
- `autoparse` : false - se attivato, l'app controlla che quando viene inserito un tag html
                che possieda l'attributo 'crud-view' o 'crud-dashboard' attiva in automatico 
                la creazione della vista o dashboard definita nell'attributo.


### Metodi

- `getResources()` : vettore di tutte le risorse caricate dalla pagina
- `init(options,callback)` : metodo iniziale da chiamare subito dopo la new per inizializzare
l'applicazione
    - @param options : options dell'app
    - @param callback : funzione da richiamare al fine del caricamento
- `loadResource(fileName, callback)` : carica una risorsa script o css dinamicamente partendo dalla 
cartella pluginsPath. quando lo script e' stato caricato chiama la callback
    - @param fileName : path compreso dal filename della risorsa da caricare
    - @param callback : funzione da richiamare al fine del caricamento
- `loadResources(resources, callback)` : carica un vettore di risorse, al fine caricamento chiama la callback
    - @param resources : vettore risorse da caricare
    - @param callback : funzione da richiamare dopo il caricamento di tutte le risorse
- `addView(options)` : aggiunge una view, se in options la proprietà autorender=true la visualizza.
    - @param options : configurazione della view, deve essere un'istanza Conf.  
- `addDashboard(options)` : aggiunge una dashboard
    - @param options : opzioni per l'aggiunta di una dashboard
- `renderViews()` : renderizza tutte le view prensenti aggiunte precedentemente
- `renderView(key, callback)` : renderizza la view con chiave key e chiama la callback se passata
    - @param key : chiave della view da visualizzare
    - @param callback : opzionale, se passata viene chiamata quando la view e' stata visualizzata
- `getView(key)` : restituisce la view di chiave key, se esiste, altrimenti null.
    - @param key : chiave view da prendere
- `getViews()` : ritorna il vettore di tutte le views presenti in App.
- `getKeyFromId(htmlId)` : se il container html della view ha un id allora possiamo recuperare la chiave
della view tramite questo id.
    - @param htmlId : id html del container che contiene la view. 
    - @return : stringa che contiene la key della view
- `getViewById(htmlId)` : sel il container html della view ha un id allora possiamo recuperare direttamente la
view tramite questo id.
    - @param htmlId : id html del container che contiene la view. 
    - @return : oggetto view
- `removeViewById(htmlId)` : rimuove la view associata al container con quell'id.
    - @param htmlId : id html del container
- `removeAllViews()` : rimuove tutte le view istanziate.
- `removeView(key)` : rimuove la view associate alle key passata
    - @param key : chiave view che vogliamo cancellare 
- `renderViewById(htmlId,callback)` : renderizza una view che id html passato. Poi chiama la callback, se passata.
    - @param htmlId : id html del container che contiene la view
    - @param callback : opzionale, funziona da chiamare quando la view viene renderizzata
- `getHtmlConf(jQe)`: prende gli attributi dell'elemento jQuery *jQe* e crea la configurazione adatta
   
- `parse(container)`: esegue il parse di un container html e istanzia tutte le views o dashboards trovate.
    - @param container
    - @return {Array} di views
- `viewModal(title,ViewConf,callback)`: visualizza una view in modal.
    - @param title : 'Titolo della modale',
    - @param ViewConf : configurazione della view,
    - @param callback : callback che verrà richiamata quando la modale sarà chiusa
    - @return la key id della view presente nella modale 
- `dashboardModal` = function (title,dash,callback) 
- `getConf` = function (model,action,role) 
- `translate` = function (key,plural,params) 
- `translateIfExist` = function (key,plural,params) 
- `getLocale` = function () 
- `waitStart(msg,container)` : esegue l'animazione di wait 
    - @param : msg - messaggio da visualizzare nell'attesa
    - @param : container - opzionale, se settato, fa partire l'animazione wait sul container 
    altrimenti a tutta pagina. 
- `waitEnd(container)` : termina la wait 
    - @param : container : opzionale se settato toglie l'animazione wait dal container altrimenti a tutta 
    pagina. 
- `messageDialog(message,callbacks)` : crea una message dialog e ne ritorna l'oggetto
    - @param : message - messaggio d'errore da visualizzare
    - @param : callbacks :
- `errorDialog(message,callbacks)` : crea una error dialog  e ne ritorna l'oggetto
    - @param : message - messaggio d'errore da visualizzare
    - @param : callbacks : 
- `confirmDialog(message,callbacks)` : crea una dialog di conferma
    - @param : message - domanda da visualizzare
    - @param : callbacks :
- `customDialog(content,callbacks)` : Visualizzazione di una modale con il conten custom
    - @param : content : 
    - @param : callbacks :    
- `progressDialog` = function (content,callbacks)
