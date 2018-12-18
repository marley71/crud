# App

App è la classe per la gestione della pagina. Permette di aggiungere e cancellare view, 
creare dashboards ecc.


### Proprietà
- `resources` : [] - vettore di risorse iniziali della pagina da caricare 
- `pluginsPath` : '/cupparis4/plugins/' - directory base dove cercare i plugins da caricare
- `log` = null  : oggetto per il log dei messaggi, viene istanziato nel costruttore dell'app.
- `show_log` : false - se visualizzare o no i messaggi in console del browser
- `mobile` = false - se la libreria viene istanziata usu un mobile



### Metodi

- `getResources()` : vettore di tutte le risorse caricate dalla pagina
- `init(options,callback)` : metodo iniziale da chiamare subito dopo la new per inizializzare
l'applicazione
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
- `getHtmlConf` = function (jQe) 
   
- `parse` = function (container)  /**
                                    * esegue il parse di un container html e istanzia tutte le views trovate
                                    * @param container
                                    * @returns {Array} di views
                                    */


- `viewModal` = function (title,ViewConf,callback) 
- `dashboardModal` = function (title,dash,callback) 
- `getConf` = function (model,action,role) 
- `translate` = function (key,plural,params) 
- `translateIfExist` = function (key,plural,params) 
- `getLocale` = function () 
- `waitStart` = function (msg,container) 
- `waitEnd` = function (container) 
- `messageDialog` = function (body,callbacks) - crea una message dialog e ne ritorna l'oggetto
- `errorDialog` = function (body,callbacks) - crea una message dialog e ne ritorna l'oggetto
- `confirmDialog` = function (body,callbacks)
- `customDialog` = function (content,callbacks) 
- `progressDialog` = function (content,callbacks)
