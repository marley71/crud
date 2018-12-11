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
- `addView(options)` : function  
- addDashboard = function(options)
- `renderViews` = function () - renderizza tutte le view prensenti nella pagina
- `renderView` = function (key, callback) 
- `getView` = function (key) 
- `getViews` = function ()
- `getKeyFromId` = function (htmlId) 
- `getViewById` = function(htmlId)
- `removeViewById` = function (htmlId) 
- `removeAllViews` = function () 
- `removeView` = function(key) 
- `renderViewById` = function (htmlId,callback) 
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
