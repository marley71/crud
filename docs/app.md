#App

App è la classe per la gestione della pagina. Permette di aggiungere e cancellare view, 
creare dashboards ec


##Proprietà
-App.resources = [];     // vettore di risorse iniziali da caricare
     App.pluginsPath = '/cupparis4/plugins/';
     App.log = null;
     App.show_log = false;
     App.mobile = false;



##Metodi

- getResources = function () - vettore di tutte le risorse caricate dalla pagina
- init = function(options,callback) metodo iniziale da chiamare subito dopo la new per inizializzare
l'applicazione
- loadResource = function (fileName, callback) - carica una risorsa script o css dinamicamente partendo dalla cartella
                                                      * pluginsPath quando lo script e' stato caricato chiama la callback
                                                      * @param fileName
                                                      * @param callback

    
- loadResources = function(resources, callback) /**
                                                     * carica un vettore di risorse, al fine caricamento chiama la callback
                                                     * @param resources
                                                     * @param callback
                                                     */


- addView = function (options) 
- addDashboard = function(options)
- renderViews = function () - renderizza tutte le view prensenti nella pagina
- renderView = function (key, callback) 
- getView = function (key) 
- getViews = function ()
- getKeyFromId = function (htmlId) 
- getViewById = function(htmlId)
- removeViewById = function (htmlId) 
- removeAllViews = function () 
- removeView = function(key) 
- renderViewById = function (htmlId,callback) 
- getHtmlConf = function (jQe) 
   
- parse = function (container)  /**
                                    * esegue il parse di un container html e istanzia tutte le views trovate
                                    * @param container
                                    * @returns {Array} di views
                                    */


- viewModal = function (title,ViewConf,callback) 
- dashboardModal = function (title,dash,callback) 
- getConf = function (model,action,role) 
- translate = function (key,plural,params) 
- translateIfExist = function (key,plural,params) 
- getLocale = function () 
- waitStart = function (msg,container) 
- waitEnd = function (container) 
- messageDialog = function (body,callbacks) - crea una message dialog e ne ritorna l'oggetto
- errorDialog = function (body,callbacks) - crea una message dialog e ne ritorna l'oggetto
- confirmDialog = function (body,callbacks)
- customDialog = function (content,callbacks) 
- progressDialog = function (content,callbacks)
