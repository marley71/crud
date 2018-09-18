# Confs

Le Confs sono nate per creare configurazioni iniziali per le views di uso generale.
Questo permette di avere, con pochissimo codice, la configurazione
della view da utilizzare e modificare solo dove occorre. 

##CoreConf

La Classe CoreConfs è la classe base che ereditano tutte le confs. Il costrutture 
accetta un vettore associativo per la sostituizione di proprietà della configurazione che 
andiamo ad instanziare. 

###Proprietà
- `routeName`: Indica la route da utilizzare per il caricamento dei dati della view. 
Su routeName verrà utilizzata la convenzione del metodo statico 
<a href="/routes#">CoreRoute.factory(routeName)</a>. 
- `viewClass`: Indica la classe view da utilizzare. Esempio *ViewList*
- `actions`: Vettore di azioni presenti nella view. La visualizzazione delle actions 
sarà compito della view secondo le sue strategie di visualizzazione.
- `extra_actions`: Vettore di azioni con la loro definizione nel caso in cui 
nel vettore actions  siano indicate azioni custom o azioni che ridefiniscono quelle
di default.
- `fields`: Il Vettore dei campi che deve essere gestito dalla views.
- `detail_fields`: Il Vettore di campi che hanno anche un dettaglio. Sono campi particali
come le aggregazioni, totale di una lista di records.
- `pagination`: Valido solo per le liste, contiene le informazioni sulla paginazione
dei risultati.
- `fields_type` : Vettore della definizione del tipo di tutti i campi presenti in *fields* 
con le loro eventuali estensioni.
- `dependencies`: Vettore associativo di oggetti Dipendence per permettere l'interazione
tra due campi diversi. 
- `fields_structure` : Indica la classe struttura da utilizzare per renderizzare i
campi. 

###Metodi

- `__costruct(attrs)`: attrs rappresenta il vettore associativo per la ridefinizione
di alcune proprietà di confs.

#Configurazioni implementate
Nella libreria ci sono già delle configurazioni di uso comune per ogni oggetto vista 
implementato di default.

##- ListConfs

Rappresenta la configurazione base utilizzare nella creazione di una Views.

```javascript
var ListConfs = CoreConf.extend({
    routeName : 'list',
    viewClass : 'ViewList',
    actions : ['actionDelete','actionMultiDelete','actionEdit','actionView','actionInsert'],
    extra_actions : {},
    fields : [],
    detail_fields: {},
    pagination : true,
    fields_type: {
        id :            {type:'hidden'},
        created_at:     {type:'hidden'},
        updated_at:     {type:'hidden'},
        deleted_at:     {type:'hidden'},
        created_by:     {type:'hidden'},
        updated_by:     {type:'hidden'},
        descrizione	:   {type:'hidden'},
        activated:      {type: 'swap','mode': 'edit'},
        verified:       {type: 'swap','mode': 'edit'},
        fotos:          {type: 'hasmany_upload_image',limit:1},
        attachments:    {type: 'hasmany_upload_attachment',limit:1},
        data:           {type: 'date_picker'}
    }
});
```
##- EditConfs

```javascript
var EditConfs = CoreConf.extend({
    viewClass : 'ViewEdit',
    actions : ['actionSave','actionBack'],
    extra_actions : {},
    labels: 'left',
    fields: [],
    fields_type: {
        id: {type:'input'},
        created_at: {type:'hidden'},
        updated_at: {type:'hidden'},
        deleted_at: {type:'hidden'},
        created_by: {type:'hidden'},
        updated_by: {type:'hidden'},
        activated:  {type: 'radio'},
        descrizione: {type: 'texthtml'},
        body: {type: 'texthtml'},
        note: {type: 'texthtml'},
        fotos: {type: 'hasmany_upload_image', 'label': 'no'},
        attachments: {type: 'hasmany_upload_attachment', 'label': 'no'},
        data: {type: 'date_picker'},
        data_formatted: {type:'hidden'},
        status: {type:'hidden'},
        token: {type:'hidden'},
        captcha: {type: 'captcha'},
    },
    dependencies : {}
});
```


##- InsertConfs

```javascript
var InsertConfs = EditConfs.extend({
    viewClass : 'ViewInsert',
});
```

##- SearchConfs

```javascript
var SearchConfs = CoreConf.extend({
    viewClass : 'ViewSearch',
    actions : ['actionSearch','actionReset'],
    extra_actions : {},
    fields:[],
    fields_type : {},
});
```

##- ViewConfs

```javascript
var ViewConfs = CoreConf.extend({
    viewClass : 'ViewView',
    labels: 'left',
    actions : [],
    extra_actions : {},
    fields : [],
    fields_type: {
        attivo: {type: 'swap'},
        fotos : {type: 'hasmany_upload_image'},
        attachments: {type: 'hasmany_upload_attachment'},
        id: {type:'hidden'},
        created_at: {type:'hidden'},
        updated_at: {type:'hidden'},
        deleted_at: {type:'hidden'},
        created_by: {type:'hidden'},
        updated_by: {type:'hidden'}
    }
});
```



