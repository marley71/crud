#CrudApp

CrudApp è la classe per la gestione dell'applicazione. Estende Vue, definisce due mixin
- `core_mixin` : qui vengono definiti metodi di utilità generale.
- `dialogs_mixin` : metodi generali per la gestione di dialog.


####data

- `templatesFile` : defaul '/crud-vue/crud-vue.html' file html dove si trovano tutti i template dei vari
widgets,views e componenti in generale. 
- `el` : default '#app', contenitore della nostra applicazione
- `appConfig` = null  : eventuale file javascript per le modifiche della configurazione iniziale `crud`


###core_mixin

####metodi

- `waitStart : function (msg,container)`
- `waitEnd : function (component)`
- `_createContainer : function (container)`
- `translate : function (key,plural,params)`
- `createRoute : function(routeName)` 
- `createProtocol : function(name)` 
- `getDescendantProp : function(obj, desc)` 
- `getFormData : function (form)` 
- `sentenceCase : function (str)`
- `camelCase : function (string)`
- `costantCase : function (string)` 
- `dotCase : function (string)` 
- `isLowerCase : function (string)`
- `isUpperCase : function (string)` 
- `lowerCase : function (str)` 
- `paramCase : function (string)` 
- `pascalCase : function (string)` 
- `pathCase : function (string)` 
- `snakeCase : function (string)` 
- `swapCase : function (str)` 
- `titleCase : function (string)` 
- `upperCase : function (str)` 
-` upperCaseFirst : function (str)`
- `cloneObj : function (obj)` 
- `confMerge : function(obj1,obj2)` 
- `merge : function(obj1, obj2)` 
- `getAllUrlParams : function (url)` :ritorna i parametri sotto forma di vettore associativo di un 
url altrimenti di location.search.
              
  

- `loadResources : function(resources, callback)` {
carica un vettore di risorse, al fine caricamento chiama la callback
 @param resources
@param callback

          
- `loadResource : function (fileName, callback)` {
carica una risorsa script o css dinamicamente partendo dalla cartella
pluginsPath quando lo script e' stato caricato chiama la callback
 @param fileName
@param callback

-` getRefId : function ()` : costruisce il riferimento id di un compoenente utilizzando la concatenazione
          degli argomenti passati con "-"; 
- `_loadHtml  : function (fileName,callback)` 
             
- `_loadScript : function (scriptName, callback) `
  
- `_loadCss : function (scriptName,callback)` 


###dialogs_mixin

####metodi

- `messageDialog : function (bodyProps,callbacks)`
- `errorDialog : function (bodyProps,callbacks)`
- `confirmDialog : function (bodyProps,callbacks)`
- `warningDialog : function (bodyProps,callbacks)`
- `customDialog : function (bodyProps,callbacks)`
- `popover : function (message,classes,time)`
- `popoverSuccess : function (message,time)`
- `popoverError : function (message,time)`
- `popoverInfo : function (message,time)`
- `popoverWarning : function (message,time)`
- `_popover : function (message,classes,time)`
