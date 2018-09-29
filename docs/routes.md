# Routes

##Route
Class base per la gestione delle route verso il backend. Sono state definite
alcune route delle principali di interazioni con il backend
 secondo le specifiche REST.

###Proprietà

- `className` default "Route" variabile di comodo per riconoscere in quale route ci troviamo
- `method` default null rappresenta il metodo usato per la chiamata ajax, può essere get o post
- `url` default null rappresenta l'url che deve essere composto per eseguire la chiamataa 
    Le parti variabili devono essere racchiuse tra parentesi graffe. Per esempio : /action/{var1}/print è un
    url in cui {var1} verrà sostituita con il valore che l'oggetto Route ha in quel momento.
- `resultType` default  null tipo di risultato, può essere record o list
- `protocol` default null nome della classe protocollo da utilizzare per applicare eventuali
 elaborazioni sui dati dopo averli ricevuti. Di default sono stati implementati due protocolli: 
    - ListProtocol
    - RecordProtocol
- `extraParams`  : {}, parametri statici da aggiungere sempre alla chiamata prima di eseguire la richiesta 
al server.
- `values` : {}, vettore associativo con il valore dei parametri per la costruzione dell'url
- `params` :{} vettore associativo dei parametri passati nella richiesta. Prima
della richiesta vengono sommati agli extraParams
    
###Metodi    
    
- `__costruct(attrs)` costruttore. Accetta come parametro un vettore associativo che permette
di sovrascrivere le proprietà dell'oggetto creato.


- `getUrl(values)` ritorna url esatto valorizzando le variabili parametriche tra {} 
presenti nella stringa url. Il parametro *values* è il vettore associativo dei valori
attuali per valorizzare le variabili. Se non viene passato prende i valori presenti
nell'oggetto nel vettore values
    
- `getParams` ritorna tutti i parametri che verranno passati nella richiesta. L'unione
tra params ed extra_params dell'oggetto
    
- `getKeys` ritorna un vettore con tutte le keys necessarie per la composizione dell'ulr
della route che devono essere valorizzati per ritornare l'url esatto. Peer esempio 
se url e' fatto come /pippo/{param1}/{param2} ritorna ['param1','param2']
                 
#Route Implementate
La libreria contiene già delle route per l'uso comune che vengono utilizzate dalle views
e dalle actions. Per la creazione di una route è stato realizzato un pseduo metodo statico
chiamato factory. Se vogliamo utilizzare il metodo factory dobbiamo rispettare la convenzione
sui nomi. Chiamare il factory('list') il metodo cercherà l'esistenza della classe
RouteList, se chiamiamo il factory('list_mia') il metodo cercherà l'esistenza
della classe RouteListMia. In altre parole sul nome passato al metodo factory viene
applicata la funziona 'pascal case' concatenato con il prefisso *Route*


- `Route.factory(type,attrs)` questo metodo istanzia una Route di tipo type
passando al costruttore gli attrs. Alla variabile type viene applicata la trasformazione
pascal case e aggiunto il prefisso *Route*. Per esempio se vogliamo istanziare un oggetto chiamato RouteList si chiama il metodo
statico :

```javascript
var r = Route.factory('list',{
    values : {
        modelName : 'user'
    }
});
```

Questo codice crea un'instanza della classe RouteList e il vettore associativo values
prenderà come valori quelli passati.

##- RouteList
la route è stata creata per recuperare una lista di record del modello specificato.
Nel vettore *values* deve essere presente la chiave:

 - `modelName`: rappresenta il nome del modello.
 
```javascript
{
	"url": "/api/json/{modelName}",
	"protocol": "list",
	"resultType": "list",
	"method": "get",
	"keys": [
		"modelName"
	]
}
``` 

##- RouteEdit
La route carica i dati di un record per la modifica.
Nel vettore *values* devono essere presenti le chiavi:

- `modelName`: rappresenta il nome del modello.
- `pk`: rappresenta l'id che identifica il record specifico

```javascript
{
	"url": "/api/json/{modelName}/{pk}/edit",
	"protocol": "record",
	"resultType": "record",
	"method": "get",
	"keys": [
		"modelName",
		"pk"
	]
}
``` 

##- RouteSearch
La route che chiede i dati di un record per la ricerca.
Nel vettore *values* deve essere presente la chiave:

 - `modelName`: rappresenta il nome del modello.


```javascript
{
	"url": "/api/json/{modelName}/search",
	"protocol": "record",
	"resultType": "record",
	"method": "get",
	"keys": [
		"modelName"
	]
}
``` 


##- RouteInsert
La route che chiede i dati di un record per l'inserimento.
Nel vettore *values* deve essere presente la chiave:

 - `modelName`: rappresenta il nome del modello.


```javascript
{
	"url": "/api/json/{modelName}/create",
	"protocol": "record",
	"resultType": "record",
	"method": "get",
	"keys": [
		"modelName"
	]
}
``` 


##- RouteSave
La route che invia i dati di un record per crearlo. I dati del modello verranno passati
come params. In questa route viene aggiunto sempre un parametro chiamato _method='POST' che 
serve a simulare il metodo save REST attraverso la chiamata http.

Nel vettore *values* deve essere presente la chiave:

 - `modelName`: rappresenta il nome del modello.


```javascript
{
	"url": "/api/json/{modelName}/create",
	"protocol": "record",
	"resultType": "record",
	"method": "post",
	"keys": [
		"modelName"
	],
	"extra_params": {
		"_method": "POST"
	}
}
``` 


##- RouteUpdate
La route che invia i dati di un record per la modifica. I dati del modello verranno passati
come params. In questa route viene aggiunto sempre un parametro chiamato _method='PUT' che 
serve a simulare il metodo put REST attraverso la chiamata http.
Nel vettore *values* devono essere presenti le chiavi:

- `modelName`: rappresenta il nome del modello.
- `pk`: rappresenta l'id che identifica il record specifico

```javascript
{
	"url": "/api/json/{modelName}/{pk}",
	"protocol": "record",
	"resultType": "record",
	"method": "post",
	"keys": [
		"modelName",
		"pk"
	],
	"extra_params": {
		"_method": "PUT"
	}
}
``` 


##- RouteView
La route che chiede i dati di un record in modalità lettura.
Nel vettore *values* devono essere presenti le chiavi:

- `modelName`: rappresenta il nome del modello.
- `pk`: rappresenta l'id che identifica il record specifico

```javascript
{
	"url": "/api/json/{modelName}/{pk}",
	"protocol": "record",
	"resultType": "record",
	"method": "get",
	"keys": [
		"modelName",
		"pk"
	]
}
``` 


##- RouteDelete
La route che rimuove un record. In questa route viene aggiunto sempre un parametro chiamato 
_method='DELETE' che serve a simulare il metodo delete REST attraverso la chiamata http.
Nel vettore *values* devono essere presenti le chiavi:

- `modelName`: rappresenta il nome del modello.
- `pk`: rappresenta l'id che identifica il record specifico

```javascript
{
	"url": "/api/json/{modelName}/{pk}",
	"protocol": "record",
	"resultType": "record",
	"method": "post",
	"keys": [
		"modelName",
		"pk"
	],
	"extra_params": {
		"_method": "DELETE"
	}
}
``` 


##- RouteMultiDelete
La route che rimuove una lista di record. La lista viene passata come vettore di id
nei params.
Nel vettore *values* deve essere presente la chiave:

 - `modelName`: rappresenta il nome del modello.

```javascript
{
	"url": "/api/json/{modelName}/deleteall",
	"protocol": "record",
	"resultType": "record",
	"method": "post",
	"keys": [
		"modelName"
	]
}
``` 



