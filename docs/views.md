## View

L'insieme delle `Views` estende la componente `c-omponent` rappresenta il contenitore di 
dati associate ad un modello di dati. Questi dati possono essere passati manualmente o 
attraverso un server, utilizzando le route che usano le convenzioni REST che restituiscano dati 
in formato json.
Nella libreria le route sono parametriche rispetto al nome del modello dati e in base alla chiave
primaria in caso di singolo record. E' stata definita una classe base

##v-base
Componente base di tutte le views. Deve essere considerato come un componente astratto.
La sua definizione è in `crud.views.wBase`

####components
- v-widget :
- v-action : 

####data 
viewTitle : default '' titolo della view
langContext : default '' eventuale contesto per la traduzione in lingua delle label presenti nella view.

####metodi
- fecthData(route,callback) : metodo per il caricamento dei dati callback di ritorno dopo aver 
caricato i dati.
- getActionConfig(name,type) : che ritorna la configurazione di un'azione in base al name e al tipo
- _loadConf(modelName,type) : politica per il caricamento della configurazione iniziale della view. 
Se cConf è una stringa viene cercata come definizione di window, se non trovata viene cercata in crud.conf.
Se cConf non viene passata viene cercata una definizione globale della window composta cosi'. window.Model+
pascalCase(modelName)[type]. Nel caso di type uguale a insert se non esiste viene cercato il type edit.
- defaultWidgetConfig : function(key,configName) : ritorna la configurazione minimale di base di un widget rispettando 
le priorita' tra le configurazioni. key : nome del campo di cui vogliamo la configurazione. confiName : nome variabile 
configurazione nell'oggetto conf. (opzionale)
- getFieldName(key) : ritorna il nome da utilizzare per il controllo html della form.


##v-record 
Estende il compomente v-base per la gestione di dati provenienti da un singolo record di un modello dati. 
Deve essere considerato come componente astratto che viene esteso da tutte le views che gestiscono un singolo record.
La sua definizione è in `crud.components.views.wRecord`

####props
- cModel,
- cPk

####metodi
- `setWidgetValue(key,value)`: metodo per settare il valore di un widget.
- `createWidgets()` : metodo per la creazione delle configurazioni dei widgets della view.
- `createActions()` : metodo per la creazione del vettore di tutte le azioni da creare.
- `createActionsClass()` : metodo per la creazione delle configurazioni delle azioni presenti nel vettore.
- `fillData(route,json)` : metodo per il propolamento del proprietà data della view. Se route è null allora viene presa
l'eventuale data di travato in cConf.data. Se route è valorizzata viene chiamata la classe Protocol definita nella 
route che ha il compito di riempire la proprietà data.
- `getViewData()` : ritorna la serializzazione di tutti i controlli della form, se presente.
- `getWidget(key)` : ritorna il widget associato alla key.
- `getAction(name)` : ritorna l'azione di nome name.

##v-collection
Estende il compomente v-base per la gestione di una collezione di record di un modello dati. 
Deve essere considerato come componente astratto 
che viene esteso da tutte le views che gestiscono una collection record.
La sua definizione è in `crud.components.views.wCollection`
   
####props
- cModel


####Metodi

- `setWidgetValue(row,key,value)` metodo per settare il valore di un widget alla riga row e nome key.
- `createWidgets()` : metodo per la creazione delle configurazioni dei widgets della view.
- `getKeys()` : ritorna le chiavi da visualizzare nella view.
- `getWidget(row,key)` : ritorna il wiget associato alla row,key.
- `createActions()` : crea i due vettori delle definizioni delle azioni da istanziare.  collectionActionsName,
recordActionsName
- `createRecordActions(row)` : crea le azioni da associare alla row.
- `createCollectionActions()` : crea le azioni da associare all'intera view.


# Views Implementate
Nella libreria sono state implementate delle views di uso comune
DAFINIRE

## v-list
E' una collection view che renderizza i risultati su un template tabellare, viene popolata attraverso la *RouteList* che prevede come parametro il modelName, questa view è composta dal
template principale piu' altri template delle varie sezioni di una lista. Questo permette di poter configurare
le singole parti in modo più puntuale. 
DAFINIRE
---

##v-list-edit
DAFINIRE

---

##v-insert
E' una view per la creazione di un nuovo record. Utilizza la route RouteInsert per il 
caricamento dei dati e la RouteSave per il salvataggio
DAFINIRE
---


##v-edit
E' una view per la modifica di un record. Utilizza la route RouteEdit per il caricamento
e la RouteUpdate per il salvataggio
DAFINIRE
---

##v-search
E' una view per effettuare una ricerca.
DAFINIRE
---

##v-view
E' una view per visualizzare i risultati in modalità lettura.
DAFINIRE
---

##v-hasmany
DAFINIRE
---

##v-hasmany-view
DAFINIRE
---
